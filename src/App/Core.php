<?php
namespace App;

use Battleship\User\Player;
use Battleship\Battleship;
use Battleship\Ship\ShipFactory;
use Battleship\Ship\Ship;

class Core
{
    private $size;
    public function __construct($gridSize = 15)
    {
        $this->size = $gridSize;
    }

    public function run(){

        // Get user position;
        $x = (in_array('x',$_POST))?:'A';
        $y = (in_array('y',$_POST))?:'1';

        $user1 = new Player();
        $fleet1 = new ShipFactory($this->size);
        $fleet1->addShipToMap('A','3',1,Ship::HORISONTAL);
        $fleet1->addShipToMap('F','1',1,Ship::HORISONTAL);
        $fleet1->addShipToMap('K','13',1,Ship::HORISONTAL);
        $fleet1->addShipToMap('D','5',1,Ship::HORISONTAL);

        $fleet1->addShipToMap('A','1',2,Ship::VERTICAL);
        $fleet1->addShipToMap('D','8',2,Ship::VERTICAL);
        $fleet1->addShipToMap('B','11',2,Ship::HORISONTAL);


        $fleet1->addShipToMap('C','2',3,Ship::HORISONTAL);
        $fleet1->addShipToMap('A','5',3,Ship::HORISONTAL);

        $fleet1->addShipToMap('E','4',1,Ship::VERTICAL);

        $user1->setFleet($fleet1);
        $user1->setState(Player::ACTIVE); //First play

        $user2 = new Player();
        $fleet2 = new ShipFactory($this->size);
        $fleet2->addShipToMap('C','3',1,Ship::HORISONTAL);
        $fleet2->addShipToMap('I','1',1,Ship::HORISONTAL);
        $fleet2->addShipToMap('E','3',1,Ship::HORISONTAL);
        $fleet2->addShipToMap('D','5',1,Ship::HORISONTAL);

        $fleet2->addShipToMap('A','7',2,Ship::VERTICAL);
        $fleet2->addShipToMap('K','8',2,Ship::VERTICAL);
        $fleet2->addShipToMap('B','11',2,Ship::HORISONTAL);


        $fleet2->addShipToMap('C','2',3,Ship::HORISONTAL);
        $fleet2->addShipToMap('J','5',3,Ship::HORISONTAL);

        $fleet2->addShipToMap('F','4',1,Ship::VERTICAL);

        $user2->setFleet($fleet2);

        $battle = new Battleship();
        $battle->addPlayer($user1);
        $battle->addPlayer($user2);

        $battle->run($x,$y);
    }
}