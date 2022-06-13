<?php
// pas de declare(strict_types=1) il y aconflit avec session start.
// create a cookie session
session_start();
date_default_timezone_set('Europe/Paris');

// input mail pass
$formLabel = [
    'mail' => 'Entrer votre mail',
    'password' => 'Entrer votre mot de passe'
    ];

$myForm = new Form($formLabel);

// connexion DATABASE
$db = new Database();


//CLEAN
// $db = new PDO(
//         'mysql:host=db.3wa.io;port=3306;dbname=alexandrevallon_trucen+',
//         'alexandrevallon',
//         '7b8c9d64b18abb50302354af1ac4afd6');
    $mailLength='';
    $passLength='';
    $validationMail='';
    $connexion='';
    
    if(isset($_POST['mail']) && isset($_POST['password']) && !empty($_POST['mail']) && !empty($_POST['password'])){
        $mail=htmlentities($_POST['mail']);
        $pass=htmlentities($_POST['password']);
        
        $params=[
            'mail'=> $mail,
            ];
        // $queryLogin= $db->prepare('SELECT mail,password FROM users WHERE users.mail=:mail');
        // $params=[
        //     'mail'=> $mail,
        //     ];
        $resultLogin= $db->prepare('SELECT mail,password FROM users WHERE users.mail=:mail',$params, true);
            
        // $queryLogin->execute($params);
        
        // $resultLogin=$queryLogin->fetch(PDO::FETCH_ASSOC);
    
        if (strlen($mail)>50){
            $mailLength='le mail contient trop de caractère';
        }
        
        if (strlen($passLength)>255){
            $passLength='le password contient trop de caractère';
        }
        
        if( empty($mailLength) && empty($passLength)){
        
        // check mail is on database.
        if($resultLogin['mail'] == $mail){
            } else {
            $validationMail=('il y a une erreur');
            };
            
            
        // if the mail is ok, check the password is it's ok session is running
            if(password_verify($pass, $resultLogin['password'])){
                
                $_SESSION['mail'] = $mail;
                $_SESSION['password'] = $pass;
                
                header('Location:index.php');
                exit();
                
                //else wrong register, try again
            } else {
                $connexion = 'il  y a une erreur, veuillez réessayer';
                };
        };    
    }; 

