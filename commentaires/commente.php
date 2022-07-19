<?php
session_start();
$db = new PDO('mysql:host=sql11.freesqldatabase.com;
dbname=sql11507471;charset=utf8;',
 'sql11507471',
 'At17mKASTq');

if($_SESSION['fullname']){
 echo $_SESSION['fullname'] . ' son email est ' . $_SESSION['email'] . ' son id est ' . $_SESSION['user_id'] . ' est bien connecté';
}

// -------------------------------- INSERTION DU COMMENTAIRE ---------------------------

//CONDITION

    //Si les champs ne sont pas remplis il ne se passe rien !
    if(isset($_POST['submit'])){
      if(empty($_POST["comment"])){
      echo"Veuillez remplir tous les champs !";
      }}
      
  if(isset($_POST['submit'])){
       if(isset($_POST['submit'])){
          if(!empty($_POST["comment"])) {
              $user_id = $_SESSION["user_id"];
              $fullname = htmlspecialchars($_SESSION["fullname"]); //htmlspecialchars permet d'empêcher un utilisateur malveillant d'envoyer du code via l'input
              $email = htmlspecialchars($_SESSION["email"]);
              $comment = $_POST['comment'];
              
               //On va selectionner le tout ("*") dans le table users
              $dataform = $db->prepare('SELECT * FROM users');
              $dataCom = $db->prepare('SELECT * FROM comments');
          
               //On va tout récupérer
              
              $dataCom->execute();
              $dataFetchCom = $dataCom->fetchAll();

              $dataform->execute();
              $dataFetch = $dataform->fetchAll();
              $id = $_POST["user_id"];
          
              $sqlQuery = 'INSERT INTO comments(user_id, fullname, email, comment) VALUES (:user_id, :fullname, :email, :comment)';
              
              // Préparation
              $insertData = $db->prepare($sqlQuery);

              // Exécution, le message est maintenant dans la base de données
              $insertData->execute([
                  'user_id' => $user_id,
                  'fullname' => $fullname,
                  'email' => $email,
                  'comment' => $comment,
              ]);
                  }}}
      ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tests commentaires</title>
</head>
<body>
    <form action="" method="POST">
    <input type="text" name="comment" style="width: 450px; height: 200px">
    <button type="submit" name="submit">Envoyer votre commentaire</button>
    </form>


</body>
</html>