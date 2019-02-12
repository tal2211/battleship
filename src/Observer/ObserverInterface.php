<?php
namespace Observer;

interface ObserverInterface
{
    public function update(EventInterface $event);
}