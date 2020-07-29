<?php
class Bottom extends Floor{

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
    }
    public function unpressDown(){
    }
    public function getPressedDown(){
    }

}
?>