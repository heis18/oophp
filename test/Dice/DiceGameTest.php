<?php

/**
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

namespace Heis\Dice;

use PHPUnit\Framework\TestCase;

use Exception;

/**
 * Example test class.
 */
class DiceGameTest extends TestCase
{


    /**
    * Test get hand
    */
    public function testGetHand()
    {
        $game = new DiceGame();

        $this->assertEquals(null, $game->getHand(0));
        $this->assertEquals(null, $game->getHand(1));

        $hand = new DiceHand(0);
        $hand->add(new Dice(6));
        $game->addHandToList($hand);

        $this->assertNotEquals(null, $game->getHand(0));
        $this->assertEquals(null, $game->getHand(1));
    }


    /**
     * Test is the hand is valide, if it contains a one ore not.
     */
    public function testIfHandIsValidException()
    {
        $game = new DiceGame();
        $this->expectException(Exception::class);
        $game->isHandValid(null);
    }


    /**
     * Test is the hand is valide, if it contains a one ore not.
     */
    public function testIfHandIsValidSuccess()
    {
        $game = new DiceGame();
        $hand = new DiceHand(0);
        $hand->add(new Dice(6));
        $hand->add(new Dice(5));
        $hand->add(new Dice(4));
        $hand->add(new Dice(3));
        $hand->add(new Dice(2));
        $handIsValid = $game->isHandValid($hand);
        $this->assertTrue($handIsValid);
    }


    /**
     * Test is the hand is valide, if it contains a one ore not.
     */
    public function testIfHandIsValidFail()
    {
         $game = new DiceGame();
         $hand = new DiceHand();
         $hand->add(new Dice(6));
         $hand->add(new Dice(5));
         $hand->add(new Dice(4));
         $hand->add(new Dice(3));
         $hand->add(new Dice(1));
         $handIsValid = $game->isHandValid($hand);
         $this->assertFalse($handIsValid);
    }


    /**
     * Test we can add a hand to the current hand/result.
     */
    public function testaddHandToList()
    {
        $game = new DiceGame();
        $hand = new DiceHand();
        $hand->add(new Dice(6));
        $hand->add(new Dice(5));
        $hand->add(new Dice(4));

        $this->assertEquals(0, count($game->diceHands()));

        $game->addHandToList($hand);
          $this->assertEquals(1, count($game->diceHands()));


        $game->addHandToList($hand);
        $game->addHandToList($hand);
          $this->assertEquals(3, count($game->diceHands()), "Misslyckades med att lägga till flera i listan.");
    }


    /**
     * Test if we can ad the result from one ore many hands to the over all result.
     */
    public function testSumResult()
    {
        $game = new DiceGame();
        $hand = new DiceHand();
        $hand->add(new Dice(6));
        $hand->add(new Dice(5));
        $hand->add(new Dice(4));

        // Test with an empty startresult
        $sum = $game->previewResult($hand);
        $this->assertEquals(15, $sum, "Misslyckades med tomt startresult");

        $game->addHandToList($hand);

        // Test with adding an empty hand, if player gets 0.
        $sum = $game->sumResult();
        $this->assertEquals(15, $sum);

        // Test with adding a hand with 15 to 15 in our hand.
        $sum = $game->previewResult($hand);
        $this->assertEquals(30, $sum);

        $hand = new DiceHand();
        $hand->add(new Dice(6));
        $hand->add(new Dice(1));
        $game->addHandToList($hand);
        $sum = $game->sumResult();
        $this->assertEquals(15, $sum, "Hänsyn togs inte till loser hand");
    }


    /**
     * Test if the resolt of a player has reached 100, if we have a winner.
     */
    public function testHasWon()
    {
        $game = new DiceGame();
        $hand = new DiceHand();
        $hand->add(new Dice(6));
        $hand->add(new Dice(5));
        $hand->add(new Dice(4));

        // Test with an empty startresult
        $sum = $game->hasWon($hand);
        $this->assertFalse($sum, "På något vis vann vi utan att nå 100");

        $game->addHandToList($hand);

        // Test with adding 15 to our hand.
        $sum = $game->hasWon($hand);
        $this->assertFalse($sum, "På något vis vann vi utan att nå 100");

        $game->addHandToList($hand);
        $game->addHandToList($hand);
        $game->addHandToList($hand);
        $game->addHandToList($hand);
        $game->addHandToList($hand);
        $game->addHandToList($hand);

        // Test with adding points to get over 100.
        $sum = $game->hasWon($hand);
        $this->assertTrue($sum, "På något vis vann vi inte när vi nått 100");
    }

    /**
     * Test if we can get a players name.
     */
    public function testGetName()
    {
        $game = new DiceGame;
        $game->setName("player1");
        $res = $game->getName();

        $this->assertEquals("player1", $res);
    }



    /**
     * Test if we can get the series of value for our histogram.
     */
    public function testgetHistogramSerie()
    {
        $game = new DiceGame;
        $hand = new DiceHand(0);
        $hand->add(new Dice(6));
        $hand->add(new Dice(5));
        $hand->add(new Dice(4));
        $game->addHandToList($hand);

        $res = $game->getHistogramSerie();

        $this->assertEquals([6, 5, 4], $res);
    }

    /**
     * Test if we can get a max value.
     */
    public function testgetHistogramMax()
    {
        $game = new DiceGame;
        $sum = $game->getHistogramMax();

        $this->assertEquals(6, $sum);
    }


    /**
     * Test if we can get a min value.
     */
    public function testgetHistogramMin()
    {
        $game = new DiceGame;
        $sum = $game->getHistogramMin();

        $this->assertEquals(1, $sum);
    }
}
