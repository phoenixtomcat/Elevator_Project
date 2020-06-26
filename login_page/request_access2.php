<?php

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password =$_POST['password1'];
$website = (isset($_POST['url'])?$_POST['url']:null);
$birthday = (isset($_POST['bdate'])?$_POST['bdate']:null);
$fac_or_student = (isset($_POST['fac_or_student'])?$_POST['fac_or_student']:null);
$gender = (isset($_POST['gender'])?$_POST['gender']:null);
$in_software = (isset($_POST['software'])?1:0);
$in_datacom = (isset($_POST['datacom'])?1:0);
$in_math = (isset($_POST['math'])?1:0);
$in_natural_science = (isset($_POST['natural_science'])?1:0);
$in_thermo = (isset($_POST['thermo'])?1:0);
$in_project = (isset($_POST['project'])?1:0);
$help_improve = (isset($_POST['help_improve'])?$_POST['help_improve']:null);
$accessText = (isset($_POST['accessText'])?$_POST['accessText']:null);

//create new user array
$new_user = [
    "firstname" => $firstname,
    "lastname" => $lastname,
    "email" => $email,
    "username" => $username,
    "password" => $password,
    "website" => $website,
    "birthday" => $birthday,
    "role" => $fac_or_student,
    "gender" => $gender,
    "in_software" => $in_software,
    "in_datacom" => $in_datacom,
    "in_math" => $in_math,
    "in_natural_science" => $in_natural_science,
    "in_thermo" => $in_thermo,
    "in_project" => $in_project,
    "help_improve" => $help_improve,
    "other_info" => $accessText
];

function createNewUser(){
    global $new_user;

    //database parameters
    $db = new PDO(
        'mysql:host=127.0.0.1;dbname=project_database',
        'ese_team',
        'ese'
    );

    //return arrays with keys that are the name of the fields
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    //create SQL statement
    $query = 'INSERT INTO userCredentials (firstname, 
                                        lastname, 
                                        email, 
                                        username, 
                                        password, 
                                        website, 
                                        birthday, 
                                        role, 
                                        gender, 
                                        in_software, 
                                        in_datacom, 
                                        in_math, 
                                        in_natural_science, 
                                        in_thermo, 
                                        in_project, 
                                        help_improve, 
                                        other_info) 
            VALUES (:firstname,
                    :lastname,
                    :email,
                    :username,
                    :password,
                    :website,
                    :birthday,
                    :role,
                    :gender,
                    :in_software,
                    :in_datacom,
                    :in_math,
                    :in_natural_science,
                    :in_thermo,
                    :in_project,
                    :help_improve,
                    :other_info)';

    //execute SQL statement at database
    $statement = $db->prepare($query);
    $result = $statement->execute($new_user);

    if($result)
        return true;
    else
        return false;

}


if(createNewUser())
{
    require '../top_header/bar_LO.html';
    require '../login_page/login.html'; //take to login page   
    require '../login_page/req_aces_sucess.html'; //success

}
else{
    require '../top_header/bar_LO.html';
    require '../login_page/request_access.html'; //if fails loop back to req_access page
    require '../login_page/req_aces_fail.html';
}
?>