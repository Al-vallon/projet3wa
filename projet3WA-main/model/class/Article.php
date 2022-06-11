<?php
declare(strict_types=1);

class Article {
    private $urlDb;
    private $titre = '';
    private $text = '';  
    
    
    
    public function __construct(array $urlDb, $titre, $text)
    {
        $this->urlDb = $urlDb;
        $this->titre = $titre;
        $this ->text = $text;
        // var_dump($titre);
        // var_dump($text);
    }
    
    
    // get id of url picture.
    public function idPicture(int $id){
        $db = new PDO(
            'mysql:host=db.3wa.io;port=3306;dbname=alexandrevallon_trucen+',
            'alexandrevallon',
            '7b8c9d64b18abb50302354af1ac4afd6');
            
        $queryUrl= $db->prepare('SELECT picture_url FROM article WHERE article.id=:id');
            $params=[
                'id'=> $id,
            ];
    
        $queryUrl->execute($params);
        
        $urlDb=$queryUrl->fetch(PDO::FETCH_ASSOC);
    }

    // create auto pic and title for card
    private function divImg(string $urlDb, string $titre):string{
        return('<img class="card_pic" src="'. $urlDb .'" atl="'. $titre . '" >');
    }
    
    //title & text
    private function divText(string $titre, string $text){
        return('<h3"' . $titre .'" </h3> <p"' . $text .'" ' );
    }
    
}


?>