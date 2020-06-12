<?php

session_start();

if (isset($_SESSION['username'])){

    require '../top_header/top_header.php';
    require '../project_info/Status_report.html';

} else{
    require '../login_page/login.php';
    require '../login_page/not_LI.html';
}
?>