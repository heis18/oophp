<?php

/**
 * @author Helena Isåfjäll <heis18@student.bth.se>
 */

namespace Heis\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class HistogramTraitTest extends TestCase
{

    public function testInitSerie()
    {
        $trait = new HistogramDummyTrait();
        $trait->initSerie();
        $serie = $trait->getHistogramSerie();
        $this->assertEquals([], $serie);
    }

    public function testHistogramMin()
    {
        $trait = new HistogramDummyTrait();
        $serie = $trait->getHistogramMin();
        $this->assertEquals(null, $serie);
    }

    public function testHistogramMax()
    {
        $trait = new HistogramDummyTrait();
        $trait->initSerie();
        $serie = $trait->getHistogramMax();
        $this->assertEquals(null, $serie);
    }
}
