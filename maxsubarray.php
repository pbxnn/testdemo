<?php

/**
 * 最大子数组和
 */
// 暴力遍历法O(n^2)
function getByTraversal($arr)
{
    if (!$arr || !is_array($arr)) {
        return false;
    }

    $start = 0;
    $end = 0;
    $max = $arr[0];
    $len = count($arr);
    for ($i = 0; $i < $len - 1; ++$i) {
        $sum = $arr[$i];
        for ($j = $i + 1; $j < $len; ++$j) {
            $sum += $arr[$j];
            if ($sum > $max) {
                $max = $sum;
                $start = $i;
                $end = $j;
            }
        }
    }

    return compact('max', 'start', 'end');
}


//贪心法O(n)
function getByGreedy($arr)
{
    if (!$arr || !is_array($arr)) {
        return false;
    }

    $maxNum = $arr[0];
    $maxSum = $arr[0];
    $sum = 0;
    $len = count($arr);

    for ($i = 0; $i < $len; ++$i) {
        $sum += $arr[$i];
        if ($arr[$i] > $maxNum) {
            $maxNum = $arr[$i];
        }

        if ($sum < 0) {
            $sum = 0;
        } elseif ($sum > $maxSum) {
            $maxSum = $sum;
        }
    }

    return $maxSum > 0 ? $maxSum : $maxNum;
}

$arr = [6,-2,-3,7,-15,2,2,1];
$arr2 = [-1,-2,-3,-4];
$res1 = getByTraversal($arr);
$res2 = getByGreedy($arr);
$res3 = getByGreedy($arr2);
var_dump($res3);exit;