<?php
if(isset($_POST['register'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['pwd']);
    $retyped = trim($_POST['conf_pwd']);
    $userfile = 'C:/private/hashed.csv';
    require_once '../includes/register_user_csv.php';
}
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <h1>Register User</h1>
    <?php
    if(isset($errors) || isset($result)){
        echo '<ul>';
        if(empty($errors)){
            echo '<li>Password OK</li>';
            echo "<li>$result</li>";
        }else{
            foreach($errors as $error){
                echo "<li>$error</li>";
            }
        }
        echo '</ul>';
    }
    ?>
    <form action="register.php" method="post">
        <p>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">
        </p>
        <p>
            <label for="pwd">Password:</label>
            <input type="password" name="pwd" id="pwd">
        </p>
        <p>
            <label for="conf_pwd">Retype Password:</label>
            <input type="password" name="conf_pwd" id="conf_pwd">
        </p>
        <p>
            <input type="submit" name="register" value="Register">
        </p>
    </form>
</body>
</html>