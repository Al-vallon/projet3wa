<?php
declare(strict_types=1);
date_default_timezone_set('Europe/Paris');

//creation de la partie admin
// si connecter alors 3 parties

// creation 
// form creation d article


//modifier
// form de modif

//supprssion
// faire un tableau qui listes les éléments et un bouton pour suppr.


$articleLabel = [
     'title' => 'Titre de votre article.',
     'text' => 'Contenu de votre texte.',
     'image' => 'image.',
    ];

// declare new Form
$createArticle = new Form ($articleLabel);
// declare new DB
$adminCreateDb = new Database();

// check length of inputs
$titleLength='';
$textLength='';
$imageLength='';

if(isset($_POST['title']) && ($_POST['text']) && ($_POST['image']) && !empty($_POST['title']) && !empty($_POST['text']) && !empty($_POST['image'])){
    
    $title = htmlentities($_POST['title']);
    $text = htmlentities($_POST['text']);
    $img = htmlentities($_POST['image']);
    $date = date ("Y-m-d H:i:s");
    
    //secure length of input
    if(strlen($title)>255){
            $titleLength ='le titre contient trop de caractères';
        }
        
        if(strlen($text)>5000){
            $textLength = 'Le texte contient plus de ';
        } 
        
        if(strlen($img)>512){
            $imageLength = 'le mail contient trop de caractères';
        // } verfier avec le script d antho.

    
        if(empty($titleLength) && empty($textLength) && empty($imageLength)){
                $params = [
                        'title' => $title,
                        'text' => $text,
                        'picture_name' => $img,
                        'alt' => $titre,
                        'date' => $date,
                        ];
                        
                $queryContact = $db->prepare('INSERT INTO article (title, text, picture_name, alt, date) VALUES (:title,:text, :picture_name, :alt, :date :name)', $params, true);
        }
    
    }
}


//upload d'image.


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
            // on lui dit ou deplacer l'image et on la nomme
            $urlImage  = 'Upload/'.time().rand().'.'.$extensionImage;
            // on déplace l'image dans le dossier Upload
            move_uploaded_file($myImage['tmp_name'],$urlImage );
            $message = "Votre image est prise en compte ! " ;
        } else {
            $message = " Votre fichier n'est pas de type jpeg jpg gif ou png !";
        }
    } else {
        $message = " Votre image depasse les 3mo !";
    }
}
?>
    
    
    

