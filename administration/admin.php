<?php
session_start();
$db = new PDO('mysql:host=sql11.freesqldatabase.com;
dbname=sql11507471;charset=utf8;',
 'sql11507471',
 'At17mKASTq');
 if(!$_SESSION['administrateur']){
    header('Location: ../index.php');
    }?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminStyle.css">
    <title>Administration</title>
</head>
<body>
    <div class="header"></div>

   <h1>Bienvenue dans le panneau d'administration </h1>

<?php 

//----------------------------------------------- PHP CODE -----------------------

$fullname = $_POST["fullname"];
$email = $_POST["email"];

//On va selectionner le tout ("*") dans le table users
$donnéesFormulaire = $db->prepare('SELECT * FROM users');

//On va tout récupérer
$donnéesFormulaire->execute();
$donnéesFetch = $donnéesFormulaire->fetchAll();
$id = $_POST["user_id"];

// On initialise l'insertion depuis notre base de données
$sqlQuery = 'INSERT INTO users(fullname, email) VALUES (:fullname, :email)';

// Préparation
$insertText = $db->prepare($sqlQuery);

// Exécution, le message est maintenant dans la base de données
$insertText->execute([
    'fullname' => $fullname,
    'email' => $email,
]);
?>


<table>
<tr>
        <th>Id</th>
        <th>fullname</th>
        <th>Email</th>
        <!-- <th>Editer</th> -->
        <th>Supprimer</th>
  </tr>     
<?php //on va afficher ce qu'on veut qui provient de table users
foreach ($donnéesFetch as $donnéesFetch) {
?>
  <tr> 
<td><?php echo $donnéesFetch['user_id']; ?></td>
<td><?php echo $donnéesFetch['fullname']; ?></td>
<td><?php echo $donnéesFetch['email']; ?></td>
<!-- <td><a href="update.php?user_id=<?php// echo $donnéesFetch['user_id']?>" name="edit">Editer</a></td> -->
<td><a href="deleteUser.php?user_id=<?php echo $donnéesFetch['user_id']?>" name="delete"><img class="icon" src="../asset/img/cross.png" alt="croix"></img></a></td>
</tr>

<?php
}?>
</table>

</body>
</html>