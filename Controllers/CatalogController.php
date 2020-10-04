<?php 

namespace Controllers;

use Models\CRUDFilms;
use resources\Logger;
use \Exception;

class CatalogController extends Controller
{      
    protected $logger;

    public function __construct() {
        $this->logger = Logger::getLogger();
    }

    public function execute() {

        try {
            $films = CRUDFilms::getFullCatalog();  
            $this->render('Catalog', $films);
        }
        catch(Exception $e) {
            $this->logger->error($e->getMessage());
            echo $e->getMessage();
        }
    }
}

?>