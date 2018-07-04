<?php

function reverseSentence($str)
{
    $arr = explode(" ", $str);
    $arr = array_reverse($arr);
    $res = implode(" ", $arr);
    echo $res . PHP_EOL;
}

reverseSentence('student. a am I');
reverseSentence("JOBDU! like I and Freshman a I'm");
