<?php

// use fopen() to open weather.csv in read mode
$file = fopen('C:/private/weather.csv', 'r');
// extract the first line from the file as an array, and then assign it to a variable called $titles.
$titles = fgetcsv($file);
// initialize an empty array for the values that will be extracted from the CSV data
$cities = [];

// get the remaining data from the file.
while(!(feof($file))){
    $data = fgetcsv($file);
    // If fgetcsv() encounters a blank line, it returns an array containing a single null element, which generates an error when passed as an argument to array_combine().
    if(empty($data[0])){
        continue;
    }
    $cities[] = array_combine($titles, $data);
}

fclose($file);

// inspect the result using print_r. Make the output easier to read with <pre> tags.
echo '<pre>';
print_r($cities);
echo '</pre>';