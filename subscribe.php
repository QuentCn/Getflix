<?php

session_start();

$db = new PDO('mysql:host=database;
dbname=Getflix;
charset=utf8;',
    'root',
    'root');

    //Si les champs ne sont pas remplis il ne se passe rien !
    if(isset($_POST['subscribe'])){
        if(empty($_POST["fullname"]) 
        OR empty($_POST['password']) 
        OR empty($_POST["email"])){
        echo"Veuillez remplir tous les champs !";
        }}
        
    if(isset($_POST['subscribe'])){
         if(isset($_POST['subscribe'])){
            if(!empty($_POST["fullname"]) 
            AND !empty($_POST['password']) 
            AND !empty($_POST["email"])){

                $user_id = $_POST["user_id"];
                $fullname = htmlspecialchars($_POST["fullname"]); //htmlspecialchars permet d'empêcher un utilisateur malveillant d'envoyer du code via l'input
                $email = htmlspecialchars($_POST["email"]);
                $password = sha1($_POST["password"]); //sha1 permet l'encryptage du mot de passe
                
                 //On va selectionner le tout ("*") dans le table users
                $dataform = $db->prepare('SELECT * FROM subscribe_users');
            
                 //On va tout récupérer
                
                $dataform->execute();
                $dataFetch = $dataform->fetchAll();
                $id = $_POST["user_id"];
            
                $sqlQuery = 'INSERT INTO subscribe_users(fullname, email, password) VALUES (:fullname, :email, :password)';
                
                // Préparation
                $insertData = $db->prepare($sqlQuery);
                
                // Exécution, le message est maintenant dans la base de données
                $insertData->execute([
                    'fullname' => $fullname,
                    'email' => $email,
                    'password' => $password,
                ]);
        
                $_SESSION['fullname'] = $fullname;
                $_SESSION['password'] = $password;
                $_SESSION['email'] = $email;
                $_SESSION['user_id'] = $user_id;
                header('Location: login.php');
            }}}
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscribe</title>
</head>
<body>
    <form action="" method="POST">
        <div data-validate="A name is required">
            <input type="text" name="fullname" placeholder="Fullname" autocomplete="off">
        </div>
        <div data-validate="An email is required">
            <input type="text" name="email" placeholder="Email" autocomplete ="off">
        </div>
        <div data-validate="A password is required">    
            <input type="password" name="password" placeholder="Password" autocomplete ="off">
        </div>
            <button type="submit" name="subscribe">Subscribe here !</button>
    </form>
</body>
</html>