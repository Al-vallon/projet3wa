<?php
    if(isset($_GET['page'])) {
        if($_GET['page'] === 'home') {
            require'./controller/home_controller.php';
            
        } else if($_GET['page'] === 'article') {
            require('./controller/article_controller.php');
        
        } else if($_GET['page'] === 'propos') {
            require('./controller/propos_controller.php');
            
        } else if($_GET['page'] === 'contact') {
            require('./controller/contact_controller.php');
            
        } else if($_GET['page'] === 'donation') {
            require('./controller/donation_controller.php');
            
        } else if($_GET['page'] === 'connexion') {
            require('./controller/connexion_controller.php');
            
        } else if($_GET['page'] === 'register') {
            require('./controller/register_controller.php');
            
        } else if($_GET['page'] === 'admin') {
            require('./controller/admin_controller.php');
           
        } else if($_GET['page'] === 'disconnect'){
            require('./controller/deco_controller.php');
        
        } else if($_GET['page'] === 'NULL'){
            require('./controller/error_controller.php');
        }

    } else {
        require('./controller/home_controller.php');
    };
?> 
 
