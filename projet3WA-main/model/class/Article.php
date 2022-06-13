<?php
declare(strict_types=1);

    class Article {
        private array $urlDb;
        private string $titre = '';
        private string $text = '';  
        
        
        
    public function __construct(array $urlDb, string $titre, string $text){
        $this->urlDb = $urlDb;
        $this->titre = $titre;
        $this ->text = $text;
        // var_dump($titre);
        // var_dump($text);
        // var_dump($urlDb);
    }
    
    
    // get id of url picture.
    public function idPicture(int $id){
        $db = new Database();
        $params=[
                'id'=> $id,
            ];
            
        $urlDb= $db->prepare('SELECT picture_url FROM article WHERE article.id=:id DESC',$params, false);
            
    }
    
    // create auto pic and title for card
    public function divImg(array $urlDb, string $titre): array | string{
        return('<img class="card_pic" src="'. $urlDb .'" atl="'. $titre . '" >');
    }
    
    //title & text
    public function divText(string $titre, string $text):string{
        return('<h3"' . $titre .'" </h3> <p"' . $text .'" ' );
    }
    
    
}


?>