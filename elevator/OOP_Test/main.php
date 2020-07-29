<?php


require_once __DIR__ . '/Node.php';
require_once __DIR__ . '/ElevatorCar.php';
require_once __DIR__ . '/Floor.php';
require_once __DIR__ . '/Middle.php';
require_once __DIR__ . '/Bottom.php';
require_once __DIR__ . '/Top.php';

$car1 = new ElevatorCar(3);
$car1->setCurrentFloor(3);
$car1->setTargetFloor(3);
$car1->setNotBusy();

$car2 = new ElevatorCar(2);
$car2->setCurrentFloor(2);
$car2->setTargetFloor(4);
$car2->setBusy();

$car3 = new ElevatorCar(1);
$car3->setCurrentFloor(1);
$car3->setTargetFloor(2);
$car3->setBusy();


$floor1 = new Bottom("Entrance");
$floor1->pressUp();
$floor1->setCalled(1);

$floor2 = new Middle("Classroom");
$floor2->setAccess(1);

$floor3 = new Middle("Store");
$floor3->setAccess(0);

$floor4 = new Top("Pool");
$floor4->setAccess(3);
$floor4->pressDown();
$floor4->setCalled(1);



echo "the node Id of car1 is" . $car1->getNodeID() . "</br>";
echo "car1 is on floor " . $car1->getCurrentFloor() . "</br>";
echo "change current floor to 1 and check ...</br>";
$car1->setCurrentFloor(1);
echo "car1 is on floor " . $car1->getCurrentFloor() . "</br></br>";

echo "the node Id of car2 is" . $car2->getNodeID() . "</br>";
echo "car2 is on floor " . $car2->getCurrentFloor() . "</br>";
echo "change current floor to 3 and check ...</br>";
$car2->setCurrentFloor(3);
echo "car2 is on floor " . $car2->getCurrentFloor() . "</br>";
echo "car1 is on floor " . $car1->getCurrentFloor() . "</br></br>";

echo "The node ID of the floor1 is " . $floor1->getNodeID() . "</br>";
echo "The floor number of the floor1 is " . $floor1->getFloor() . "</br>";
echo "floor1 is a/an " . $floor1->getType() . "</br>";
echo "floor1 one button status is " . $floor1->getPressedUp() . "</br>";
echo "Unpress the up button on floor1 </br>";
$floor1->unpressUp();
echo "floor1 one button status is " . $floor1->getPressedUp() . "</br></br>";

echo "The node ID of the floor3 is " . $floor3->getNodeID() . "</br>";
echo "The floor number of the floor3 is " . $floor3->getFloor() . "</br>";
echo "floor3 is a/an " . $floor3->getType() . "</br>";
echo "floor3 up button status is " . $floor3->getPressedUp() . "</br>";
echo "floor3 down button status is " . $floor3->getPressedDown() . "</br>";
echo "Press the up button on floor1 </br>";
$floor3->pressUp();
echo "Press the up button on floor1 </br>";
$floor3->pressDown();
echo "floor3 up button status is " . $floor3->getPressedUp() . "</br>";
echo "floor3 down button status is " . $floor3->getPressedUp() . "</br></br>";

echo "The node ID of the floor1 is " . $floor1->getNodeID() . "</br>";
echo "The floor number of the floor1 is " . $floor1->getFloor() . "</br>";
echo "floor1 is a/an " . $floor1->getType() . "</br>";
?>