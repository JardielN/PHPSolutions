<?php
if(!isset($_SESSION)){
    session_start();
}
$filename = basename($_SERVER['SCRIPT_FILENAME']);
$current = 'http://' . $_SERVER['HTTP_HOST'] .
    $_SERVER['PHP_SELF'];
?>