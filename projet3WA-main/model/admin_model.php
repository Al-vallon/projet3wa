<?php
declare(strict_types=1);
date_default_timezone_set('Europe/Paris');

$articleLabel = [
     'title' => 'Titre de votre article.',
     'text' => 'Contenu de votre texte.',
     'image' => 'image.',
    ];

// declare new Form
$Article = new Form ($articleLabel);
// declare new DB
$db = new Database();


// *************************************
// *
// *//CREATION ARTICLE
// *
// *************************************



// upload pictures.

$nameOfInputUpload = "image";
$isPost = $_SERVER['REQUEST_METHOD'] === "POST";
$myImage = isset($_FILES[$nameOfInputUpload]) ? $_FILES[$nameOfInputUpload] : null;

$message='';

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
            $nameOfImg = time().rand().'.'.$extensionImage;
            // $urlImage  = './vendor/images/upload/'.time().rand().'.'.$extensionImage;
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

$titleLength='';
$textLength='';

if(isset($_POST['title']) && isset($_POST['text']) && !empty($_POST['title']) && !empty($_POST['text'])){
    
    $title = htmlentities($_POST['title']);
    $text = htmlentities($_POST['text']);
    $date = date ("Y-m-d H:i:s");
    
    //secure length of input
    if(strlen($title)>255)
    {
        $titleLength ='le titre contient trop de caractères';
    }
    
    if(strlen($text)>5000)
    {
        $textLength = 'Le texte contient trop de caractères ';
    }
    

//insert data for articles

    if(empty($titleLength) && empty($textLength))
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


// *************************************
// *
// *//MODIFICATION ARTICLE
// *
// *************************************



//list of titles to stock title of articles:

$listTitle = [];
$articleForEdit =[];

$params = [];
$listTitle = $db->prepare('
    SELECT id, titre FROM article 
    ORDER BY 
    article.id DESC',
    $params, false
);

//foreach to remplace id by title in array

foreach ($listTitle as $titre) {
    $articleForEdit[$titre['id']] = $titre['titre'];
}


// UPDATE DATABASE WITH NEW ADD


if(isset($_POST['title']) && ($_POST['text']) && !empty($_POST['title']) || !empty($_POST['text'])){
    
    $title = htmlentities($_POST['title']);
    $text = htmlentities($_POST['text']);
    $date = date ("Y-m-d H:i:s");
    
    //secure length of input
    
    if(strlen($title)>255)
    {
        $titleLength ='le titre contient trop de caractères';
    }
    
    if(strlen($text)>5000)
    {
        $textLength = 'Le texte contient trop de caractères ';
    }
    

    //insert info for articles
    
    if(empty($titleLength) && empty($textLength))
    {
        $params = [
                    'title' => $title,
                    'text' => $text,
                    'date' => $date,
        ];
        $queryMod = $db->prepare('
            UPDATE article 
            (titre, text, date) 
            SET
            (:title,:text, :date)',
            $params, false
        );
           
    }

    var_dump($queryMod); 
}




// *************************************
// *
// *//DELETE ARTICLE
// *
// *************************************



    
// $params = [
//     'title' => $title,
//     'text' => $text,
//     'picture_name' => $_COOKIE['img'],
//     'alt' => $title,
//     'date' => $date,
// ];


// $queryDelete = $db->prepare('
//     DELETE FROM article 
//     (titre, text, picture_name, alt, date) 
//     WHERE 
//     (:title,:text, :picture_name, :alt, :date)',
//     $params, true
// );



?>