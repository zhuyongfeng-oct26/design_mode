<?php

/*
 * 访问者模式
 * **/

interface ServiceVisitor
{
    public function sendMsg(SendMessage $e);

    public function pushMsg(PushMessage $p);
}

class AliYun implements ServiceVisitor
{
    public function sendMsg(SendMessage $e)
    {
        echo 'ali send message' . PHP_EOL;
    }

    public function pushMsg(PushMessage $p)
    {
        echo 'ali push message' . PHP_EOL;
    }
}

class JiGuang implements ServiceVisitor
{
    public function sendMsg(SendMessage $e)
    {
        echo 'jiguang send message' . PHP_EOL;
    }

    public function pushMsg(PushMessage $p)
    {
        echo 'jiguang push message' . PHP_EOL;
    }
}

interface Message
{
    public function msg(ServiceVisitor $v);
}

class PushMessage implements Message
{
    public function msg(ServiceVisitor $v)
    {
        echo '推送脚本启动：' . PHP_EOL;
        $v->pushMsg($this);
    }
}

class SendMessage implements Message
{
    public function msg(ServiceVisitor $v)
    {
        echo '短信脚本启动：' . PHP_EOL;
        $v->sendMsg($this);
    }
}

class ObjectStructure
{
    private $elements = [];

    public function attach(Message $element)
    {
        $this->elements[] = $element;
    }

    public function accept(ServiceVisitor $visitor)
    {
        foreach($this->elements as $element) {
            $element->msg($visitor);
        }
    }
}

$o = new ObjectStructure();
$o->attach(new PushMessage());
$o->attach(new SendMessage());

$v1 = new AliYun();
$v2 = new JiGuang();

$o->accept($v1);
$o->accept($v2);


