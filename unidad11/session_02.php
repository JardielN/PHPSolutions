<!DOCTYPE html>
<?php
// Initiate session
session_start();
// Check that form has been submitted and that name() is not empty
if($_POST && !empty($_POST['name'])){
    // set session variable
    $_SESSION['name'] = $_POST['name'];
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // Check session variable is set.
    if(isset($_SESSION['name'])){
        // if set, greet by name.
        echo 'Hi there, ' . htmlentities($_SESSION['name']) . ' . <a href="session_03.php">Next</a>';
    }else{
        // If not set, send back to login.
        echo 'Who are you? <a href="session_01.php">Please log in</a>';
    }
    ?>
</body>
</html>