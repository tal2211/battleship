<?php

namespace Battleship\Ship;


class ShipFactory
{
    const EMPTY_ITEM = '0';
    const MISS_ITEM = '-1';
    const HIT_ITEM = '1';

    private $fleet = [];
    private $oldFleet;
    private $maxX;
    private $maxY;
    private $minY;
    private $minX;
    private $opponentMap;
    private $fleetConf;

    public function __construct($size)
    {
        $this->minX = 'A';
        $this->minY = '1';

        $this->fleetConf = ['1' => '4', '2' => '3', '3' => '2', '4' => '1'];
        $x = $this->minX;
        for($i = 0; $i < $size; $i++){
            $y = $this->minY;
            for($j = 0; $j < $size; $j++){
                $this->opponentMap[$x][$y] = self::EMPTY_ITEM;
                $y++;
            }
            $x++;
        }
        $this->maxX = $x;
        $this->maxY = $y;
    }

    public function addShipToMap($x,$y,$length,$orientation){

        if((array_key_exists($length, $this->fleetConf)) && $this->fleetConf[$length] > 1){
            switch ($orientation){
                case Ship::VERTICAL:
                    $xLength = 1;
                    $yLength = $length;
                    break;
                case Ship::HORISONTAL:
                    $yLength = 1;
                    $xLength = $length;
                    break;
            }

            if($this->checkMap($x,$y,$xLength,$yLength)){
                $this->fleetConf[$length] -= 1;
                $this->fleet[] = new Ship($x,$y,$length,$orientation);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function checkMap($x,$y,$xLength = 1, $yLength = 1 ){

        if($xLength < $this->minX){
            $xLength = $this->minX;
        }

        if($yLength < $this->minY){
            $yLength = $this->minY;
        }


        foreach ($this->fleet as $k => $ship){
            if($ship->isShip($x,$y)){
                return false;
            }
        }

        if($xLength == 1 && $yLength == 1){
            foreach ($this->fleet as $k => $ship){
                if($ship->isShip($x,$y)){
                    return false;
                }
            }
        }
        $xPosition = $x;
        $yPosition = $y;
        $toX = false;


        if($xLength > 1 && $yLength == 1){
            $last = chr(ord($x) + $xLength - 1);
            if($x < $this->minX || ($last > $this->maxX)){
                return false;
            }
            $toX = true;
        } else {
            $last = chr(ord($y) + $yLength - 1);
            if($x < $this->minY || ($last > $this->maxY)){
                return false;
            }
        }

        for($i = 0; $i < $xLength; $i++) {
            foreach ($this->fleet as $k => $ship){
                if($ship->isShip($xPosition,$yPosition)){
                    return false;
                }
            }
            if($toX){
                $xPosition++;
            } else {
                $yPosition++;
            }
        }

        return true;
    }

    /**
     * @param $x
     * @param $y
     * @return int
     */
    public function damageShip($x, $y){
        foreach ($this->fleet as $k => $ship){
            if($ship->isShip($x,$y)){
                $this->fleet[$k]->setDamage($x,$y);
                $ship = $this->fleet[$k];
                if($ship->isDestroyed()){
                    $this->oldFleet[] = $ship;
                    unset($this->fleet[$k]);
                    return -1;
                }
                return 1;
            }
        }
        return 0;
    }

    public function hasShips(){
        return (count($this->fleet) > 0)?true:false;
    }

    public function getOpponentMap(){
        return $this->opponentMap;
    }

    public function addOpponentMap($x,$y,$status){
        return $this->opponentMap[$x][$y] = $status;
    }
}