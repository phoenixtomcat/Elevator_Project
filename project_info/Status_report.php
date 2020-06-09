<?php

session_start();

if (isset($_SESSION['username'])){

    require '../project_info/Status_report.html';

} else{
    require '../login_page/login.html';
    require '../login_page/not_LI.html';
}
?>