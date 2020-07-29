<?php
abstract class Floor extends Node{
protected $called; 
private $access;
private $FloorNum;
private static $lastFloorNum;
private $type; 
private $pressedUp;
private $pressedDown;

public function __construct($type){

    $this->type = $type;
    $this->FloorNum = ++self::$lastFloorNum;
    parent:: __construct();

} 

public function getType(){
    return $this->type; 
}

public function getFloor(){
    return $this->FloorNum; 
}

public function getCalled(){
    return $this->called; 
}

public function getAccess(){
    return $this->access; 
}

public function setAccess(int $clear){
    $this->access = $clear; 
}

public function setCalled(){
    $this->called = 1; 
}



abstract public function pressUp();
abstract public function unpressUp();
abstract public function getPressedUp();

abstract public function pressDown();
abstract public function unpressDown();
abstract public function getPressedDown();

}

?>