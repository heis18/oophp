<?php

/**
* A hand, consisting a number of dices
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

namespace Heis\Dice;

/**
  * A hand, consisting a number of dices
  */
class DiceHand
{
    /**
     * @var Dice $dices   Array consisting of dices.
     */
    private $dices;

    /**
    * @var int[] $values Array consisting of last roll of the dices.
    */
    private $values;

      /**
       * Constructor to initiate the dicehand with a number of dices.
       *
       * @param int $dices Number of dices to create, defaults three.
       */
    public function __construct(int $dices = 3)
    {
          $this->dices =  [];
          $this->values = [];

        for ($i=0; $i < $dices; $i++) {
              $this->dices[] = new Dice();
              $this->values[] = null;
        }
    }

      /**
       * Roll all dices save their value.
       *
       * @return void.
       */
    public function roll()
    {
        for ($i=0; $i < count($this->dices); $i++) {
            $this->dices[$i]->roll();
            $this->values[$i] = $this->dices[$i]->getNumber();
        }
    }

      /**
       * Add a dices.
       * @param Dice $dice dice to add to the hand
       *
       * @return void.
       */
    public function add($dice)
    {
        $this->dices[] = $dice;
        $this->values[] = $dice->getNumber();
    }

    /**
     * Get the dices from last roll.
     *
     * @return array of Dice dices
     */
    public function dices()
    {
        return $this->dices;
    }

      /**
       * Get values of dices from hand.
       *
       * @return array with values of the hand.
       */
    public function values()
    {
        return $this->values;
    }


    /**
     * Add a result from hand to another unsaved hand, if you want to keep roll.
     *
     * @param DiceHand $hand the hand of dices to add to this hand.
     * @return int as the sum of all values.
     */
    public function addHandToHand($hand)
    {
        foreach ($hand->dices as $key => $dice) {
            $this->add($dice);
        }
    }

      /**
       * Get the sum of all dices.
       *
       * @return int as the sum of all dices.
       */
    public function sum()
    {
        $res = 0;
        for ($i = 0; $i < count($this->values); $i++) {
            $res =  $res + $this->values[$i];
        }

        return $res;
    }
}
