<?php

session_start();

if (isset($_SESSION['username'])){

    if(isset($_SESSION['authorized']) && $_SESSION['authorized'] == 1){
        //only authorized person can control the elevator
        require '../top_header/bar_LI.html';
        require 'elevator.html';
    }
    else{
        require "../login_page/not_authorized.html";
        require '../index_page/index.php';
    }
    

} else{
    require '../login_page/login.php';
    require '../login_page/not_LI.html';
}
?>