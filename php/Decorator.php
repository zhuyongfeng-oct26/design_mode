<?php
/*
 * 装饰器模式
 * */

interface MessageTemplate {
    public function message();
}

class CouponMessageTemplate implements MessageTemplate {

    public function message()
    {
        return '优惠券内容: 我们是全国第一的厂商，值得信赖哦！';
    }

}

abstract class DecoratorMessageTemplate implements MessageTemplate
{
    public $template;
    public function __construct($template)
    {
        $this->template = $template;
    }
}

class AdFilterDecoratorMessage extends DecoratorMessageTemplate {

    public function message()
    {
        return str_replace('全国第一', '优秀', $this->template->message());
    }
}


class Message {

    public function send(MessageTemplate $tm)
    {
        echo $tm->message() . PHP_EOL;
    }
}

// 老接口发送信息
$message = new Message();
$template = new CouponMessageTemplate();
$message->send($template);

//新接口发送信息
$template = new AdFilterDecoratorMessage($template);
$message->send($template);



