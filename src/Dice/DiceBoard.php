<?php

/**
 * Single game of dice, or a player.
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

namespace Heis\Dice;

use Exception;

/**
 * A board for a roll dices game.
 */
class DiceBoard
{
    /**
     * @var int $round Number of which round the game is in.
     */
    private $round;

     /**
     * @var DiceGame $players Which players is involved in the game.
     */
    private $players;

     /**
     * @var int $currentPlayer Which is the current player
     */
    private $currentPlayer;

     /**
     * Create a new DiceGame with one player and a computer.
     */
    public function __construct()
    {
        $this->round = 1;
        $this->players = [];
        $this->players [] = new DiceGame();
        $this->players [] = new DiceGame();

        $this->getPlayer1()->setName("Player 1");
        $this->getComputer()->setName("Computer");
        $this->currentPlayer = 0;
    }

  /**
   * Get the first player.
   *
   * @return DiceGame with values of the last roll.
   */
    public function getPlayer1()
    {
        return $this->players [0];
    }

  /**
   * Get the second player/computer.
   *
   * @return DiceGame with values of the last roll.
   */
    public function getComputer()
    {
        return $this->players [1];
    }

  /**
   * Get the number of the round of the game.
   *
   * @return int with values of the last roll.
   */
    public function getRound()
    {
        return $this->round;
    }

    /**
     * Go to the next round in the game.
     * @return void
     */
    public function nextRound()
    {
        $this->round = $this->round + 1;
        $this->getPlayer1()->createNewCurrentHand();
        $this->getComputer()->createNewCurrentHand();
    }

    /**
    * Move the game to the next player.
    */
    public function nextPlayer()
    {
        $curPla = $this->getCurrentPlayer();
        $curPla->addHandToList($curPla->currentHand());

        if ($this->currentPlayer == 0) {
            $this->currentPlayer = 1;
        } else {
            $this->currentPlayer = 0;
        }
    }

    /**
     * Get which players is the active player.
     *
     * @return DiceGame with player.
     */
    public function getCurrentPlayer()
    {
        return $this->players[$this->currentPlayer];
    }

    /**
     * Get the the player who won
     *
     * @return DiceGame with winning player, or null if no winner is detected.
     */
    public function getWinner()
    {
        $pl1 = $this->getPlayer1();
        if ($pl1->hasWon(new DiceHand())) {
            return $pl1;
        }

        $comp1 = $this->getComputer();
        if ($comp1->hasWon(new DiceHand())) {
            return $comp1;
        }

        return null;
    }

    /**
    * Has the computer enough points or should it make another attempt.
    *
    * @param DiceHand $hand the hand to check.
    */
    public function computerHasEnough($hand)
    {
        $computer = $this->getComputer();
        if (false == $computer->isHandValid($hand)) {
            return true;
        }

        if ($computer->hasWon($hand)) {
            return true;
        }

        if ($hand->sum() > 11) {
            return true;
        }

        return false;
    }

    /**
    * Play for the computer.
    */
    public function playComputer()
    {
        $computer = $this->getComputer();
        $hand = new DiceHand();
        $hand->roll();
        if ($this->computerHasEnough($hand) == false) {
            $hand2 = new DiceHand();
            $hand2->roll();
            $hand->addHandToHand($hand2);
        }

        $computer->currentHand()->addHandToHand($hand);

        //if player has won, the result is saved in the table
        if ($computer->hasWon($computer->currentHand())) {
            $computer->addHandToList($computer->currentHand());
        }
    }
}
