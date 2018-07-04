<?php


/**
 * 在递增数组中找到和为sum的两个数字，如果有多对，输出乘积最小的一对
 */
function findNumWithSum($arr, $sum)
{
    $start = 0;
    $end = count($arr) - 1;

    while ($start < $end) {
        $currSum = $arr[$start] + $arr[$end];
        if ($sum == $currSum) {
            return [$arr[$start], $arr[$end]];
        }

        if ($currSum < $sum) {
            ++$start;
        }

        if ($currSum > $sum) {
            --$end;
        }
    }

    return false;
}


/**
 * 和为S的连续正数序列
 */
function findSeqWithSum($sum)
{
    $start = 1;
    $end = 2;
    while ($start <= $end) {
        $currSum = getSum($start, $end);
        if ($sum == $currSum) {
            break;
        }
        if ($sum < $currSum) {
            ++$start;
        }
        if ($sum > $currSum) {
            ++$end;
        }
    }

    for ($i = $start; $i <= $end; ++$i) {
        echo $i . ' ';
    }
    echo PHP_EOL;
}

function getSum($start, $end)
{
    return intval(($start + $end) * ($end - $start + 1) / 2);
}


$arr = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15];
$sum = 10;

// var_dump(findNumWithSum($arr, $sum));
findSeqWithSum(200);