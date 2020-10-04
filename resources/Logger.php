<?php

namespace resources;

use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;

class Logger 
{
    protected $log;
    protected static $logger;

    /**
     * Private constructor
     */
    private function __construct() {
        $this->log = new MonologLogger('Logger');      
        $this->log->pushHandler(new StreamHandler('log/log.txt', MonologLogger::DEBUG));
    }

    /**
     * Public method for instanciating Logger
     * 
     * @return object Logger
     */
    public static function getLogger() {
        if(!isset(self::$logger)) {
            self::$logger = new Logger();
        }
        return self::$logger; 
    }

    /**
     * Log info
     * 
     * @param string $message
     * @return boolean
     */
    public function info($message) {
        try {
            $this->log->info($message);
            return true;
        }
        catch (Exception $e) {
            return false;
        }        
    }

    /**
     * Log error
     * 
     * @param string $message
     * @return boolean
     */
    public function error($message) {
        try {
            $this->log->error($message);
            return true;
        }
        catch (Exception $e) {
            return false;
        }        
    }

}

?>