<?php
class Form {
    protected $data;
    protected $error;
    
    public function __construct($data = []){
        $this->data = $data;
    }
    
    protected function getValue($index){
        if(isset($_POST[$index])){
            if(empty($_POST[$index])){
                $this->createError($index);
            }
            return $_POST[$index];
        }
        //return isset($_POST[$index]) ? $_POST[$index] : null ;
    }
    
    protected function createError($index, $error='input vide'){
        $this->error[$index] = $error;
    }
    
    protected function showError($index){
        return isset($this->error[$index]) ? $this->error[$index] . '<br>' : null;
    }
    
    protected function label($name){
        return('<label for="'. $name . '">'. $this->data[$name] . '</label>');
    }
    
    public function input($name, $type='text'){
        return($this->label($name). '<input type="'.$type.'" id="'. $name .'" name="'.$name.'" value="'. $this->getValue($name) .'" > <br>'. $this-> showError($name));
    }
    
    public function submit($text='Envoyer'){
        return('<input type="submit" value="'.$text.'">');
    }
}

$formLabel = [
    'username' => 'Entrer votre pseudo',
    'password' => 'Entrer votre mot de passe'
];
$myForm = new Form($formLabel);
?>
