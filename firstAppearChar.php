<?php

function firstAppearChar($str)
{
    $cnt = [];
    for ($i = 0; $i < strlen($str); ++$i) {
        if (empty($cnt[$str[$i]])) {
            $cnt[$str[$i]] = [1, $i];
        } else {
            ++$cnt[$str[$i]][0];
        }
    }

    foreach ($cnt as $k => $v) {
        if ($v[0] == 1) {
            return $v[1];
        }
    }
}


$str = 'ababcbdef';
var_dump(firstAppearChar($str));