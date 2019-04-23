<?php

namespace Anng\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */
    private $number;
    private $tries;

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */
    public function __construct(int $number = -1, int $tries = 6)
    {
        $this->number = $number;
        $this->tries = $tries;
    }

    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */
    public function random() : void
    {
        $this->number = rand(1, 100);
        $this->tries = 6;
    }

    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */
    public function tries() : int
    {
        return $this->tries;
    }

    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */
    public function number() : int
    {
        return $this->number;
    }

    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     * @param int $number The guessed number
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */
    public function makeGuess($number) : string
    {
        if ($number > 100 || $number < 1) {
            throw new GuessException("Your guess is out of bounds (1-100)");
        } elseif ($this->tries <= 0) {
            throw new GuessException("You are out of tries");
        } else {
            if ($number > $this->number) {
                $message = 'Too high';
            } elseif ($number < $this->number) {
                $message = 'Too low';
            } elseif ($number == $this->number) {
                $message = '<strong>CORRECT!</strong>';
            }
        }
        $this->tries -= 1;
        return $message;
    }
}
