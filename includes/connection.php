<?php
function dbConnect($usertype, $connectionType = 'mysqli') {
    $host = 'localhost';
    $db = 'phpsols';
    if ($usertype  == 'read') {
        $user = 'root';
        $pwd = '';
    } elseif ($usertype == 'write') {
        $user = 'root';
        $pwd = '';
    } else {
        exit('Unrecognized user');
    }
    if ($connectionType == 'mysqli') {
        $conn = @ new mysqli($host, $user, $pwd, $db);
        if ($conn->connect_error) {
            exit($conn->connect_error);
        }
        return $conn;
    } else {
        try {
            return new PDO("mysql:host=$host;dbname=$db", $user, $pwd);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}