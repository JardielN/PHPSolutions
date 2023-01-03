<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamically Generated Image Menu</title>
</head>
<body>
    <form action="" method="post">
        <select name="pix" id="pix">
            <option value="">Select an Image</option>
<?php
$files = new FilesystemIterator('../images');
$images = new RegexIterator($files, '/\.(?:jpg|png|gif|webp)$/i');
foreach($images as $image){
    $filename = $image->getFilename();
?>
<option value="<?=$filename?>"><?=$filename?></option>
<?php } ?>
        </select>
    </form>
</body>
</html>