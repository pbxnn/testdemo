<?php

function isPopOrder($inOrder, $outOrder)
{
    $inLen = count($inOrder);
    $outLen = count($outOrder);

    if (!is_array($inOrder) || !is_array($outOrder) || !$inLen || $inLen != $outLen) {
        return false;
    }
    $tmp = [];
    array_unshift($tmp, $inOrder[0]);
    echo 'push ' . $inOrder[0] . PHP_EOL;
    for ($i = 0, $j = 0; $i < $inLen && $j < $outLen;) {
        if (!empty($tmp) && $tmp[0] == $outOrder[$j]) {
            array_shift($tmp);
            echo 'pop ' . $outOrder[$i] . PHP_EOL;
            ++$j;
            continue;
        } else {
            ++$i;
            echo 'push ' . $inOrder[$i] . PHP_EOL;
            array_unshift($tmp, $inOrder[$i]);

        }
    }
var_dump($tmp);
    return empty($tmp);
}

$in = [1,2,3];
$out = [1,3,2];
var_dump(isPopOrder($in, $out));