
<?php 
session_destroy();
header('Location: index.php');
exit();
var_dump($_SESSION['login']);
?>