<?php

function printMatrix($data, $row, $col)
{
    if (!$data || !is_array($data) || !$row || !$col) {
        return false;
    }

    $len = count($data);
    if ($len != $row * $col) {
        return false;
    }


    $res = [];
    $left = 0;
    $right = $col - 1;
    $up = 0;
    $down = $row - 1;
    $i = 0;
    while (true) {
        for ($j = $left; $j <= $right; ++$j) {
            if ($i >= $len) {
                return $res;
            }
            $res[$up][$j] = $data[$i];
            ++$i;
        }
        ++$up;

        for ($j = $up; $j <= $down; ++$j) {
            if ($i >= $len) {
                return $res;
            }
            $res[$j][$right] = $data[$i];
            ++$i;
        }
        --$right;

        for ($j = $right; $j >= $left; --$j) {
            if ($i >= $len) {
                return $res;
            }
            $res[$down][$j] = $data[$i];
            ++$i;
        }
        --$down;

        for ($j = $down; $j >= $up; --$j) {
            if ($i >= $len) {
                return $res;
            }
            $res[$j][$left] = $data[$i];
            ++$i;
        }
        ++$left;
    }
}

$data = [1,2,3,4,5,6,7,8,9,10,11,12];
$col = 4;
$row = 3;
$res = printMatrix($data, $row, $col);
for ($i = 0; $i < $row; ++$i) {
    for ($j = 0; $j < $col; ++$j) {
        echo $res[$i][$j] . ' ';
    }
    echo PHP_EOL;
}