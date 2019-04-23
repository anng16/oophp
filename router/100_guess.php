<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game.
 */
$app->router->get("guess-game/init", function () use ($app) {
    // init session for the game
    $game = new Anng\Guess\Guess();
    $game->random();

    $_SESSION['number'] = $game->number();
    $_SESSION['tries'] = $game->tries();

    return $app->response->redirect("guess-game/play");
});

/**
 * Play the game, main page
 */
$app->router->get("guess-game/play", function () use ($app) {
    // Get current settings from SESSION
    $tries = $_SESSION["tries"] ?? null;
    $res = $_SESSION["res"] ?? null;
    $guess = $_SESSION["guess"] ?? null;

    // Reset settings in SESSION
    $_SESSION["res"] = null;
    $_SESSION["guess"] = null;

    $data = [
        "guess"     => $guess ?? null,
        "tries"     => $tries,
        "number"    => $number ?? null,
        "res"       => $res,
        "doGuess"   => $doGuess ?? null,
        "doCheat"   => $doCheat ?? null,
    ];

    $app->page->add("guess/play", $data);
    $app->page->add("guess/debug");

    return $app->page->render([
        // Set the title for the page
        "title" => 'Gissa nummret',
    ]);
});

/**
 * Reset the game.
 */
$app->router->get("guess-game/reset", function () use ($app) {
    // Get current settings from the SESSION
    $number = $_SESSION["number"] ?? null;
    $tries = $_SESSION["tries"] ?? null;

    $game = new Anng\Guess\Guess($number, $tries);
    $game->random();
        
    $_SESSION['number'] = $game->number();
    $_SESSION['tries'] = $game->tries();

    return $app->response->redirect("guess-game/play");
});

/**
 * Cheat in the game
 */
$app->router->get("guess-game/cheat", function () use ($app) {
    // Get current settings from the SESSION
    $number = $_SESSION["number"] ?? null;
    $tries = $_SESSION["tries"] ?? null;

    $game = new Anng\Guess\Guess($number, $tries);
    $_SESSION["res"] = 'Cheater.. The number is ' . $game->number();

    return $app->response->redirect("guess-game/play");
});

/**
 * Make a guess in the game
 */
$app->router->get("guess-game/guess", function () use ($app) {
    // Get current settings from the SESSION
    $number = $_SESSION["number"] ?? null;
    $tries = $_SESSION["tries"] ?? null;
    $guess = $_SESSION["guess"] ?? null;

    $game = new Anng\Guess\Guess($number, $tries);
    $res = $game->makeGuess($guess);
    $_SESSION["tries"] = $game->tries();
    $_SESSION["res"] = $res;
    $_SESSION["guess"] = $guess;

    return $app->response->redirect("guess-game/play");
});

/**
 * Play game, decide which action / redirect to take.
 */
$app->router->post("guess-game/play", function () use ($app) {
    // Deal with incoming variables
    $guess = $_POST["gissning"] ?? null;
    $doGuess = $_POST["gissa"] ?? null;
    $doInit = $_POST["reset"] ?? null;
    $doCheat = $_POST["fuska"] ?? null;

    if ($doGuess) {
        $_SESSION["guess"] = $guess;
        return $app->response->redirect("guess-game/guess");
    } elseif ($doInit) {
        return $app->response->redirect("guess-game/reset");
    } elseif ($doCheat) {
        return $app->response->redirect("guess-game/cheat");
    }

    return $app->response->redirect("guess-game/play");
});

/**
 * Returning a JSON message with Hello World.
 */
$app->router->get("lek/hello-world-json", function () use ($app) {
    // echo "Some debugging information";
    return [["message" => "Hello World"]];
});



/**
* Showing message Hello World, rendered within the standard page layout.
 */
$app->router->get("lek/hello-world-page", function () use ($app) {
    $title = "Hello World as a page";
    $data = [
        "class" => "hello-world",
        "content" => "Hello World in " . __FILE__,
    ];

    $app->page->add("anax/v2/article/default", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});
