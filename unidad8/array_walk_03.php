<?php

// passing the name of a defined function as a string

$book = [
    'author' => 'David Powers',
    'title' => 'PHP 8 Solutions'
];

function output(&$val){
    return $val = strtoupper($val);
}
array_walk($book, 'output');
echo '<pre>';
print_r($book);
echo '</pre>';