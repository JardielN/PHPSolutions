<?php
session_start();
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    // Check whether session variable is set.
    if(isset($_SESSION['name'])){
        // If set, greet by name
        echo'Hi, ' . htmlentities($_SESSION['name']) . '. See, I remembered your name!<br>';
        // Unset session variable
        unset($_SESSION['name']);
        // Invalidate the session cookie
        if(isset($_COOKIE[session_name()])){
            setcookie(session_name(), '', time()-86400, '/');
        }
        ob_end_flush();
        // end session
        session_destroy();
        echo '<a href="session_02.php">Back to page 2</a>';
    }else{
        // Display if not recognized
        echo "Sorry, I don't know you.<br>";
        echo '<a href="session_01.php">Please Log in.</a>';
    }
    ?>
</body>
</html>