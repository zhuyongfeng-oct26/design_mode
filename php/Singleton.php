<?php


/*
 * 实现单例模式
 * */
class Singleton {

	//创建静态私有变量保存对象
	static private $instance;

	//参数
	public $name;

	//防止直接创建对象
	private function __construct($name) {
		$this->name = $name;
	}

	//防止克隆
	private function __clone() {}


	static public function getInstance($name) {
		if(!self::$instance instanceof self) {
			self::$instance = new self($name);
		}

		return self::$instance;
	}

	public function test() {
		echo '我是一个 ' . $this->name; 
	}
}

$obj = Singleton::getInstance('单例类1');
$obj->test();


$obj = Singleton::getInstance('单例类2');
$obj->test();

