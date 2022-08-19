<?php session_start();

include 'database.php';

$firstLetterProfile = $_SESSION['fullname'][0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Getflix</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/fontawesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.5.5/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="asset/css/style.css">
    <link rel="stylesheet" href="asset/css/navbar.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>


<body>

<!-- Barre de navigation (quent)--> 

<nav class="navbar">
  <div class="title">Getflix</div>
  <a href="#" class="toggle-button">
    <span class="bar"></span>
    <span class="bar"></span>
    <span class="bar"></span>
  </a>
  <div class="navbar-links">
    <ul>
      <li><a href="testhome.html">Home</a></li>
      <li><a href="pergender.html">Films</a></li>
      <li><a href="">Contact</a></li>
    </ul>
  </div>
</nav>

 <!--Fin de la barre de navigation-->

<!--affichage des films --> 

<div class="container-lg">
  <div id="tags"></div>
  <div id="myNav" class="overlay">

      <!-- Pour fermer l'overlay -->
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    
      <!-- Overlay -->
      <div class="overlay-content" id="overlay-content"></div>
      
      <a href="javascript:void(0)" class="arrow left-arrow" id="left-arrow">&#8656;</a> 
      
      <a href="javascript:void(0)" class="arrow right-arrow" id="right-arrow" >&#8658;</a>

    </div>
  <main id="main"></main>
  <div class="pagination">
      <div class="page" id="prev">Previous Page</div>
      <div class="current" id="current">1</div>
      <div class="page" id="next">Next Page</div>

  </div>
</div>



<!-- ----------------------------------- TEST ZONE COMMENTAIRE ------------------------------------- -->

<?php

$dataform = $db->prepare('SELECT * FROM `users`');
$dataCom = $db->prepare('SELECT * FROM `comments`');

$dataCom->execute();
$dataFetchCom = $dataCom->fetchAll();

$dataform->execute();
$dataFetch = $dataform->fetchAll();

$dataComId = $db->prepare('SELECT `commentID` FROM `comments`');
$dataComId->execute();
$commentID = $dataComId->fetch()['commentID'];
?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
  <script src="asset/js/navbar.js"></script>
    <script src="asset/js/home.js"></script>

</body>
</html>
