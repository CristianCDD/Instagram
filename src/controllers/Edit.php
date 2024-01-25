<?php
 namespace Marcosrivas\Instagram\controllers;

 use Marcosrivas\Instagram\lib\Controller;
 use Marcosrivas\Instagram\models\User;
 use Marcosrivas\Instagram\models\PostImage;


class Edit extends Controller{
    public function __construct(){
        parent::__construct();
    }

    public function getPost($username){
        PostImage::get($username);
    }

}

?>