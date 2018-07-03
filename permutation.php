<?php
/**
 * 字符串排列组合，列出全部情况
 */
class Test{

    protected $data = [];

    public function permutation ($prefix, $str)
    {
        $len = strlen($str);
        if ($len == 0) {
            $this->data[] = $prefix;
        }
    
        for ($i = 0; $i < $len; ++$i) {
            $this->permutation($prefix . $str[$i], substr($str, 0, $i) . substr($str, $i + 1));
        }
    }

    public function dump()
    {
        $res = array_unique($this->data);
        foreach ($res as $k => $v) {
            echo $v . PHP_EOL;
        }
        echo PHP_EOL;
    }

    public function reset()
    {
        $this->data = [];
    }
}

$obj = new Test;
$obj->permutation('', 'abc');
$obj->dump();
$obj->reset();
$obj->permutation('', 'def');
$obj->dump();
$obj->reset();