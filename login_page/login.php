<?php
$submitted = !empty($_POST);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Form Handler Page</title>
        <body>
            <p>Form submitted? <?php echo (int) $submitted; ?></p>
            <p>Your login info is</p>
            <ul>
                <li><b>username</b>: <?php echo $_POST['username']; ?></li>
                <li><b>passowrd</b>: <?php echo $_POST['password']; ?></li>
            </ul>
        </body>
    </head>

</html>