<?php 

class Controller 
{
    public function render ($viewFile, $data = '') {        
        require "Views/" . $viewFile . ".php";
    }
}

?>