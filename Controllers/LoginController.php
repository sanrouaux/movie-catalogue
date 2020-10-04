<?php 

namespace Controllers;

use Models\CRUDUsers;
use stdClass;
use resources\Logger;
use \Exception;

class LoginController extends Controller
{      
    protected $logger;

    public function __construct() {
        $this->logger = Logger::getLogger();
    }

    public function execute() {

        try {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = CRUDUsers::getUserByEmail($email);
            
            $response = new stdClass();
            if($user) {
                if($user->password == $password) {
                    $response->valid = true;
                    $response->user = $user;
                    $this->logger->info($user->firstName . ' ' . $user->lastName . ' has logged in.');
                }
                else {
                    $response->valid = false;
                    $response->message = "Password incorrecto";
                }
            }
            else {
                $response->valid = false;
                $response->message = "No existe el usuario";
            }
            
            header('Content-type: application/json');
            echo json_encode($response);
        }
        catch (Exception $e) {
            $this->logger->error($e->getMessage());
            echo $e->getMessage();
        }
    }

}

?>