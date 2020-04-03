<?php
header('Content-Type: text/html; charset=utf-8');
/*
 * 组合模式
 * */
abstract class Role {

    protected $user_role_list;
    protected $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    abstract public function add($role);

    abstract public function remove($role);

    abstract public function sendMessage();

}

class RoleManger extends Role {

    public function add($role)
    {
        $this->user_role_list[] = $role;
    }

    public function remove($role)
    {
        $position = 0;
        foreach ($this->user_role_list as $n) {
            ++$position;
            if ($n == $role) {
                array_splice($this->user_role_list, ($position), 1);
            }
        }
    }

    public function sendMessage()
    {
        echo 'begin send ' . $this->name . PHP_EOL;
        foreach($this->user_role_list as $role) {
            $role->sendMessage();
        }
    }

}

class Team extends Role {
    public function add($role)
    {
        echo "小组用户不能添加下级了！", PHP_EOL;
    }

    public function remove($role)
    {
        echo "小组用户没有下级可以删除！", PHP_EOL;
    }

    public function sendMessage()
    {
        echo "小组用户角色：" . $this->name . '的短信已发送！', PHP_EOL;
    }
}

// root 用户
$root = new RoleManger('root用户');
$root->add(new Team('小组用户'));
$root->sendMessage();

// 其他用户
$root2 = new RoleManger('社交版块');
$managerA = new RoleManger('论坛用户');
$managerA->add(new Team('论坛用户一组'));
$managerA->add(new Team('论坛用户二组'));

$managerB = new RoleManger('sns用户');
$managerB->add(new Team('sns用户一组'));
$managerB->add(new Team('sns用户二组'));

$root2->add($managerA);
$root2->add($managerB);
$root2->sendMessage();