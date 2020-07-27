<?php

function getTableName(){
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
    $query = 'SHOW TABLES;';
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
                $array[$key] = $value['Tables_in_project_database'];
            }


            return json_encode($array);
    }
}

echo getTableName();

?>