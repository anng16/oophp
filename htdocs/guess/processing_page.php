<?php
/**
 * The processing page for the game
 *
 */
include(__DIR__ . '\autoload.php');
include(__DIR__ . '\config.php');

if (isset($_POST['gissa'])) {
    $_SESSION['guess'] = $_POST['gissning'];
    $_SESSION['message'] = 'Which is ' . $_SESSION['game']->makeGuess($_SESSION['guess']);
    $_SESSION['action'] = 'Made guess';
} elseif (isset($_POST['reset'])) {
    $_SESSION['action'] = 'reset';
    $_SESSION['message'] = 'Game reset';
    $_SESSION['game']->random();
    $_SESSION['guess'] = 'You have yet to make a guess';
} elseif (isset($_POST['fuska'])) {
    $_SESSION['action'] = 'fuska';
    $_SESSION['message'] = 'The number is ' . $_SESSION['game']->number();
}

$url = "./index.php";
header("Location: $url");
