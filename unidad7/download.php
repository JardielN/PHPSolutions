<?php
// define error page
$error = '../unidad7/error.php';
// define the pagh to the download folder
$filepath = '../images/';
$getfile = NULL;
// block any attempt to explore the filesystem
if(isset($_GET['file']) && basename($_GET['file']) == $_GET['file']){
    $getfile = $_GET['file'];
}else{
    header("location: $error");
    exit;
}
if($getfile){
    $path = $filepath . $getfile;
    // check that it exists and is readable
    if(file_exists($path) && is_readable($path)){
        // send the appropiate headers
        header('Content-type: application/octect-stream');
        header('Content-Length: ' . filesize($path));
        header('Content-Disposition: attachment; filename=' . $getfile);
        header('Content-Transfer-Encoding: binary');
        // output the fle content
        readfile($path);
    }else{
        header("Location: $error");
    }
}