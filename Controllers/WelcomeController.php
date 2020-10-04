<?php

namespace Controllers;

use resources\Logger;
use \Exception;

class WelcomeController extends Controller
{      
    protected $logger;

    public function __construct() {
        $this->logger = Logger::getLogger();
    }
    
    public function execute() {
        
        try {
            $this->render('Welcome');
            
        }
        catch (Exception $e) {
            $this->logger->error($e->getMessage());
            echo $e->getMessage();
        }
    }

}

?>