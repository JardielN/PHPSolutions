<?php

$colors = ['red', 'amber', 'green'];
$actions = ['stop', 'caution', 'go'];
$signals = array_combine($colors, $actions);
foreach($signals as $key => $value){
    echo "{$key} => {$value} " . '<br>';
}