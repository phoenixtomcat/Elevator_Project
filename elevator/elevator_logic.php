<?php 
echo "here";
$floor_cmd = "elv3";

function elevator_logic($but_id){
/******************store value in elevator arrays**********************************************************/

/*******should be global */
$flr_but = array();       //priority array
$updw_but = array("3d", "2u");      //secondary array
$busy = 0;
$current_flr = 1;
$updw;    
/*******should be global */

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


    if($but_id == "1" || $but_id == "2" || $but_id == "3"){
        if (in_array($but_id,$flr_but)){    //if the key exsists it's already been called, no need for repeats
            echo "id exists";
            return;
        }
        else {            //store value in $flr_but array
            array_push($flr_but, $but_id);
            echo print_r($flr_but) . "\n";

        }
    }
    elseif($but_id == "3d" || $but_id == "2d" || $but_id == "2u" || $but_id == "1u"){
        if (in_array($but_id, $updw_but)){
            /*id exsists in array do not add it make sure second floor is stored as 2u or 2d*/
            return;
        }
        else{
            //store value in $updw_but array
            array_push($updw_but, $but_id);
            echo print_r($updw_but) . "\n";
        }
    }
    else {
        echo "Error in ID";
    }

    /***************wait for the elvator to not be moving***************************/
    while($busy == 1) {
        //delay for a few seconds
        sleep(3);
        if(sizeof($flr_but) == 0 && sizeof($updw_but) == 0){
            return;
        }
    }
    $busy = 1; //claim busy for our own
echo "\n made it out of loop ";
    /***************************************************************************************
     figure out where the elevator needs to go next, not necessarially the button 
     that you came in with, may be doing someone else's button
     **************************************************************************************/

     if(sizeof($flr_but) == 0){         //nothing in the $flr_but array so check other array.  This is the priority array

        if(sizeof($updw_but) == 0){    //nothing in either arrays return
            return;
        }
        else {                        //something in secondary array go to its floor

            //just take the first element in this array as it is least important queue and will likely pass on its way
            //may change this later
            $target = array_shift($updw_but);
            if($target == "3d"){
                $target = "3";
            }
            elseif($target == "2d"){
                $target = "2";
            }
            elseif($target == "2u"){
                $target = "2";
            }
            elseif($target == "1u"){
                $target = "1";
            }
            echo $target;
            return(target);

        }
     }
     else{                           //something in priority array. Do that first
        $diff = $flr_but[0] - $current_flr;
        echo " diff is" . $diff . ";";
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
            foreach($flr_but as $i => $flr_nbr){
                if($flr_nbr == "2"){
                    $target = 2; 
                    array_splice($flr_but, $i,1);       //should delete value in array if it exsists
                    echo print_r($flr_but) . "\n";

                }
            }

            //checks if anyone wants to get on at 2 and if we're going in the right direction we'll let them on
            foreach($updw_but as $i => $flr_nbr){ 
                if($flr_nbr == "2d" && $updw == "down"){
                    $target = 2; 
                    array_splice($updw_but, $i, 1);
                }
                if($flr_nbr == "2u" && $updw == "up"){
                    $target = 2; 
                    array_splice($updw_but, $i, 1);
                }
            }

            if($target != 2){
                $target = array_shift($flr_but);
            }

            foreach($flr_but as $i => $flr_nbr){    //checks if flr_but array has deuplicates to this floor or if it has the value of the target in it
                if($flr_nbr == $current_flr || $flr_nbr == $target){
                    array_splice($flr_but, $i, 1);       //should delete value in array if it exsists
                }
            }

            foreach($updw_but as $i => $flr_nbr){    //checks if updw_but array has deuplicates to this floor or if it has the value of the target in it
                if($flr_nbr == "1u" && $target == 1){      //if the target is two and the elevator is moving up then take 2u off of list because we are assuming they will get on at flr 2
                    array_splice($updw_but, $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "1u" && $current_flr == 1 ){
                    array_splice($updw_but, $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "2d" && $target == 2 && $updw == "down"){
                    array_splice($updw_but, $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "2u" && $target == 2 && $updw == "up"){      //if the target is two and the elevator is moving up then take 2u off of list because we are assuming they will get on at flr 2
                    array_splice($updw_but, $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "2d" && $current_flr == 2 && $updw == "down"){
                    array_splice($updw_but, $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "2u" && $current_flr == 2 && $updw == "up"){      //if the current floor is two and the elevator is moving up then take 2u off of list because we are assuming they will get on at flr 2
                    array_splice($updw_but, $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "3d" && $target == 3){      //if the target is two and the elevator is moving up then take 2u off of list because we are assuming they will get on at flr 2
                    array_splice($updw_but, $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "3d" && $current_flr == 3 ){
                    array_splice($updw_but, $i, 1);       //should delete value in array if it exsists
                }
            }
            echo $target;
            return($target);

        }

/***********************If the elevator is changing 1 floor *************************************** */
        elseif($diff == 1){             //only going one floor
            $target = array_shift($flr_but);
            echo print_r($flr_but) . "\n";


            //might be able to take this foreach out
            foreach($flr_but as $i => $flr_nbr){    //checks if flr_but array has deuplicates to this floor or if it has the value of the target in it
                if($flr_nbr == $current_flr || $flr_nbr == $target){
                    array_splice($flr_but, $i, 1);       //should delete value in array if it exsists

                }
            }

            //delete any numbers in the updw_but array if we are at or are going to stop at that floor
            foreach($updw_but as $i => $flr_nbr){    //checks if updw_but array has deuplicates to this floor or if it has the value of the target in it
                if($flr_nbr == "1u" && $target == 1){      //if the target is two and the elevator is moving up then take 2u off of list because we are assuming they will get on at flr 2
                    array_splice($updw_but, $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "1u" && $current_flr == 1 ){
                    array_splice($updw_but, $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "2d" && $target == 2 && $updw == "down"){
                    array_splice($updw_but, $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "2u" && $target == 2 && $updw == "up"){      //if the target is two and the elevator is moving up then take 2u off of list because we are assuming they will get on at flr 2
                    array_splice($updw_but, $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "2d" && $current_flr == 2 && $updw == "down"){
                    array_splice($updw_but, $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "2u" && $current_flr == 2 && $updw == "up"){      //if the current floor is two and the elevator is moving up then take 2u off of list because we are assuming they will get on at flr 2
                    array_splice($updw_but, $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "3d" && $target == 3){      //if the target is two and the elevator is moving up then take 2u off of list because we are assuming they will get on at flr 2
                    array_splice($updw_but, $i, 1);       //should delete value in array if it exsists
                }
                if($flr_nbr == "3d" && $current_flr == 3 ){
                    array_splice($updw_but, $i, 1);       //should delete value in array if it exsists
                }
            }

            echo $target;
            return $target;
        }
        elseif (diff == 0)
        {
            echo $current_flr;
            return $current_flr;
        }


        else {
            echo "error"; 
        }



     }




}

function logic_done(){
    //delay for people to get off 
    sleep(5);
    //set busy flag to free
    $busy = 0; 
    }

    function getFloorDB(){
        /* to get current floor number from database
        return: current floor -- if SQL execution succeeded and got non-empty array
                null          -- execution failed or got empty array */
        //database parameters
        $db = new PDO(
            'mysql:host=127.0.0.1;dbname=elevator',
            'ese_team',
            'ese'
        );
    
        //return arrays with keys that are the name of the fields
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
        //prepare SQL statement
        $query = 'SELECT currentFloor FROM elevatorNetwork WHERE nodeID = 1;';
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




    /**************Actual work************************ */

    if($floor_cmd == "get_current_floor")
    {
        $current_flr = getFloorDB();
    }
    elseif($floor_cmd == "done"){
        logic_done();
    }
    else{
       elevator_logic($floor_cmd);
    }
?>