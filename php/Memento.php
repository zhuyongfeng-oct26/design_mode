<?php

/*
 * 备忘录模式
 * */

class Message
{
    private $content;
    private $to;
    private $state;
    private $time;

    public function __construct($to, $content)
    {
        $this->to = $to;
        $this->content = $content;
        $this->state = '未发送';
        $this->time = time();
    }

    public function show()
    {
        return $this->to . '--' . $this->content . '--' . $this->time . '--' . $this->state . PHP_EOL;
    }

    public function createSaveState()
    {
        $ss = new saveState();
        $ss->setState($this->state);
        return $ss;
    }

    public function setSaveState($ss)
    {
        if($this->state != $ss->getState()) {
            $this->time = time();
        }
        $this->state = $ss->getState();
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }

}

class saveState
{
    private $state;
    public function setState($state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }
}

class stateContainer
{
    private $ss;
    public function setSaveState($ss)
    {
        $this->ss = $ss;
    }

    public function getSaveState()
    {
        return $this->ss;
    }
}

//模拟短信发送
$mlist = [];
$scList = [];
for($i = 1; $i <= 10; $i++) {
    $m = new Message('Phone' . $i, 'content' . $i);
    echo $m->show();

    //保存初始信息
    $sc = new stateContainer();
    $sc->setSaveState($m->createSaveState());
    $scList[] = $sc;

    //模拟短信发送，2发送成功，3发送失败
    $pushState = mt_rand(2, 3);
    $m->SetState($pushState == 2 ? '发送成功' : '发送失败');
    echo $m->show();

    $mlist[] = $m;
}

// 模拟另一个线程查找发送失败的并把它们还原到未发送状态
sleep(2);
foreach($mlist as $k => $m) {

    if($m->getState() == '发送失败') {
        $m->setSaveState($scList[$k]->getSaveState());
    }

    echo '查询发布失败后状态：' . PHP_EOL;
    echo $m->show();
}

