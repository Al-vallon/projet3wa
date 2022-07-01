<?php
session_start();
// declare(strict_types=1); don't work with session_start 
// session_start();
date_default_timezone_set('Europe/Paris');

$articleLabel = [
     'title' => 'Définir un titre.',
     'text' => 'Contenu de votre texte.',
     'image' => 'image.',
    ];

$message='';
$textLength='';
$listTitle = [];
$listTextMod = [];
$titleForEdit =[];
$articleForEdit = [];
$validFile = false;
$listUsers=[];
$delNickname='';
$delMail='';

// declare new Form
$Article = new Form ($articleLabel);
// declare new DB
$db = new Database();



// *************************************
// *
// *//CREATION ARTICLE
// *
// *************************************
if(isset($_SESSION['role']) && strval($_SESSION['role']=== '1')){

    if(isset($_GET['addarticle'])){
    
    // upload pictures.
        $nameOfInputUpload = "image";
        $isPost = $_SERVER['REQUEST_METHOD'] === "POST";
        $myImage = isset($_FILES[$nameOfInputUpload]) ? $_FILES[$nameOfInputUpload] : null;
        
        
        // si il y a un fichier qui a été envoyé sans erreur et qu'il a le name image
        if(isset($myImage) && $myImage['error'] == 0){
            // si l'image ne depasse pas les 3mo
            if($myImage['size'] <= 3000000 ){
                $informationImage = pathinfo($myImage['name']);
                $extensionImage = $informationImage['extension'];
                $extensionArray = ['jpg','gif','png','jpeg'];
                // si l'extension de l'image est dans le tableau $extensionArray
                    if(in_array($extensionImage, $extensionArray)){
                        $validFile = true;
                        // on lui dit ou deplacer l'image et on la nomme
                        $nameOfImg = time().rand().'.'.$extensionImage;
                        $urlImage  = './vendor/images/upload/'.$nameOfImg;
                        // on déplace l'image dans le dossier Upload
                        move_uploaded_file($myImage['tmp_name'],$urlImage );
                        $message = "Votre image est prise en compte ! " ;
                        setcookie('img', $nameOfImg, time() + 60*60*24*30);
                    } else {
                        $message = " Votre fichier n'est pas de type jpeg jpg gif ou png !";
                    }
                } else {
                    $message = " Votre image depasse les 3mo !";
                }
    }
    
    
    // check length of inputs for secure
    
    if(isset($_POST['title']) && isset($_POST['text']) && !empty($_POST['title']) && !empty($_POST['text'])){
        
        $title = htmlentities($_POST['title']);
        $text = htmlentities($_POST['text']);
        $date = date ("Y-m-d H:i:s");
        
        //secure length of input
        if(strlen($title)>255 && strlen($text)>5000) 
        {
            $textLength ='le champs contient trop de caractères';
        }
    
    //insert data for articles
    
            if(empty($textLength))
            {
                $params = [
                    'title' => $title,
                    'text' => $text,
                    'picture_name' => $_COOKIE['img'],
                    'alt' => $title,
                    'date' => $date,
                ];
                $query = $db->prepare('
                    INSERT INTO article 
                    (titre, text, picture_name, alt, date) 
                    VALUES 
                    (:title,:text, :picture_name, :alt, :date)',
                    $params, true
                );
                setcookie('img', 'bye', time() -10);
            }
        }
    }
    
    // *************************************
    // *
    // *//MODIFICATION ARTICLE
    // *
    // *************************************
    
    
    if(isset($_GET['change']))
        {
            if(isset($_POST['id']) && !empty($_POST['id']))
            {
            
                setcookie('id',$_POST['id'], time()+ 60*60*24*30);
            }
            
            //list of titles to stock TITLE OF ARTICLE:
            
            $params = [];
            $listTitle = $db->prepare('
                SELECT id, titre FROM article 
                ORDER BY 
                article.id DESC',
                $params, false
            );
        
                //foreach to remplace id by title in array
        
            foreach ($listTitle as $titre)
            {
                $titleForEdit[$titre['id']] = $titre['titre'];
            }
            
        
            //list of titles to stock TEXT OF ARTICLE:
        
            $params = [];
            
            $listTextMod = $db->prepare('
                SELECT id, text FROM article 
                ORDER BY 
                article.id DESC',
                $params, false
            );
            
            foreach ($listTextMod as $text)
            {
                $articleForEdit[$text['id']] = $text['text'];     
            };
        
        
        // UPDATE DATABASE WITH NEW ADD
        
        
        //secure the input 
        
        if(isset($_POST['title']) && ($_POST['text']) && !empty($_POST['title']) && !empty($_POST['text']))
            {
                $title = htmlentities($_POST['title']);
                $text = htmlentities($_POST['text']);
                $id = htmlentities($_COOKIE['id']);
                $date = date ("Y-m-d H:i:s");
    
                //secure length of input
                
                if(strlen($title)>255 || strlen($text)>5000) 
                {
                    $textLength ='le champs contient trop de caractères';
                }
                
                
                //insert info for articles
                 
                if(empty($textLength))
                {
                    $params = [
                        'titre' => $title,
                        'text' => $text,
                        'alt' => $title,
                        'date' => $date,
                        'id' => $id,
                    ];
                
                    $queryMod = $db->prepare('
                        UPDATE article 
                        SET 
                        titre=:titre,
                        text=:text,
                        alt=:titre,
                        date=:date
                        WHERE id = :id',
                        $params, true
                    );
                    setcookie('id', 'ciao', time() -10);
                        
                }
              }
            

        //update input select with the new value of mod
        
        $params = [];
        
        $listTitle = $db->prepare('
            SELECT id, titre FROM article 
            ORDER BY 
            article.id DESC',
            $params, false
        );
        
        // In input select, change ID by the title of article.
        foreach ($listTitle as $titre)
        {
            $titleForEdit[$titre['id']] = $titre['titre'];
        }
    }
    
    
    // *************************************
    // *
    // *    DELETE ARTICLE
    // *
    // *************************************
    
    if(isset($_GET['delete']))
    {
        
        //get Id of article table in database
        
        $params = [];
        
        $listTitle = $db->prepare('
            SELECT id, titre FROM article 
            ORDER BY 
            article.id DESC',
            $params, false
        );
        
        // In input select, change ID by the title of article.
        foreach ($listTitle as $titre)
        {
            $titleForEdit[$titre['id']] = $titre['titre'];
        }
        
        if(isset($_POST['id']))
        {
            $id = htmlentities($_POST['id']);
            $params = [
                'id' => $id,
            ];
            
            $queryDelete = $db->prepare('
                DELETE FROM article 
                WHERE id = :id',
                $params, false
            );
            unset($titleForEdit[$id]); // delete variable ID.
        }
        
    }
    
    
    
    // *************************************
    // *
    // *    DELETE USERS
    // *
    // *************************************
    
    
    
    if(isset($_GET['deleteUser']))
    {

        //delete users
        if(isset($_POST['Envoyer']) && !empty($_POST['Envoyer']) && isset($_POST['id']) && !empty($_POST['id']))
        {
            $id = htmlentities($_POST['id']);
            $params = [
                'id' => $id,
            ];
            
            $queryDelete = $db->prepare('
                DELETE FROM users 
                WHERE id = :id',
                $params, false
            );
        }
        // select nickname & mail
        $params = [];
        $listUsers = $db->prepare('
            SELECT id, username, mail FROM users',
            $params, false
        );
    }
    
    // *************************************
    // *
    // *    READING MSG
    // *
    // *************************************
    
    
    if(isset($_GET['msg']))
    {

        //delete users
        if(isset($_POST['Envoyer']) && !empty($_POST['Envoyer']) && isset($_POST['id']) && !empty($_POST['id']))
        {
            $id = htmlentities($_POST['id']);
            $params = [
                'id' => $id,
            ];
            
            $queryDelete = $db->prepare('
                DELETE FROM msgcontact 
                WHERE id = :id',
                $params, false
            );
        }
        // select nickname & mail
        $params = [];
        $messages = $db->prepare('
            SELECT id, objet ,message, mail 
            FROM msgcontact
            ORDER BY msgcontact.id DESC',
            $params, false
        );
    } 
    
    
} else{
    header('Location:index.php?page=error');
}
?> 