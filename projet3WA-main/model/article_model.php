<?php
declare(strict_types=1);
date_default_timezone_set('Europe/Paris');

// call database
$db = new Database();


// SQL REQUEST
$listArticle = $db->prepare('
    SELECT id, titre, text, picture_name, alt, date FROM article 
    ORDER BY 
    article.id DESC',
    []
);

//declaration of new article class
$article = new Article($listArticle);
    
?>