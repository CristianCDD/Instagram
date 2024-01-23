<?php
namespace Marcosrivas\Instagram\lib;
use Marcosrivas\Instagram\lib\View;

class Controller{
    private View $view;
    private string $name;

    public function __construct(){
        $this->view = new View();
    }
   

    public function render($view, $data = []){
        $this->view->render($view, $data);
    }

    protected function post(string $param){
        if(!isset($_POST[$param])){
            return NULL;
        }

        return $_POST[$param];
    }

    
    protected function get(string $param){
        if(!isset($_GET[$param])){
            return NULL;
        }

        return $_GET[$param];
    }


    protected function file(string $param){
        if(!isset($_FILES[$param])){
            return NULL;
        }

        return $_FILES[$param];
    }
}
?>
