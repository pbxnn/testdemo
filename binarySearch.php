<?php

function binarySearch($data, $val)
{
    $len = count($data);
    if (!is_array($data) || !$len) {
        return false;
    }

    if ($val < $data[0] || $val > $data[$len - 1]) {
        return false;
    }

    $midPos = $len / 2;
    $midVal = $data[$midPos];
    var_dump($midVal);
    if ($val == $midVal) {
        return true;
    }
    if ($val > $midVal) {
        $newData = array_slice($data, $midPos + 1);
        return binarySearch($newData, $val);
    }
    if ($val < $midVal) {
        $newData = array_slice($data, 0, $midPos - 1);
        return binarySearch($newData, $val);
    }
}


$arrData = array(1,2,3,4,5,7,8,9,11,23,56,100,104,578,1000); 
var_dump(binarySearch($arrData, 555));
var_dump(binarySearch($arrData, 100));