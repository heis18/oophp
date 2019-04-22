<?php
/**
 * A graphic representation of a dice hand.
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */
namespace Heis\Dice;

/**
* A graphic representation of a dice hand.
*/
class DiceHandGraphic
{

    /**
    * @var DiceHand $hand the hand to draw
    */
    private $hand;
    /**
    * Constructor to initiate the dice with six sides.
    * @param DiceHand $hand the hand to draw.
    */
    public function __construct($hand)
    {
        $this->hand = $hand;
    }

    /**
     * Get a graphic value of the last rolled dice.
     *
     * @return string as graphical representation of last rolled dice.
     */
    public function graphic()
    {
        $res = "<div>";
        foreach ($this->hand->dices() as $dice) {
            $gr = new DiceGraphic($dice);
            $res .= "<i class='dice-sprite ".$gr->graphic()."'></i>";
        }

        $res .= "</div>";
        return $res;
    }
}
