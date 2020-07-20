<?php
    //logout.php
    session_start();
    session_destroy();

    // require '../top_header/bar_LO.html';
    // require '../index_page/index.html';
    header("Location: ../index_page/index.php");
?>