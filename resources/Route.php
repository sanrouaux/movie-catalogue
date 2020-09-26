<?php

class Route {

    public static function set($route, $function) {
        
        $url = isset($_GET['url']) ? $_GET['url'] : '';
        
        if($url == $route) {
            $function->__invoke();
        }
    }
}

?>