<?php

$book = [
    'author' => 'David Powers',
    'title' => 'PHP 8 Solutions'
];

function modify($val){
    return strtoupper($val);
}

$modify = array_map('modify', $book);

echo '<pre>';
print_r($book);
print_r($modify);
echo '</pre>';