<?php

class TreeNode {
    public $val;
    public $left = NULL;
    public $right = NULL;

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

/**
 * 前序遍历
 */
function preOrder($pRoot)
{
    if ($pRoot == NULL) {
        return false;
    }

    echo $pRoot->val . PHP_EOL;
    preOrder($pRoot->left);
    preOrder($pRoot->right);
}


/**
 * 中序遍历
 */
function inOrder($pRoot)
{
    if ($pRoot == NULL) {
        return false;
    }
    inOrder($pRoot->left);
    echo $pRoot->val . PHP_EOL;
    inOrder($pRoot->right);
}


/**
 * 根据前序和中序遍历重建二叉树
 */
function buildTree($preOrder = [], $inOrder)
{
    if (!$preOrder || !$inOrder || !is_array($preOrder) || !is_array($inOrder) || count($preOrder) != count($inOrder)) {
        return NULL;
    }

    $rootVal = $preOrder[0];
    $pRoot = new TreeNode($rootVal);

    $inPos = array_search($rootVal, $inOrder);
    if ($inPos === false) {
        return NULL;
    }
    $leftLen = $inPos + 1;

    $leftPre = array_slice($preOrder, 1, $leftLen - 1);
    $rightPre = array_slice($preOrder, $leftLen);

    $leftIn = array_slice($inOrder, 0, $leftLen - 1);
    $rightIn = array_slice($inOrder, $leftLen);
// var_dump($leftPre, $rightPre, $leftIn, $rightIn);exit;
    $pRoot->left = buildTree($leftPre, $leftIn);
    $pRoot->right = buildTree($rightPre, $rightIn);

    return $pRoot;
}


/**
 * 判断一颗二叉树是否为另一二叉树的子树
 */
function isChild($parent, $child)
{
    if ($child == NULL) {
        return true;
    } elseif ($parent == NULL) {
        return false;
    }

    if ($parent->val != $child->val) {
        return false;
    }

    return isChild($parent->left, $child->left) && isChild($parent->right, $child->right);
}

function hasSubTree($parent, $child)
{
    if ($child == NULL) {
        return false;
    } elseif ($parent == NULL) {
        return false;
    }

    $res = false;
    if ($parent->val == $child->val) {
        $res = isChild($parent, $child);
    }

    if (!$res) {
        return hasSubTree($parent->left, $child) || hasSubTree($parent->right, $child);
    }

    return true;
}


/**
 * 镜像
 */
function mirror($root)
{
    if ($root == NULL) {
        return false;
    }

    swap($root->left, $root->right);
    mirror($root->left);
    mirror($root->right);
}

function swap(&$left, &$right)
{
    $tmp = $left;
    $left = $right;
    $right = $tmp;
}

/**
 * 非递归求镜像
 */
/**
 * 前序
 */
function mirrorPre($root)
{
    
}



/**
 *          1
 *         / \
 *        2   3
 *       /   / \
 *      4   5   6
 *       \     /
 *        7   8
 */
$preOrder = [1, 2, 4, 7, 3, 5, 6, 8];
$inOrder = [4, 7, 2, 1, 5, 3, 8, 6];
// $preOrder = [1, 2, 3];
// $inOrder = [2, 1, 3];
$root = buildTree($preOrder, $inOrder);
// var_dump($root);
// inOrder($root);
// preOrder($root);
// $depth = getDepth($root);
// var_dump($depth);

$cpre = [3, 5, 6];
$cin = [5, 3, 6];
$c = buildTree($cpre, $cin);
$res = hasSubTree($root, $c);


mirror($root);
preOrder($root);
inOrder($root);