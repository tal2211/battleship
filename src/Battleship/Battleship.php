<?php
namespace Battleship;

use \Battleship\Ship\ShipFactory;
use \Battleship\User\Player;
use \Observer\Event;

class Battleship extends Battle implements BattleshipInterface {

    protected $users;

    private $user;
    private $opponent;

    public function addPlayer(Player $player){
        if($player->getState() == Player::ACTIVE){
            if(!isset($this->user)){
                $this->user = $player;
                $this->attachObserver($player);
            } else {
                throw new \Exception('Player already exists');
            }
        } else {
            if(!isset($this->opponent)){
                $this->opponent = $player;
                $this->attachObserver($player);
            } else {
                throw new \Exception('Opponent already exists');
            }
        }
    }

    public function run($x,$y)
    {
        if ($this->user->getState() == Player::ACTIVE){
            $this->hit($this->user,$this->opponent,$x,$y);
        } else {
            $this->hit($this->opponent,$this->user,$x,$y);
        }
    }

    public function hit(Player $currentUser,Player $user,$x,$y){
        $ship = $user->getFleet()->damageShip($x,$y);
        if($ship != 0){
            if($ship == -1){
                $event = new Event(Event::DESTROY_EVENT,$this);
                $this->notify($event);
            } else {
                $event = new Event(Event::HIT_EVENT,$this);
                $this->notify($event);
            }
            $status = ShipFactory::HIT_ITEM;
            if(!$user->getFleet()->hasShips()){
                $event = new Event(Event::WIN_EVENT,$this);
                $this->notify($event);
            }
        } else {
            $event = new Event(Event::MISS_EVENT,$this);
            $this->notify($event);
            $status = ShipFactory::MISS_ITEM;
        }
        $currentUser->getFleet()->addOpponentMap($x,$y,$status);
    }
    

    public function initPlayerEvent(){
        $event = new Event(Event::INIT_USER,$this);
        $this->notify($event);
    }
}
