<?php

session_start();
$username = $_POST['username'];
$password = $_POST['password'];

if($username == "username"&&$password=="password"){
    $_SESSION['username']=$username;
    require '../index_page/index.php';
   // require'../login_page/sucess_LI.html';
}
elseif($username == ""&&$password==""){
    $_SESSION['username']=$username;
    require '../top_header/top_header.php';
    require '../login_page/login.html';
}

else{
    require '../top_header/top_header.php';
    require '../login_page/login.html';
    require '../login_page/fail_LI.html';


}
?>