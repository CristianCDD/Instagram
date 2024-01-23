<?php
 namespace Marcosrivas\Instagram\controllers;
  
 use Marcosrivas\Instagram\lib\Controller;
use Marcosrivas\Instagram\models\User;

 class Login extends Controller{
    public function __construct(){
        parent::__construct();
    }

    public function auth(){
        $username = $this->post('username');
        $password = $this->post('password');

        if(!is_null($username) && !is_null($password)){
            if(User::exists($username)){ //Verificar si existe el ususuario
                $user = User::get($username);

                if($user->comparePasswords($password)){ //Verificiar si existe la contraseña
                    $_SESSION['user'] = serialize($user);
                    
                    header('location: /instagram/home');
                }else{
                    header('location: /instagram/login');
                }

            }else{
                header('location: /instagram/login');
            }
        }else{
            header('location: /instagram/login');
        }

    }
 }
?>