<?php
// PHP SOLUTION 8-10. USING A GENERATOR TO PROCESS 
// A CSV FILE

// generator that yields each line of a CSV file as an
// array
function csv_pocessor($csv_file){
    if(@!$file = fopen($csv_file, 'r')){
        echo "Can't open $csv_file.";
        return;
    }
    while(($data = fgetcsv($file)) !== false){
        yield $data;
    }
    fclose($file);
}

$scores = csv_pocessor('./scores.csv');

/*
foreach($scores as $score){
    [$home, $hscore, $away, $ascore] = $score;
    echo "$home $hscore: $ascore $away<br>";
}
*/

$scores->next();
while($scores->valid()){
    [$home, $hscore, $away, $ascore] = $scores->current();
    echo "$home $hscore: $ascore $away<br>";
    $scores->next();
}