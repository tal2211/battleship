<?php
namespace Battleship\User;

use Battleship\Ship\ShipFactory;

interface PlayerInterface
{
    public function fire();
    public function setFleet(ShipFactory $ships);
    public function leaveShips();
}