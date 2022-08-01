<?php
session_start();
include '../database.php';


$getData = $_GET;

  if(!isset($getData['commentID']) && is_numeric($getData['commentID'])){
    echo("Il faut un identifiant de recette afin d'utiliser la fonction éditer !");
    return;
  };

  $donnéesFormulaire = $db-> prepare('SELECT * FROM comments WHERE commentID=:commentID');
  $donnéesFormulaire -> execute([
    'commentID' => $getData['commentID'],
  ]);

$dataFetchCom = $donnéesFormulaire ->fetch(PDO::FETCH_ASSOC);

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
    <form action="postUpdateCom.php" method="POST">
      <div style="display:none;">Il manque des informations pour permettre des modifications.
        <label for="id" class="form-label">Identifiant de ligne de formulaire</label>
        <input type="text" class="form-control" id="id" name="commentID" value="<?php echo $dataFetchCom['commentID']; ?>">
      </div>
    <input type="text" name="comment" style="width: 450px; height: 200px" value="<?php echo $dataFetchCom['comment']; ?>">
    <button type="submit" name="submit">Envoyer votre commentaire</button>
    </form>

</body>
</html>
