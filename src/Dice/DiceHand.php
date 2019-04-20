<?php

namespace Heis\Dice;

/**
  * A dicehand, consisting dices
  */
class DiceHand
{
  /**
       * @var Dice $dices   Array consisting of dices.
       * @var int  $values  Array consisting of last roll of the dices.
       */
    private $dices;
    private $values;

      /**
       * Constructor to initiate the dicehand with a number of dices.
       *
       * @param int $dices Number of dices to create, defaults to five.
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
     * @return array with values of the last roll.
     */
  public function dices()
  {
        return $this->dices;
  }

      /**
       * Get values of dices from last roll.
       *
       * @return array with values of the last roll.
       */
    public function values()
    {
          return $this->values;
    }


    /**
     * Add a result from hand to another unsaved hand, if you want to keep roll.
     *
     * @return int as the sum of all values.
     */
    public function addHandToHand()
    {

    }


      /**
       * Get the sum of all dices.
       *
       * @return int as the sum of all dices.
       */
    public function sum()
    {
          $res = 0;
        for ($i=0; $i < count($this->values); $i++) {
              $res =  $res + $this->values[$i];
        }
          return $res;
    }


}
