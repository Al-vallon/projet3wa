<?php 
session_start();
//test if the session is active or not
// var_dump($_SESSION['mail']);
// var_dump($_SESSION['password']);
session_destroy();
header('Location: index.php');
exit();
?>