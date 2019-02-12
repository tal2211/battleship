<?php
namespace Battleship\User;

use Observer\Event;
use Observer\ObserverInterface;
use Observer\EventInterface;
use Battleship\Ship\ShipFactory;

class Player implements PlayerInterface, ObserverInterface
{
    const ACTIVE = 'active';
    const WAIT = 'wait';
    protected $name;
    protected $state;
    protected $fleet;
    protected $leaveShips;
    protected $hitMap;
    protected $score;
    protected $destrShips;


    public function __construct($name = '')
    {
        $this->name = (!empty($name))?$name:'opponent';
        $this->state = self::WAIT;
    }

    public function setState($state){
        $this->state = $state;
    }

    public function getState(){
        return $this->state;
    }

    public function fire()
    {

    }

    /**
     * @return ShipFactory
     */
    public function getFleet()
    {
        return $this->fleet;
    }

    /**
     * @param ShipFactory $ships
     */
    public function setFleet(ShipFactory $ships)
    {
        $this->fleet = $ships;
    }

    public function leaveShips()
    {
        // TODO: Implement leaveShips() method.
    }

    public function update(EventInterface $event)
    {
        switch ($event->getName()){
            case Event::INIT_USER:
                print("Customer {$this->name} event:".$event->getName());
                break;
            case Event::MISS_EVENT:
                print("Customer {$this->name} MISS event:".$event->getName());
                if($this->state == self::WAIT){
                    $this->state = self::ACTIVE;
                } else {
                    $this->state = self::WAIT;
                }
                break;
            case Event::HIT_EVENT:
                print("Customer {$this->name} HIT event:".$event->getName());
                if($this->state == self::WAIT){
                    //$this->state = self::ACTIVE;
                } else {
                    //$this->state = self::WAIT;
                    $this->score += 1;
                }
                break;
            case Event::DESTROY_EVENT:
                print("Customer DESTROY state:{$this->state} event:".$event->getName());
                if($this->state == self::WAIT){
                    //$this->state = self::ACTIVE;
                } else {
                    //$this->state = self::WAIT;
                    $this->score += 10;
                    $this->destrShips ++;
                }
                break;
        }
    }
}