<?php

function find2DArray($needle, $haystack)
{
    if (!is_array($haystack) || !is_array($haystack[0])) {
        return false;
    }

    $yLen = count($haystack);
    $xLen = count($haystack[0]);

    $min = $haystack[0][0];
    $max = $haystack[$yLen - 1][$xLen - 1];

    if ($needle > $max || $needle < $min) {
        return false;
    }

    $xPos = $xLen - 1;
    $yPos = 0;
    while ($xPos >= 0 && $yPos <= $yLen - 1) {
        if ($haystack[$yPos][$xPos] > $needle) {
            $xPos--;
            continue;
        }

        if ($haystack[$yPos][$xPos] < $needle) {
            $yPos++;
            continue;
        }

        if ($haystack[$yPos][$xPos] == $needle) {
            return $haystack[$yPos][$xPos];
        }
    }

    return false;
}


function binarySearch($needle, $haystack)
{
    if (!is_array($haystack) || !is_numeric($needle)) {
        return false;
    }

    $len = count($haystack);
    $min = $haystack[0];
    $max = $haystack[$len - 1];

    if ($needle < $min || $needle > $max) {
        return false;
    }

    if ($len % 2 == 0) {
        $mid = intval($len / 2) - 1;
    } else {
        $mid = intval($len / 2);
    }
    
    if ($haystack[$mid] == $needle) {
        return $haystack[$mid];
    }

    if ($haystack[$mid] < $needle) {
        $newHaystack = array_slice($haystack, $mid + 1);
        return binarySearch($needle, $newHaystack);
    }

    if ($haystack[$mid] > $needle) {
        $newHaystack = array_slice($haystack, 0, $mid - 1);
        return binarySearch($needle, $newHaystack);
    }
}

// $a = [
//     [1, 3, 5],
//     [2, 4, 6],
//     [3, 5, 7],
//     [6, 7, 9],
// ];

// $res = find2DArray(10, $a);
// var_dump($res);


$binArr = [1,2,3,4,5,6,7];
var_dump(binarySearch(6, $binArr));