<?php

include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");


// Deal with incoming variables
$number   = $_POST["number"] ?? null;
$tries    = $_POST["tries"] ?? null;
$guess    = $_POST["guess"] ?? null;
$doInit   = $_POST["doInit"] ?? null;
$doGuess  = $_POST["doGuess"] ?? null;
$doCheat  = $_POST["doCheat"] ?? null;

//Init the game
if ($doInit || $number === null) {
    $number = rand(1, 100);
    $tries = 5;
  // header("Location: index_get.php?tries=$tries&number=$number")
} elseif ($doGuess) {
    // Do a guess
    $tries -= 1;
    if ($guess === $number) {
        $res = "CORRECT";
    } elseif ($guess > $number) {
        $res = "TOO HIGH";
    } else {
        $res = "TOO LOW";
    }
}

require __DIR__ . "/view/guess_number_render.php";
