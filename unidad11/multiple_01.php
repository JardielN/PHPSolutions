<?php
if(isset($_POST['next'])){
    // Set a variable to control access to other pages
    $_SESSION['formStarted'] = true;
    // Set required fields
    $required = 'first_name';
    $firstPage = 'multiple_01.php';
    $nextPage = 'multiple_02.php';
    $submit = 'next';
    require_once '../includes/multiform.php';
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Multiple form 1</title>
</head>

<body>
<form method="post" action="multiple_01.php">
    <p>
        <label for="first_name">First name:</label>
        <input type="text" name="first_name" id="first_name">
    </p>
    <p>
        <label for="family_name">Family name:</label>
        <input type="text" name="family_name" id="family_name">
    </p>
    <p>
        <input type="submit" name="next" value="Next &gt;">
    </p>
</form>
</body>
</html>
