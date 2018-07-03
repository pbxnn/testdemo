<?php

/**
 * 1-n的整数中，数字1出现的次数
 */


// 遍历法O(nlogn)
function getByTraversal($n)
{
    if (!is_int($n) || $n < 1) {
        return false;
    }

    $count = 0;
    for ($i = 1; $i <= $n; ++$i) {
        $count += getCount($i);
    }

    return $count;
}


function getCount($num)
{
    $count = 0;
    while ($num) {
        if ($num % 10 == 1) {
            ++$count;
        }
        $num = intval($num / 10);
    }
    return $count;
}

$cnt = getByTraversal(200);
echo $cnt . PHP_EOL;