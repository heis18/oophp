<?php
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
    // $game = new Heis\Dice\DiceGame();
    // $_SESSION["game"] = $game;

    return $app->response->redirect("dice/play");
});



/**
 * Play the game, show status.
 */

 $app->router->get("dice/play", function () use ($app) {
     $title = "Play the game";

     $board= new Heis\Dice\DiceBoard();

     $p1 = $board->getPlayer1();
     $c1 = $board->getComputer();

     //$hand = new Heis\Dice\DiceHand(0);
     // $hand->roll();
     // $p1->addHandToList($hand);
     //$hand = new DiceHand();
     //$c1->addHandToList($hand);
     //$hand = new Heis\Dice\DiceHand();
     $hand = $p1->currentHand();
     $hand->roll();
     //$p1->addHandToList($hand);





     $data = [
         "board" => $board,
     ];

     $app->page->add("dice/play", $data);

     return $app->page->render([
         "title" => $title,
     ]);
 });



 $app->router->post("dice/roll", function () use ($app) {



   return $app->response->redirect("dice/play");

 });



 $app->router->post("dice/save", function () use ($app) {



   return $app->response->redirect("dice/play");

 });




 $app->router->post("dice/player2", function () use ($app) {



   return $app->response->redirect("dice/play");

 });
