<?php
declare(strict_types=1);

if (!function_exists('is_empty_array')) {
    function is_empty_array($value): bool
    {
        return is_array($value) && empty($value);
    }
}

if (!function_exists('is_full_array')) {
    function is_full_array($value): bool
    {
        return is_array($value) && !empty($value);
    }
}

if (!function_exists('is_numeric_array')) {
    function is_numeric_array($array): bool
    {
        if (!is_array($array)) return false;

        $keys = array_keys($array);
        foreach ($keys as $key) {
            if (!is_int($key)) return false;
        }
        return true;
    }
}

if (!function_exists('is_numeric_array_recursive')) {
    function is_numeric_array_recursive($array): bool
    {
        if (!is_array($array)) return false;

        foreach ($array as $key => $value) {
            if (is_array($value) && !is_numeric_array_recursive($value)) {
                return false;
            }
        }
        return is_numeric_array($array);
    }
}

if (!function_exists('array_every')) {
    function array_every(array $array, callable $test = null): bool
    {
        if (is_null($test)) {
            foreach ($array as $value) {
                if (!$value) return false;
            }
            return true;
        }

        foreach ($array as $key => $value) {
            if (!$test($value, $key)) return false;
        }
        return true;
    }
}

if (!function_exists('array_any')) {
    function array_any(array $array, callable $test = null): bool
    {
        if (is_null($test)) {
            foreach ($array as $value) {
                if ($value) return true;
            }
            return false;
        }

        foreach ($array as $key => $value) {
            if ($test($value, $key)) return true;
        }
        return false;
    }
}

if (!function_exists('array_diff_key_recursive')) {
    function array_diff_key_recursive(array $main, array $other): array
    {
        $diff = [];
        foreach ($main as $mainKey => $mainValue) {
            if (!array_key_exists($mainKey, $other)) {
                $diff[$mainKey] = $mainValue;
                continue;
            }

            $otherValue = $other[$mainKey] ?? null;
            if (is_array($mainValue) && is_array($otherValue)) {
                $newDiff = array_diff_key_recursive($mainValue, $otherValue);
                if (is_array($newDiff) && !empty($newDiff)) {
                    $diff[$mainKey] = $newDiff;
                }
            } elseif (is_array($mainValue)) {
                $diff[$mainKey] = $mainValue;
            }
        }
        return $diff;
    }
}

if (!function_exists('array_filter_recursive')) {
    function array_filter_recursive(array $array, callable $test = null): array
    {
        foreach ($array as &$value) {
            if (is_array($value)) {
                $value = array_filter_recursive($value, $test);
            }
        }

        if (is_null($test)) {
            return array_filter($array);
        }
        return array_filter($array, $test, ARRAY_FILTER_USE_BOTH);
    }
}

if (!function_exists('array_pick')) {
    function array_pick(array &$array, array $values): array
    {
        $new = [];
        $picked = [];

        foreach ($array as $k => $v) {
            if (in_array($v, $values, true)) {
                $picked[$k] = $v;
                continue;
            }
            $new[$k] = $v;
        }

        $array = $new;
        return $picked;
    }
}
