<?php
// 8-11. PROCESSING A CSV FILE WITH THE SPLAT OPERATOR

// generator that yields each line of a CSV file as an
// array
function csv_processor($csv_file) {
    if (@!$file = fopen($csv_file, 'r')) {
        echo "Can't open $csv_file.";
        return;
    }
    while (($data = fgetcsv($file)) !== false) {
        yield $data;
    }
    fclose($file);
}



function display_temp($city, $temp) {
    $tempF = round($temp/5*9+32);
    return "$city: $temp&deg;C ($tempF&deg;F)";
}



$cities = csv_processor('./weather.csv');


$cities->next();
while ($cities->valid()) {
    [$city, $temp] = $cities->current();
    echo display_temp($city, $temp) . '<br>';
    $cities->next();
}
