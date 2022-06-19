<?php
declare(strict_types=1);

class Form {
    protected array $data;
    protected array $error;
    protected array $listTitle;
    
    public function __construct(array $data = []){
        $this->data = $data;
        }
    
    //verify if the input is empty or the value is set else create error. 
    protected function getValue(string|int $index):string | int | null{
        if(isset($_POST[$index])){
            if(empty($_POST[$index])){
                $this->createError($index);
            }
            return $_POST[$index];
        }
        return null;
    }
    
    protected function createError(string | int $index, string $error='le champs est vide'){
        $this->error[$index] = $error;
    }
    
    protected function showError(string|int $index):string|int|null{
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
    
    public function selector(string $name):string{
        return($this->label($name). '<select id="'. $name .'" <option value="'. $this->getValue($name) .'" />"'. $this->getValue($name) .'"</option></select>'. $this-> showError($name));
    }
    
    public function selectorForeach(string $name, array $listTitle):string
    {
        $html = '<select name="'. $name .'" id="'. $name .'">';
        foreach($listTitle as $key =>$value){
            $html .= '<option value="'. $key .'" />"'. $value .'"</option>';
        }
        $html .= '</select>';
        return $html; 
    }
    
    public function submit(string $text='Envoyer'):string{
        return('<input type="submit" value="'.$text.'">');
    }
    
    
    
}
