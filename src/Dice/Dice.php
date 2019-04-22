<?php

/**
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

namespace Heis\Dice;

class Dice
{
  /**
  *@var int $number   The number from the Dice
  */

    private $number;

    public function __construct($val = -1)
    {
        $this->number = $val;
    }

    /**
     * Randomize the dicenumber between 1 and 6 to initiate a new game.
     *
     * @return void
     */

    public function roll()
    {
        $this->number = rand(1, 6);
        return $this->getNumber();
    }



      /**
      * A function that gets the current dice value
      *
      *@return int value of the dice
      */
    public function getNumber()
    {
        return $this->number;
    }


      /**
      * New function that do the same as getNumber
      *
      *@return int value of the dice
      */
    public function getLastRoll()
    {
        return $this->number;
    }
}
