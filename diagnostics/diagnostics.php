<?php
    require '../top_header/bar_LI.html';

    $db = new PDO(
    'mysql:host=127.0.0.1;dbname=project_database',
    'ese',
    'ese'
);

$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


$reqFlr = $db->query('SELECT requestedFloor FROM elevatorControl');
$curFlr = $db->query('SELECT currentFloor FROM elevatorControl');
$stat = $db->query('SELECT status FROM elevatorControl');
echo "<br />";
echo "<br />";
echo "<br />";
echo "<br />";

$servername = "localhost";
$username = "ese";
$password = "ese";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully to the DataBase.";
echo "<br />";
echo "<br />";

foreach ($reqFlr as $req){
//var_dump($flr);
echo "Requested Floor by the User ".$req['requestedFloor']."."."<br>";
echo "<br />";
}
foreach ($curFlr as $cur){
    echo "Current Floor of the Elevator ".$cur['currentFloor']."."."<br>";
    echo "<br />";
}

foreach ($stat as $st){
    //echo $st["status"];
    //echo "<br />";

    if($st["status"] == 1){
        echo "Please, wait elevator is moving to the Requested Floor.";
        echo "<br />";
        echo "Vrr...Vrr!";
        echo "<br />";
    }
    else{
        echo "Elevator is Reached requested floor.";
        echo "<br />";
    }
}
    //require '../diagnostics/diagnostics.html';
?>