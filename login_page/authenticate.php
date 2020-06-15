<?php

session_start();
$username = $_POST['username'];
$password = $_POST['password'];

function verify_credential ($username, $password) :bool {

    $json_content = file_get_contents(__DIR__ . '/../JSON/credentials.json');

    $data = json_decode($json_content, true);

    foreach($data as $key => $user){
        if ($username==$user['username'] && $password==$user['password']){
            return true;
        }
    }
    return false;
}

if(verify_credential($username, $password)){
    $_SESSION['username']=$username;
    require '../index_page/index.php';
    include '../login_page/suces_LI.html';
    
}
else{
    require '../top_header/bar_LO.html';
    require '../login_page/login.html';
    require '../login_page/fail_LI.html';
}
?>