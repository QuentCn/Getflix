<?php //Je connecte mes pages au serveur
    include '../database.php';


          header('Location: home.php')?>

<?php //On va selectionner le tout ("*") dans le table users
$donnéesFormulaire = $db->prepare('SELECT * FROM comments WHERE commentID');?>

<?php //On va tout récupérer
$donnéesFormulaire->execute();
$donnéesFetch = $donnéesFormulaire->fetchAll();?>

<?php
$commentID = $_GET['commentID'];
$sqlQuery ='DELETE FROM comments WHERE commentID=:commentID';

$delete = $db -> prepare($sqlQuery);
$delete->execute([
    'commentID' => $commentID,
]); ?>