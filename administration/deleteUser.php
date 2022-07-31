<?php //Je connecte mes pages au serveur
    $db = new PDO('mysql:host=sql11.freesqldatabase.com;
    dbname=sql11507471;charset=utf8;',
     'sql11507471',
     'At17mKASTq');

          header('Location: admin.php')?>

<?php //On va selectionner le tout ("*") dans le table users
$donnéesFormulaire = $db->prepare('SELECT * FROM users WHERE user_id');?>

<?php //On va tout récupérer
$donnéesFormulaire->execute();
$donnéesFetch = $donnéesFormulaire->fetchAll();?>

<?php
$user_id = $_GET['user_id'];
$sqlQuery ='DELETE FROM users WHERE user_id=:user_id';

$delete = $db -> prepare($sqlQuery);
$delete->execute([
    'user_id' => $user_id,
]); ?>