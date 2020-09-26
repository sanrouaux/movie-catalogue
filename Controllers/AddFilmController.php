<?php 

require_once('./Controllers/Controller.php');
require_once('./Models/CRUDFilms.php');


class AddFilmController extends Controller
{      
    
    public function execute() {
        
        try {
            $name = $_POST['name'];
            $director = $_POST['director'];
            $year = $_POST['year'];
            $poster = $_FILES['photo']['tmp_name'];
            $photoExtension = $_POST['photoExtension'];        
            
            $addFilmOk = CRUDFilms::addFilm($name, $director, $year, $poster, $photoExtension);  

            $response = new stdClass();
            if($addFilmOk) {             
                $response->exito = true;
            }
            else {
                $response->exito = false;
            } 

            header('Content-type: application/json');
            echo json_encode($response);
        }
        catch(Exception $e) {
            echo $e->getMessage();
        } 
    }

}

?>