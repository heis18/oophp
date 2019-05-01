<?php

namespace Heis\Dice;

/**
 * A class which extends a trait so we can test the trait.
 */
class HistogramDummyTrait
{
    use HistogramTrait2;

    public function __construct()
    {
    }
}
