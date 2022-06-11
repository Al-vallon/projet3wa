<?php
date_default_timezone_set('Europe/Paris');
// name input 
$formLabel = [
    'name' => 'Entrez votre nom.',
    'mail' => 'Entrez votre mail de contact.',
    'objet' => 'Entrez un titre',
    'message' => 'Entrer votre message.'
];

$myForm = new Form($formLabel);

    $db = new PDO(
            'mysql:host=db.3wa.io;port=3306;dbname=alexandrevallon_trucen+',
            'alexandrevallon',
            '7b8c9d64b18abb50302354af1ac4afd6');
        
        
    $nameLength='';
    $mailLength='';
    $objetLength='';
    $msgLength='';
    $msgOk='';
    
    if(isset($_POST['name']) && ($_POST['mail']) && ($_POST['objet']) && ($_POST['message']) && !empty($_POST['name']) && !empty($_POST['mail']) && !empty($_POST['objet']) && !empty($_POST['message'])){
        $name = htmlentities($_POST['name']);
        $mail = htmlentities($_POST['mail']);
        $objet = htmlentities($_POST['objet']);
        $message = htmlentities($_POST['message']);
        $date = date("Y-m-d H:i:s");
      
      
        // secure the length inputs.
         if(strlen($objet)>255){
            $objetLength ='le titre contient trop de caractères';
        }
        
        if(strlen($message)>1000){
            $msgLength = 'Le message contient plus de 1000 caractères';
        } 
        
        if(strlen($mail)>50){
            $mailLength = 'le mail contient trop de caractères';
        }
        
        if (strlen($name)>50){
          $nameLength ='le nom est trop long'; 
        }
         

        if(empty($nameLength) && empty($mailLength) && empty($objetLength) && empty($msgLength)){
                $query = $db->prepare('INSERT INTO msgcontact (objet, message, mail, date, name) VALUES (:objet,:message, :mail, :date, :name)');
                $params = [
                    'objet' => $objet,
                    'message' => $message,
                    'mail' => $mail,
                    'date' => $date,
                    'name' => $name,
                    ];
                
                $query->execute($params);
        
            // header('Location:index.php?page=home');
      
        };
        
    };

?>