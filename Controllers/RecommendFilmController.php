<?php 

require_once('./Controllers/Controller.php');
require_once('./Models/CRUDFilms.php');


class RecommendFilmController extends Controller
{      
    
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
            echo $e->getMessage();
        }
        
    }
}

?>