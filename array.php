<?php

if (!function_exists('array_first')) {
    /**
     * Returns the value of the first array element
     *
     * @param array $array
     * @return mixed
     */
    function array_first(array $array)
    {
        return reset($array);
    }
}

if (!function_exists('array_last')) {
    /**
     * Returns the value of the last array element
     *
     * @param array $array
     * @return mixed
     */
    function array_last(array $array)
    {
        return end($array);
    }
}

if (!function_exists('array_reduce_left')) {
    /**
     * Iteratively reduce the array to a single value using a callback function
     * applied for each array value (from left-to-right)
     *
     * @param array $array
     * @param callable $callback
     * @param mixed $initial OPTIONAL
     * @return mixed
     */
    function array_reduce_left(array $array, $callback, $initial = null) {
        foreach ($array as $key => $value) {
            $initial = call_user_func($callback, $initial, $value, $key);
        }
        return $initial;
    }
}
