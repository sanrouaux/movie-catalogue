<?php

require_once('./resources/DatabaseAccess.php');
require_once('./Models/User.php');

class CRUDUsers
{
    public static function getAllUsers() {        
        $dataAccessObject = DatabaseAccess::getDatabaseAccess();
        $query = 'SELECT * FROM users';
        $data = $dataAccessObject->query($query);

        $users = array();
        foreach($data as $user) {
            array_push($users, new User($user['id'], $user['first_name'], $user['last_name'], $user['email'], $user['password'], $user['profile']));
        }
        return $users;
    }

    public static function getUserById($id) {     
        $dataAccessObject = DatabaseAccess::getDatabaseAccess();
        $query = 'SELECT * FROM users WHERE id = ' . $id;
        $data = $dataAccessObject->query($query);
        if($data) {
            $user = new User($data[0]['id'], $data[0]['first_name'], $data[0]['last_name'], $data[0]['email'], $data[0]['password'], $data[0]['profile']);
            $response = $user;
        }
        else {
            $response = false;
        }        
        return $response;
    }

    public static function getUserByEmail($email) {     
        $dataAccessObject = DatabaseAccess::getDatabaseAccess();
        $query = 'SELECT * FROM users WHERE email = "' . $email . '"';
        $data = $dataAccessObject->query($query);
        if($data) {
            $user = new User($data[0]['id'], $data[0]['first_name'], $data[0]['last_name'], $data[0]['email'], $data[0]['password'], $data[0]['profile']);
            $response = $user;
        }
        else {
            $response = false;
        }        
        return $response;
    }

    public static function addUser($firstName, $lastName, $email, $password, $profile) {  
        $dataAccessObject = DatabaseAccess::getDatabaseAccess();
        $query = 'INSERT INTO users (first_name, last_name, email, password, profile) VALUES ("' . $firstName . '", "' . $lastName . '", "' . $email . '", "' . $password . '", "' . $profile . '")';
        $response = $dataAccessObject->query($query);
        return $response;
    }

    public static function deleteUserById($id) {   
        $dataAccessObject = DatabaseAccess::getDatabaseAccess();         
        $query = 'DELETE FROM users WHERE id = ' . $id;
        $response = $dataAccessObject->query($query);
        return $response;
    }

    public static function upDateUser($id, $firstName, $lastName, $email, $password, $profile) {  
        $dataAccessObject = DatabaseAccess::getDatabaseAccess();
        $query = 'UPDATE users SET first_name = "' . $firstName . '", last_name = "' . $lastName . '", email = "' . $email . '", password = "' . $password . '", profile = "' . $profile . '" WHERE id = ' . $id;
        $response = $dataAccessObject->query($query);
        return $response;
    }
}

?>