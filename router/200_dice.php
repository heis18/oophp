<?php

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
     $data = [
         "who" => "Isåfjäll",
     ];

     $app->page->add("dice/play", $data);

     return $app->page->render([
         "title" => $title,
     ]);
 });
