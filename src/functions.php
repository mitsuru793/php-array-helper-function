<?php
declare(strict_types=1);

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
