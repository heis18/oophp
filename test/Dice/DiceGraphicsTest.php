<?php

/**
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

namespace Heis\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceGraphicsTest extends TestCase
{
  function testDiceGraphic(){
      $diceGraphic = new DiceGraphic(new Dice(6));
      $serie = $diceGraphic->graphic();
      $this->assertEquals("dice-6",$serie);
  }

  function testDiceHandGraphic(){
      $hand = new DiceHand(0);
      $hand->add(new Dice(6));
      $diceGraphic = new DiceHandGraphic($hand);
      $serie = $diceGraphic->graphic();
      $this->assertNotEquals("", $serie);
      $this->assertNotEquals(-1, strpos($serie,"<div"));
      $this->assertNotEquals(-1, strpos($serie,"dice-"));
      $this->assertEquals("<div><i class='dice-sprite dice-6'></i></div>",$serie);
  }
}
