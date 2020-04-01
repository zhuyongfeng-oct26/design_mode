<?php

/*
 * 门面模式
 * */

class MessageInfo {
    public function send($service)
    {
        $service->send();
    }

}

class PushInfo {

    public function push($service)
    {
        $service->push();
    }
}


class AliYunService {
    public function send()
    {
        echo 'AliYun send..' . PHP_EOL;
    }

    public function push()
    {
        echo 'AliYun push..' . PHP_EOL;
    }
}

class Send {
    private $aliYunService;

    private $message;
    private $push;

    public function __construct()
    {
        $this->aliYunService = new AliYunService();
        $this->message = new MessageInfo();
        $this->push = new PushInfo();
    }

    public function pushAndSendAliYun()
    {
        $this->message->send($this->aliYunService);
        $this->push->push($this->aliYunService);
    }
}

$obj = new Send();
$obj->pushAndSendAliYun();