<?php

class Stack {
    private $data = [];
    private $min = [];

    public function push($val)
    {
        if (!is_numeric($val)) {
            return false;
        }
        array_unshift($this->data, $val);
        if (!count($this->min) || $val <= $this->min[0]) {
            array_unshift($this->min, $val);
        }
    }

    public function pop()
    {
        $res = array_shift($this->data);
        if (count($this->min) && $res == $this->min[0]) {
            array_shift($this->min);
        }
        return $res;
    }

    public function getMin()
    {
        if (!$this->min) {
            return false;
        }
        return $this->min[0];
    }
}

$stack = new Stack();
$stack->push(1);
var_dump($stack->getMin());
$stack->push(2);
var_dump($stack->getMin());
$stack->push(1);
var_dump($stack->getMin());
$stack->push(0);
var_dump($stack->getMin());
var_dump($stack->pop());
var_dump($stack->getMin());
var_dump($stack->pop());
var_dump($stack->getMin());
var_dump($stack->pop());
var_dump($stack->getMin());
var_dump($stack->pop());
var_dump($stack->getMin());
var_dump($stack->pop());