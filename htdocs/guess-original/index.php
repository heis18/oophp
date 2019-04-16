
<?php

include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");

session_name("heis18");
session_start();

// Deal with incoming variables
$guess    = $_POST["guess"] ?? null;
$doInit   = $_POST["doInit"] ?? null;
$doGuess  = $_POST["doGuess"] ?? null;
$doCheat  = $_POST["doCheat"] ?? null;


if (!isset($_SESSION["game"])) {
    $_SESSION["game"] = new Guess();
} elseif ($doInit != null) {
    $_SESSION["game"] = new Guess();
}


$game = $_SESSION["game"];

if ($doGuess != null) {
    try {
        $res = $game->makeGuess($guess);
    } catch (GuessException $e) {
        $res = $e->getMessage();
    }
}


require __DIR__ . "/view/guess_number_render.php";
