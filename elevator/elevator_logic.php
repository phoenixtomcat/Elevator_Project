<?php 
session_start();


$floor_cmd = "elv3";
$flr_but = array();       //priority array
$updw_but = array();      //secondary array
$busy = 0;
$current_flr;  //just for test
$updw;    


function elevator_logic_set($but_id){
    /******************store value in elevator arrays**********************************************************/
    global $flr_but, $updw_but, $busy, $current_flr, $updw;    

    if($but_id == "elv1") {
        $but_id = 1;
    }
    elseif($but_id == "elv2"){
        $but_id = 2;
    }
    elseif($but_id == "elv3"){
        $but_id = 3;
    }
    elseif($but_id == "dwnfl3"){
        $but_id = "3d";
    }
    elseif($but_id == "dwnfl2"){
        $but_id = "2d";
    }
    elseif($but_id == "upfl2"){
        $but_id = "2u";
    }
    elseif($but_id == "upfl1"){
        $but_id = "1u";
    }

    if (!isset($_SESSION['elv'])) {
        $_SESSION['elv'] = array();
    }
    if (!isset($_SESSION['flr'])) {
       // echo "not set?!";
        $_SESSION['flr'] = array();
    }

    
    if($but_id == "1" || $but_id == "2" || $but_id == "3"){
        if (in_array($but_id,$_SESSION['elv'])){    //if the key exsists it's already been called, no need for repeats
            echo "id exists";
        }
        else {            //store value in $flr_but array

            array_push($_SESSION['elv'], $but_id);

        }
    }
    elseif($but_id == "3d" || $but_id == "2d" || $but_id == "2u" || $but_id == "1u"){
        if (in_array($but_id, $_SESSION['flr'])){
            /*id exsists in array do not add it make sure second floor is stored as 2u or 2d*/
        }
        else{
            //store value in $updw_but array
            array_push($_SESSION['flr'], $but_id);
            //echo print_r($updw_but);

        }
    }
    else {
        echo "Error in ID";
    }

    return;
    /***************wait for the elvator to not be moving***************************/

    /***************************************************************************************
     figure out where the elevator needs to go next, not necessarially the button 
     that you came in with, may be doing someone else's button
     **************************************************************************************/


}

