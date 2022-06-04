<?php
// call to class form
require('class/Form.php');

// name iput 
$formLabel = [
    'name' => 'Entrer votre nom.',
    'mail' => 'Entrer votre mail de contact.',
    'message' => 'Entrer votre message.'
];

$myForm = new Form($formLabel);
?>

