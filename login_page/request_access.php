<?php


if ($submitted = !empty($_POST)){
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$username = $_POST['username']; //U can also use $_GET array
$password =$_POST['password'];
$website = $_POST['url'];
$birthday = $_POST['birthday'];
$fac_or_student = $_POST['fac_or_student'];
$involvement = $_POST['involvement'];
$help_improve = $_POST['help_improve'];
$accessText = $_POST['accessText'];
} else {
$username = [];
$password = [];
 echo " ";
}

if($username&&$password)
{
    require '../login_page/login.html'; //take to login page
    
    require '../login_page/req_aces_sucess.html'; //success
    $headers = array_keys($_POST);
    $file = fopen("members_info.csv","a");
    if(!filesize("members_info.csv")){
        fputcsv($file, $headers ); //write headers (key of the $_POST array (id,username,password,etc)
        fputcsv($file, $_POST ); //write values to file
    }
    else{
        fputcsv($file, $_POST );
    }
    fclose($file);
}
else if($username == ""&&$password==""){
    require '../top_header/bar_LO.html';
    require '../login_page/request_access.html';
    require '../login_page/req_aces_fail.html';
}
else{
    require '../top_header/bar_LO.html';
    require '../login_page/request_access.html'; //if fails loop back to req_access page
    
}
?>