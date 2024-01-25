<?php

use Marcosrivas\Instagram\controllers\Signup;
use Marcosrivas\Instagram\controllers\Login;
use Marcosrivas\Instagram\controllers\Home;
use Marcosrivas\Instagram\controllers\Actions;
use Marcosrivas\Instagram\controllers\Profile;
use Marcosrivas\Instagram\controllers\edit;



    $router = new \Bramus\Router\Router();
    session_start();

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../config/');
$dotenv->load();

function noAuth(){
    if(!isset($_SESSION['user'])){
        header("location:/instagram/login");
        exit();
    }

}

function Auth(){
    if(isset($_SESSION['user'])){
        header("location:/instagram/home");
        exit();
    }
}

    $router -> get('/', function(){
        echo "Inicio";
      
    });

    $router -> get('/login', function(){
        Auth();
        $controller = new login;
        $controller->render('login/index');
    });


   

    $router -> post('/auth', function(){
        Auth();
        $controller = new login;
        $controller->auth();
    });

    $router->get('/signup', function() { 
        Auth();
        $controller = new Signup;
        $controller->render('signup/index');
    });

    $router -> post('/register', function(){
        Auth();
        $controller = new Signup;
        $controller->register();
    });

    

   











    $router -> get('/profile', function(){
        $user = unserialize($_SESSION['user']);
        $controller = new Profile();
        $controller ->getUserProfile($user);
    });

    
   



    $router -> get('/profile/{username}', function($username){
        noAuth();
        $controller = new Profile();
        $controller ->getUserNameProfile($username);
    });
















    $router -> get('/home', function(){
        noAuth();
        $user = unserialize($_SESSION['user']);
        $controller = new Home($user);
        $controller -> index();
    });



    $router->get('/edit/{post_id}', function ($post_id) {
        $controller = new Profile();
        $post = $controller->getEditPost($post_id);
    
    });
    

    $router->post('/editOn', function () {
        $post = $_POST["post_id"];
        $title = $_POST["title"];

        echo $post, $title;
        
    });


    $router -> post('/publish', function(){
        noAuth();
        $user = unserialize($_SESSION['user']);
        $controller = new Home($user);
        $controller -> store();
    });
    








    




   


















    $router -> post('/addLike', function(){
        noAuth();
        $user = unserialize($_SESSION['user']);
        $controller = new Actions($user);
        $controller -> like();
    });

    //Salir de la sesion
    $router -> get('/singout', function(){
        noAuth();
        unset($_SESSION['user']);
        header("location: /instagram/login");
    });

  

    $router -> run();
?>