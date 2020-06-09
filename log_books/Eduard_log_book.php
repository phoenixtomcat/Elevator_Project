<?php

session_start();

if (isset($_SESSION['username'])){

    require '../log_books/Eduard_log_book.html';

} else{
    require '../login_page/login.html';
    require '../login_page/not_LI.html';
}
?>