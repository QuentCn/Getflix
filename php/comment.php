<?php  // -------------------------------- PHP UNSERTION COMMENTAIRE ---------------------------

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
            $movie_id = $moviesId;
            
             //On va selectionner le tout ("*") dans le table users
            $dataform = $db->prepare('SELECT * FROM `users`');
            $dataCom = $db->prepare('SELECT * FROM `comments`');
        
             //On va tout récupérer dans la base de données des deux tables
            $dataCom->execute();
            $dataFetchCom = $dataCom->fetchAll();

            $dataform->execute();
            $dataFetch = $dataform->fetchAll();
            $id = $_POST["user_id"];
        
            $sqlQuery = 'INSERT INTO `comments`(user_id, fullname, email, comment, movie_id, date) VALUES (:user_id, :fullname, :email, :comment, :movie_id, NOW())';
            
            // Préparation
            $insertData = $db->prepare($sqlQuery);

            // Exécution, le message est maintenant dans la base de données
            $insertData->execute([
                'user_id' => $user_id,
                'fullname' => $fullname,
                'email' => $email,
                'comment' => $comment,
                'movie_id' => $movie_id,
            ]); echo "<meta http-equiv='refresh' content='0'>"; // actualise la page pour que le nouveau commentaire apparaisse directement sans avoir à actualiser la page manuellement
  }}}; 


?>