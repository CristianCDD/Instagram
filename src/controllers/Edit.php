<?php
 namespace Marcosrivas\Instagram\controllers;

 use Marcosrivas\Instagram\lib\Controller;
 use Marcosrivas\Instagram\models\User;
use Marcosrivas\Instagram\lib\UtilImages;

 use Marcosrivas\Instagram\models\PostImage;


class Edit extends Controller{
    public function __construct(){
        parent::__construct();
    }

    public function getEditPost(String $user){
        $post = User::getPost($user);
        $this->render("edit/index", ["post"=>$post]);

    }

    public function updateEdit(){
        $postId = $_POST["post_id"];
        $title = $_POST["title"];

       $imagen = $_FILES["image"];

       $fileName = UtilImages::storeImage($imagen); 


       User::updatePost($postId, $title, $fileName);
        header("location: /instagram/home");  
 
       
    }

}

?>