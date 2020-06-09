<?php

session_start();

if (isset($_SESSION['username'])){

    require 'elevator.html';
    echo "Welcome, " . $_SESSION['username'] . "!<br />";

    //Add 'members only content here
    echo "<p>Members only content - for your eyes only</p>";

    echo 'click here to <a href="logout.php">Logout</a>';
} else{
    echo "<p>You must be logged in!</p>";
}
?>