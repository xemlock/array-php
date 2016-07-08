<?php

if (!function_exists('array_first')) {
    /**
     * Returns the value of the first array element
     *
     * @param array $array
     * @return mixed
     */
    function array_first($array)
    {
        if (!is_array($array)) {
            trigger_error(
                sprintf('%s expects parameter %d to be array, %s given', __FUNCTION__, 1, gettype($array)),
                E_USER_WARNING
            );
            return null;
        }
        return reset($array);
    }
}

if (!function_exists('array_first_key')) {
    function array_first_key($array)
    {
        if (!is_array($array)) {
            trigger_error(
                sprintf('%s expects parameter %d to be array, %s given', __FUNCTION__, 1, gettype($array)),
                E_USER_WARNING
            );
            return null;
        }
        reset($array);
        return key($array);
    }
}

if (!function_exists('array_last')) {
    /**
     * Returns the value of the last array element
     *
     * @param array $array
     * @return mixed
     */
    function array_last($array)
    {
        if (!is_array($array)) {
            trigger_error(
                sprintf('%s expects parameter %d to be array, %s given', __FUNCTION__, 1, gettype($array)),
                E_USER_WARNING
            );
            return null;
        }
        return end($array);
    }
}

if (!function_exists('array_reduce_left')) {
    /**
     * Reduce the array to a single value using a callback function applied
     * for each array value (from left to right)
     *
     * @param array $array
     * @param callable $callback
     * @param mixed $initial OPTIONAL
     * @return mixed
     */
    function array_reduce_left($array, $callback, $initial = null)
    {
        if (!is_array($array)) {
            trigger_error(
                sprintf('%s expects parameter %d to be array, %s given', __FUNCTION__, 1, gettype($array)),
                E_USER_WARNING
            );
            return null;
        }
        foreach ($array as $key => $value) {
            $initial = call_user_func($callback, $initial, $value, $key);
        }
        return $initial;
    }
}

if (!function_exists('array_reduce_right')) {
    function array_reduce_right($array, $callback, $initial = null)
    {
        if (!is_array($array)) {
            trigger_error(
                sprintf('%s expects parameter %d to be array, %s given', __FUNCTION__, 1, gettype($array)),
                E_USER_WARNING
            );
            return null;
        }
        end($array);
        while (($key = key($array)) !== null) {
            $initial = call_user_func($callback, $initial, current($array), $key);
            prev($array);
        }
        return $initial;
    }
}

