<?php //Je connecte mes pages au serveur
    include '../database.php';

    $movie_id = $_GET['movie_id'];
     header('Location: ../film.php?id='.$movie_id)?>

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