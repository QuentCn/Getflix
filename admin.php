<?php
session_start();
$db = new PDO('mysql:host=database;
dbname=Getflix;',
 'root',
  'root');
 if(!$_SESSION['administrateur']){
    header('Location: login.php');
    }?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Félicitations, vous êtes connecté.e !
    
    <?php 
        $takeUsers = $db -> query('SELECT * FROM subscribe_users');
        while($user = $takeUsers -> fetch()){?>
            <p><?php echo$user["fullname"]; ?> <a href=""></a></p>
       <?php }
    ?>

</body>
</html>