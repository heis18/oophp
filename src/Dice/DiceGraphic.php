<?php

namespace Heis\Dice;

/**
  * A graphic dice.
  */

class DiceGraphic
{
    private $dice;

    /**
    *Constructor to initiate the dice with six sides.
    */
    public function __construct($dice)
    {
       $this->dice = $dice;
    }


    /**
     * Get a graphic value of the last rolled dice.
     *
     * @return string as graphical representation of last rolled dice.
     */
    public function graphic()
    {
        return "dice-" . $this->dice->getNumber();
    }
}
