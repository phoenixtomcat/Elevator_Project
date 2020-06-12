<?php

session_start();

if (isset($_SESSION['username'])){

    require '../top_header/bar_LI.html';
  

} else{
    require '../top_header/bar_LO.html';
}
?>