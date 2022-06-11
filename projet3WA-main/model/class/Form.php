<?php
// declare(strict_type=1);

class Form {
    protected $data;
    protected $error;
    
    public function __construct(array $data = []){
        $this->data = $data;
    }
    
    //verify if the input is empty or the value is set else create error. 
    protected function getValue($index){
        if(isset($_POST[$index])){
            if(empty($_POST[$index])){
                $this->createError($index);
            }
            return $_POST[$index];
        }
        //return isset($_POST[$index]) ? $_POST[$index] : null ;
    }
    
    protected function createError($index, $error='le champs est vide'){
        $this->error[$index] = $error;
    }
    
    protected function showError($index){
        return isset($this->error[$index]) ? $this->error[$index]: null;
    }
    
    protected function label(string $name):string {
        return('<label for="'. $name . '">'. $this->data[$name] . '</label>');
    }
    
    public function input(string $name, string $type='text'):string{
        return($this->label($name). '<input type="'.$type.'" id="'. $name .'" name="'.$name.'" value="'. $this->getValue($name) .'" ></input>'. $this-> showError($name));
    }
    
    public function textarea(string $name):string{
        return($this->label($name). '<textarea id="'. $name .'" name="'.$name.'" rows="10" cols="50" value="'. $this->getValue($name) .'" ></textarea>'. $this-> showError($name));
    }
    
    public function submit(string $text='Envoyer'):string{
        return('<input type="submit" value="'.$text.'">');
    }
}
