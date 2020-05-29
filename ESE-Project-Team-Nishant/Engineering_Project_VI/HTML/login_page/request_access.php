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
                <li><b>Request Details</b>: <?php echo $_POST['accessText']; ?></li>
            </ul>
        </body>
    </head>

</html>