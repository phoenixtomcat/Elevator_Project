<?php

$data = $_REQUEST['q'];
$data_array = (array)json_decode(stripslashes($data));

function getSingleCellValue(){
    global $data_array;
    $tableName = $data_array['tableName'];
    $column = $data_array['column'];
    $row = $data_array['row'];
    $row_key = $data_array['row_key'];
    $new_value = $data_array['new_value'];

    //database parameters
    $db = new PDO(
        'mysql:host=127.0.0.1;dbname=project_database',
        'ese_team',
        'ese'
    );

    //return arrays with keys that are the name of the fields
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    //create SQL statement
    $query = "UPDATE {$tableName} SET {$column} = {$new_value} WHERE {$row_key} = {$row};";

    $statement = $db->prepare($query);
    $result = $statement->execute();

    //check execution result
    if (!$result){
        return true;
    }else{
        return false;            
    }

}

echo getSingleCellValue();