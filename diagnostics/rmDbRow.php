<?php

$data = $_REQUEST['q'];
$data_array = (array)json_decode(stripslashes($data));

function rmRowDb(){
    global $data_array;
    $tableName = $data_array['tableName'];
    $key = $data_array['key'];
    $value = $data_array['value'];

    //if the row key is not an ID, add double quote to $row
    if (strpos($key, 'ID') == false){
        $value = "'" . $value . "'";
    }

    //database parameters
    $db = new PDO(
        'mysql:host=127.0.0.1;dbname=project_database',
        'ese_team',
        'ese'
    );

    //return arrays with keys that are the name of the fields
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    //create SQL statement
    $query = "DELETE FROM {$tableName} WHERE {$key} = {$value};";

    $statement = $db->prepare($query);
    $result = $statement->execute();

    if($result)
        return true;
    else{
        $error = $statement->errorInfo();
        return false;
    }
        

}

echo rmRowDb();

?>