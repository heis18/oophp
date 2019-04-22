<?php

/**
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

use Heis\Dice\Dice;

/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



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



 $app->router->post("dice/roll/", function () use ($app) {
     $board = $_SESSION["game"] ?? null;


     if ($board == null) {
       return $app->response->redirect("dice/init");
     }

     $player = $board->getPlayer1();

     $hand = new Heis\Dice\DiceHand();
     $hand->roll();


     if ($player->isHandValid($hand)) {
       $player->currentHand()->addHandToHand($hand);
     } else {
       $player->currentHand()->addHandToHand($hand);
     }

   return $app->response->redirect("dice/play");

 });


 $app->router->post("dice/next", function () use ($app) {
   $board = $_SESSION["game"] ?? null;
   if ($board == null) {
     return $app->response->redirect("dice/init");
   }

     $player = $board->getPlayer1();
     $computer = $board->getComputer();
     $currentPlayer = $board->getCurrentPlayer();
     $board->nextPlayer();

     if ($currentPlayer == $computer) {
       $board->nextRound();
     }


   return $app->response->redirect("dice/play");
 });



 $app->router->post("dice/player2", function () use ($app) {
   $board = $_SESSION["game"] ?? null;
   if ($board == null) {
     return $app->response->redirect("dice/init");
   }

   $player = $board->getComputer();

   $hand = new Heis\Dice\DiceHand();
   $hand->roll();

   if ($player->isHandValid($hand)) {
      if ($hand->sum() <11) {
        $hand2 = new Heis\Dice\DiceHand();
        $hand2->roll();
        $hand->addHandToHand($hand2);
      }
   }

   $player->currentHand()->addHandToHand($hand);

  return $app->response->redirect("dice/play");

 });
