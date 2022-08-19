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
    <link rel="stylesheet" href="asset/css/film.css">
    <link rel="stylesheet" href="asset/css/navbar.css">
</head>
<body>
 <!--Navigation bar-->
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
<!--end of Navigation bar-->
<br>


<!-- page du film -->

<div class="movie-info">
  <div class="movie-detail">
      <h1 class="movie-name"></h1>
      <p class="genres"></p>
      <p class="des"></p>
      <p class="starring"><span>Starring:</span></p>
  </div>
</div>>

<!-- video clips -->
<div class="trailer-container">
    <h1 class="heading">Trailer</h1>
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

<!-- lien js-->
<script src="asset/js/film.js"></script>
<script src="asset/js/navbar.js"></script>


 </body>
</html>