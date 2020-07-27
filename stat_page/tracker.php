<?php
//     session_start();
// if (isset($_SESSION['username'])) {

//     require '../top_header/bar_LI.html';
//     require '../stat_page/home_stat.html';
// } else {
//     require '../login_page/login.php';
//     require '../login_page/not_LI.html';
// }

    $dbselect = new PDO(
    'mysql:127.0.0.1;dbname=project_database',
   //  'mysql:127.0.0.1;dbname=elevator',
        'root',
       ''
    );

    $dbselect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// $username = $_POST['username'];
// $password = $_POST['password'];

    $servername = "localhost";
    $username = "root";
    $password = "";

// $connection = new mysqli($servername, $username, $password);
// if ($connection->connect_error){
//     die("connection issue: Please retry.");
// }

    $query = 'SELECT * FROM userCredentials';
    $statement = $dbselect->prepare($query);
    $statement->bindValue('username', $username);


    $result = $statement->execute();
    $rows = $statement->fetchAll();

    $this_page = $_SERVER["PHP_SELF"];
    $IP = $_SERVER["REMOTE_ADDR"];
    $date_auto = time();

    // $test= "test";
    // //$query2 = "INSERT INTO tracker (test) VALUES ('$test')";
    // $result2 = $dbselect->exec($query2);
    // var_dump($result2);
    // echo "<br/>";
    // $error = $dbselect->errorInfo()[2];
    // var_dump($error);
    // echo "<br/>";

    foreach ($rows as $row){
        var_dump($row);
        echo "<br/>";
    }
    $query3 = "SELECT count (*) FROM tracker WHERE page = '$this_page'";
//     $result = mysqli_query($connection, $query);
// //$views = mysqli($result, 0, "count(*)"); it won't work with PHP 7 
//     $row = mysqli_fetch_array($result);
// //$row = mysqli_fetch_row($result);

    $statement3 = $dbselect->prepare($query3);
    $statement3->bindValue('page', $this_page);
    $result3 = $statement3->execute();
    $row3 = $statement3->fetchAll();

    echo $rows;
?>