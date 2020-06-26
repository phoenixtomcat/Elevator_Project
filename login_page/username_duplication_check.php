<?php

$username = $_REQUEST["q"];

function checkUsernameDuplicate(){
    /*return: true -- no duplicate
            : false -- duplicated or sql failed */
    global $username;

    //database parameters
    $db = new PDO(
        'mysql:host=127.0.0.1;dbname=project_database',
        'ese_team',
        'ese'
    );

    //return arrays with keys that are the name of the fields
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    //prepare SQL statement
    $query = 'SELECT password FROM userCredentials WHERE username=:username;';
    $statement = $db->prepare($query);
    $statement->bindValue('username', $username);

    //execute the SQL statement and store return array at $row
    $result = $statement->execute();
    $row = $statement->fetchAll();

    //check execution result
    if (!$result){
        //execution failed
        return false;
    }else{
        //execution successfully
        if ($row == [])
            //no duplicate
            return true;
        else
            return false;
    }

}

echo checkUsernameDuplicate();

?>