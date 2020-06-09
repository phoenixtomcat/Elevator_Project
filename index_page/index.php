<?php

session_start();

if (isset($_SESSION['username'])){

    require '../index_page/index_LI.html';

} else{
    require '../index_page/index.html';
}
?>