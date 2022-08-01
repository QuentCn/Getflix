<?php 
session_start();

include 'database.php';

echo $_SESSION['user_id'];
?>