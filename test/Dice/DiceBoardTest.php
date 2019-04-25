<?php

/**
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

namespace Heis\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceBoardTest extends TestCase
{
    /**
     * Test if we can get a player1.
     */
    public function testGetPlayer1()
    {
        $board = new DiceBoard();
        $this->assertNotEquals(null, $board->getPlayer1());
    }


    /**
     * Test if we can get the number from the current dice.
     */
    public function testGetComputer()
    {
        $board = new DiceBoard();
        $this->assertNotEquals(null, $board->getComputer());
    }


    /**
     * Test if we can get the last rolled dice.
     */
    public function testGetRound()
    {
        $board = new DiceBoard();
        $this->assertEquals(1, $board->getRound());
    }


    /**
     * Test if we can get the last rolled dice, as player1.
     */
    public function testGetWinnerPlayer1()
    {
        $board = new DiceBoard();
        $pl1 = $board->getPlayer1();
        $hand = new DiceHand();
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));

        $pl1->addHandToList($hand);
        $this->assertNotEquals(null, $board->getWinner());
    }


    /**
     * Test if we can get the last rolled dice as computer.
     */
    public function testGetWinnerComputer()
    {
        $board = new DiceBoard();
        $pl1 = $board->getComputer();
        $hand = new DiceHand();
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));
        $hand->add(new Dice(6));

        $pl1->addHandToList($hand);
        $this->assertNotEquals(null, $board->getWinner());
    }


    /**
     * Test if computer can roll dice again.
     */
    public function testPlayComputerWinLogic()
    {
        $board = new DiceBoard();
        $comp1 = $board->getComputer();
        $hand = new DiceHand();
        $hand->add(new Dice(93));


        $comp1->addHandToList($hand);

        $hand = new DiceHand();
        $hand->add(new Dice(6));

        $this->assertFalse($board->computerHasEnough($hand));

        $hand = new DiceHand();
        $hand->add(new Dice(5));
        $hand->add(new Dice(2));
        $hand->add(new Dice(2));

        $this->assertTrue($board->computerHasEnough($hand));



        $hand = new DiceHand();
        $hand->add(new Dice(6));
        $hand->add(new Dice(1));

        $this->assertTrue($board->computerHasEnough($hand));
    }


    /**
     * Test if we can get the next player.
     */
    public function testNextPlayer()
    {
        $board = new DiceBoard();
        $board->getCurrentPlayer(0);
        $this->assertEquals(null, $board->nextPlayer());
    }


    /**
     * Test if we can get the next round.
     */
    public function testGetNextRound()
    {
        $board = new DiceBoard();
        $board->getRound(2);
        $this->assertEquals(null, $board->nextRound());
    }
}
