<?php
  namespace Marcosrivas\Instagram\controllers;
  
  use Marcosrivas\Instagram\lib\Controller;
use Marcosrivas\Instagram\lib\UtilImages;
use Marcosrivas\Instagram\models\User;


  class Signup extends Controller{
    
    public function register(){
        $username = $this->post('username');
        $password = $this->post('password');
        $profile = $this->file('profile');

        if(!is_null($username) && !is_null($password) && !is_null($profile)){
            $url = UtilImages::storeImage($profile);
            $user = new User($username, $password);
            $user->setProfile($url);
            $user->save();
            header('location: login');
        }else{
            $this->render('errors/index');
        }
    }
  }


   

?>