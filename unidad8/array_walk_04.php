<?php

// the third argument can be any other value that you want to use.

$book = [
    'author' => 'David Powers',
    'title' => 'PHP 8 Solutions'
];

function output(&$val, $key, $verb){
    return $val = "The $key of this book $verb $val.";
}

array_walk($book, 'output', 'is');

echo '<pre>';
print_r($book);
echo '</pre>';