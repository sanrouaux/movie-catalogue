<?php 

namespace Controllers;

use Models\CRUDFilms;
use stdClass;
use resources\Logger;
use \Exception;

class RecommendFilmController extends Controller
{      
    protected $logger;

    public function __construct() {
        $this->logger = Logger::getLogger();
    }
    
    public function execute() {   

        try {
            $films = CRUDFilms::getFullCatalog();

            $numberOfElements = count($films);
        
            $randomNumber = rand(0, $numberOfElements - 1);

            $film = $films[$randomNumber];

            header('Content-type: application/json');
            echo json_encode($film);
            
        }
        catch (Exception $e) {
            $this->logger->error($e->getMessage());
            echo $e->getMessage();
        }
        
    }
}

?>