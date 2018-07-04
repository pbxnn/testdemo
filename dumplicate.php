<?php


function dumplicate($arr)
{
    $cnt = [];
    foreach ($arr as $k => $v) {
        if (!array_key_exists($v, $cnt)) {
            $cnt[$v] = 0;
        } else {
            $cnt[$v]++;
        }
    }

    $res = array_keys(array_filter($cnt));
    $len = count($res);
    $index = rand(1, 10000) % $len;

    return $res[$index];
}

$arr = [2,3,1,0,2,5,3];
echo dumplicate($arr);