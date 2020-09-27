<?php 

namespace Controllers;

use Models\CRUDFilms;

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