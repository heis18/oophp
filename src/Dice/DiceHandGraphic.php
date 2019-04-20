<?php

namespace Heis\Dice;

/**
  * A graphic dice.
  */

class DiceHandGraphic
{

    private $hand;
    /**
    *Constructor to initiate the dice with six sides.
    */
    public function __construct($hand)
    {
        $this->hand = $hand;
    }


    /**
     * Get a graphic value of the last rolled dice.
     *
     * @return string as graphical representation of last rolled dice.
     */
    public function graphic()
    {

      $res = "<div>";
      foreach ($this->hand->dices() as $key => $dice) {
        $gr = new DiceGraphic($dice);
        $res .= "<i class='dice-sprite ".$gr->graphic()."'></i>";
      }

      $res .= "</div>";
      return $res;
    }
}
