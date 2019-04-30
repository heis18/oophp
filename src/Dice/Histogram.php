<?php

namespace Heis\Dice;

/**
 * Generating histogram data.
 */
class Histogram
{
    /**
     * @var array $serie  The numbers stored in sequence.
     * @var int   $min    The lowest possible number.
     * @var int   $max    The highest possible number.
     */
    private $serie = [];
    private $min;
    private $max;


    /**
     * Inject the object to use as base for the histogram data.
     *
     * @param HistogramInterface $object The object holding the serie.
     *
     * @return void.
     */
    public function injectData(HistogramInterface $object)
    {
        // Allow the trait to set data, since the trait uses it's own serie.
        $object->initSerie();
        $this->serie = $object->getHistogramSerie();
        $this->min   = $object->getHistogramMin();
        $this->max   = $object->getHistogramMax();
    }

    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getSerie()
    {
        return $this->serie;
    }



    /**
     * Return a string with a textual representation of the histogram.
     *
     * @return string representing the histogram.
     */
    public function getAsText()
    {
        return $this->printHistogram($this->min, $this->max);
    }



    /**
     * Print out the histogram, default is to print out only the numbers
     * in the serie, but when $min and $max is set then print also empty
     * values in the serie, within the range $min, $max.
     *
     * @param int $min The lowest possible integer number.
     * @param int $max The highest possible integer number.
     *
     * @return string representing the histogram.
     */
    private function printHistogram(int $min = null, int $max = null)
    {
        $group = $this->groupArray($this->serie);

        // Prepare the result.
        $result = "";

        // Get min and max value
        if ($min == null || $max == null) {
            foreach ($group as $key => $value) {
                $result = $result . $this->printLine($key, $value);
            }
        } else {
            for ($i=$min; $i <=$max; $i++) {
                $key = $i;
                $value = [];
                if (array_key_exists($i, $group)) {
                    $value = $group[$i];
                }

                $result = $result . $this->printLine($key, $value);
            }
        }

        // Return the value.
        return $result;
    }


    /**
    * We go through all our list of int and group them by ther numbers.
    *
    * @return int[][] We send back a grouped and sorted list.
    */
    private function groupArray($data)
    {
        $result = array();
        $sorted = $data;
        sort($sorted, SORT_NUMERIC);
        foreach ($sorted as $element) {
            $result[$element][] = $element;
        }

        return $result;
    }


    /**
    * We define what to print and how many when we have a hit on a dice.
    */
    private function printStars($data)
    {
        $star = str_pad("", count($data), "*");
        return $star;
    }


    /**
    * We tell for what number to printStars.
    */
    private function printLine($key, $data)
    {
          $result = "$key: " . $this->printStars($data) . "<br>";
          return $result;
    }
}
