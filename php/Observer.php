<?php
header('Content-Type: text/html; charset=utf-8');
/*
 * 观察者模式
 * */

interface Observer {
    public function update($obj);
}

class Message implements Observer {
    public function update($obj)
    {
        echo '发送新订单短信(' . $obj->mobile . ')通知给商家！' . PHP_EOL;
    }
}

class Goods implements Observer {
    public function update($obj)
    {
        echo '修改商品' . $obj->goods_id . '的库存！' . PHP_EOL;
    }
}

class Order {

    private $observers = [];

    public function attach($ob)
    {
        $this->observers[] = $ob;
    }

    public function notify($obj)
    {
        foreach($this->observers as $ob) {
            $ob->update($obj);
        }
    }

    public function sale()
    {
        /*
         * 创建商品订单...
         * */
        // ...

        $obj = new stdClass();
        $obj->mobile = '139xxx...';
        $obj->goods_id = 12;

        $this->notify($obj);
    }

}

$message = new Message();
$goods = new Goods();
$order = new Order();
$order->attach($message);
$order->attach($goods);

// 订单卖出了！！
$order->sale();