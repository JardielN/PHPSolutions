<?php
// Run this script only if the logout button has been clciked.
if(isset($_POST['logout'])){
    // empty the $_SESSION array
    $_SESSION = [];
    // Invalidate the session cookie
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(), '', time()-86400, '/');
    }
    // End session and redirect
    session_destroy();
    header('Location: http://localhost/curso4/unidad11/login.php');
}


?>
<form method="post">
    <input type="submit" name="logout" value="Log Out">
</form>