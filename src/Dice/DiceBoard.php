<?php

namespace Heis\Dice;
use Exception;
/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class DiceBoard
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     * @var bool $hasWon  If the game is won.

     */

    private $round;
    private $players;


        /**
         * Constructor to initiate the object with current game settings,
         * if available. Randomize the current number if no value is sent in.
         *
         * @param int $number The current secret number, default -1 to initiate
         *                    the number from start.
         * @param int $tries  Number of tries a guess has been made,
         *                    default 6.
         */

        public function __construct(int $number = -1, int $tries = 6)
        {
            $this->round = 1;
            $this->players = [];
            $this->players [] = new DiceGame();
            $this->players [] = new DiceGame();

            $this->getPlayer1()->setName("Player 1");
            $this->getComputer()->setName("Computer");
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
       * @return DiceGame with values o$p1f the last roll.
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




        public function getWinner(){
            $p1 = $this->getPlayer1();
            if($p1->hasWon($p1->currentHand())){
                return $p1;
            }

            $c1 = $this->getComputer();
            if($c1->hasWon($c1->currentHand())){
              return $c1;
            }

            return null;


        }
}
