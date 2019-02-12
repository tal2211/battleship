<?php
namespace Battleship;
use \Observer\SubjectInterface;
use \Observer\ObserverInterface;
use \Observer\EventInterface;

class Battle implements SubjectInterface
{
    private $observers;

    public function attachObserver(ObserverInterface $observer)
    {
        if(empty($this->observers) || !in_array($observer,$this->observers)){
            $this->observers[] = $observer;
        }
    }

    public function dettachObserver(ObserverInterface $observer)
    {
        foreach ($this->observers as $k => $obs){
            if($obs == $observer){
                unset($this->observers[$k]);
                return;
            }
        }
    }

    public function notify(EventInterface $event)
    {
        foreach ($this->observers as $obs){
            $obs->update($event);
        }
    }
}