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
 * 后序遍历
 */
function postOrder($pRoot)
{
    if ($pRoot == NULL) {
        return false;
    }
    postOrder($pRoot->left);
    postOrder($pRoot->right);
    echo $pRoot->val . PHP_EOL;
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
function mirrorPre($root)
{

}


/**
 * 层序遍历（队列）
 */
function levelOrder($root)
{
    if ($root == NULL) {
        return false;
    }

    $queue = [];
    array_push($queue, $root);

    while (count($queue)) {
        $root = array_shift($queue);

        if ($root == NULL) {
            break;
        } else {
            echo $root->val . PHP_EOL;
            if ($root->left != NULL) {
                array_push($queue, $root->left);
            }
            if ($root->right != NULL) {
                array_push($queue, $root->right);
            }
        }
    }
}


/**
 * 打印和为某一数值的所有路径
 */
function printPathBySum($root, $sum, $path = [], $currSum = 0)
{
    if ($root == NULL) {
        return false;
    }
    array_push($path, $root);
    $currSum += $root->val;
    if ($currSum == $sum) {
        foreach ($path as $k => $v) {
            echo $v->val . ' ';
        }
        echo PHP_EOL;
    }

    if ($root->left != NULL) {
        printPathBySum($root->left, $sum, $path, $currSum);
    }
    if ($root->right != NULL) {
        printPathBySum($root->right, $sum, $path, $currSum);
    }
}



/**
 * 中序遍历中，某节点的下一个节点
 */
function findNext($pNode)
{
    if ($pNode == NULL) {
        return NULL;
    }

    $pNext = NULL;
    if ($pNode->right != NULL) {
        $pNext = $pNode->right;
        while ($pNext != NULL) {
            $pNext = $pNext;
        }
    } elseif ($pNode->right == NULL && $pNode->next != NULL) {
        $pCurrent = $pNode;
        $pParent = $pNode->next;
        while ($pParent != NULL && $pCurrent == $pParent->right) {
            $pCurrent = $pParent;
            $pParent = $pCurrent->next;
        }
        $pNext = $pParent;
    }
    return $pNext;
}



/**
 * 判断二叉树是否对称
 */
function isSymmetry($root)
{
    if ($root == NULL) {
        return true;
    }
    return isSymmetryRescurison($root->left, $root->right);
}
function isSymmetryRescurison($left, $right)
{
    if ($left == NULL && $right == NULL) {
        return true;
    } elseif ($left == NULL || $right == NULL) {
        return false;
    } elseif ($left->val != $right->val) {
        return false;
    } else {
        return isSymmetryRescurison($left->left, $right->right) && isSymmetryRescurison($left->right, $right->left);
    }
}
// 测试
$p1 = [1,2,2];
$i1 = [2,1,2];
$p2 = [1,2,3,3,2,3,3];
$i2 = [3,2,3,1,3,2,3];
$p3 = [1,2,3,4,2,4,3];
$i3 = [3,2,4,1,4,2,3];
$r1 = buildTree($p1, $i1);
$r2 = buildTree($p2, $i2);
$r3 = buildTree($p3, $i3);
var_dump(isSymmetry($r1), isSymmetry($r2), isSymmetry($r3));exit;



/**
 * 二叉搜索树转双向链表（不创建新节点，中序）
 */
// class listNode {
//     public $val;
//     public $last = NULL;
//     public $next = NULL;
//     public function __construct($val) {
//         $this->val = $val;
//     }
// }
function convertRecursion($root, $lastNode = NULL)
{
    if ($root == NULL) {
        return NULL;
    }

    $currNode = $root;
    $lastNode = NULL;

    if ($currNode->left != NULL) {
        $lastNode = convertRecursion($currNode->left, $lastNode);
    }

    $currNode->left = $lastNode;
    if ($lastNode != NULL) {
        $lastNode->right = $currNode;
    }

    if ($currNode != NULL) {
        $lastNode = $currNode;
    }

    if ($currNode->right != NULL) {
        $lastNode = convertRecursion($currNode->right, $lastNode);
    }
    return $lastNode;
}

function convert($root)
{
    if ($root == NULL) {
        return NULL;
    }
    $lastNode = convertRecursion($root);
    while ($lastNode != NULL && $lastNode->left != NULL) {
        $lastNode = $lastNode->left;
    }
    return $lastNode;
}

// $searchPreOrder = [5,3,2,4,7,6,8];
// $searchInOrder = [2,3,4,5,6,7,8];
// $searchRoot = buildTree($searchPreOrder, $searchInOrder);
// // levelOrder($searchRoot);
// $listNode = convert($searchRoot);
// var_dump($listNode);
// exit;



/**
 *          1
 *         / \
 *        2   3
 *       /   / \
 *      4   14   6
 *       \     /
 *        11  8
 */
$preOrder = [1, 2, 4, 11, 3, 14, 6, 8];
$inOrder = [4, 11, 2, 1, 14, 3, 8, 6];
// $preOrder = [1, 2, 3];
// $inOrder = [2, 1, 3];
$root = buildTree($preOrder, $inOrder);
printPathBySum($root, 18, [], 0);
// exit;
// inOrder($root);
// preOrder($root);
// postOrder($root);
levelOrder($root);
exit;
// $depth = getDepth($root);
// var_dump($depth);

$cpre = [3, 5, 6];
$cin = [5, 3, 6];
$c = buildTree($cpre, $cin);
$res = hasSubTree($root, $c);


mirror($root);
preOrder($root);
inOrder($root);