<?php
$floor_cmd = $_REQUEST["q"];


function getFloorDB(){
    /* to get current floor number from database
    return: current floor -- if SQL execution succeeded and got non-empty array
            null          -- execution failed or got empty array */
    //database parameters
    $db = new PDO(
        'mysql:host=127.0.0.1;dbname=project_database',
        'ese',
        'ese'
    );

    //return arrays with keys that are the name of the fields
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    //prepare SQL statement
    $query = 'SELECT currentFloor FROM elevatorControl WHERE nodeID = 0;';
    $statement = $db->prepare($query);

    //execute the SQL statement and store return array at $row
    $result = $statement->execute();
    $row = $statement->fetchAll();

    //check execution result
    if (!$result){
        //execution failed
        return null;
    }else{
        //execution successfully
        if ($row == [])
            //get empty result back
            return null;
        else
            //get current floor
            return $row[0]['currentFloor'];
    }
}

function getStatusDB(){
    /* to get current floor number from database
    return: current floor -- if SQL execution succeeded and got non-empty array
            null          -- execution failed or got empty array */
    //database parameters
    $db = new PDO(
        'mysql:host=127.0.0.1;dbname=project_database',
        'ese',
        'ese'
    );

    //return arrays with keys that are the name of the fields
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    //prepare SQL statement
    $query = 'SELECT status FROM elevatorControl WHERE nodeID = 0;';
    $statement = $db->prepare($query);

    //execute the SQL statement and store return array at $row
    $result = $statement->execute();
    $row = $statement->fetchAll();

    //check execution result
    if (!$result){
        //execution failed
        return null;
    }else{
        //execution successfully
        if ($row == [])
            //get empty result back
            return null;
        else
            //get current floor
            return $row[0]['status'];
    }
}


if ($floor_cmd == "null"){
    //request current floor from database
    echo getFloorDB();
}else {
        echo setStatusDB();
    

}



?>