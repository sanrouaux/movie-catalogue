<?php 

namespace Controllers;

require_once('./Controllers/Controller.php');
require_once('./Models/CRUDFilms.php');

class CatalogController extends Controller
{          
    public function execute() {

        try {
            $films = CRUDFilms::getFullCatalog();  
            $this->render('Catalog', $films);
        }
        catch(Exception $e) {
            echo $e->getMessage();
        }
    }
}

?>