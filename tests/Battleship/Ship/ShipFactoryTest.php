<?php
namespace test\Battleship\Ship;

use \Battleship\Ship\Ship;
use \PHPUnit\Framework\TestCase;
use \Battleship\Ship\ShipFactory;

class ShipFactoryTest extends TestCase
{
    protected $shipFactory;

    public function __construct()
    {
        parent::__construct();
        $this->shipFactory = new ShipFactory(15);
        $this->shipFactory->addShipToMap('E','2',3,Ship::VERTICAL);
    }


    public function testCheckMapSuccess(){
        $this->assertTrue($this->shipFactory->checkMap('A','3',3,0));
    }

    public function testCheckMapFalse(){
        $status = $this->shipFactory->checkMap('T','11',7,0);
        $this->assertFalse($status);
    }
    public function testAddShipToMapToAnotherShip(){
        $this->assertFalse($this->shipFactory->addShipToMap('E',4,2,Ship::HORISONTAL));
    }

    public function testAddShipToMapSuccess(){
        $this->assertTrue($this->shipFactory->addShipToMap('B',4,2,Ship::HORISONTAL));
    }

    public function testAddShipToMapFalse(){
        $status = $this->shipFactory->addShipToMap('T','11',7,Ship::HORISONTAL);
        $this->assertFalse($status);
    }

    public function testAddMissActionSaccess(){
        $status = $this->shipFactory->damageShip('A','2');
        $this->assertEquals(0,$status);
    }

    public function testAddHitActionSaccess(){
        $status = $this->shipFactory->damageShip('E','3');
        $this->assertEquals(1,$status);
    }

    public function testAddDestroyActionSaccess(){
        $this->shipFactory->damageShip('E','2');
        $this->shipFactory->damageShip('E','3');
        $status = $this->shipFactory->damageShip('E','3');
        $this->assertEquals(-1,$status);
    }
}