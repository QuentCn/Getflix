<?php
session_start();

include '../database.php';

$postData = $_POST;

$movie_id = $_POST['movie_id'];

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

 header('Location: ../film.php?id='.$movie_id);

?>