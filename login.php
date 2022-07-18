<?php
session_start();

$db = new PDO('mysql:host=database;
dbname=Getflix;charset=utf8;',
 'root',
 'root');

if(isset($_POST['login'])){
    if(empty($_POST["fullname"]) 
    OR empty($_POST['password']))
    {
    echo"Veuillez remplir tous les champs !";
    }}

// se connecter à l'espace d'administration
// -----------------------------------------------------------------------------
if (isset($_POST['login'])){
    if(!empty($_POST["fullname"]) AND !empty($_POST['password'])){
        $pseudo = "admin";
        $password = "123";

        $pseudoWrote = htmlspecialchars($_POST['fullname']);
        $passwordWrote = htmlspecialchars($_POST['password']);
        if($pseudoWrote == $pseudo AND $passwordWrote == $password){
            $_SESSION['administrateur'] = $password;
            header('Location: admin.php');
         } 
    //else {
    //         echo "Votre pseudo ou mot de passe est incorrect.";
    //     }
    // } else {
    //     echo "Veuillez compléter tous champs avant de soumettre votre inscription.";
     };
}
// ---------------------------------------------------------------------------------
// fin de la connexion à l'espace admin


// Connexion du membre 

//On traduit le cryptage
$password = sha1($_POST["password"]);
$fullname = htmlspecialchars($_POST["fullname"]);

//On va chercher les données dans la database
$dataform = $db->prepare('SELECT * FROM subscribe_users WHERE fullname = ? AND password = ?');
        
$dataform->execute(array($fullname, $password));
//Si les conditions sont remplies la connexion se fait
 if(isset($_POST['login'])){
    if(!empty($_POST['fullname']) 
    AND !empty($_POST['password'])){
        
            if($dataform->rowCount() > 0){
                $_SESSION['fullname'] = $fullname;
                $_SESSION['password'] = $password;
                $_SESSION['user_id'] = $dataform->fetch()['user_id'];
                $_SESSION['email'] = $dataform->fetch()['email'];
                header('Location: index.php');
            } else {
                echo "Votre pseudo ou mot de passe est incorrect. ";
            }        
    }}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
    <div class="login">
        <form action="" method="POST">
            <h1>Identifiez-vous !</h1>
            <input class="input-name" type="text" name="fullname" placeholder="your name">
            <br>
            <input class="input-password" type="password" name="password" autocomplete="new-password" placeholder="password">
            <br>
            <button class="sign-in" type="submit" name="login">Sign in</button>
        </form>
    </div>
</body>
</html>