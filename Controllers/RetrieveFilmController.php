<?php 


require_once('./Controllers/Controller.php');
require_once('./Models/CRUDFilms.php');


class RetrieveFilmController extends Controller
{      
    
    public function execute() {
        
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
}

?>