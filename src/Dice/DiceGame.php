<?php

namespace Heis\Dice;
use Exception;
/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class DiceGame
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     * @var bool $hasWon  If the game is won.

     */

    private $number;
    private $hasWon;
    private $diceHands;
    private $winlimit;
    

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
        $this->hasWon = false;
        $this->diceHands = [];
        $this->winlimit = 100;
    }


    public function roll()
    {
        return new DiceHand();
    }




    public function isHandValid($hand)
    {
        if(null == $hand) {
          throw new Exception("Hand is null");
        }

        $fail = array_search(1, $hand->values());
        if($fail === false) {
            return true;
        }
        return false;
    }


    /**
     * Add a result from hand to another unsaved hand, if you want to keep roll.
     *
     * @return int as the sum of all values.
     */
    public function diceHands()
    {
        return $this->diceHands;

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
   * Sum the new hand with the allready saved hand.
   *
   * @return int as the sum of all values.
   */
    public function sumResult()
    {
      $res = 0;
      foreach ($this->diceHands as $key => $hand)
      {
          if ($this->isHandValid($hand)) {
            $res = $res + $hand->sum();
          }
      }

      return $res;
    }

    public function previewResult($currentHand)
    {
      $res = $this->sumResult();

      if($this->isHandValid($currentHand)){
          $res = $res + $currentHand->sum();
      }

      return $res;
    }

    /**
     * Get the resulte.
     *
     * @return bool as the result.
     */
    public function hasWon($currentHand)
    {
      if($this->previewResult($currentHand) >= $this->winlimit) {
          return true;
      }

      return false;
    }








    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws DiceException when guessed number is out of bounds.
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
            throw new DiceException("SORRY, YOUR GUESS IS OUT OF BOUNDS");
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
