<?php

/**
 * x的y次幂
 */
function getPower($base, $exp)
{
    if ($exp === 0) {
        return 1;
    }

    $res = 1;
    for ($i = 1; $i <= abs($exp); $i++) {
        $res = $res * $base;
    }

    if ($exp < 0) {
        return 1 / $res;
    }

    if ($exp > 0) {
        return $res;
    }
}

echo getPower(1.1, 4);
echo getPower(1.1, -4);