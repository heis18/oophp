<?php

/**
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

namespace Heis\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceHandTest extends TestCase
{
    /**
     * Test if we can roll dices and get result.
     */
    public function testRollDice()
    {
        $hand = new DiceHand();
        $hand->roll();
        foreach ($hand->dices() as $dice) {
            $this->assertTrue($dice->getNumber()>0 && $dice->getNumber()<7);
        }
    }

    /**
     * Test if we can get and add numbers from dices to the game.
     */
    public function testAddDice()
    {
        $hand = new DiceHand(0);

        $this->assertEquals(0, count($hand->dices()));

        $hand->add(new Dice(6));

        $this->assertEquals(1, count($hand->dices()));

        $hand->add(new Dice(5));
        $hand->add(new Dice(4));

        $this->assertEquals(3, count($hand->dices()), "Misslyckades med att lägga till flera i listan.");
    }

    /**
     * Test if we can sum the values from the dices.
     */
    public function testSumValuesFromDices()
    {
        $hand = new DiceHand(0);

        $this->assertEquals(0, ($hand->sum()));

        $hand->add(new Dice(6));

        $this->assertEquals(6, ($hand->sum()));

        $hand->add(new Dice(1));
        $hand->add(new Dice(4));

        $this->assertEquals(11, ($hand->sum()), "Misslyckades med att summera tärningarna.");
    }



    /**
     * Test if we can get and add a hand to another hand in the game.
     */
    public function testAddHandToHand()
    {
        $hand1 = new DiceHand();
        $hand2 = new DiceHand();

        $hand1->addHandToHand($hand2);
        $this->assertEquals(6, count($hand1->dices()));

        //
        // $hand->addHandToHand($hand);
        //
        // $this->assertEquals(2, count($hand);
        //
        // $hand->addHandToHand($hand);
        // $hand->addHandToHand($hand);
        //
        //
        // $this->assertNotEquals(3, count($hand, "Misslyckades med att räkna händerna.");
    }
}
