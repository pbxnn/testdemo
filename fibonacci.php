<?php

function fibonacciRecursion($n)
{
    if ($n < 0) {
        return false;
    }
    if ($n <= 1) {
        return $n;
    }
    return fibonacciRecursion($n - 1) + fibonacciRecursion($n - 2);
}


function fibonacciNonRecursion($n)
{
    if ($n < 0) {
        return false;
    }
    if ($n <= 1) {
        return $n;
    }

    $one = 0;
    $two = 1;
    $res = 0;
    for ($i = 2; $i <= $n; $i++) {
        $res = $one + $two;
        $one = $two;
        $two = $res;
    }
    return $res;
}


for ($i = 0; $i < 10; $i++) {
    echo fibonacciRecursion($i) . ' ';
}
echo PHP_EOL;
for ($i = 0; $i < 10; $i++) {
    echo fibonacciNonRecursion($i) . ' ';
}