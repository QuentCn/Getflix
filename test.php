<?php 
session_start();
$db = new PDO('mysql:host=sql11.freesqldatabase.com;
dbname=sql11507471;charset=utf8;',
 'sql11507471',
 'At17mKASTq');

echo $_SESSION['email'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>