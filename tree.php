<?php

class TreeNode {
    public $val;
    public $lchild = NULL;
    public $rchild = NULL;

    public function __construct($val)
    {
        $this->val = $val;
    }
}


/**
 * 求二叉树深度，非递归，广度优先遍历
 */
function getDepth($pRoot)
{
    if ($pRoot == NULL) {
        return false;
    }

    $count = 0;
    $nextCount = 1;
    $depth = 0;

    $queue = [];
    array_push($queue, $pRoot);

    while (!empty($queue)) {
        $count++;
        $val = array_shift($queue);
        if ($val->left) {
            array_push($queue, $val->left);
        }
        
        if ($val->right) {
            array_push($queue, $val->right);
        }

        if ($count == $nextCount) {
            $depth++;
            $nextCount = count($queue);
            $count = 0;
        }
    }
    return $depth;
}

