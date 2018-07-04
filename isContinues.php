<?php

function isContinues($arr)
{
    sort($arr);
    $index = 0;
    $zeroCnt = 0;
    while ($arr[$index] == 0) {
        ++$index;
        ++$zeroCnt;
    }

    for ($i = $index; $i < count($arr) - 1; ++$i) {
        $gap = $arr[$i + 1] - $arr[$i];

        if ($gap == 1) {
            continue;
        }

        $zeroCnt  = $zeroCnt - $gap + 1;
    }

    if ($zeroCnt >= 0) {
        echo 'y' . PHP_EOL;
    } else {
        echo 'n' . PHP_EOL;
    }
}

$arr = [0,2,6,1,4];
isContinues($arr);