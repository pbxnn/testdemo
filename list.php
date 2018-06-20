<?php

class ListNode {
    public $val;
    public $next = null;

    public function __construct($val = null)
    {
        $this->val = $val;
    }
}

function init($vals)
{
    $pHead = new ListNode(array_shift($vals));
    $node = $pHead;
    foreach ($vals as $k => $v) {
        $node->next = new ListNode($v);
        $node = $node->next;
    }
    return $pHead;
}


function initRing($vals, $start = 1)
{
    $pHead = init($vals);
    $pEnd = $pHead;
    while($pEnd->next) {
        $pEnd = $pEnd->next;
    }
    $node = $pHead;
    for ($i = 1; $i < $start && $node; ++$i) {
       $node = $node->next;
    }
    $pEnd->next = $node;
    return $pHead;
}

function dump($pHead)
{
    $node = $pHead;
    while($node) {
        echo $node->val . PHP_EOL;
        $node = $node->next;
    }

    echo PHP_EOL;
}

function findRing($pHead)
{
    $fast = $pHead;
    $slow = $pHead;

    while ($fast && $slow && $fast->next) {
        $slow = $slow->next;
        $fast = $fast->next->next;
        if ($fast === $slow) {
            return true;
        }
    }
    return false;
}

function findEntrance($pHead)
{
    $fast = $slow = $pHead;
    $hasRing = false;
    while ($slow && $fast && $fast->next) {
        $slow = $slow->next;
        $fast = $fast->next->next;
        if ($slow === $fast) {
            $curr = $slow;
            $hasRing = true;
            break;
        }
    }

    if (!$hasRing) {
        return false;
    }

    while ($pHead !== $curr) {
        $pHead = $pHead->next;
        $curr = $curr->next;
    }

    return $pHead;
}


function headInsert($pHead, $vals)
{
    $newHead = init($vals);
    $newEnd = $newHead;
    while ($newEnd->next) {
        $newEnd = $newEnd->next;
    }
    $newEnd->next = $pHead;
    $pHead = $newHead;
    return $pHead;
}


function isCross($pHead1, $pHead2)
{
    while ($pHead1 && $pHead1->next) {
        $pHead1 = $pHead1->next;
    }

    while ($pHead2 && $pHead2->next) {
        $pHead2 = $pHead2->next;
    }

    return $pHead1 === $pHead2 ? true : false;
}



function findCrossPoint($pHead1, $pHead2)
{
     $len1 = $len2 = 0;
     $node1 = $pHead1;
     $node2 = $pHead2;
     while ($node1 && $node1->next) {
        $node1 = $node1->next;
        ++$len1;
    }

    while ($node2 && $node2->next) {
        $node2 = $node2->next;
        ++$len2;
    }

    if ($node1!== $node2) {
        return false;
    }

    if ($len1 >= $len2) {
        $diff = $len1 - $len2;
        for ($i = 0; $i < $len1; ++$i) {
            if ($pHead1 === $pHead2) {
                return $pHead1;
            }
            $pHead1 = $pHead1->next;
            if ($i < $diff) {
                continue;
            }
            $pHead2 = $pHead2->next;
        }
    } else {
        $diff = $len2 - $len1;
        for ($i = 0; $i < $len2; ++$i) {
            if ($pHead1 === $pHead2) {
                return $pHead1;
            }
            $pHead2 = $pHead2->next;
            if ($i < $diff) {
                continue;
            }
            $pHead1 = $pHead1->next;
        }
    }

    return false;
}


$data1 = [1, 2, 3, 4, 5];
$data2 = [2, 3, 4, 5];
$r1= initRing($data1, 4);
$l1 = init($data1);
$l2 = headInsert($l1, $data2);
dump($l1);
dump($l2);
//$hasRing = findRing($r1);
//var_dump($hasRing);
//$entrance = findEntrance($r1);
//var_dump($entrance->val);
$isCoross = isCross($l1, $l2);
var_dump($isCoross);
$crossPoint = findCrossPoint($l1, $l2);
var_dump($crossPoint->val);
