<?php session_start();

include 'database.php';
$firstLetterProfile = $_SESSION['fullname'][0];

$moviesId = $_GET["id"];
$url = "Location: film.php?";
  
 $dataform = $db->prepare('SELECT * FROM `users`');
 $dataCom = $db->prepare('SELECT * FROM `comments`');
 
 $dataCom->execute();
 $dataFetchCom = $dataCom->fetchAll();
 
 $dataform->execute();
 $dataFetch = $dataform->fetchAll();
 
 $dataComId = $db->prepare('SELECT `commentID` FROM `comments`');
 $dataComId->execute();
 $commentID = $dataComId->fetch()['commentID'];

 //Fichier php contenant l'insertion de commentaire
 include 'php/comment.php';
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
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" id="nav-button">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel"> Getflix</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="home.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">Vos comptes</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Nos films
              </a>
              <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                <li><a class="dropdown-item" href="pergender.php">Dernières Sorties</a></li>
                <li><a class="dropdown-item" href="pergender.php">Les plus regardés</a></li>
                <li>
                </li>
                <li><a class="dropdown-item" href="pergender.php">Par Genre</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="nav-comp" href="logout.php">Logout</a>
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Rechercher</button>
          </form>
        </div>
      </div>
    </div>
 </nav>
<!-- Fin de la barre de navigation -->

<div class="card text-center">
  <div class="card-header">
    Featured
  </div>
  <div class="card-body">
    <h5 class="card-title" id="">Special title treatment</h5>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
  <div class="card-footer text-muted">
    2 days ago
  </div>
</div>

<!-- ---------------- SECTION COMMENTAIRES -------------- -->

<?php if($_SESSION['type'] == 'admin' OR $_SESSION['type'] == 'premium'){
echo '
<div id="displayForm">
<form action="" method="POST">
    <input type="text" id="comment" name="comment">
    <button type="submit" id="submitComment" name="submit">Envoyer votre commentaire</button>
    </form>
    </div>'?>
    <?php
  };
?>
            <table id="commentSection">
            <?php //on va afficher ce qu'on veut qui provient de table users
            foreach ($dataFetchCom as $dataFetchCom) {
            if( $moviesId == $dataFetchCom["movie_id"]){?>
            <tr> 
            <!-- <td><?php// echo $dataFetchCom['user_id']; ?></td> -->
            <td><?php echo $dataFetchCom['fullname']; ?></td>
            <!-- <td><?php// echo $dataFetchCom['email']; ?></td> -->
            <td id="commentZone"><?php echo $dataFetchCom['comment']; ?></td>
            <!-- <td><?php// echo $dataFetchCom['movie_id']; ?></td> -->
            <td><?php echo $dataFetchCom['date']; ?></td>
            <?php if($_SESSION['type'] == 'admin'){echo
            '<td><a title="Edit the comment" href="commentaires/updateCom.php?commentID=';?><?php echo $dataFetchCom["commentID"];?><?php echo'&movie_id='; ?><?php echo $moviesId ?><?php echo'" name="edit"><img class="icons" src="asset/img/wrench.png" alt="clé à molette"></img></a></td>
            <td><a title="Delete the comment" href="commentaires/deleteCom.php?commentID=';?><?php echo $dataFetchCom["commentID"];?><?php echo'&movie_id='; ?><?php echo $moviesId ?><?php echo'" name="delete"><img class="icons" src="asset/img/cross.png" alt="croix"></img></a></td>';
        };?>

            </tr>

           <?php }
            ?>
            
            <?php
             }?>
            </table>

    </div>


<!-- lien js-->


<script src="asset/js/main.js"></script>

 </body>
</html>