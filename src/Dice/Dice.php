<?php

namespace Heis\Dice;

class Dice
{
  /**
  *@var int $number   The number from the Dice
  */

    private $number;


    public function __construct($val= -1)
    {
        $this->number = $val;
    }



    /**
     * Randomize the secret number between 1 and 6 to initiate a new game.
     *
     * @return void
     */

    public function roll()
    {
        $this->number = rand(1, 6);
        return $this->getNumber();
    }



    /**
    * A function that saves the last roll
    */
    public function getNumber()
    {
        return $this->number;
    }


    /**
    * New function that do the same as getNumber
    */
    public function getLastRoll()
    {
        return $this->number;
    }


}
