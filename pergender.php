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
      <a class="navbar-brand" id="title" href="home.php">Getflix</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" id="nav-button">
        <span class="navbar-toggler-icon"><?php echo $firstLetterProfile; ?></span>
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
          <!-- --------------------------- BARRE DE RECHERCHE --------------------- -->
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Rechercher</button>
          </form>
        </div>
      </div>
    </div>
 </nav>

<!-- Fin de la barre de navigation -->
<div class="container-lg">
  <div id="tags"></div>
    <div id="myNav" class="overlay">

      <!-- Pour fermer l'overlay -->
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    
      <!-- Overlay -->
      <div class="overlay-content" id="overlay-content"></div>
      
      <a href="javascript:void(0)" class="arrow left-arrow" id="left-arrow">&#8656;</a> 
      
      <a href="javascript:void(0)" class="arrow right-arrow" id="right-arrow" >&#8658;</a>

        <!-- ----------------------------------- TEST ZONE COMMENTAIRE ------------------------------------- -->

<?php
if($_SESSION['fullname']){
 echo $_SESSION['fullname'] . ' son email est ' . $_SESSION['email'] . ' son id est ' . $_SESSION['user_id'] . ' est bien connecté <br />';
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



// -------------------------------- INSERTION DU COMMENTAIRE ---------------------------

//CONDITION

    //Si les champs ne sont pas remplis il ne se passe rien !
    if(isset($_POST['submit'])){
      if(empty($_POST["comment"])){
      echo"Veuillez remplir tous les champs !";
      }};
      
  if(isset($_POST['submit'])){
       if(isset($_POST['submit'])){
          if(!empty($_POST["comment"])) {
              $user_id = $_SESSION["user_id"];
              $fullname = htmlspecialchars($_SESSION["fullname"]); //htmlspecialchars permet d'empêcher un utilisateur malveillant d'envoyer du code via l'input
              $email = htmlspecialchars($_SESSION["email"]);
              $comment = $_POST['comment'];
              
               //On va selectionner le tout ("*") dans le table users
              $dataform = $db->prepare('SELECT * FROM `users`');
              $dataCom = $db->prepare('SELECT * FROM `comments`');
          
               //On va tout récupérer
              
              $dataCom->execute();
              $dataFetchCom = $dataCom->fetchAll();

              $dataform->execute();
              $dataFetch = $dataform->fetchAll();
              $id = $_POST["user_id"];
          
              $sqlQuery = 'INSERT INTO `comments`(user_id, fullname, email, comment) VALUES (:user_id, :fullname, :email, :comment)';
              
              // Préparation
              $insertData = $db->prepare($sqlQuery);

              // Exécution, le message est maintenant dans la base de données
              $insertData->execute([
                  'user_id' => $user_id,
                  'fullname' => $fullname,
                  'email' => $email,
                  'comment' => $comment,
              ]);
    }}};
                  
?>
    <form action="" method="POST">
    <input type="text" name="comment" style="width: 450px; height: 200px">
    <button type="submit" name="submit">Envoyer votre commentaire</button>
    </form>

            <table id="commentSection">
            <tr>
                    <th>Id</th>
                    <th>fullname</th>
                    <th>Email</th>
                    <th>Comment</th>
                    <?php if($_SESSION['type'] =='admin'){echo "<th>Editer</th>
                    <th>Supprimer</th>";
                    };?>
            </tr> 
            <?php //on va afficher ce qu'on veut qui provient de table users
            foreach ($dataFetchCom as $dataFetchCom) {
            ?>
            <tr> 
            <td><?php echo $dataFetchCom['user_id']; ?></td>
            <td><?php echo $dataFetchCom['fullname']; ?></td>
            <td><?php echo $dataFetchCom['email']; ?></td>
            <td><?php echo $dataFetchCom['comment']; ?></td>
            <?php if($_SESSION['type'] == 'admin'){echo
            '<td><a href="commentaires/updateCom.php?commentID=';?><?php echo $dataFetchCom["commentID"];?><?php echo'" name="edit"><img class="icons" src="asset/img/wrench.png" alt="clé à molette"></img></a></td>
            <td><a href="commentaires/deleteCom.php?commentID=';?><?php echo $dataFetchCom["commentID"];?><?php echo'" name="delete"><img class="icons" src="asset/img/cross.png" alt="croix"></img></a></td>';
        };?>

            </tr>

            <?php
            }?>
            </table>

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

 </body>
</html>