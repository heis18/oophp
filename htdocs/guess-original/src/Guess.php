<?php
/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     * @var bool $hasWon  If the game is won.

     */

    private $number;
    private $tries;
    private $hasWon;


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
        $this->hasWon = false;

        if ($tries == 6) {
            $this->tries = 0;
        }
        if ($number ==-1) {
            $this->random();
        }
    }



    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */

    public function random()
    {
        $this->number = rand(1, 100);
    }




    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */

    public function tries()
    {
        return 5 - $this->tries;
    }




    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */

    public function number()
    {
        return $this->number;
    }



    /**
     * Get the resulte.
     *
     * @return bool as the result.
     */

    public function hasWon()
    {
        return $this->hasWon;
    }



    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */

    public function makeGuess($number)
    {
        // if ($this->tries >=5 ) {
        //     throw new Exception("WRONG, Out of tries, YOU LOST!");
        // }

        if ($number == $this->number) {
            $this->hasWon = true;
            return "CORRECT, CONGRATULATIONS!";
        } elseif ($number > 100 || $number < 1) {
            throw new GuessException("SORRY, YOUR GUESS IS OUT OF BOUNDS");
        } elseif ($number > $this->number) {
            $this->tries = $this->tries +1;
            if ($this->tries() == 0) {
                return "TOO HIGH! SORRY, YOU ARE OUT OF GUESSES, YOU LOST!";
            }
            return "TOO HIGH";
        } elseif ($number < $this->number) {
            $this->tries = $this->tries +1;
            if ($this->tries() == 0) {
                return "TOO LOW! SORRY, YOU ARE OUT OF GUESSES, YOU LOST!";
            }
            return "TOO LOW";
        }
    }
}
