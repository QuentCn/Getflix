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
</head>


<body>

<!-- Barre de navigation (quent) -->


 <nav class="navbar bg-light fixed-top">
    <div class="container-fluid" id="nav">
      <a class="navbar-brand" id="title" href="home.php"><img class="getflixLogo" src="./asset/img/getflix2.png" alt="Logo Getflix"></a>
      <form class="d-flex" role="search" id="serchbar">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit" id="search-btn">Search</button>
      </form>
      <button class="navbar-toggler btn btn-info btn-circle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" id="nav-button">
        <span class="navbar-toggler-icon" id="profileImage"><?php echo $firstLetterProfile; ?>
</span>
      </button>
      
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel"> Getflix</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" id="nav-comp" aria-current="page" href="home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="nav-comp" href="account.html">Vos comptes</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="nav-comp" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Nos films
              </a>
              <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                <li><a class="dropdown-item" id="nav-comp" href="pergender.php">Dernières Sorties</a></li>
                <li><a class="dropdown-item" href="pergender.php">Les plus regardés</a></li>
                <li><a class="dropdown-item" id="nav-comp" href="pergender.php">Par Genre</a></li>
              </ul>
            </li>
            <?php if($_SESSION['type'] == 'admin'){
            echo'<li class="nav-item">
              <a class="nav-link" id="nav-comp" href="administration/admin.php">Administration</a>
            </li>' ?>
       <?php };
            ?>
            <li class="nav-item">
              <a class="nav-link" id="nav-comp" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
 </nav>
<!-- fin de la navbar (quent) -->

<!-- Upcoming movies (quent) -->
<!--
<section id="Upcoming Movies">
    <div class="Container">
        <h2>UpComingMovies</h2>
        <div class="row Movies">
            <div class="col-lg col-md-4">
                <div class="row">
                    <div class="col-6"><a href="#"><img src="/asset/img/" class="" alt="..."></a></div>
                    
                </div>
        </div>
    </div>
js pas encore fait -->
<!-- fin de la section (quent) -->


<!-- carroussel 1 Nouveauté (quent) -->

<div class="card bg-dark text-white max-height d-grid align-items-center my-5 justify-content-center">
  <div class="container-fluid max-height d-grid align-items-center my-5 justify-content-center">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="asset/img/love-death-robots-rsz.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="asset/img/manifest.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="asset/img/Sick-Note-rsz.png" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <div class="card-img-overlay">
    <h5 class="card-title">Nouveau Sur Getflix</h5>
    <p class="card-text"></p>
    <p class="card-text"></p>
  </div>
</div>


<!--carrousel 2 Les plus regardés (quent) -->

<div class="card bg-dark text-white max-height d-grid align-items-center my-5 justify-content-center">
  <div class="container-fluid max-height d-grid align-items-center my-5 justify-content-center">
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="asset/img/love-death-robots-rsz.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="asset/img/manifest.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
          <img src="asset/img/Sick-Note-rsz.png" class="d-block w-100" alt="...">
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <div class="card-img-overlay">
    <h5 class="card-title">Les Plus regardés</h5>
    <p class="card-text"></p>
    <p class="card-text"></p>
  </div>
</div>


<hr>


<!--carrousel 3 par genre (quent) -->

<div class="container-fluid max-height d-grid align-items-center my-5 justify-content-center">
  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="asset/img/love-death-robots-rsz.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="asset/img/manifest.png" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="asset/img/Sick-Note-rsz.png" class="d-block w-100" alt="...">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>



<!-- ----------------------------------- TEST ZONE COMMENTAIRE ------------------------------------- -->

<?php

if($_SESSION['fullname']){
 echo $_SESSION['fullname'] . ' son email est ' . $_SESSION['email'] . ' son id est ' . $_SESSION['user_id'] . 'et son type est' . $_SESSION['type'] . ' est bien connecté <br />';
};

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
    <script src="asset/js/main.js"></script>

</body>
</html>
