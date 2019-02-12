<?php
namespace Observer;

class Event implements EventInterface
{
    const INIT_USER = 'init_user';
    const BATTLE_STEP = 'battle_step';
    const HIT_EVENT = 'hit_event';
    const MISS_EVENT = 'miss_event';
    const DESTROY_EVENT = 'miss_event';
    const WIN_EVENT = 'win_event';

    private $name;
    private $sender;
    private $params;

    public function __construct($name, SubjectInterface $sender, $params = [])
    {
        $this->name = $name;
        $this->sender = $sender;
        $this->params = $params;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getParams()
    {
        return $this->params;
    }

    public function getSender()
    {
        return $this->sender;
    }
}