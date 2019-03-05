<?php
// put example array here
$example = [10 => 7, 9 => 7, 17 => 6, 11 => 6, 23 => 3, 27 => 4, 50 => 'test', 51 => '6', 52 => 'a'];

// create object and sort example
$sortSystem = new sortAlgorithm();
try {
    $example = $sortSystem->sortArray($example);
} catch (Exception $e) {
    echo 'Caught exception: ' . $e->getMessage();
}

// print output
print_r($example);

/**
 * Class sortAlgorithm
 */
class sortAlgorithm
{
    /**
     * @param $array array
     *
     * @return array
     * @throws Exception
     */
    public function sortArray($array)
    {
        // if it is not array just return null
        if (!is_array($array)) {
            throw new Exception('given variable is not array');
        }

        // create simple array from associative array
        $unsortedSimpleArray = $this->simplifyArray($array);

        // sort simple array by values
        $sortedSimpleArray = $this->quickSort($unsortedSimpleArray);

        // create associative array back from simple and return it
        return $this->restoreArray($sortedSimpleArray);
    }

    /**
     * @param $array array
     *
     * @return array|null
     */
    private function quickSort($array)
    {
        // if it is not array just return null
        if (!is_array($array)) {
            return null;
        }

        // if length is one or less there is no need to sort it
        if (count($array) <= 1) {
            return $array;
        }

        // select pivot. First one is good
        $pivot = $array[0];

        // declare less and more arrays
        $left = $right = [];

        // loop and compare each item in the array to the pivot value, place item in appropriate partition
        for ($i = 1; $i < count($array); $i++) {
            // right now is taking every element as int
            if ((int)$array[$i][1] < (int)$pivot[1]) {
                $left[] = $array[$i];
            } else {
                $right[] = $array[$i];
            }
        }

        // return recursive function to sort left and right lists
        return array_merge($this->quickSort($left), [$pivot], $this->quickSort($right));
    }

    /**
     * @param $B array
     *
     * @return array
     */
    private function simplifyArray($B)
    {
        // create empty array
        $unsorted = [];
        // create simple array of arrays with key and value of each element
        foreach ($B as $key => $value) {
            $unsorted[] = [$key, $value];
        }

        return $unsorted;
    }

    /**
     * @param $sorted array
     *
     * @return array
     */
    private function restoreArray($sorted)
    {
        $array = [];
        // create back associative array from simplify version of it
        foreach ($sorted as $value) {
            $array[$value[0]] = $value[1];
        }

        return $array;
    }
}