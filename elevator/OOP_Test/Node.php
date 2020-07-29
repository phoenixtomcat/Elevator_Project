<?php
class Node{
private $NodeID;
private static $NextNodeID = 0;

public function __construct() {
    $this->NodeID = ++self::$NextNodeID; 
}

public function getNodeID():int {
    return $this->NodeID;
}


}
?>