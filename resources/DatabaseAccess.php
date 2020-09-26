<?php 

namespace Resources;

/**
 * Class DatabaseAccess
 * 
 * Singleton Pattern
 */
class DatabaseAccess {

    public static $host = 'localhost';
    public static $dbName = 'peliculas';
    public static $userName = 'web';
    public static $password = 'web';

    public static $databaseConnection;
    public $pdo;

    private function __construct() {
        $this->pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName.";charset=utf8", self::$userName, self::$password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getDatabaseAccess() {
        if(!isset(self::$databaseConnection)) {
            self::$databaseConnection = new DatabaseAccess();
        }
        return self::$databaseConnection;
    }

    public function query($query, $params = array()) {
        
        $statement = $this->pdo->prepare($query);
        
        if($statement->execute($params)) {
            if(explode(' ', $query)[0] == 'SELECT') {
                $data = $statement->fetchAll();
                $response = $data;
            }
            else {
                $response = true;
            }
        }
        else {
            $response = false;
        }
        return $response;        
    }


}
?>