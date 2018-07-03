<?php

function getByIndex($n)
{
    if (!is_int($n) || $n < 1) {
        return false;
    }

    $cnt = 0;
    $start = 1;
    while ($cnt < $n) {
        ++$start;
        if (isUglyNum($start)) {
            ++$cnt;
        }
    }

    return $start;
}


function isUglyNum($num)
{
    while ($num % 2 == 0) {
        $num /= 2;
    }

    while ($num % 3 == 0) {
        $num /= 3;
    }

    while ($num % 5 == 0) {
        $num /= 5;
    }

    return $num == 1;
}

$res = getByIndex(5);
var_dump($res);exit;