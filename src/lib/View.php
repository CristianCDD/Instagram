<?php
namespace Marcosrivas\Instagram\lib;

class View{
    private $d;
    function __construct(){

    }
    function render($nombre, $data = []){
        $this->d = $data;
        
        //$this->handleMessages();
        require 'src/views/' . $nombre . '.php';
    }
}


?>