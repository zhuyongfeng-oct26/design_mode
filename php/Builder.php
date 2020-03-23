<?php
/*
 * 建造者设计模式
 * */
class Dialog {
    private $account;
    private $key;
    private $token;

    public function setAccount($account)
    {
        $this->account = $account;
    }

    public function setKey($key)
    {
        $this->key = $key;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function show()
    {
        echo 'account = ' . $this->account . PHP_EOL;
        echo 'key = ' . $this->key . PHP_EOL;
        echo 'token = ' . $this->token . PHP_EOL;
    }
}

interface Builder{
    public function builderAccount($account);
    public function builderKey($key);
    public function builderToken($token);
}

class DialogBuilder implements Builder{
    private $dialog;
    public function __construct()
    {
        $this->dialog = new Dialog();
    }

    public function builderAccount($account)
    {
        $this->dialog->setAccount($account);
    }

    public function builderKey($key)
    {
        $this->dialog->setKey($key);
    }

    public function builderToken($token)
    {
        $this->dialog->setToken($token);
    }

    public function getDialog()
    {
        return $this->dialog;
    }
}

class DialogDirector {
    public function construct($account, $key, $token)
    {
        $builder = new DialogBuilder();

        $builder->builderAccount($account);
        $builder->builderKey($key);
        $builder->builderToken($token);

        return $builder;
    }
}

// 调用方法一
$obj = new DialogDirector();
$obj->construct('account_123', 'key_123', 'token_123')->getDialog()->show();

// 调用方法二
$obj = new DialogBuilder();
$obj->builderAccount('account_123');
$obj->builderKey('key_123');
$obj->builderToken('token_123');
$obj->getDialog()->show();
