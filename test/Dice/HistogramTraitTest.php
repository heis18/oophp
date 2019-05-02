<?php

/**
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

namespace Heis\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test for Histogram trait.
 */
class HistogramTraitTest extends TestCase
{

    /**
     * Test for init-function.
     */
    public function testInitSerie()
    {
        $trait = new HistogramDummyTrait();
        $trait->initSerie();
        $serie = $trait->getHistogramSerie();
        $this->assertEquals([], $serie);
    }

    /**
     * Test for max-function.
     */
    public function testHistogramMin()
    {
        $trait = new HistogramDummyTrait();
        $serie = $trait->getHistogramMin();
        $this->assertEquals(null, $serie);
    }

    /**
     * Test for min-function.
     */
    public function testHistogramMax()
    {
        $trait = new HistogramDummyTrait();
        $trait->initSerie();
        $serie = $trait->getHistogramMax();
        $this->assertEquals(null, $serie);
    }
}
