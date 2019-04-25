<?php

/**
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

use Heis\Dice\Dice;

/**
 * Init the guess-game and direct to play the game.
 */
$app->router->get("dice/init", function () use ($app) {
    // Init the session too start the game.
    $game = new Heis\Dice\DiceBoard();
    $_SESSION["game"] = $game;

    return $app->response->redirect("dice/play");
});



/**
 * Play the game, show status.
 */

 $app->router->get("dice/play", function () use ($app) {
     $title = "Play the game";
     $board = $_SESSION["game"] ?? new Heis\Dice\DiceBoard();

     $data = [
         "board" => $board,
     ];

     $app->page->add("dice/play", $data);

     return $app->page->render([
         "title" => $title,
     ]);
 });



 $app->router->post("dice/roll", function () use ($app) {
    $board = $_SESSION["game"] ?? null;
    if ($board == null) {
        return $app->response->redirect("dice/init");
    }

    $player = $board->getPlayer1();

    $hand = new Heis\Dice\DiceHand();
    $hand->roll();

    $player->currentHand()->addHandToHand($hand);

     //if player has won, the result is saved in the table
    if ($player->hasWon($player->currentHand())) {
        $player->addHandToList($player->currentHand());
    }

    return $app->response->redirect("dice/play");
 });



 $app->router->post("dice/next", function () use ($app) {
    $board = $_SESSION["game"] ?? null;
    if ($board == null) {
        return $app->response->redirect("dice/init");
    }

    $currentPlayer = $board->getCurrentPlayer();
    $board->nextPlayer();

      // get to next round computer rolled his dices
    if ($currentPlayer == $board->getComputer()) {
        $board->nextRound();

      // when player1 activate"next"
      // we roll the dices for the computer
    } else {
        $board->playComputer();
    }

    return $app->response->redirect("dice/play");
 });
