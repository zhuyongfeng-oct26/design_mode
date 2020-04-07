<?php
/*
 * 原型设计模式
*/

abstract class Prototype {
    abstract function cloned();
}

class Demo extends Prototype {

    public $title = '';

    public function getTitle()
    {
        echo $this->title . PHP_EOL;
    }

    public function cloned()
    {
        return clone $this;
    }
}

$obj_1 = new Demo();
$obj_1->title = 'test demo 1';
$obj_1->getTitle();

$obj_2 = $obj_1->cloned();
$obj_2->getTitle();