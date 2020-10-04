<?php 

namespace Controllers;

use Models\CRUDFilms;
use stdClass;
use resources\Logger;
use \Exception;

class DeleteFilmController extends Controller
{      
    protected $logger;

    public function __construct() {
        $this->logger = Logger::getLogger();
    }
    
    public function execute() {
        
        try {
            
            $id = $_POST['id'];    
            $deleteFilmOk = CRUDFilms::deleteFilmById($id);

            $response = new stdClass();
            if($response) {             
                $response->delete = true;
            }
            else {
                $response->delete = false;
            } 
            
            header('Content-type: application/json');
            echo json_encode($response);

        }
        catch(Exception $e) {
            $this->logger->error($e->getMessage());
            echo $e->getMessage();
        }  
    }

}

?>