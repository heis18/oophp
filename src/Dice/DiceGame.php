<?php

/**
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

namespace Heis\Dice;

use Exception;

/**
 * Roll dices to reach 100 points, class supporting the game through GET, POST and SESSION.
 */
class DiceGame
{
    /**
     * @var bool $hasWon      If the game is won.
     * @var int $diceHands    The current dices numbers.
     * @var int $winlimit     The limit of points to reach to win the game.
     * @var int $currentHand  The current hand of dices.
     * @var string $name      Who is playing the game.


     */
    private $hasWon;
    private $diceHands;
    private $winlimit;
    private $currentHand;
    private $name;




    public function __construct()
    {
        $this->hasWon = false;
        $this->diceHands = [];
        $this->winlimit = 100;
        $this->currentHand = new DiceHand(0);
    }


    /**
     * Get which player is playing.
     *
     * @return string with the name of the player.
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Set which player is playing.
     */
    public function setName($name)
    {
        $this->name = $name;
    }


    /**
     * Roll all dices save their value.
     *
     * @return int with numbers from the dices.
     */
    public function roll()
    {
        return new DiceHand();
    }


    /**
    * Get hand for round.
    * @param int $round The round to get hand for.
    * @return DiceHand for selected round, null if not available.
    */
    public function getHand($round)
    {
        if (array_key_exists($round, $this->diceHands)) {
            return $this->diceHands[$round];
        }

        return null;
    }


    /**
     * Check if the hand is valid or not, if it has a 1 in it.
     *
     * @return bool.
     */
    public function isHandValid($hand)
    {
        if (null == $hand) {
            throw new Exception("Hand is null");
        }

        $fail = array_search(1, $hand->values());
        if ($fail === false) {
            return true;
        }
        return false;
    }


    /**
     * Add a result from hand.
     *
     * @return int as the sum of all values.
     */
    public function diceHands()
    {
        return $this->diceHands;
    }

    /**
     * Add a result from hand.
     *
     * @return int as the sum of all values.
     */
    public function currentHand()
    {
        return $this->currentHand;
    }



    /**
     * Add a result from hand to the list of saved result.
     *
     * @return int as the sum of all values.
     */
    public function addHandToList($hand)
    {
        $this->diceHands[] = $hand;
    }



    /**
     * Get a new empty hand when you start a new round.
     *
     * @return void
     */
    public function createNewCurrentHand()
    {
        $this->currentHand = new DiceHand(0);
    }


    /**
     * Sum the new hand with the allready saved hand.
     *
     * @return int as the sum of all values.
     */
    public function sumResult()
    {
        $res = 0;
        foreach ($this->diceHands as $key => $hand) {
            $res = $res + $this->sumHand($hand);
        }

        return $res;
    }


    /**
     * Get the sum of all dices.
     *
     * @return int as the sum of all dices, if the hand is valid.
     */
    public function sumHand($hand)
    {
        if ($this->isHandValid($hand)) {
            return $hand->sum();
        }

        return 0;
    }


    /**
     * Get a preview of what the result is going to be..
     *
     * @return int as the sum.
     */
    public function previewResult($currentHand)
    {
        $res = $this->sumResult();

        if ($this->isHandValid($currentHand)) {
            $res = $res + $currentHand->sum();
        }

        return $res;
    }


    /**
     * Get the resulte of who won the game.
     *
     * @return bool as the result.
     */
    public function hasWon($currentHand)
    {
        if ($this->sumResult($currentHand) >= $this->winlimit) {
            return true;
        }

        return false;
    }





    //
    // /**
    //  * Make a guess, decrease remaining guesses and return a string stating
    //  * if the guess was correct, too low or to high or if no guesses remains.
    //  *
    //  * @throws DiceException when guessed number is out of bounds.
    //  *
    //  * @return string to show the status of the guess made.
    //  */
    //
    // public function makeGuess($number)
    // {
    //     // if ($this->tries >=5 ) {
    //     //     throw new Exception("WRONG, Out of tries, YOU LOST!");
    //     // }
    //
    //     if ($number == $this->number) {
    //         $this->hasWon = true;
    //         return "CORRECT, CONGRATULATIONS!";
    //     } elseif ($number > 100 || $number < 1) {
    //         throw new DiceException("SORRY, YOUR GUESS IS OUT OF BOUNDS");
    //     } elseif ($number > $this->number) {
    //         $this->tries = $this->tries +1;
    //         if ($this->tries() == 0) {
    //             return "TOO HIGH! SORRY, YOU ARE OUT OF GUESSES, YOU LOST!";
    //         }
    //         return "TOO HIGH";
    //     } elseif ($number < $this->number) {
    //         $this->tries = $this->tries +1;
    //         if ($this->tries() == 0) {
    //             return "TOO LOW! SORRY, YOU ARE OUT OF GUESSES, YOU LOST!";
    //         }
    //         return "TOO LOW";
    //     }
    // }
}
