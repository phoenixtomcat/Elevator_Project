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
                <li><b>First Name</b>: <?php echo $_POST['firstname']; ?></li>
                <li><b>Last Name</b>: <?php echo $_POST['lastname']; ?></li>
                <li><b>Email</b>: <?php echo $_POST['email']; ?></li>
                <li><b>Website</b>: <?php echo $_POST['url']; ?></li>
                <li><b>Birthday</b>: <?php echo $_POST['birthday']; ?></li>
                <li><b>Faculty or student</b>: <?php echo $_POST['fac_or_student']; ?></li>
                <li><b>Involvement</b>: <?php echo $_POST['involvement']; ?></li>
                <li><b>Willing to help</b>: <?php echo $_POST['fac_or_student']; ?></li>
                <li><b>Request Details</b>: <?php echo $_POST['accessText']; ?></li>
            </ul>
        </body>
    </head>

</html>