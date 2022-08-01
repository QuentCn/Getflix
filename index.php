<?php
//On démarre la session et connecte la base de données
session_start();

 try
 { 
    //SI NOUVEAU PROBLEME INCONNU, CHECKER ICI --------------------
    $options =
    [
        PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $db = new PDO('mysql:host=sql11.freesqldatabase.com;
    dbname=sql11510091;charset=utf8;',
    'sql11510091',
    'BIHR2vUXNA',
    $options);

// ----------------------- CODE PHP POUR LOGIN ------------------------
// condition de connexion

if($_SESSION['fullname']){
    header('Location: home.php');
}

if(isset($_POST['login'])){
    if(empty($_POST["loginName"]) 
    OR empty($_POST['loginPassword']))
    {
    echo"Veuillez remplir tous les champs !";
    }}

// se connecter à l'espace d'administration
if (isset($_POST['login'])){
    if(!empty($_POST["loginName"]) AND !empty($_POST['loginPassword'])){
        $pseudo = "admin";
        $password = "123";

        $pseudoWrote = htmlspecialchars($_POST['loginName']);
        $passwordWrote = htmlspecialchars($_POST['loginPassword']);
        if($pseudoWrote == $pseudo AND $passwordWrote == $password){
            $_SESSION['administrateur'] = $password;
            header('Location: administration/admin.php');
         } 
     };
}
// fin de la connexion à l'espace admin


// Connexion du membre 
//On traduit le cryptage
$password = sha1($_POST["loginPassword"]);
$fullname = htmlspecialchars($_POST["loginName"]);

//On va chercher les données dans la database
$dataform = $db->prepare('SELECT * FROM users WHERE fullname = ? AND password = ?');
$dataEmail = $db->prepare('SELECT `email` FROM users WHERE fullname = ?');
$dataId = $db->prepare('SELECT `user_id` FROM users WHERE fullname = ?');
        
$dataform->execute(array($fullname, $password));
$dataEmail->execute(array($fullname));
$dataId->execute(array($fullname));
//Si les conditions sont remplies la connexion se fait
 if(isset($_POST['login'])){
    if(!empty($_POST['loginName']) 
    AND !empty($_POST['loginPassword'])){
        
            if($dataform->rowCount() > 0){
                $_SESSION['fullname'] = $fullname;
                $_SESSION['password'] = $password;
                $_SESSION['user_id'] = $dataId->fetch()['user_id'];
                $_SESSION['email'] = $dataEmail->fetch()['email'];
                header('Location: index.php');
            } else {
                echo "Votre pseudo ou mot de passe est incorrect. ";
            }        
    }}

// ----------------------------- CODE PHP POUR INSCRIPTION ----------------------- 

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
                $dataform = $db->prepare('SELECT * FROM users');
            
                 //On va tout récupérer
                
                $dataform->execute();
                $dataFetch = $dataform->fetchAll();
                $id = $_POST["user_id"];
            
                $sqlQuery = 'INSERT INTO users(fullname, email, password) VALUES (:fullname, :email, :password)';
                
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

        }

        catch(PDOException $pe){
            echo 'ERREUR : '.$pe->getMessage();
         }
        ?>

<!-- ------------------------------  HTML  --------------------------------- -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="ongletStyle.css">
    <title>Document</title>
</head>
<body>
    <div class="container">

        <div class="container-onglets">
            <div class="onglets active" data-anim="1">Login</div>
            <div class="onglets" data-anim="2">Inscription</div>
        </div>
            <!--Formulaire de login-->
        <div class="contenu activateContenu" data-anim="1">
        <form action="" method="POST">
            <input class="input-name" type="text" name="loginName" placeholder="your name">
            <br>
            <input class="input-password" type="password" name="loginPassword" autocomplete="new-password" placeholder="password">
            <br>
            <button class="sign-in" type="submit" name="login">Sign in</button>
        </form>
        </div>

            <!--Formulaire d'inscription-->
        <div class="contenu desactivateContenu" data-anim="2">
        <form action="" method="POST">
            <div data-validate="A name is required">
                <input type="text" name="fullname" placeholder="Fullname" autocomplete="off">
            </div>
            <div data-validate="An email is required">
                <input type="text" name="email" placeholder="Email" autocomplete ="off">
            </div>
            <div data-validate="A password is required">    
                <input type="password" name="password" placeholder="Password" autocomplete="new-password">
            </div>
            <button type="submit" name="subscribe">Subscribe here !</button>
    </form>
        </div>

    </div>

    <script src="ongletJS.js"></script>
</body>
</html>