<?php

session_start();

if (isset($_SESSION['username'])){

    require '../top_header/top_header.php';
    require '../log_books/Eduard_log_book.html';

} else{
    require '../login_page/login.php';
    require '../login_page/not_LI.html';
}
?>