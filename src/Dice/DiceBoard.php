<?php

/**
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

namespace Heis\Dice;

use Exception;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class DiceBoard
{
    /**
     * @var int $round    Number of which round the game is in.
     * @var bool $players Which players is involved in the game.

     */

    private $round;
    private $players;
    private $currentPlayer;


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
     * Create the next round in the game.
     */
    public function nextRound()
    {
        $this->round = $this->round + 1;
        $this->getPlayer1()->createNewCurrentHand();
        $this->getComputer()->createNewCurrentHand();
    }


    public function nextPlayer()
    {
        $curPla = $this->getCurrentPlayer();
        $curPla->addHandToList($curPla->currentHand());

        if($this->currentPlayer == 0) {
          $this->currentPlayer = 1;
        } else{
          $this->currentPlayer = 0;
        }
    }

    /**
     * Get which players is the activ player.
     *
     * @return DiceGame with player.
     */
    public function getCurrentPlayer()
    {
        return $this->players[$this->currentPlayer];
    }


    /**
     * Get the winning player in the game.
     *
     * @return DiceGame with winning player.
     */
    public function getWinner()
    {
        $p1 = $this->getPlayer1();
        if ($p1->hasWon($p1->currentHand())) {
            return $p1;
        }

        $c1 = $this->getComputer();
        if ($c1->hasWon($c1->currentHand())) {
            return $c1;
        }

        return null;
    }
}
