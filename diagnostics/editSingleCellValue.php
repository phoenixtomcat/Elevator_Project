<?php

$data = $_REQUEST['q'];
$data_array = (array)json_decode(stripslashes($data));

function editSingleCellValue(){
    global $data_array;
    $tableName = $data_array['tableName'];
    $column = $data_array['column'];
    $row = $data_array['row'];
    $row_key = $data_array['row_key'];
    $new_value = $data_array['new_value'];
    
    //if the row key is not an ID, add double quote to $row
    if (strpos($row_key, 'ID') == false){
        $row = "'" . $row . "'";
    }

    if (strpos($column, 'ID') == false){
        $new_value = "'" . $new_value . "'";
    }
    

    //database parameters
    $db = new PDO(
        'mysql:host=127.0.0.1;dbname=project_database',
        'ese_team',
        'ese'
    );

    //return arrays with keys that are the name of the fields
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->beginTransaction();

    try {
        //create SQL statement
        $query = "UPDATE {$tableName} SET {$column} = {$new_value} WHERE {$row_key} = {$row};";

        $statement = $db->prepare($query);
        $result = $statement->execute();
        $row = $statement->rowCount();

        //check execution result
        if (!$result || $row != 1){
            //if execution failed or affectd row is not 1
            throw new Exception($statement->errorInfo());
        }
        $db->commit();
        
        return "Cell value is edited successfully";
    }catch (Exception $e){
        $db->rollBack();
        return "Encoutered error! Rollback transaction. <br />Error message: " . $e->getMessage();
    }

}

echo editSingleCellValue();