<?php
session_start();
$db = new PDO('mysql:host=sql11.freesqldatabase.com;
dbname=sql11507471;charset=utf8;',
'sql11507471',
'At17mKASTq');

$postData = $_POST;

if (
    // !isset($postData['user_id'])
     !isset($postData['commentID'])
     || !isset($postData['comment'])
    ){
        echo('Il manque des informations pour permettre des modifications.');
        return;
    }

$user_id = $_SESSION['user_id'];
$fullname = $_SESSION['fullname'];
$email = $_SESSION['email'];
$comment = $postData['comment'];
$commentID = $postData['commentID'];

$editForm = $db -> prepare ('UPDATE comments SET fullname =:fullname, email=:email, 
comment=:comment, user_id=:user_id WHERE commentID=:commentID');
$editForm -> execute([
    'fullname' => $fullname,
    'email' => $email,
    'comment' => $comment,
    'user_id' => $user_id,
    'commentID' => $commentID
]);

header('Location: commente.php')

?>