if (!function_exists('array_flatten')) {
    /**
     * Convert multi-dimensional array into a flat array
     *
     * Arrays are traversed in the depth-first order.
     *
     * If the arrays have the same string keys, then the later value for that
     * key will overwrite the previous one. If, however, the arrays contain
     * numeric keys, the later value will not overwrite the original value,
     * but will be appended.
     *
     * @param $array
     * @return array
     */
    function array_flatten($array)
    {
        if (!is_array($array)) {
            trigger_error(
                sprintf('%s expects parameter %d to be array, %s given', __FUNCTION__, 1, gettype($array)),
                E_USER_WARNING
            );
            return null;
        }
        $stack = array(array(null, $array));
        $result = array();
        while (count($stack)) {
            list($key, $value) = array_shift($stack);
            if (is_array($value)) {
                // insert array items at the beginning of the stack maintaining
                // their order in the original array
                end($value);
                while (($k = key($value)) !== null) {
                    $v = current($value);
                    array_unshift($stack, array($k, $v));
                    prev($value);
                }
            } elseif (is_int($key)) {
                $result[] = $value;
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }
}

if (!function_exists('array_tail')) {
    /**
     * Return all items from array except first element
     *
     * @param array $array
     * @param bool $preserve_keys
     * @return array|null
     */
    function array_tail($array, $preserve_keys = false)
    {
        if (!is_array($array)) {
            trigger_error(
                sprintf('%s expects parameter %d to be array, %s given', __FUNCTION__, 1, gettype($array)),
                E_USER_WARNING
            );
            return null;
        }
        return array_slice($array, 1, count($array) - 1, $preserve_keys);
    }
}

if (!function_exists('array_every')) {
    /**
     * Test whether all items in the array pass the callback test
     *
     * @param array $array
     * @param callable $callback
     * @return bool
     */
    function array_every($array, $callback)
    {
        if (!is_array($array)) {
            trigger_error(
                sprintf('%s expects parameter %d to be array, %s given', __FUNCTION__, 1, gettype($array)),
                E_USER_WARNING
            );
            return null;
        }
        if (!is_callable($callback)) {
            trigger_error(
                sprintf('%s expects parameter %d to be a valid callback, %s given', __FUNCTION__, 2, gettype($array)),
                E_USER_WARNING
            );
            return null;
        }
        foreach ($array as $key => $value) {
            if (!call_user_func($callback, $value, $key, $array)) {
                return false;
            }
        }
        return true;
    }
}

if (!function_exists('array_some')) {
    /**
     * Test whether at least one item in the array pass the callback test
     *
     * @param array $array
     * @param callable $callback
     * @return bool
     */
    function array_some($array, $callback)
    {
        if (!is_array($array)) {
            trigger_error(
                sprintf('%s expects parameter %d to be array, %s given', __FUNCTION__, 1, gettype($array)),
                E_USER_WARNING
            );
            return null;
        }
        if (!is_callable($callback)) {
            trigger_error(
                sprintf('%s expects parameter %d to be a valid callback, %s given', __FUNCTION__, 2, gettype($array)),
                E_USER_WARNING
            );
            return null;
        }
        foreach ($array as $key => $value) {
            if (call_user_func($callback, $value, $key, $array)) {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('array_get_path')) {
    /**
     * @param array $array
     * @param string|array $path
     * @return mixed
     */
    function array_get_path($array, $path) {
        if (!is_array($array)) {
            trigger_error(
                sprintf('%s expects parameter %d to be array, %s given', __FUNCTION__, 1, gettype($array)),
                E_USER_WARNING
            );
            return null;
        }
        $value = $array;
        foreach ((array) $path as $key) {
            if (isset($value[$key])) {
                $value = $value[$key];
            } else {
                return null;
            }
        }
        return $value;
    }
}

if (!function_exists('array_set_path')) {
    function array_set_path(&$array, $path, $value) {
        if (!is_array($array)) {
            trigger_error(
                sprintf('%s expects parameter %d to be array, %s given', __FUNCTION__, 1, gettype($array)),
                E_USER_WARNING
            );
            return null;
        }
        $ref = &$array;
        foreach ((array) $path as $key) {
            if (!is_array($ref)) {
                $ref = array();
            }
            $ref = &$ref[$key];
        }
        $ref = $value;
        return $array;
    }
}

if (!function_exists('array_unset_path')) {
    function array_unset_path(&$array, $path) {
        if (!is_array($array)) {
            trigger_error(
                sprintf('%s expects parameter %d to be array, %s given', __FUNCTION__, 1, gettype($array)),
                E_USER_WARNING
            );
            return null;
        }
        $path = (array) $path;
        $ref = &$array;
        while (count($path)) {
            $key = array_shift($path);
            if (!is_array($ref) || !array_key_exists($key, $ref)) {
                break;
            }
            if (count($path)) {
                $ref = &$ref[$key];
            } else {
                unset($ref[$key]);
            }
        }
        return $array;
    }
}

if (!function_exists('array_path_exists')) {
    function array_path_exists($array, $path) {
        if (!is_array($array)) {
            trigger_error(
                sprintf('%s expects parameter %d to be array, %s given', __FUNCTION__, 1, gettype($array)),
                E_USER_WARNING
            );
            return null;
        }
        $value = $array;
        foreach ((array) $path as $key) {
            if (!is_array($value) || !array_key_exists($key, $value)) {
                return false;
            }
            $value = $value[$key];
        }
        return true;
    }
}

if (!function_exists('array_change_key_case_recursive')) {
    /**
     * Recursively changes the case of all keys in an array.
     *
     * @param array $array The array to work on
     * @param int $case    Either CASE_UPPER or CASE_LOWER (default)
     * @return array|false An array with its keys lower or uppercased, or FALSE if array is not an array.
     */
    function array_change_key_case_recursive($array, $case = CASE_LOWER) {
        if (!is_array($array)) {
            trigger_error(
                sprintf('%s expects parameter %d to be array, %s given', __FUNCTION__, 1, gettype($array)),
                E_USER_WARNING
            );
            return false;
        }
        $array = array_change_key_case($array, $case);
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = array_change_key_case_recursive($value, $case);
            }
        }
        return $array;
    }
}