function run_elevator_logic(){


    $flr_but = $_SESSION['elv'];
    $updw_but = $_SESSION['flr'];
    global $flr_but, $updw_but, $busy, $current_flr, $updw;    

    
     if(sizeof($_SESSION['elv']) == 0){         //nothing in the $flr_but array so check other array.  This is the priority array

        if(sizeof($_SESSION['flr']) == 0){    //nothing in either arrays return
           
            echo "arrays empty";

            return;
        }
        else {                        //something in secondary array go to its floor

            //just take the first element in this array as it is least important queue and will likely pass on its way
            //may change this later
            $target = array_shift($_SESSION['flr']);
            if($target == "3d"){
                $target = 3;
            }
            elseif($target == "2d"){
                $target = 2;
            }
            elseif($target == "2u"){
                $target = 2;
            }
            elseif($target == "1u"){
                $target = 1;
            }
            else{
                $target = "8";
            }
            echo $target;
            return($target);


        }
     }
     else{                           //something in priority array. Do that first
        $diff = $_SESSION['elv'][0] - $current_flr;
        //echo " diff is" . $diff . ";";
        if($diff < 0){
            $updw = "down";
        }
        else{
            $updw = "up";
        }
        $diff = abs($diff);             //find absolute differnece in where the elevator has to go
        echo " abs diff is" . $diff . "; ";
        echo $updw . ";";


       
       /***********If the elevator is changing two floors**************************** */
        if($diff == 2){
            
        

            //checks if anyone wants to get out on two
            foreach($_SESSION['elv'] as $i => $flr_nbr){
                if($flr_nbr == "2"){
                    $target = 2; 
                    array_splice($_SESSION['elv'], $i,1);       //should delete value in array if it exsists
                    echo print_r($_SESSION['elv']) . "\n";

                }
            }

            //checks if anyone wants to get on at 2 and if we're going in the right direction we'll let them on
            foreach($_SESSION['flr'] as $i => $flr_nbr){ 
                if($flr_nbr == "2d" && $updw == "down"){
                    $target = 2; 
                    array_splice($_SESSION['flr'], $i, 1);
                }
                if($flr_nbr == "2u" && $updw == "up"){
                    $target = 2; 
                    array_splice($_SESSION['flr'], $i, 1);
                }
            }

            if($target != 2){
                $target = array_shift($_SESSION['elv']);
            }

            foreach($_SESSION['elv'] as $i => $flr_nbr){    //checks if flr_but array has deuplicates to this floor or if it has the value of the target in it
                if($flr_nbr == $current_flr || $flr_nbr == $target){
                    array_splice($_SESSION['elv'], $i, 1);       //should delete value in array if it exsists
                }
            }

            foreach($_SESSION['flr'] as $i => $flr_nbr){    //checks if updw_but array has deuplicates to this floor or if it has the value of the target in it
                if($flr_nbr == "1u" && $target == 1){      //if the target is two and the elevator is moving up then take 2u off of list because we are assuming they will get on at flr 2
                    array_splice($_SESSION['flr'], $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "1u" && $current_flr == 1 ){
                    array_splice($_SESSION['flr'], $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "2d" && $target == 2 && $updw == "down"){
                    array_splice($_SESSION['flr'], $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "2u" && $target == 2 && $updw == "up"){      //if the target is two and the elevator is moving up then take 2u off of list because we are assuming they will get on at flr 2
                    array_splice($_SESSION['flr'], $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "2d" && $current_flr == 2 && $updw == "down"){
                    array_splice($_SESSION['flr'], $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "2u" && $current_flr == 2 && $updw == "up"){      //if the current floor is two and the elevator is moving up then take 2u off of list because we are assuming they will get on at flr 2
                    array_splice($_SESSION['flr'], $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "3d" && $target == 3){      //if the target is two and the elevator is moving up then take 2u off of list because we are assuming they will get on at flr 2
                    array_splice($_SESSION['flr'], $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "3d" && $current_flr == 3 ){
                    array_splice($_SESSION['flr'], $i, 1);       //should delete value in array if it exsists
                }
            }
            echo $target;

            return($target);

        }

    /***********************If the elevator is changing 1 floor *************************************** */
        elseif($diff == 1){             //only going one floor
            $target = array_shift($_SESSION['elv']);
            echo print_r($_SESSION['elv']) . "\n";


            //might be able to take this foreach out
            foreach($_SESSION['elv'] as $i => $flr_nbr){    //checks if flr_but array has deuplicates to this floor or if it has the value of the target in it
                if($flr_nbr == $current_flr || $flr_nbr == $target){
                    array_splice($_SESSION['elv'], $i, 1);       //should delete value in array if it exsists

                }
            }

            //delete any numbers in the updw_but array if we are at or are going to stop at that floor
            foreach($_SESSION['flr'] as $i => $flr_nbr){    //checks if updw_but array has deuplicates to this floor or if it has the value of the target in it
                if($flr_nbr == "1u" && $target == 1){      //if the target is two and the elevator is moving up then take 2u off of list because we are assuming they will get on at flr 2
                    array_splice($_SESSION['flr'], $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "1u" && $current_flr == 1 ){
                    array_splice($_SESSION['flr'], $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "2d" && $target == 2 && $updw == "down"){
                    array_splice($_SESSION['flr'], $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "2u" && $target == 2 && $updw == "up"){      //if the target is two and the elevator is moving up then take 2u off of list because we are assuming they will get on at flr 2
                    array_splice($_SESSION['flr'], $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "2d" && $current_flr == 2 && $updw == "down"){
                    array_splice($_SESSION['flr'], $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "2u" && $current_flr == 2 && $updw == "up"){      //if the current floor is two and the elevator is moving up then take 2u off of list because we are assuming they will get on at flr 2
                    array_splice($_SESSION['flr'], $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "3d" && $target == 3){      //if the target is two and the elevator is moving up then take 2u off of list because we are assuming they will get on at flr 2
                    array_splice($_SESSION['flr'], $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "3d" && $current_flr == 3 ){
                    array_splice($_SESSION['flr'], $i, 1);       //should delete value in array if it exsists
                }
            }

            echo $target;

            return $target;
        }
        elseif (diff == 0)
        {
            $target = array_shift($_SESSION['elv']);
            echo $current_flr;
            echo $target;

            return $current_flr;
        }
        else {
            echo "error"; 
        }



     }
}

function getFloorDB(){
        /* to get current floor number from database
        return: current floor -- if SQL execution succeeded and got non-empty array
                null          -- execution failed or got empty array */
        //database parameters
        $db = new PDO(
            'mysql:host=127.0.0.1;dbname=project_database',
            'ese_team',
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
        'ese_team',
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

function setFloorDB($floor) {
        /* to set floor number at database
        return: true  -- executed successfully
                false -- execution failed */
        //database parameters
        $db = new PDO(
            'mysql:host=127.0.0.1;dbname=project_database',
            'ese_team',       //ese_team
            'ese'         //ese
        );
    
        //return arrays with keys that are the name of the fields
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        //Create SQL statement
        $query = 'UPDATE elevatorControl SET requestedFloor=:floor WHERE nodeID = 0;';
    
        //execute SQL statement at database
        $statement = $db->prepare($query);
        $statement->bindValue('floor', (int)$floor);
        $result = $statement->execute($new_user);
    
        if($result)
            return true;
        else
            return false;
}

function setStatusDB($num) {
    /* to set floor number at database
    return: true  -- executed successfully
            false -- execution failed */
    //database parameters
    $db = new PDO(
        'mysql:host=127.0.0.1;dbname=project_database',
        'ese_team',       //ese_team
        'ese'         //ese
    );

    //return arrays with keys that are the name of the fields
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    //Create SQL statement
    $query = 'UPDATE elevatorControl SET status=:num WHERE nodeID = 0;';

    //execute SQL statement at database
    $statement = $db->prepare($query);
    $statement->bindValue('num', (int)$num);
    $result = $statement->execute($new_user);

    if($result)
        return true;
    else
        return false;
}



    /**************Actual work************************ */


$button_id = $_REQUEST["x"];

//var_dump($_SESSION['elv']);

elevator_logic_set($button_id);
//var_dump($_SESSION['elv']);
//array_shift($_SESSION['flr']);

//var_dump($_SESSION['flr']);

session_write_close();
//elevator_logic_set("elv1");
//elevator_logic_set("elv3");
//elevator_logic_set("elv2");
//setFloorDB($floor_target);


//$floor_target = run_elevator_logic();
//echo $floor_target;
//array_shift($_SESSION['flr']);

sleep(5);
$tell = 0;
while(getStatusDB() == 1) {
    //delay for a few seconds
    sleep(3);
    if(sizeof($_SESSION['elv']) == 0 && sizeof($_SESSION['flr']) == 0){
        $tell = 1;    
        break;
    }
}
//saftey percaution
session_start();
if(sizeof($_SESSION['elv']) == 0 && sizeof($_SESSION['flr']) == 0){

}
else{
    setStatusDB(1); //claim busy for our own
    $current_flr = getFloorDB();
    $floor_target = run_elevator_logic();
    session_write_close();
    setFloorDB($floor_target);
    
    //simulate elevator
    //sleep(5);
    //setStatusDB(0); //claim busy for our own
    //echo $floor_target;
}

//$floor_target = run_elevator_logic();



/*
    if($floor_cmd == "get_current_floor")
    {
        $current_flr = getFloorDB();
    }
    elseif($floor_cmd == "done"){
        logic_done();
    }
    else{
       elevator_logic($floor_cmd);
    }*/


    ?>