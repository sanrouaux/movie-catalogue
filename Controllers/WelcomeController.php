<?php 

//namespace Controllers;

require_once('./Controllers/Controller.php');


class WelcomeController extends Controller
{      
    
    public function execute() {
        
         $this->render('Welcome');
    }

}

?>