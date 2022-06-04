<?php
//cookie 
session_start();

require('class/Form.php');



// input mail pass
$formLabel = [
    'mail' => 'Entrer votre mail',
    'password' => 'Entrer votre mot de passe'
    ];

$myForm = new Form($formLabel);

// connexion DATABASE
$db = new PDO(
        'mysql:host=db.3wa.io;port=3306;dbname=alexandrevallon_trucen+',
        'alexandrevallon',
        '7b8c9d64b18abb50302354af1ac4afd6');


// check if the mail is inside the database


if(isset($_POST['mail'])){
    $mail=htmlentities($_POST['mail']);
    
    $queryMailLogin= $db->prepare('SELECT * FROM users WHERE users.mail=:mail');
    $params=[
        'mail'=> $mail,
        ];
        
    $queryMailLogin->execute($params);
    
    $resultMailLogin=$queryMailLogin->fetch(PDO::FETCH_ASSOC);
    
    
    if($resultMailLogin !== false){
        echo('Mail');
    
};

// check if the password is inside the database
$connection='';
if(isset($_POST['password'])){
    $pass=htmlentities($_POST['password']);
    
    $queryPass=$db->prepare('SELECT * FROM users WHERE users.password= :password');
    $params=[
        'password'=> $pass,
        ]; 
 
    $queryPass->execute($params);
    
    $resultPass=$queryPass->fetch(PDO::FETCH_ASSOC);
    
    if (password_verify($resultPass,$password)) {
        $connection = 'Vous êtes bien connecté';
        } else {
        $connection = 'Mauvais mot de passe...';
    }
  
};




// setcookie('username', htmlentities($_POST['username']), time() + 60*60*24*30);




?>