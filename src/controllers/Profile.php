<?php
 namespace Marcosrivas\Instagram\controllers;
  
 use Marcosrivas\Instagram\lib\Controller;
use Marcosrivas\Instagram\models\User;

class Profile extends Controller{
    public function __construct(){
        parent::__construct();
    }

    public function getUserProfile(User $user){
        $user -> fetchPost();
        $this->render("profile/index", ["user"=>$user]);

    }


    public function getUsernameProfile(string $username){
        $user = User::get($username);
        $this->getUserProfile($user);
        
    }

    public function getEditPost(String $user){
        $post = User::getPost($user);
        $this->render("edit/index", ["post"=>$post]);

        }
}

?>
