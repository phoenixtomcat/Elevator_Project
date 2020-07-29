<?php

$data = $_REQUEST['q'];
$data_array = (array)json_decode(stripslashes($data));

function getSingleCellValue(){
    global $data_array;
    $tableName = $data_array['tableName'];
    $column = $data_array['column'];
    $row = $data_array['row'];
    $row_key = $data_array['row_key'];

    //database parameters
    $db = new PDO(
        'mysql:host=127.0.0.1;dbname=project_database',
        'ese_team',
        'ese'
    );

    //return arrays with keys that are the name of the fields
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    //create SQL statement
    $query = "SELECT {$column} FROM {$tableName} WHERE {$row_key} = {$row};";

    $statement = $db->prepare($query);
    $result = $statement->execute();
    $return_value = $statement->fetchAll();

    //check execution result
    if (!$result){
        //execution failed
        return null;
    }else{
        //execution successfully
        if ($return_value == [])
            //get empty result back
            return null;
        else{
            return $return_value[0][$column];
        }
            
    }

}

echo getSingleCellValue();