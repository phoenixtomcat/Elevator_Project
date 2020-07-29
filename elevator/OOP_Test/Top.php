<?php
class Top extends Floor{

    public function __construct($type){
        parent:: __construct($type);
    }

    public function pressUp(){
    }
    public function unpressUp(){
    }
    public function getPressedUp(){
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