<?php

/*
 * 实现简单工厂模式
 * */
class Factory {
    //初始化静态方法
    public static function createProduct($type) {
        switch($type) {
            case 'A':
                return new ProductA();
                break;
            case 'B':
                return new ProductB();
                break;
        }
    }
}

interface Product {
    public function show();
}

class ProductA implements Product {
    public function show() {
        echo 'this is ProductA Class.';
    }
}

class ProductB implements Product {
    public function show() {
        echo 'this is ProductB Class.';
    }
}

$productA = Factory::createProduct('A');
$productA->show();

$productB = Factory::createProduct('B');
$productB->show();