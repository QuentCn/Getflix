<?php
//On démarre la session et connecte la base de données
session_start();

 try
 { 
    //----------------- SI NOUVEAU PROBLEME, CHECKER ICI --------------------
    $options =
    [
        PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8',
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $db = new PDO('mysql:host=sql11.freesqldatabase.com;
    dbname=sql11511483;charset=utf8;',
    'sql11511483',
    'wsyzeTJra8',
    $options);

// ----------------------- CODE PHP POUR LOGIN ------------------------
// condition de connexion

if($_SESSION['fullname']){
    header('Location: home.php');
}

    // ------------- MIS EN COMMENTAIRE CAR CETTE FONCTIONNALITE A ETE AMELIOREE --------

// if(isset($_POST['login'])){
//     if(empty($_POST["loginName"]) 
//     OR empty($_POST['loginPassword']))
//     {
//     echo"Veuillez remplir tous les champs !";
//     }}




    // ------------- MIS EN COMMENTAIRE CAR CETTE FONCTIONNALITE A ETE AMELIOREE --------
// se connecter à l'espace d'administration
// if (isset($_POST['login'])){
//     if(!empty($_POST["loginName"]) AND !empty($_POST['loginPassword'])){
//         $pseudo = "admin";
//         $password = "123";

//         $pseudoWrote = htmlspecialchars($_POST['loginName']);
//         $passwordWrote = htmlspecialchars($_POST['loginPassword']);
//         if($pseudoWrote == $pseudo AND $passwordWrote == $password){
//             $_SESSION['administrateur'] = $password;
//             header('Location: administration/admin.php');
//          } 
//      };
// }
// fin de la connexion à l'espace admin
// ------------------------------------------------------------------------------------------

// Connexion du membre 
//On traduit le cryptage
$password = sha1($_POST["loginPassword"]);
$fullname = htmlspecialchars($_POST["loginName"]);

//On va chercher les données dans la database
$dataform = $db->prepare('SELECT * FROM users WHERE fullname = ? AND password = ?');
$dataEmail = $db->prepare('SELECT `email` FROM users WHERE fullname = ?');
$dataId = $db->prepare('SELECT `user_id` FROM users WHERE fullname = ?');
$dataType = $db->prepare('SELECT `type` FROM users WHERE type = ?');
        
$dataform->execute(array($fullname, $password));
$dataEmail->execute(array($fullname));
$dataId->execute(array($fullname));
$dataType->execute(array($fullname));

//Si les conditions sont remplies la connexion se fait
 if(isset($_POST['login'])){
    if(!empty($_POST['loginName']) 
    AND !empty($_POST['loginPassword'])){
        
            if($dataform->rowCount() > 0){
                $_SESSION['type'] = $dataType->fetch()['type'];
                $_SESSION['fullname'] = $fullname;
                $_SESSION['password'] = $password;
                $_SESSION['user_id'] = $dataId->fetch()['user_id'];
                $_SESSION['email'] = $dataEmail->fetch()['email'];
                header('Location: home.php');
            } else {
                echo "Votre pseudo ou mot de passe est incorrect. ";
            }        
    }}

// ----------------------------- CODE PHP POUR INSCRIPTION ----------------------- 

    if(isset($_POST['subscribe'])){
        if(empty($_POST["fullname"]) 
        OR empty($_POST['password']) 
        OR empty($_POST["email"])
        OR empty($_POST["typeOfAccount"])
        OR empty($_POST['confirmPassword'])){
            
        echo"Veuillez remplir tous les champs !";
        }}

    if(isset($_POST['subscribe'])){
        if($_POST['password'] != $_POST['confirmPassword']){
        echo"Veuillez faire correspondre vos deux mots de passe.";
    }}
        
    if(isset($_POST['subscribe'])){
         if(isset($_POST['subscribe'])){
            if(!empty($_POST["fullname"]) 
            AND !empty($_POST['password'])
            AND !empty($_POST['confirmPassword']) 
            AND !empty($_POST["email"])
            AND !empty($_POST["typeOfAccount"])
            AND $_POST['password'] == $_POST['confirmPassword']){

                $user_id = $_POST["user_id"];
                $fullname = htmlspecialchars($_POST["fullname"]); //htmlspecialchars permet d'empêcher un utilisateur malveillant d'envoyer du code via l'input
                $email = htmlspecialchars($_POST["email"]);
                $password = sha1($_POST["password"]); //sha1 permet l'encryptage du mot de passe
                $typeOfAccount = $_POST["typeOfAccount"];
                
                 //On va selectionner le tout ("*") dans le table users
                $dataform = $db->prepare('SELECT * FROM users');
            
                 //On va tout récupérer
                
                $dataform->execute();
                $dataFetch = $dataform->fetchAll();
                $id = $_POST["user_id"];
            
                $sqlQuery = 'INSERT INTO users(type, fullname, email, password) VALUES (:type, :fullname, :email, :password)';
                
                // Préparation
                $insertData = $db->prepare($sqlQuery);
                
                // Exécution, le message est maintenant dans la base de données
                $insertData->execute([
                    'type' => $typeOfAccount,
                    'fullname' => $fullname,
                    'email' => $email,
                    'password' => $password,
                ]);
        // J'ai mis cette partie en commentaire car bug au niveau de l'id, pas le temps de modifier ça pour l'instant
                // $_SESSION['type'] = $typeOfAccount;
                // $_SESSION['fullname'] = $fullname;
                // $_SESSION['password'] = $password;
                // $_SESSION['email'] = $email;
                // $_SESSION['user_id'] = $user_id;
                echo'Félicitation ! Vous êtes désormais inscrit !';
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
    <script src="https://kit.fontawesome.com/da64da315b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="asset/css/landing.css">
    <title>Getflix - Watch TV Shows Online, Watch Movies Online</title>
</head>
<body>
 <header class="showcase">
     <div class="showcase-top">
        <img src="./asset/img/getflix2.png" alt="Logo Getflix">
<!-- -------------------------------------- BOUTON SIGN IN --------------------------------------- -->
        <a id="open" class="btn btn-rounded">Sign in</a>
     </div>
     <div class="showcase-content">
         <h1>See what's next</h1>
         <p>Watch anywhere | Cancel anytime</p>
         <a id="watchFree" class="btn btn-xl">
             Watch Free For 30 Days <i class="fas fa-chevron-right btn-icon"></i>
         </a>
     </div>
 </header> 
 <!-- second section -->
 <section class="tabs">
     <div class="container">
         <div id="tab-1" class="tab-item tab-border">
             <i class="fas fa-door-open fa-3x"></i>
             <p class="hide-sm">Cancel anytime</p>
         </div>

         <div id="tab-2" class="tab-item">
             <i class="fas fa-tablet-alt fa-3x"></i>
             <p class="hide-sm">Watch anywhere</p>
         </div>

         <div id="tab-3" class="tab-item">
             <i class="fas fa-tags fa-3x"></i>
             <p class="hide-sm">Pick your price now</p>
         </div>

     </div>
 </section>
 <!-- third section -->
 <section class="tab-content">
    <div class="container">
        <!--tab content 1-->
        <div id="tab-1-content" class="tab-content-item show">
            <div class="tab-1-content-inner">
                <div>
                    <p class="text-lg">
                        If you decide Getflix isn't for you - no problem. No commitment.
                        Cancel online anytime by contacting us.
                    </p>
                    <!-- <a href="#" class="btn btn-lg">Watch Free For 30 Days</a> -->
                </div>
                <img src="./asset/img/landingpage1.png" alt="">
            </div>
        </div>

        <!--tab content 2-->

        <div id="tab-2-content" class="tab-content-item">
            <div class="tab-2-content-top">
                <p class="text-lg">Watch TV shows and movies anytime, anywhere - personalized for you.</p>
                <!-- <a href="#" class="btn btn-lg">Watch Free For 30 Days</a> -->
            </div>
        
            
            <div class="tab-2-content-bottom">
                <div>
                    <img src="./asset/img/landingpage2.png" alt=""/>
                    <p class="text-md">Watch on your TV</p>
                    <p class="text-dark">Smart TVs, PlayStation, Xbox, Chromecast, Apple TV, Blu-ray, PlayStation and more.</p>  
                </div>

                <div>
                    <img src="./asset/img/landingpage3.png" alt=""/>
                    <p class="text-md">Watch instantly</p>
                    <p class="tex-dark">Available on phone and tablet, wherever you go.</p>  
                </div>

                <div>
                    <img src="./asset/img/landingpage4.png" alt=""/>
                    <p class="text-md">Use any computer</p>
                    <p class="tex-dark">Watch right on getflix.com</p>  
                </div>
            </div>
        </div>

        <!--tab 3 ceontent -->
        <div id="tab-3-content" class="tab-content-item">
            <div class="text-center">
                <p class="text-lg">Choose one plan and watch everything on Getflix</p>
                <!-- <a href="#" class="btn btn-lg">Watch Free For 30 days</a> -->
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Free</th>
                        <th>Premium</th>
                    </tr>
                </thead>
                <tbody>
                   <td>Monthly price</td> 
                   <td>Free</td>
                   <td>Free again... yeah, don't ask why...</td>
                   </tr>
                   <tr>
                       <td>HD Available</td>
                       <td><i class= "fas fa-check"></i></td>
                       <td><i class= "fas fa-check"></i></td>
                    </tr>
                    <tr>
                       <td>Watch on your laptop, TV, phone and tablet</td>
                       <td><i class= "fas fa-check"></i></td>
                       <td><i class= "fas fa-check"></i></td>
                    </tr>
                    <tr>
                       <td>Able to view comments</td>
                       <td><i class= "fas fa-check"></i></td>
                       <td><i class= "fas fa-check"></i></td>
                    </tr>
                    <tr>
                       <td>Able to post comments</td>
                       <td><i class= "fas fa-times"></i></td>
                       <td><i class= "fas fa-check"></i></td>
                    </tr>
                    <tr>
                       <td>First month free</td>
                       <td><i class= "fas fa-check"></i></td>
                       <td><i class= "fas fa-check"></i></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
 </section>

 <!-- --------------------------- LOGIN & INSCRIPTION ------------------------ -->

<div class="modal" id="modal">
    <div class="containerLogin">
        <div class="container-onglets">
        <button data-close-button class="close-button"></button>
            <div class="onglets logTabButton" data-anim="1">Login</div>
            <div class="onglets subTabButton" data-anim="2">Sign up</div>
        </div>
            <!-- -------- Formulaire de login -------- -->
        <div class="contenu contenuLog" data-anim="1">
        <form action="" method="POST">
            <input id="logName" class="input-name logField" type="text" name="loginName" placeholder="Username" required><span class="errorLog"></span>
            <br>
            <input id="logPassword" class="input-password logField" type="password" name="loginPassword" autocomplete="new-password" placeholder="Password" required><span class="errorLog"></span>
            <br>
            <button id="loginButton" class="sign-in logField" type="submit" name="login" cursor="pointer">Login</button>
        </form>
    </div>

        <!-- --------- Formulaire d'inscription -------- -->
    <div class="contenu contenuSub" data-anim="2">
        <form action="" method="POST" id="subForm">
                <input id="subName" class="subField" type="text" name="fullname" placeholder="Username" autocomplete="off" required><span id="errorNameSub" class="hideError"></span> 
                <input id="subEmail" class="subField" type="email" name="email" placeholder="Email" autocomplete ="off" required><span id="errorEmailSub" class="hideError"></span>

                <br>
                <input id="subPassword" class="subField" type="password" name="password" placeholder="Password" autocomplete="new-password" required><span id="errorPasswordSub" class="hideError"></span>
                <input id="subConfirmPassword" class="subField" type="password" name="confirmPassword" placeholder="Confirm password" autocomplete="new-password" required><span id="errorPasswordSub" class="hideError"></span>

            <div>
                <select required id="typeOfAccount" class="subFieldAccountType" name="typeOfAccount">
                    <option required value="">Type of account</option>
                    <option required id="optionFree" value="free">Free</option>
                    <option required value="premium">Premium</option>
                    <option required value="admin">Administrator</option>
                </select>
            </div><span id="errorAccountType" class="hideError"></span>

            <button id="subscribeButton" class="subField" type="submit" name="subscribe">Sign up</button>
        </form>
    </div>

</div>
</div>
<div id="overlay"></div>

<!-- ------------------------------------ FOOTER ------------------------------- -->

 <footer class="footer">
    <div class="footer-cols">
        <ul>
            <li><a href="#">FAQ</a></li> |
        <!-- </ul>
        <ul> -->
            <li><a href="#">Contact Us</a></li> |
        <!-- </ul>
        <ul> -->
            <li><a href="#">Buy Gift Cards</a></li>        
        </ul>

    </div>
 </footer>

 <script src="asset/js/landing.js"></script>
 <script src="asset/js/login.js"></script>
</body>
</html> 