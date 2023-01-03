<?php
use Php8Solutions\Image\ThumbnailUpload;
if(isset($_POST['upload'])){
    require_once('../Php8Solutions/Image/ThumbnailUpload.php');
    try{
        $loader = new ThumbnailUpload('image', 'C:/upload_test/', 
        thumbPath: 'C:/thumbs/');
        $messages = $loader->getMessages();
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
if(!empty($messages)){
    echo '<ul>';
    foreach($messages as $message){
        echo "<li>$message</li>";
    }
    echo '</ul>';
}
?>
    <form action="create_thumb_upload_01.php" method="POST" enctype="multipart/form-data">
        <p>
            <label for="image">Upload images to create thumbnails:</label>
            <input type="file" name="image[]" id="image" multiple>
        </p>
        <p>
            <input type="submit" name="upload" id="upload" value="Upload">
        </p>
    </form>
</body>
</html>