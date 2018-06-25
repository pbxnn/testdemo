<?php

class queue {

    protected $stack1 = [];

    protected $stack2 = [];

    public function push($val)
    {
        array_unshift($this->stack, $val);
    }

    public function pop()
    {
        if (!empty($this->stack2)) {
            return array_shift($this->stack2);
        }

        while ($this->stack1) {
            array_unshift($this->stack2, array_shift($this->stack1));
        }

        return array_shift($this->stack2);
    }
}