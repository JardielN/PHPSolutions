<?php
// nl2br() que convierte los caracteres de nueva línea en etiquetas <br/> 

//nl2br(readfile('C:/private/sonnet.txt'));

// file_get_contents establece el formato correcto y esperado para los archivos
//echo nl2br(file_get_contents('C:/private/sonnet.txt'));

// definir la forma en como se mostrara, es otra ventaja de file_get_contents()
/*
$sonnet = file_get_contents('C:/private/sonnet.txt');
// replace new lines with spaces
$words = str_replace("\r\n", ' ', $sonnet);
// split into an array of words
$words = explode(' ', $words);
// extract the first nine array elements
$first_line = array_slice($words, 0, 9);
// join the first nine elements and display
echo implode(' ', $first_line);
*/

// es mas sencillo usar file() para mostrar lineas. Este desreferencia por medio de arreglos un archivo por lineas.
echo file('C:/private/sonnet.txt')[10];