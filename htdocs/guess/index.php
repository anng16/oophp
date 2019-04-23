<?php
/**
 * Main program for the guess game
 *
 */
// Include config and autoloader
include(__DIR__ . '\autoload.php');
include(__DIR__ . '\config.php');

// Check to see if the game should be initialized
if (isset($_SESSION['game'])) {
    if ($_SESSION['game']->number == -1) {
        $_SESSION['game']->random();
    }
} elseif (!(isset($_SESSION['game']))) {
    $_SESSION['game'] = new Guess();
    $_SESSION['game']->random();
}

// Set variables to empty to avoid error message on first page-load
$gissning = '';
$message = '';

// Display messages if they exist
if (isset($_SESSION['guess'])) {
    $gissning = $_SESSION['guess'];
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}

$triesLeft = 'You have ' . $_SESSION['game']->tries() . ' tries left';

// Render page for guessing
require(__DIR__ . '/view/guess_page.php');
