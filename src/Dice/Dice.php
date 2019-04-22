<?php

/**
 * A nice dice.
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

namespace Heis\Dice;

/**
* A dice.
*/
class Dice
{
  /**
  *@var int $number the number from the Dice
  */

    private $number;

    /**
    * Create a new dices
    * @param int $val the value of the dice. -1 if no value is set.
    */
    public function __construct($val = -1)
    {
        $this->number = $val;
    }

    /**
     * Randomize the dicenumber between 1 and 6 of the current dice.
     *
     * @return int the value of the dice after roll.
     */

    public function roll()
    {
        $this->number = rand(1, 6);
        return $this->getNumber();
    }

    /**
    * Gets the current dice value
    *
    * @return int value of the dice
    */
    public function getNumber()
    {
        return $this->number;
    }

      /**
      * Get the last roll
      *
      * @return int the value of the dice
      */
    public function getLastRoll()
    {
        return $this->number;
    }
}
