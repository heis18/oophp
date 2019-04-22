<?php

/**
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

namespace Heis\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceTest extends TestCase
{
    /**
     * Test if we can get a values from the dice.
     */
    public function testRollDice()
    {
        $dice = new Dice();
        $dice->roll();
        $this->assertNotEquals(-1, $dice->getNumber());
    }


    /**
     * Test if we can get the number from the current dice.
     */
    public function testGetNumber()
    {
        $dice = new Dice();
        $this->assertEquals(-1, $dice->getNumber());

        $dice = new Dice(6);
        $this->assertEquals(6, $dice->getNumber());
    }


    /**
     * Test if we can get the last rolled dice.
     */
    public function testGetLastRoll()
    {
        $dice = new Dice();
        $this->assertEquals(-1, $dice->getLastRoll());

        $dice = new Dice(3);
        $this->assertEquals(3, $dice->getLastRoll());

        $rollRes = $dice->roll();
        $this->assertEquals($rollRes, $dice->getLastRoll());
    }
}
