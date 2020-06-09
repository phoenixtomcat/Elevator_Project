<?php

session_start();

if (isset($_SESSION['username'])){

    require '../team_members/team_members.html';

} else{
    require '../login_page/login.html';
    require '../login_page/not_LI.html';
}
?>