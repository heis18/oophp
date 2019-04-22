<?php

/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the guess-game and direct to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    // Init the session too start the game.
    $game = new Heis\Guess\Guess();
    $_SESSION["game"] = $game;

    return $app->response->redirect("guess/play");
});



/**
 * Play the game, show status.
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";

    $game = $_SESSION["game"] ?? null;
    $res = $_SESSION ["res"] ?? null;
    $guess = $_SESSION["guess"] ?? null;
    $lastAction = $_SESSION["last_action"] ?? null;

    $_SESSION["res"] = null;
    $_SESSION["guess"] = null;
    $_SESSION["last_action"] = null;

    $data = [
      "guess" => $guess ?? null,
      "doInit" => $doInit ?? null,
      "doGuess" => $lastAction == "guess",
      "doCheat" => $lastAction == "cheat",
      "game" => $game,
      "res" => $res
    ];

    $app->page->add("guess/play", $data);
    $app->page->add("guess/debugg", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * Play the game, make a guess.
 */
 $app->router->post("guess/play", function () use ($app) {

    // Deal with incomming variables
    $guess    = $_POST["guess"] ?? null;
    $doInit   = $_POST["doInit"] ?? null;
    $doGuess  = $_POST["doGuess"] ?? null;
    $doCheat  = $_POST["doCheat"] ?? null;

    // Get current settings from SESSION
    if (!isset($_SESSION["game"])) {
       // Do a guess
        $_SESSION["game"] = new Heis\Guess\Guess();
    } elseif ($doInit != null) {
        $_SESSION["game"] = new Heis\Guess\Guess();
    }

    $game = $_SESSION["game"];

    $_SESSION["last_action"] = null;
    if ($doGuess != null) {
        try {
            $res = $game->makeGuess($guess);
            $_SESSION["last_action"] = "guess";
            $_SESSION["res"] = $res;
            $_SESSION["guess"] = $guess;
        } catch (Heis\Guess\GuessException $e) {
            $res = $e->getMessage();
            $_SESSION["last_action"] = "guess";
            $_SESSION["res"] = $res;
            $_SESSION["guess"] = $guess;
        }
    } else if ($doCheat) {
        $_SESSION["last_action"] = "cheat";
    }

     return $app->response->redirect("guess/play");
 });
