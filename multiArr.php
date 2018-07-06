<?php

function multiArr($arr)
{
    $res = [];
    $len = count($arr);

    for ($i = 0, $tmp = 1; $i < $len; ++$i) {
        $res[$i] = $tmp;
        $tmp *= $arr[$i];
    }

    for ($i = $len -1, $tmp = 1; $i >= 0; --$i) {
        $res[$i] *= $tmp;
        $tmp *= $arr[$i];
    }

    return $res;
}

$arr = [3,4,5];
foreach ($arr as $k => $v) {
    echo $v . ' ';
}

echo PHP_EOL;

$res = multiArr($arr);
foreach ($res as $k => $v) {
    echo $v . ' ';
}
echo PHP_EOL;