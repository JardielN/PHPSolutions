<?php

// Restricting file types with the RegexIterator.

$files = new FilesystemIterator('.');
$files = new RegexIterator($files, '/\.(?:txt|csv)$/i');
foreach ($files as $file) {
    echo $file->getFilename(). '<br>';
}