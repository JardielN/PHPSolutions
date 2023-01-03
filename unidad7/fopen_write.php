<?php
//if the form has been submitted, process the input text
if(isset($_POST['putContents'])){
    // open the file in write-only mode
    $file = fopen('C:/private/write.txt', 'w');
    // write the contents
    fwrite($file, $_POST['contents']);
    // close the file
    fclose($file);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write Only</title>
    <style>
        label{
            font-weight: bold;
            display: inline-block;
            float: left;
            margin-right: 15px;
        }
        textarea{
            width: 400px;
            height: 125px;
        }
    </style>
</head>
<body>
    <form action="fopen_write.php" name="writeFile" method="post">
        <p>
            <label for="contents">Write this to file:</label>
            <textarea name="contents" id="contents"></textarea>
            <p>
                <input type="submit" name="putContents" value="Write to file">
            </p>
        </p>
    </form>
</body>
</html>