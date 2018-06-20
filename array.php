<?php

// diff
// $a = [1,2,3];
// $b = [1,2,3,4,5];
// 
// $diff1 = array_diff($a, $b);
// $diff2 = array_diff($b, $a);
// 
// var_dump($diff1, $diff2);


// diff_assoc
$a = ['a' => 1, 'b' => 2];
$b = ['a' => 2, 'b' => 2];

$diff1 = array_diff_assoc($a, $a);
var_dump($diff1);
