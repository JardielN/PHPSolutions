<?php
use Php8Solutions\File\MultiUpload;
// set the maximum upload size in bytes
$max = 512000;
if(isset($_POST['upload'])){
    // define the path to the upload folder
    $path = 'C:/upload_test/';
    require_once '../Php8Solutions/File/MultiUpload.php';
    try{
        $loader = new MultiUpload('image', $path, mime: 'application/pdf', max: $max);
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
    <form action="multi_upload.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="image">Upload images (multiple selections permitted):</label>
            <input type="file" name="image[]" id="image" multiple>
        </p>
        <p>
            <input type="submit" name="upload" value="Upload">
        </p>
    </form>
    <pre>
        <?php
        if(isset($_POST['upload'])){
            print_r($_FILES);
        }
        ?>
    </pre>
</body>
</html>