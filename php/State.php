<?php
/**
 * Created by PhpStorm.
 * User: bamboo
 * Date: 2020-06-09
 * Time: 22:19
 */

//状态模式
class Member
{
    private $state;
    private $score;

    public function setState($state)
    {
        $this->state = $state;
    }

    public function setScore($score)
    {
        $this->score = $score;
    }

    public function getScore()
    {
        return $this->score;
    }

    public function discount()
    {
        return $this->state->discount($this);
    }
}

interface State
{
    public function discount($member);
}

class PlatinumMemeberState implements State
{
    public function discount($member)
    {
        if($member->getScore() >= 1000) {
            return 0.8;
        } else {
            $member->setState(new GoldMemberState());
            return $member->discount();
        }
    }
}

class GoldMemberState implements State
{
    public function discount($member)
    {
        if($member->getScore() >= 800) {
            return 0.85;
        } else {
            $member->setState(new SilverMemberState());
            return $member->discount();
        }
    }
}

class SilverMemberState implements State
{
    public function discount($member)
    {
        if($member->getScore() >= 500) {
            return 0.9;
        } else {
            $member->setState(new SilverMemberState());
            return $member->discount();
        }
    }
}

class GeneralMemberState implements State
{
    public function discount($member)
    {
        // TODO: Implement discount() method.
        return 0.95;
    }
}

$m = new Member();
$m->SetState(new PlatinumMemeberState());
$m->setScore(1200);
echo '当前会员' . $m->GetScore() . '积分，折扣为：' . $m->discount(), PHP_EOL;