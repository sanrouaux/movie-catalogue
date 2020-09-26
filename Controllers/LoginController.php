<?php 

namespace Controllers;

use Controllers\Controller;
use Models\CRUDUsers;

require_once('./Controllers/Controller.php');
require_once('./Models/CRUDUsers.php');


class LoginController extends Controller
{      
    
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
                }
                else {
                    $response->valid = false;
                    $response->message = "Password incorrecto";
                }
            }
            else {
                $response->valid = false;
                $response->message = "Mail incorrecto";
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