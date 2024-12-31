<?php

//php -S localhost:8081

require "Connect.php";
require "Bible.php";

$testament = isset($_GET['testament']) ? $_GET['testament'] : false;
$book = isset($_GET['book']) ? $_GET['book'] : false;
$charpter = isset($_GET['charpter']) ? $_GET['charpter'] : false;

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <title>BíBlia Sagrada!</title>
  </head>
  <body>
    <div class="container">

        <h1>BíBlia Sagrada!</h1>
        <div class="box-card-main">
            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
            <div class="card-header">Testamento</div>
            <div class="card-body">
                <h5 class="card-title"><?php print $testament ?></h5>
            </div>
            </div>
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
            <div class="card-header">Livro</div>
            <div class="card-body">
                <h5 class="card-title"><?php print $book ?></h5>
            </div>
            </div>  
            <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header">Capítulo</div>
            <div class="card-body">
                <h5 class="card-title"><?php print $charpter ?></h5>
            </div>
            </div>
        </div>    

        <ul class="nav nav-pills">
            <?php
            foreach (Bible::chooseTestament() as $row) { 
            ?>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php print $row['Testament'] == $testament ? 'active' : '' ?>" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><?php print htmlspecialchars($row['Testament']) ?></a>
                <ul class="dropdown-menu">
                <?php    
                foreach (Bible::chooseBook($row['Testament']) as $bookItem) { 
                ?>
                    <li><a class="dropdown-item" href="/index.php?testament=<?php print htmlspecialchars($row['Testament']); ?>&book=<?php print htmlspecialchars($bookItem["Book"]); ?>"><?php print htmlspecialchars($bookItem['Book']) ?></a></li>
                <?php
                }
                ?>
                </ul>
            </li>
            <?php
            }
            ?>
        </ul>

        <?php
        if ($testament && $book && $charpter == false){
            try {
                // Fetch and display the unique values
                echo "<div class='charpter-main-box'>";
                foreach (Bible::chooseCharpter($testament,$book) as $row) { ?>
                    <div class='charpter-box'><a class="choose-charpter" href="/index.php?testament=<?php print htmlspecialchars($testament); ?>&book=<?php print htmlspecialchars($book); ?>&charpter=<?php print htmlspecialchars($row['Chapter']) ?>"><?php print htmlspecialchars($row['Chapter']) ?></a></div>
                    <?php
                }
                echo "</div>";
            } catch (PDOException $e) {
                // Handle connection errors
                echo "Error: " . $e->getMessage();
            }
            
        } elseif ($testament && $book && $charpter){
            
            try {
                echo "<div class='verse-main-box'>";
                foreach (Bible::chooseVerse($testament,$book,$charpter) as $row){ ?>
                    <a class='verse-box' href="#verse-<?php print $row['Verse'] ?>"><?php print htmlspecialchars($row['Verse']) ?></a><br>
                    <?php
                }
                echo "</div>";
                foreach(Bible::getText($testament,$book,$charpter) as $textItem){
                    ?>
                        <h3 id='verse-<?php print $textItem['Verse'] ?>'><?php print $textItem['Verse'] ?>.<?php print $textItem['Text'] ?></h3>
                    <?php
                }
            } catch (PDOException $e) {
                // Handle connection errors
                echo "Error: " . $e->getMessage();
            }

        }
        ?>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>