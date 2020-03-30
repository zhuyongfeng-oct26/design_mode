<?php
/*
 * 适配器模式
 * */
class Message {
    public function send()
    {
        echo '老接口发送短信!' . PHP_EOL;
    }

    public function push()
    {
        echo '老接口发送推送!' . PHP_EOL;
    }
}

class aliYunMessage {
    public function send_out_msg()
    {
        echo '新接口发送短信!' . PHP_EOL;
    }

    public function push_msg()
    {
        echo '新接口发送推送!' . PHP_EOL;
    }
}


class aliYunSDKAdapter extends Message {
    private $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function send()
    {
        $this->message->send_out_msg();
    }

    public function push()
    {
        $this->message->push_msg();
    }
}

//老接口发送短信
$message = new Message();
$message->send();
$message->push();

//新接口调用
$aliyun_message = new aliYunMessage();
$aliyun_sdk = new aliYunSDKAdapter($aliyun_message);
$aliyun_sdk->send();
$aliyun_sdk->push();
