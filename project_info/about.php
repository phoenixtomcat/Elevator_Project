<?php

session_start();

if (isset($_SESSION['username'])){

    require '../project_info/about.html';

} else{
    require '../login_page/login.html';
    require '../login_page/not_LI.html';
}
?>