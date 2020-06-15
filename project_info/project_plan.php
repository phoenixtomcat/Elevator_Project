<?php

session_start();

if (isset($_SESSION['username'])){

    require '../top_header/bar_LI.html';
    require '../project_info/project_plan.html';

} else{
    require '../login_page/login.php';
    require '../login_page/not_LI.html';
}
?>