<?php

$tableName = $_REQUEST["q"];

function getDbTable($tablename){
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
    $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '{$tablename}' AND TABLE_SCHEMA = 'project_database';";
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
            //re-arrange SQL results
            foreach( $row as $key => $value){
                $header[$key] = $value['COLUMN_NAME'];
            }
    }

    $array['header'] = $header;

    //prepare SQL statement
    $query = "SELECT * FROM {$tablename};";
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
        else{
            foreach( $row as $key_1 => $value_1){
                $body[$key_1] = [];
                foreach($value_1 as $key_2 => $value_2){
                    array_push($body[$key_1], $value_2);
                }
            }
        }
            
    }

    $array['body'] = $body;

    return json_encode($array);
}

echo getDbTable($tableName);

?>