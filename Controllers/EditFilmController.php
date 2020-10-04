<?php 

namespace Controllers;

use Models\CRUDFilms;
use stdClass;

class EditFilmController extends Controller
{      
    
    public function execute() {

        try {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $director = $_POST['director'];
            $year = $_POST['year'];

            if(isset($_FILES['photo']['tmp_name'])) {

                $imageTmpLocation = $_FILES['photo']['tmp_name'];
                $imageExtension = $_POST['photoExtension'];  
                $updateFilmOk = CRUDFilms::updateFilm($id, $name, $director, $year, $imageTmpLocation, $imageExtension);               
            }       
            else {
                $updateFilmOk = CRUDFilms::updateFilm($id, $name, $director, $year);
            }  
            
            $response = new stdClass();
            if($updateFilmOk) {             
                $response->exito = true;
            }
            else {
                $response->exito = false;
            } 
            
            header('Content-type: application/json'); 
            echo json_encode($response);

        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

}

?>