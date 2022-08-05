<?php
session_start();

include '../database.php';

if($_SESSION['fullname']){
 echo $_SESSION['fullname'] . ' son email est ' . $_SESSION['email'] . ' son id est ' . $_SESSION['type'] . ' est bien connecté <br />';
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
                $movie_id = $_POST['movie_id'];
                
                 //On va selectionner le tout ("*") dans le table users
                $dataform = $db->prepare('SELECT * FROM `users`');
                $dataCom = $db->prepare('SELECT * FROM `comments`');
            
                 //On va tout récupérer
                
                $dataCom->execute();
                $dataFetchCom = $dataCom->fetchAll();
  
                $dataform->execute();
                $dataFetch = $dataform->fetchAll();
                $id = $_POST["user_id"];
            
                $sqlQuery = 'INSERT INTO `comments`(user_id, fullname, email, comment, movie_id) VALUES (:user_id, :fullname, :email, :comment, :movie_id)';
                
                // Préparation
                $insertData = $db->prepare($sqlQuery);
  
                // Exécution, le message est maintenant dans la base de données
                $insertData->execute([
                    'user_id' => $user_id,
                    'fullname' => $fullname,
                    'email' => $email,
                    'comment' => $comment,
                    'movie_id' => $movie_id,
                ]);
      }}};
                    
  ?>
  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="commentStyle.css">
    <title>Tests commentaires</title>
</head>
<body>

    <form action="" method="POST">
    <input type="text" id="comment" name="comment" style="width: 450px; height: 200px">
    <!-- --------------- PHP PRENDRE L'ID DU FILM POUR LES COMMENTAIRES ----------------------- -->
    <input type="text" name="movie_id" id="moviesId" style="visibility:hidden">
    <button type="submit" id="submitComment" name="submit">Envoyer votre commentaire</button>
    </form>

            <table id="commentSection">
            <tr>
                    <th>Id</th>
                    <th>fullname</th>
                    <th>Email</th>
                    <th>Comment</th>
                    <th>Movie_id</th>
                    <?php if($_SESSION['type'] =='admin'){echo "<th>Editer</th>
                    <th>Supprimer</th>";
                    };?>
            </tr> 
            <?php //on va afficher ce qu'on veut qui provient de table users
            foreach ($dataFetchCom as $dataFetchCom) {
            if( $dataFetchCom["movie_id"] == $dataFetchCom["movie_id"]){?>
            <tr> 
            <td><?php echo $dataFetchCom['user_id']; ?></td>
            <td><?php echo $dataFetchCom['fullname']; ?></td>
            <td><?php echo $dataFetchCom['email']; ?></td>
            <td><?php echo $dataFetchCom['comment']; ?></td>
            <td><?php echo $dataFetchCom['movie_id']; ?></td>
            <?php if($_SESSION['type'] == 'admin'){echo
            '<td><a href="commentaires/updateCom.php?commentID=';?><?php echo $dataFetchCom["commentID"];?><?php echo'" name="edit"><img class="icons" src="asset/img/wrench.png" alt="clé à molette"></img></a></td>
            <td><a href="commentaires/deleteCom.php?commentID=';?><?php echo $dataFetchCom["commentID"];?><?php echo'" name="delete"><img class="icons" src="asset/img/cross.png" alt="croix"></img></a></td>';
        };?>

            </tr>

           <?php }
            ?>
            
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


</body>
</html>