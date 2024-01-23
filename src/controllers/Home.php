<?php
 namespace Marcosrivas\Instagram\controllers;
  
 use Marcosrivas\Instagram\lib\Controller;
use Marcosrivas\Instagram\lib\UtilImages;
use Marcosrivas\Instagram\models\User;
use Marcosrivas\Instagram\models\PostImage;


class Home extends Controller{
    public function __construct(private User $user){
       
        parent::__construct();
    }

    public function index(){
        $posts = PostImage::getFeed();
        $this->render("home/index",['user' => $this->user, 'posts' => $posts]);
    }

    public function store(){
        $title = $this->post('title');
        $image = $this->file('image');

        if(!is_null($title) && !is_null($image)){
            $fileName = UtilImages::storeImage($image);

            $post = new PostImage($title, $fileName);
            
              $this -> user -> publish($post);
            header("location: /instagram/home");  

        }else{
            echo "Error";
            header("location: /instagram/home");
        }

    }
}

?>