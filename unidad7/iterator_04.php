<?php

// RECURSIVEDIRECTORYITERATOR. RECURSIVEITERATORITERATOR

// to avoid the dot files, that represent the current and parent folders, use the constant SKIP_DOTS.
$files = new RecursiveDirectoryIterator('../images', RecursiveDirectoryIterator::SKIP_DOTS);

$files = new RecursiveIteratorIterator($files);

foreach ($files as $file) {
    echo $file->getRealPath(). '<br>';
}