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


/**
 * 求1+2+3+...+n
 * 要求不能使用乘除法、for、while、if、else、switch、case等关键字及条件判断语句（A?B:C）。
 */
function sumRecursion($n)
{
    $ans = $n;
    $n && ($ans += sumRecursion($n - 1));
    return $ans;
}

/**
 * 位运算求和
 */
function bitAdd($left, $right)
{
    while ($right != 0) {
        $tmp = $left ^ $right;
        $right = ($left & $right) << 1;
        $left = $tmp;
    }
    return $left;
}


/**
 * 大数求和
 */
function bigAdd($a, $b)
{
    $a = (string)$a;
    $b = (string)$b;

    $lena = strlen($a);
    $lenb = strlen($b);

    $ar = strrev($a);
    $br = strrev($b);

    $res = '';
    $last = 0;
    var_dump($ar, $br);
    for ($i = 0; $i < max($lena, $lenb); ++$i) {
        if (empty($ar[$i])) {
            $ar[$i] = 0;
        }
        if (empty($br[$i])) {
            $br[$i] = 0;
        }
        $tmp = intval($ar[$i]) + intval($br[$i]);
        if ($tmp > 10) {
            $tmp -= 10;
            $tmp += $last;
            $last = 1;
            $res .= $tmp;
        } elseif ($tmp < 0) {
            $tmp = -$tmp;
            $tmp += $last;
            $last = -1;
            $res .= $tmp;
        } else {
            $tmp += $last;
            $res .= $tmp;
        }
        echo $res . PHP_EOL;
    }

    return strrev($res);
}

echo bigAdd("11111111111111111111111111111111", "2222222222222222222222222222222222222222") . PHP_EOL;


$arr = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15];
$sum = 10;

// var_dump(findNumWithSum($arr, $sum));
// findSeqWithSum(200);
// echo sumRecursion(10) . PHP_EOL;
// echo bitAdd(5, 9) . PHP_EOL;