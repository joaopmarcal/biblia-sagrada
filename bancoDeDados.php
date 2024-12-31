<?php

// Database connection settings
$host = 'localhost'; // Replace with your database host
$dbname = 'bible'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = 'lkoperu89074563'; // Replace with your database password

$testmentArray = ['antigoTestamento','novoTestamento'];
$oldBooks = [];//46
$newBooks = [];//27

####################################################################################################
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

//print_r($json_data['antigoTestamento'][45]['capitulos'][2]['versiculos'][2]['texto']);
####################################################################################################

####################################################################################################
foreach($json_data as $testament => $data){
    var_dump($testament);
    foreach($data as  $books){
        //var_dump($books['nome']);//Reis
        $book = $books['nome'];
        foreach($books['capitulos'] as $chapters){
            //var_dump($chapters['capitulo']);
            $chapter = (int) $chapters['capitulo'];
            foreach($chapters['versiculos'] as $verse){
                //var_dump($verse['versiculo']);
                //var_dump($verse['texto']);
                $verseItem = (int) $verse['versiculo'];
                $text = $verse['texto'];
                try {
                    // Create a PDO connection
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                    // Insert query
                    $sql = "INSERT INTO bible (Testament, Book, Chapter, Verse, Text) 
                    VALUES (:Testament, :Book, :Chapter, :Verse, :Text)";
                
                    // Prepare the statement
                    $stmt = $pdo->prepare($sql);
                
                    // Bind parameters
                    $stmt->bindParam(':Testament', $testament);
                    $stmt->bindParam(':Book', $book);
                    $stmt->bindParam(':Chapter', $chapter);
                    $stmt->bindParam(':Verse', $verseItem);
                    $stmt->bindParam(':Text', $text);
                
                    // Example data to insert
                    //$testament = 'Old Testament'; // Replace with 'New Testament' if needed
                    //$book = 'Genesis';
                    //$chapter = 1;
                    //$verse = 'In the beginning God created the heavens and the earth.';
                    
                    // Execute the query
                    $stmt->execute();
                
                    //echo "Record inserted successfully!";
                } catch (PDOException $e) {
                    // Handle connection or query errors
                    echo "Error: " . $e->getMessage();
                }
            }
        }

    }
}
####################################################################################################

/*
CREATE TABLE bible (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Testament TEXT,
    Book TEXT,
    Chapter INT,
    Verse INT,
    Text TEXT
) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
*/


?>
