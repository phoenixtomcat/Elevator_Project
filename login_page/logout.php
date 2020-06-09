<?php
    //logout.php
    session_start();
    session_destroy();

    require '../index_page/index.php'
?>