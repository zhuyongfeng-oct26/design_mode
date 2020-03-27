<?php
header('Content-Type: text/html; charset=utf-8');

/*
 * 代理模式
 * */
class UserProxy extends User{
    private $statistics;

    public function __construct()
    {
        $this->statistics = new Statistics;
    }

    public function login()
    {
        $this->statistics->start_time = time();
        sleep(2);
        parent::login();
        $this->statistics->end_time = time();
        echo $this->statistics->timeStatistics() . PHP_EOL;
    }
}


/*
 * 耗时统计
 * */
class Statistics {

    public $start_time = 0;
    public $end_time = 0;

    public function timeStatistics()
    {
        $running_time = bcsub($this->end_time, $this->start_time);
        echo '耗时：' . $running_time . 's';
    }
}


/*
 * 用户类
 * */
class User {

    public function login()
    {
        echo '登陆成功!' . PHP_EOL;
    }

    public function register()
    {
        echo '注册成功!' . PHP_EOL;
    }
}

$obj = new UserProxy();
$obj->login();
