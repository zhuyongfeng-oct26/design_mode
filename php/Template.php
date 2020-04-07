<?php
/*
 * 模板模式
 * */

abstract class Cache {

    private $config;
    private $conn;

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $this->getConfig();
        $this->openConnection();
        $this->checkConnection();
    }

    abstract public function getConfig();
    abstract public function openConnection();
    abstract public function checkConnection();

}

class MemcachedCache extends Cache {

    public function getConfig()
    {
        echo 'get Memcached config' . PHP_EOL;
    }

    public function openConnection()
    {
        $this->conn = true;
        echo 'open Memcached connection' . PHP_EOL;
    }

    public function checkConnection()
    {
        if($this->conn === true) {
            echo 'check Memcached connection success' . PHP_EOL;
        } else {
            echo 'check Memcached connection fail' . PHP_EOL;
        }
    }

}

class RedisCache extends Cache {

    public function getConfig()
    {
        echo 'get Redis config' . PHP_EOL;
    }

    public function openConnection()
    {
        $this->conn = false;
        echo 'open Redis connection' . PHP_EOL;
    }

    public function checkConnection()
    {
        if($this->conn === true) {
            echo 'check Redis connection success' . PHP_EOL;
        } else {
            echo 'check Redis connection fail' . PHP_EOL;
        }
    }

}

//示例
$memcached = new MemcachedCache();
$redis = new RedisCache();