<?php

date_default_timezone_set('Europe/Paris');
// input for registering
$formLabel = [
    'username' => 'Entrez votre pseudo',
    'password' => 'Entrez votre mot de passe',
    'mail'=> 'Entrez votre adresse email'
];

$myForm = new Form($formLabel);

// connexion DATABASE
// $db = new Database();
   $db=new PDO(
        'mysql:host=db.3wa.io;port=3306;dbname=alexandrevallon_trucen+',
        'alexandrevallon',
        '7b8c9d64b18abb50302354af1ac4afd6'
        );

    // decalration of variables length for secure.
    $userLength='';
    $passLength='';
    $mailLength='';
    $wrongMail= '';
    
    if(isset($_POST['username']) && ($_POST['password']) && ($_POST['mail']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['mail'])){
        $username = htmlentities($_POST['username']);
        $password = htmlentities($_POST['password']);
        $mail = htmlentities($_POST['mail']);
        $reg_date = date("Y-m-d H:i:s");
      
        
        // secure password for database
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $queryMail= $db->prepare('SELECT * FROM users WHERE users.mail=:mail');
        $params=[
            'mail'=> $mail,
            ];
            
        $queryMail->execute($params); 
        
        $resultMail=$queryMail->fetch(PDO::FETCH_ASSOC);
        
        // secure the length inputs.
        
        if (strlen($username)>50){
          $userLength ='le nom d utilisateur est trop long';
        }
        
        if (strlen($passLength)>255){
            $passLength='le password contient trop de caractère';
        }
        
        if (strlen($mail)>50){
            $mailLength='le mail contient trop de caractère';
        }
        
            
        
        if(empty($userLength) && empty($passLength) && empty($mailLength)){
            // checking if the mail is on the database
           
            if($resultMail !== false){
                $wrongMail='email deja utiliser!';
            }else{
                $query = $db->prepare('INSERT INTO users (role_id,username, password, mail, reg_date) VALUES (:role_id,:username, :password, :mail, :reg_date)');
                $params = [
                    'role_id' => 2,
                    'username' => $username,
                    'password' => $password,
                    'mail' => $mail,
                    'reg_date' => $reg_date,
                    ];
                
                $query->execute($params);
                
                header('Location:index.php?page=connexion'); //plutot renvoyer sur la page de connexion
                }
            };
        }
?>