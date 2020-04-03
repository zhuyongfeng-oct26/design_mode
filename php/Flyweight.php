<?php
header('Content-Type: text/html; charset=utf-8');
/*
 * 享元模式
 * */
interface Message {
    public function send($user);
}

class AliYunMessage implements Message {

    private $template;

    public function __construct($template)
    {
        $this->template = $template;
    }

    public function send($user)
    {
        echo '使用阿里云向' . $user->getName() . '发送短信' . PHP_EOL;
        echo $this->template->getTemplate() . PHP_EOL;
    }

}

class JiGuangMessage implements Message {

    private $template;

    public function __construct($template)
    {
        $this->template = $template;
    }

    public function send($user)
    {
        echo '使用极光向' . $user->getName() . '发送短信' . PHP_EOL;
        echo $this->template->getTemplate() . PHP_EOL;
    }
}

class MessageFactory {

    private $messages = [];

    public function getMessage($template, $type = '')
    {
        $key = md5($template->getTemplate() . $type);
        if (!key_exists($key, $this->messages)) {
            if ($type == 'ali') {
                $this->messages[$key] = new AliYunMessage($template);
            } else {
                $this->messages[$key] = new JiGuangMessage($template);
            }
        }
        return $this->messages[$key];
    }
}

class User {
    public $name;

    public function getName()
    {
        return $this->name;
    }
}

class Template {
    public $template;

    public function getTemplate()
    {
        return $this->template;
    }
}

$t1 = new Template();
$t1->template = '模板一';

$t2 = new Template();
$t2->template = '模板二';

$u1 = new User();
$u1->name = '用户一';

$u2 = new User();
$u2->name = '用户二';

// 享元工厂
$factory = new MessageFactory();

$m1 = $factory->getMessage($t1, 'ali');
$m1->send($u1);

$m2 = $factory->getMessage($t2, 'ali');
$m2->send($u2);

$m3 = $factory->getMessage($t1, 'jg');
$m3->send($u1);

$m4 = $factory->getMessage($t2, 'jg');
$m4->send($u2);


