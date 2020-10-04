<?php 

namespace Controllers;

use Models\CRUDUsers;
use stdClass;
use resources\Logger;
use \Exception;

class SigninController extends Controller
{      
    protected $logger;

    public function __construct() {
        $this->logger = Logger::getLogger();
    }
    
    public function execute() {

        try {
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];
            $password = $_POST['password'];           
                          
            $response = new stdClass();
            if($this->isEmailAvailable($email)) {
                $addUser = CRUDUsers::addUser($firstName, $lastName, $email, $password, "usuario");
                if($addUser) {             
                    $response->ok = true;
                    $response->user = ["name" => $firstName, "lastName" => $lastName];
                }
                else {
                    $response->ok = false;
                    $response->message = 'No se logró registrar al usuario';
                } 
            } else {
                $response->ok = false;
                $response->message = 'Ya existe un usuario registrado con ese email'; 
            }  
            
            header('Content-type: application/json'); 
            echo json_encode($response);
            
        }
        catch(Exception $e) {
            $this->logger->error($e->getMessage());
            echo $e->getMessage();
        }
    }

    private function isEmailAvailable ($email) {
        $user = CRUDUsers::getUserbyEmail($email);
        if(!$user) {
            return true;
        } else {
            return false;
        }
    } 

}

?>