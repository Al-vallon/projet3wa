<?php
declare(strict_types=1);
date_default_timezone_set('Europe/Paris');

$createArticle =[
    'src'=> 'selectionner image',
    'alt'=>'description image',
    ];
$titre='';
$text='';


$myArticle = new Article ($createArticle, $titre, $text);

$db = new Database();




// Page adminn?  
//create data for an article

//creer les informations pour les articles. meme données que la DB
// $db = new Database();
//     $params = [
//         'titre' => $titre,
//         'text' => $text,
//         'picture_url' => $createArticle,
//         'alt' => $titre,
//         'date' => $date 
//         ];
        
//  $query = $db->prepare('INSERT INTO article (titre, text, picture_url, alt, date) VALUES (:titre, :text, :picture_url, :alt, :date, $params, true');
 





?>