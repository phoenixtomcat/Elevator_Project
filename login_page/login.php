<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

if($username == "username" && $password=="password"){
    $_SESSION['username']=$username;
    require '../index_page/index.php';
    include '../login_page/suces_LI.html';
    
}
else{
    require '../login_page/login.html';
    require '../login_page/fail_LI.html';
}
?>