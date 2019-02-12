<?php
namespace Battleship\Ship;

class Ship
{
    const VERTICAL = 'vertical';
    const HORISONTAL = 'horisontal';

    const GOOD = 'good';
    const HITTED = 'hitted';
    const DESTROYED = 'descroyed';
    private $startX;
    private $startY;
    private $length;
    private $left;
    private $position;
    private $damage;
    private $status;

    public function __construct($x,$y,$length,$position)
    {
        $this->startX = $x;
        $this->startY = $y;
        $this->length = $length;
        $this->left = $length;
        $this->position = $position;
        $this->status = self::GOOD;
    }

    public function getDamage(){
        $this->damage;
    }

    public function  setDamage($x,$y){
        $size = $this->shipSize();
        $status = $this->status;

        if(in_array($x,$size['x']) && in_array($y,$size['y'])){
            $this->damage[$x][$y] = 'x';
            $this->left --;
            if($this->isDestroyed()){
                $status = self::DESTROYED;
            } else {
                $status = self::HITTED;
            }
        }
        $this->status = $status;
    }

    public function getState(){
        return $this->status;
    }

    public function getHittedPercent(){
        return (int)($this->left * 100) / $this->length;
    }

    public function isDestroyed(){
        return ($this->left == 0)? true: false;
    }

    public function isShip($x,$y){
        $size = $this->shipSize();
        if(in_array($x,$size['x']) && in_array($y,$size['y'])){
            return true;
        }
        return false;
    }

    public function shipSize(){
        if($this->position == self::VERTICAL){

            $last = $this->startY + $this->length - 1;
            return [
                'x' => [$this->startX],
                'y' => range($this->startY,$last),
                ];
        } else {
            $last = chr(ord($this->startX) + $this->length - 1);
            return [
                'x' => range($this->startX,$last),
                'y' => [$this->startY],
            ];
        }
    }
}