<?php


$username = $_POST['username'];
$password = $_POST['password'];
$verification_bypass = false;  //<-----Please keep this false when you push in master!!!

function verify_credential_db(){
    global $username, $password, $verification_bypass;

    //bypass verification
    if($verification_bypass)
        return true;
    
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
        //compare return password
        //since username is a primary key, the return 2-D array will only has one element
        if ($row == [])
            //no such username
            return false;
        else if ($row[0]['password'] == $password)
            //found username, password matched
            return false;
        else
            //found username, password wrong
            return false;
    }
}


//verification with json file. Will not be used once database is up.
function verify_credential_json ():bool {
    global $verification_bypass, $username, $password;

    if($verification_bypass)
        return true;

    $json_content = file_get_contents(__DIR__ . '/../JSON/credentials.json');

    $data = json_decode($json_content, true);

    foreach($data as $key => $user){
        if ($username==$user['username'] && $password==$user['password']){
            return true;
        }
    }
    return false;
}

if(verify_credential_db()){
    session_start();
    $_SESSION['username']=$username;
    header("Location: ../index_page/index.php");
    exit;
    // require '../top_header/bar_LI.html';
    // require '../index_page/index.html';
    // include '../login_page/sucess_LI.html';
    
}
else{
    require '../top_header/bar_LO.html';
    require '../login_page/login.html';
    require '../login_page/fail_LI.html';
}
?>