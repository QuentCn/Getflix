<?php
	$db = new PDO('mysql:host=database;
    dbname=stockage_formulaire_restaurant;charset=utf8',
     'root',
     'root');

$postData = $_POST;

if (
    !isset($postData['user_id'])
    || !isset($postData['firstname'])
    || !isset($postData['texte'])
    ){
        echo('Il manque des informations pour permettre des modifications.');
        return;
    }

$user_id = $postData['user_id'];
$firstname = $postData['firstname'];
$lastname = $postData['lastname'];
$email = $postData['email'];
$message = $postData['texte'];

$editForm = $db -> prepare ('UPDATE users SET firstname =:firstname, lastname =:lastname,
email=:email, message=:message WHERE user_id=:user_id');
$editForm -> execute([
    'firstname' => $firstname,
    'lastname' => $lastname,
    'email' => $email,
    'message' => $message,
    'user_id' => $user_id,
]);

header('Location: index.php')

?>