<?php

/**
 * 调整数组顺序，使奇数位于偶数前面,并保证奇数和奇数，偶数和偶数之间的相对位置不变
 */
function reOrder($arr)
{
    if (!is_array($arr) || !$arr) {
        return false;
    }
    $newArr = [];
    $lIndex = 0;
    $rIndex = count($arr) - 1;
    foreach ($arr as $k => $v) {
        if ($v % 2 == 1) {
            $newArr[] = $v;
            unset($arr[$k]);
        }
    }
    $newArr = array_merge($newArr, $arr);
    return $newArr;
}

$arr = [5, 1, 2, 3, 4, 5];
var_dump(reOrder($arr));