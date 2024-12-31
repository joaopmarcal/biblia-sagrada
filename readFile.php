<?php

//print 'Reading File';

$json = file_get_contents('bibliaAveMaria.json'); 

// Check if the file was read successfully
if ($json === false) {
    die('Error reading the JSON file');
}

// Decode the JSON file
$json_data = json_decode($json, true); 

// Check if the JSON was decoded successfully
if ($json_data === null) {
    die('Error decoding the JSON file');
}

// Display data
//echo "<pre>";
print_r($json_data['antigoTestamento'][45]['capitulos'][2]['versiculos'][2]['texto']);
//var_dump(array_keys($json_data['novoTestamento']));
//echo "</pre>";

//antigoTestamento
//novoTestamento

id
Testamento text
Livro text
Capitulos int
Versiculo int 
Texto text