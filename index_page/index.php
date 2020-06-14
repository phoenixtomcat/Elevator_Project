<?php

session_start();

if (isset($_SESSION['username'])){

    require '../top_header/top_header.php';
    require '../index_page/index.html';
} else{
    require '../top_header/top_header.php';
    require '../index_page/index.html';
}
?>