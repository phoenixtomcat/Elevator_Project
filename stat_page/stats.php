<?php

session_start();

if (isset($_SESSION['username'])){

    require '../top_header/bar_LI.html';
    require '../stat_page/home_stat.html';

} else{
    require '../login_page/login.php';
    require '../login_page/not_LI.html';
    
}
?>