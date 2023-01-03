<?php
$error = '';
if(isset($_POST['login']))
{
    session_start();
    $username = $_POST['username'];
    $password = $_POST['pwd'];
    // location of username and passwords.
    $userlist = 'C:/private/hashed.csv';
    // location to redirect on success
    $redirect = 'http://localhost/curso4/unidad11/menu.php';
    require_once '../includes/authenticate.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <h1>Log In User</h1>
    <form action="login.php" method="POST">
        <p>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">
        </p>
        <p>
            <label for="pwd">Password:</label>
            <input type="password" name="pwd" id="pwd">
        </p>
        <p>
            <input type="submit" name="login" value="Log in">
        </p>
    </form>
</body>
</html>