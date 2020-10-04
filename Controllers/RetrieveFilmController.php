<?php 

namespace Controllers;

use Models\CRUDFilms;
use stdClass;
use resources\Logger;
use \Exception;

class RetrieveFilmController extends Controller
{      
    protected $logger;

    public function __construct() {
        $this->logger = Logger::getLogger();
    }
    
    public function execute() {
       
        try {
            $id = $_POST['id'];
            
            $film = CRUDFilms::getFilmById($id);        

            header('Content-type: application/json');
            if($film) {                  
                echo json_encode(["success" => true, "film" => $film]);
            }
            else {
                echo json_encode(["success" => false]);
            }
        }
        catch (Exception $e) {
            $this->logger->error($e->getMessage());
            echo $e->getMessage();
        }  
    }
}

?>