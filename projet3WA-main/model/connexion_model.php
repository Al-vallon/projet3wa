<?php
session_start();
// pas de declare(strict_types=1) il y aconflit avec session start.
// create a cookie session
date_default_timezone_set('Europe/Paris');

// input mail pass
$formLabel = [
    'mail' => 'Mail *',
    'password' => 'Password *'
    ];

$myForm = new Form($formLabel);

// connexion DATABASE
$db = new Database();

$mailLength='';
$passLength='';
$emptyMail='';
$emptyPass='';
$validationMail='';
$connexion='';

if(isset($_POST['mail']) && isset($_POST['password']) && !empty($_POST['mail']) && !empty($_POST['password'])){
    $mail=htmlentities($_POST['mail']);
    $pass=htmlentities($_POST['password']);
    
    $params=[
        'mail'=> $mail,
    ];
 
    $resultLogin= $db->prepare('
        SELECT mail,password, role_id 
        FROM users 
        WHERE users.mail=:mail',
        $params, true
    );
    
    //Check the size of input 
    if(strlen($mail)>50)
    {
        $mailLength='le mail contient trop de caractère';
    }
    
    if(strlen($passLength)>255)
    {
        $passLength='le password contient trop de caractère';
    }
    
    
    if(empty($mailLength) && empty($passLength)){
    
    // check mail is on database.
        if($resultLogin !==false){
         
        // if the mail is ok, check the password is it's ok for user's session is running 
            if(password_verify($pass, $resultLogin['password'])){
                $_SESSION['user'] = $mail . $pass; 
                $_SESSION['role'] = $resultLogin['role_id'];
                
                header('Location:index.php');
                exit();
                
                //else wrong register, try again
                } else {
                    $connexion = 'il  y a une erreur, veuillez réessayer';
                };
        }  else {
            $connexion = 'il  y a une erreur, veuillez réessayer';
        }  
    }
      
}; 