<?php session_start();

include 'database.php';
$firstLetterProfile = $_SESSION['fullname'][0];

// if(isset($_GET['movie_id'])){
//   echo "bonjour";
// }

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
  <div class="title"><a href="home.php"><img class="getflixLogo" src="./asset/img/getflix2.png" alt="Logo Getflix"></a></div>
  <a href="#" class="toggle-button">
    <span class="bar"></span>
    <span class="bar"></span>
    <span class="bar"></span>
  </a>
  <form role="search" id="searchbar">
    <input class="form-control position-relative" id="search" type="search" placeholder="Search" aria-label="Search">
  </form>
  <div class="navbar-links">
    <ul>
      <li><a href="home.php">Home</a></li>
      <li><a href="pergender.php">Films</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </div>
</nav>


 <!--Fin de la barre de navigation-->






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
<!-- lien js-->

<script src="asset/js/main.js"></script>
<script src="asset/js/navbar.js"></script>

 </body>
</html>