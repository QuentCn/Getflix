<?php session_start();
$db = new PDO('mysql:host=sql11.freesqldatabase.com;
dbname=sql11507471;charset=utf8;',
 'sql11507471',
 'At17mKASTq');

$getUser = $db->query('SELECT * FROM users ORDER BY user_id DESC');
               
if(isset($_GET['keyword']) AND !empty($_GET['keyword'])){
    $search = htmlspecialchars($_GET['keyword']);
    $getUser = $db->query('SELECT fullname FROM users WHERE fullname LIKE "%'.$search.'%" ORDER BY user_id DESC');
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="research.css">
    <title>research result</title>
</head>
<body>
        
    <form id="form-search" method="GET">
        <input class="input-search" type="text" name="keyword" placeholder="Search">
    </form>

    <?php 
        if($getUser->rowCount() > 0){
            while($user = $getUser->fetch()){
                ?>        
                <br><br><br>
                <table>
                    <tr>
                        <th>Affiche</th>
                        <th>Nom du film</th>
                        <th>Année de sortie</th>
                        <th>Description</th>
                    </tr>
                    <tr>
                        <td><?php echo $user['fullname']; ?></td>
                        <td>exemple(pareil avec une description par exemple)</td>
                    </tr>
                </table>

                <?php
            }} else {
                echo"Votre requête ne peut malheureusement pas aboutir à un résultat concluant.";
            }
?>

</body>
</html>