<?php

// this is how you would open a text file for reading with fopen.
// r means a Internal pointer initially at the beginning of the file

// store the pathname of a file
$filename = 'C:/private/sonnet.txt';
// open the file in read-only mode
$file = fopen($filename, 'r');
// read the file and store its contents
$contents = fread($file, filesize($filename));
// close the file
fclose($file);
// display the contents with <br/> tags.
echo nl2br($contents);