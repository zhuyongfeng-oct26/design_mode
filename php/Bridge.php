<?php
/*
 * 桥接模式
 * */
interface MessageTemplate {
    public function getTemplate();
}

class LoginMessage implements MessageTemplate {

    public function getTemplate()
    {
        echo "login code : " . rand(111, 999) . rand(111, 999) . rand(111, 999) . rand(111, 999);
    }
}

abstract class MessageService
{
    protected $template;

    public function SetTemplate($template)
    {
        $this->template = $template;
    }

    abstract public function send();
}

class aliYunService extends MessageService {

    public function send()
    {
        $this->template->getTemplate();
    }
}

$login_message = new LoginMessage();
$aliyun = new aliYunService();
$aliyun->SetTemplate($login_message);
$aliyun->send();


