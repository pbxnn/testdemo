<?php

function isNumeric($str)
{
    $len = strlen($str);
    $hasPoint = false;
    if ($str[0] != '+' && $str[0] != '-' && ($str[0] < 1 || $str[0] > 9)) {
        return false;        
    }
    for ($i = 1; $i < $len; ++$i) {
        if ($str[$i] >= '0' && $str[$i] <= '9') {
            continue;
        }

        if ($str[$i] == '.' && !$hasPoint) {
            $hasPoint = true;
            continue;
        }

        if ($str[$i] == '.' && $hasPoint) {
            return false;
        }

        if ($str[$i] == 'e' || $str[$i] == 'E') {
            continue;
        }

        if (($str[$i] == '+' || $str[$i] == '-')
            && ($str[$i - 1] == 'e' || $str[$i - 1] == 'E')) {
                continue;
        }

        return false; 
    }

    return true;
}


var_dump(isNumeric('1234'));
var_dump(isNumeric('+1234'));
var_dump(isNumeric('-1234'));
var_dump(isNumeric('-1234.111'));
var_dump(isNumeric('1234e111'));
var_dump(isNumeric('1234E111'));
var_dump(isNumeric('1234e+111'));
var_dump(isNumeric('1234E-111'));
var_dump(isNumeric('1.234E111'));

echo PHP_EOL . PHP_EOL;

var_dump(isNumeric('1234.1.1'));
var_dump(isNumeric('a1234'));
var_dump(isNumeric('12c34'));
var_dump(isNumeric('.1234'));