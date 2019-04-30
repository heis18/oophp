<?php

namespace Heis\Dice;

/**
 * A trait implementing HistogramInterface.
 */
trait HistogramTrait2
{
    /**
     * @var array $serie  The numbers stored in sequence.
     */
    private $serie = [];


    public function initSerie()
    {
        $this->serie = $this->getHistogramSerie();
    }

    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getHistogramSerie()
    {
        return $this->serie;
    }


    /**
     * Get min value for the histogram.
     *
     * @return int with the min value.
     */
    public function getHistogramMin()
    {
        if (count($this->serie) == 0) {
            return null;
        }

        return min($this->serie);
    }


    /**
     * Get max value for the histogram.
     *
     * @return int with the max value.
     */
    public function getHistogramMax()
    {
        if (count($this->serie) == 0) {
            return null;
        }

        return max($this->serie);
    }
}
