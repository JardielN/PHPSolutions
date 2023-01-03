<?php

// FILESYSTEM ITERATOR

$files = new FilesystemIterator('../images', FilesystemIterator::UNIX_PATHS);

foreach ($files as $file) {
    echo $file . '<br>';
}