<?php 
session_start();

//test if the session is active or not
// var_dump($_SESSION['user']);
// var_dump($_SESSION['role']);

session_destroy();
header('Location: index.php');
exit();
?>