<?php

/**
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

namespace Heis\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class HistogramTest extends TestCase
{
  function testHistogramGetSerie(){
    $histogram = new Histogram();
    $serie = $histogram->getSerie();
    $this->assertEquals([],$serie);
  }

  function testHistogramInjectData(){
    $histogram = new Histogram();
    $diceGame = new DiceGame();
    $hand = new DiceHand(0);
    $hand->add(new Dice(1));
    $hand->add(new Dice(2));
    $hand->add(new Dice(3));
    $diceGame->addhandtoList($hand);
    $histogram->injectData($diceGame);
    $serie = $histogram->getSerie();
    $this->assertEquals([1,2,3],$serie);
  }

  function testHistogramGetAsText(){
    $histogram = new Histogram();
    $diceGame = new DiceGame();
    $hand = new DiceHand(0);
    $hand->add(new Dice(1));
    $hand->add(new Dice(2));
    $hand->add(new Dice(3));
    $diceGame->addhandtoList($hand);
    $histogram->injectData($diceGame);
    $text = $histogram->getAsText();
    $this->assertNotEquals(null,$text);
    $this->assertNotEquals("",$text);
    $this->assertNotEquals(-1, strpos($text, "*"));
    $this->assertNotEquals(-1, strpos($text, "6"));
  }
}
