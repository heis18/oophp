<?php

/**
 * A graphic view of a Dice
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

namespace Heis\Dice;

/**
  * A graphic dice.
  */

class DiceGraphic
{
    /**
    * @var Dice $dice the dice to draw.
    */
    private $dice;

    /**
    * Constructor to initiate the dice.
    * @param int $dice the value for the dice.
    */
    public function __construct($dice)
    {
        $this->dice = $dice;
    }

    /**
     * Get a graphic value of the last rolled dice.
     *
     * @return string as graphical representation of dice.
     */
    public function graphic()
    {
        return "dice-" . $this->dice->getNumber();
    }
}
