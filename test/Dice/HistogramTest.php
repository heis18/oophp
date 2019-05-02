<?php

/**
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

namespace Heis\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test for the Histogram class.
 */
class HistogramTest extends TestCase
{
  /**
   * Test if we get get the series.
   */
    public function testHistogramGetSerie()
    {
        $histogram = new Histogram();
        $serie = $histogram->getSerie();
        $this->assertEquals([], $serie);
    }

    /**
     * Test if we get get inject data in to the histogram.
     */
    public function testHistogramInjectData()
    {
        $histogram = new Histogram();
        $diceGame = new DiceGame();
        $hand = new DiceHand(0);
        $hand->add(new Dice(1));
        $hand->add(new Dice(2));
        $hand->add(new Dice(3));
        $diceGame->addhandtoList($hand);
        $histogram->injectData($diceGame);
        $serie = $histogram->getSerie();
        $this->assertEquals([1,2,3], $serie);
    }

    /**
     * Test if we get get the histogram as text.
     */
    public function testHistogramGetAsText()
    {
        $histogram = new Histogram();
        $diceGame = new DiceGame();
        $hand = new DiceHand(0);
        $hand->add(new Dice(1));
        $hand->add(new Dice(2));
        $hand->add(new Dice(3));
        $diceGame->addhandtoList($hand);
        $histogram->injectData($diceGame);
        $text = $histogram->getAsText();

        $this->assertNotEquals(null, $text);
        $this->assertNotEquals("", $text);
        $this->assertNotEquals(-1, strpos($text, "*"));
        $this->assertNotEquals(-1, strpos($text, "6"));
    }
}
