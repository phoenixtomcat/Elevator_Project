<?php
class ElevatorCar extends Node {
    private $currentFloor;
    private $targetFloor;
    private static $lastElevatorNum = 0; 
    private  $ElevatorNum; 
    private $busy;

    public function __construct(int $floor){
        $this->currentFloor = $floor;
        $this->ElevatorNum = ++self::$lastElevatorNum;
        parent:: __construct();
    }

    public function setCurrentFloor(int $floor){
        $this->currentFloor = $floor;
    }

    public function setTargetFloor(int $floor){
        $this->TargetFloor = $floor;
    }

    public function getCurrentFloor(): int {
        return $this->currentFloor;
    }

    public function getTargetFloor(): int {
        return $this->targetFloor;
    }

    public function getBusy(): int {
        return $this->busy;
    }

    public function setBusy(){
        $this->busy = 1;
    }

    public function setNotBusy(){
        $this->busy = 0;
    }


}



?>