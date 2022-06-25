<?php
declare(strict_types=1);

    class Article {
 
        protected array $data=[];
        
        // $data=$listArticle 
        public function __construct(array $data = []){
            $this->data = $data;
        }
        
        // when loop is on, function creatArticle is update with loop infos
        public function generateAllArticle():string
        {
            $result = '';
            foreach($this->data as $article){
                $result .= $this->creatArticle($article);
            }
             return $result;
        }
        
        // create article skeletor for phtml articke
        protected function creatArticle(array $article):string
        {
            $html ='<div class="article">';
            $html .= '<div class="article_first">';
            $html .= '<h3>'. $article['titre'] .'</h3>';
            $html .= '<div class="article_first_picture"> <img src="vendor/images/upload/'.$article['picture_name'].'" alt="'.$article['alt'].'"></div>';
            $html .= '<div class="article_first_text">';
            $html .= '<p>'. nl2br($article['text']) . '</p>';
            $html .= '<span>'. $article['date'] .'</span></div></div></div>';
            return $html;
        }
    }
?>