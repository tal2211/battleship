<?php
namespace Observer;

interface SubjectInterface
{
    public function attachObserver(ObserverInterface $observer);
    public function dettachObserver(ObserverInterface $observer);
    public function notify(EventInterface $event);
}