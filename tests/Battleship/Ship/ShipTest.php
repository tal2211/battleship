<?php
namespace test\Battleship\Ship;

use \Battleship\Ship\Ship;
use \PHPUnit\Framework\TestCase;

class ShipTest extends TestCase
{
    protected $ship;

    public function __construct()
    {
        parent::__construct();
        $this->ship = new Ship('C','2',3, Ship::HORISONTAL);
    }

    public function testHitState(){
        $ship = $this->ship;
        $ship->setDamage('C','2');

        $this->assertEquals(Ship::HITTED,$ship->getState());
    }

    public function testDestroyState(){
        $ship = $this->ship;
        $ship->setDamage('C','2');
        $ship->setDamage('D','2');
        $ship->setDamage('E','2');

        $this->assertEquals(Ship::DESTROYED,$ship->getState());
    }
}