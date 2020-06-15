<?php

session_start();
$username = $_POST['username'];
$password = $_POST['password'];



if($username == "username" && $password=="password"){
    $_SESSION['username']=$username;
    require '../index_page/index.php';
    include '../login_page/suces_LI.html';
    
}
elseif($username == ""&&$password==""){
    $_SESSION['username']=$username;
    require '../top_header/bar_LI.html';
    require '../login_page/login.html';
}

else{
    require '../top_header/bar_LO.html';
    require '../login_page/login.html';
    require '../login_page/fail_LI.html';


}
?>