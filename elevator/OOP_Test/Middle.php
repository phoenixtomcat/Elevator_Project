<?php
class Middle extends Floor{

    public function __construct($type){
        parent:: __construct($type);
    }

    public function pressUp(){
        $this->pressedUp = 1;
    }
    public function unpressUp(){
        $this->pressedUp = 0;
    }
    public function getPressedUp(){
        return $this->pressedUp;
   }

    public function pressDown(){
        $this->pressedDown = 1;
    }
    public function unpressDown(){
        $this->pressedDown = 0;
    }
    public function getPressedDown(){
        return $this->pressedDown;
    }

}
?>