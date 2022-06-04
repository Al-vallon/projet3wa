<?php
// declaration classes
// require('class/PDO.php');
require('class/Form.php');

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

//

if(isset($_POST['username']) && ($_POST['password']) && ($_POST['mail'])){
    $username = htmlentities($_POST['username']);
    $password = htmlentities($_POST['password']);
    $mail = htmlentities($_POST['mail']);
    $reg_date = date("Y-m-d H:i:s");
    
   
    $queryMail= $db->prepare('SELECT * FROM users WHERE users.mail=:mail');
    $params=[
        'mail'=> $mail,
        ];
        
    $queryMail->execute($params);
    
    $resultMail=$queryMail->fetch(PDO::FETCH_ASSOC);
    
    
    if($resultMail !== false){
        echo('email deja utiliser!');
    }else{
        
    $query = $db->prepare('INSERT INTO users (role_id,username, password, mail, reg_date) VALUES (:role_id,:username, :password, :mail, :reg_date)');
    $params = [
     'role_id' => 2,
     'username' => $username,
     'password' => $password,
     'mail' => $mail,
     'reg_date' => $reg_date,
    ];
    
    $msgLogin='';
    $password=hash('md5','test');
    if(isset($_POST['password'])){
        $_SESSION['password'] = htmlentities($_POST['password'])
            if($password === hash('md5', htmlentities($_POST['password'])){
                $msgLogin='vous etes connecter';
            }else {
                $msgLogin='Mot de passe incorrect';
            };
                    
        };
    };
    
    $query->execute($params);
    
};



?>
