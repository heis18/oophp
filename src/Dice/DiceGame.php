<?php
/**
 * Roll dices to reach 100 points, class supporting the game through GET, POST and SESSION.
 *
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

namespace Heis\Dice;

use Exception;

/**
 * Roll dices to reach 100 points, class supporting the game through GET, POST and SESSION.
 */
class DiceGame implements HistogramInterface
{
    use HistogramTrait2;

    /**
     * @var array of DiceHand $diceHands The current dices numbers.
     */
    private $diceHands;

    /**
    * @var int $winlimit The limit of points to reach to win the game.

    */

    private $winlimit;

    /**
    * @var int $currentHand The current hand of dices.
    */
    private $currentHand;

    /**
    * @var string $name Who is playing the game.
    */
    private $name;

    /**
    * Create a new DiceGame
    */
    public function __construct()
    {
        $this->hasWon = false;
        $this->diceHands = [];
        $this->winlimit = 100;
        $this->currentHand = new DiceHand(0);
    }

    /**
     * Get the name of the player.
     *
     * @return string with the name of the player.
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the name of player who is playing.
     *
     * @param string $name name of player
     *
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
    * Get hand for round.
    *
    * @param int $round The round to get hand for.
    *
    * @return DiceHand for selected round, null if not available.
    */
    public function getHand($round)
    {
        if (array_key_exists($round, $this->diceHands)) {
            return $this->diceHands[$round];
        }

        return null;
    }

    /**
     * Check if the hand is valid or not, if it has a 1 in it.
     *
     * @param DiceHand $hand The hand to check
     *
     * @return bool true if the hand is ok.
     */
    public function isHandValid($hand)
    {
        if (null == $hand) {
            throw new Exception("Hand is null");
        }

        $fail = array_search(1, $hand->values());
        if ($fail === false) {
            return true;
        }

        return false;
    }


    /**
     * Gives all the hands.
     *
     * @return DiceHand[]
     *
     */
    public function diceHands()
    {
        return $this->diceHands;
    }

    /**
     * Gets the current hand.
     *
     * @return DiceHand the current hand
     */
    public function currentHand()
    {
        return $this->currentHand;
    }

    /**
     * Add the current hand to the list of saved result.
     *
     * @param DiceHand $hand a hand to store to the history.
     *
     * @return void
     */
    public function addHandToList($hand)
    {
        $this->diceHands[] = $hand;
    }

    /**
     * Create a new hand when you start a new round.
     *
     * @return void
     */
    public function createNewCurrentHand()
    {
        $this->currentHand = new DiceHand(0);
    }


    /**
     * Sum the new hand with the already saved hand.
     *
     * @return int as the sum of all values.
     */
    public function sumResult()
    {
        $res = 0;
        foreach ($this->diceHands as $hand) {
            $res = $res + $this->sumHand($hand);
        }

        return $res;
    }

    /**
     * Get the sum of all dices.
     *
     * @param DiceHand $hand Include hand in sum.
     *
     * @return int as the sum of all valid dices, if the hand is valid.
     */
    public function sumHand($hand)
    {
        if ($this->isHandValid($hand)) {
            return $hand->sum();
        }

        return 0;
    }


    /**
     * Get a preview of what the result is going to be..
     *
     * @param DiceHand $currentHand Preview the sum.
     *
     * @return int as the sum.
     */
    public function previewResult($currentHand)
    {
        $res = $this->sumResult();

        if ($this->isHandValid($currentHand)) {
            $res = $res + $currentHand->sum();
        }

        return $res;
    }


    /**
     * Get the result if this player has won the game.
     *
     * @param DiceHand $currentHand Check to see if the current hand has won the game.
     *
     * @return bool as the result. True if the game is won.
     */
    public function hasWon($currentHand)
    {
        if (($this->sumResult()+$this->sumHand($currentHand)) >= $this->winlimit) {
            return true;
        }

        return false;
    }


    /**
     * Get the numbers of all the dices to put into the histogram.
     *
     * @return array of the result.
     */
    public function getHistogramSerie()
    {
        $res = [];
        foreach ($this->diceHands as $hand) {
            foreach ($hand->values() as $value) {
                $res[] = $value;
            }
        }
        return $res;
    }


    /**
     * The highest value in our histogram.
     *
     * @return int as the max value.
     */
    public function getHistogramMax()
    {
        return 6;
    }


    /**
     * The lowest value in our histogram.
     *
     * @return int as the min value.
     */
    public function getHistogramMin()
    {
        return 1;
    }
}
