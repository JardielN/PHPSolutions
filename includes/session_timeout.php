<?php
session_start();
ob_start();
// Set a limit time in seconds
$timelimit = 15;
// Get the current time
$now = time();
// Where to redirect if rejected.
$redirect = ' http://localhost/curso4/unidad11/login.php';
// if session variable not set, redirect to login page
if (!isset($_SESSION['authenticated'])) {
    header("Location: $redirect");
    exit;
}
elseif ($now > $_SESSION['start'] + $timelimit){
    // If timelimit has expired, destroy the session and redirect
    $_SESSION = [];
    // Invalidate the session cookie
    if(isset($_COOKIE[session_name()])){
        setcookie(session_name(), '', time()-86400, '/');
    }
    // end session and redirect with query string
    session_destroy();
    header("Location: {$redirect}?expired=yes");
    exit;
}else{
    // If it's got this far, it's OK, so update start time
    $_SESSION['start'] = time();
}
?>