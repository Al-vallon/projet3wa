<?php
date_default_timezone_set('Europe/Paris');

$createArticle = [
    'src'=> 'selectionner image',
    'alt'=>'description image',
    'titre'=>'choisir un titre',
    'text'=> 'ecrire du texte',
    ];

$myArticle = new Article($createArticle,$titre,$text);



?>