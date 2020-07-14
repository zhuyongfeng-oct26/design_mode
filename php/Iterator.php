<?php
/*
 * 迭代器模式
 * */

interface IteratorTest
{
    public function first();
    public function next();
    public function isDone();
    public function currentItem();
}

class MsgIterator implements IteratorTest
{

    private $list;
    private $index;

    public function __construct($list)
    {
        $this->list = $list;
        $this->index = 0;
    }

    public function first()
    {
        $this->index = 0;
    }

    public function next()
    {
        $this->index++;
    }

    public function isDone()
    {
        return $this->index >= count($this->list);
    }

    public function currentItem()
    {
        return $this->list[$this->index];
    }

}

class Message
{
    public function createIterator($list)
    {
        return new MsgIterator($list);
    }
}

$mobileList = [
    '13111111111',
    '13111111112',
    '13111111113',
    '13111111114',
    '13111111115',
    '13111111116',
    '13111111117',
    '13111111118',
];

$server = new Message();
$iterator = $server->createIterator($mobileList);

while(!$iterator->isDone()) {
    echo $iterator->currentItem() . PHP_EOL;
    $iterator->next();
}

