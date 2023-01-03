<?php
use Php8Solutions\File\Upload;
// set the maximum upload size in bytes
$max = 512000;
if(isset($_POST['upload'])){
    // define the path to the upload folder
    $path = 'C:/upload_test/';
    require_once '../Php8Solutions/File/Upload.php';
    try{
        $loader = new Upload('image', $path, mime: 'application/pdf', max: $max);
        $result = $loader->getMessages();
    }catch(Throwable $e){
        echo $e->getMessage();
    }
}
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
    if(isset($result)){
        echo '<ul>';
        foreach($result as $message){
            echo "<li>$message</li>";
        }
        echo '</ul>';
    }
    ?>
    <form action="file_upload_01.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="image">Upload image:</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="<?=$max?>">
            <input type="file" name="image" id="image">
        </p>
        <p>
            <input type="submit" name="upload" value="Upload">
        </p>
    </form>
</body>
</html>