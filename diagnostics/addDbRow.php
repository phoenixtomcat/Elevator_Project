<?php

$data = $_REQUEST['q'];
$data_array = (array)json_decode(stripslashes($data));

function addRowDb(){
    global $data_array;
    $header = "";
    $value_placeholder = "";

    //prepare data
    //the table name is always at the end of the received data array
    $table_name = array_pop($data_array);
    foreach($data_array as $key => $value){
        $header = $header . $key . ",";
        $value_placeholder = $value_placeholder . ":" . $key . ",";
    }
    //remove last commas
    $header = substr($header, 0, -1);
    $value_placeholder = substr($value_placeholder, 0, -1);

    //database parameters
    $db = new PDO(
        'mysql:host=127.0.0.1;dbname=project_database',
        'ese_team',
        'ese'
    );

    //return arrays with keys that are the name of the fields
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    //create SQL statement
    $query = "INSERT INTO {$table_name} ({$header}) VALUES ({$value_placeholder});";

    $statement = $db->prepare($query);
    $result = $statement->execute($data_array);

    if($result)
        return true;
    else
        return false;

}

echo addRowDb();

?>