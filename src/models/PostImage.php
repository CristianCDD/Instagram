<?php
namespace Marcosrivas\Instagram\models;

use Marcosrivas\Instagram\lib\Database;
use  Marcosrivas\Instagram\models\Post;
use PDO;
use PDOException;

class PostImage extends Post{

    public  function __construct(private string $title, private string $image){
        parent::__construct($title);
    }

    public static function getFeed():array{
        $items = [];

        try {
            $db = new Database();

            $query = $db->connect()->query("SELECT * FROM posts ORDER BY post_id DESC");

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new PostImage($p["title"], $p["media"]);
                $item ->setId($p['post_id']);
                $item ->fetchLikes();
                $user = User::getById($p['user_id']);
                $item->setUser($user);

                array_push($items, $item);

            }
            return $items;
        } catch (PDOException $e) {
            return [];
        }

        return [];
    }

    public static function getAll($user_id){
        $items = [];
        try {
            $db = new Database();
            $query = $db ->connect()->prepare("SELECT * FROM posts WHERE user_id = :user_id ORDER BY post_id DESC");
            $query->execute(['user_id' => $user_id ]);

            while($p = $query->fetch(PDO::FETCH_ASSOC)){
                $item = new PostImage($p['title'], $p['media']);
                $item -> setId($p["post_id"]);
                $item -> fetchLikes();
                $user = USer::getById($p["user_id"]);
                $item -> setUser($user);

                array_push($items, $item);

            }

            return $items;
            
        } catch (PDOException $e) {
            return [];
        }
    }

    public static function get($post_id){
        try {
            $db = new Database();
            $query = $db -> connect()->prepare("SELECT * FROM posts WHERE post_id = :post_id");
            $query ->execute(['post_id' => $post_id] );
        
            $data = $query->fetch(PDO::FETCH_ASSOC);

            $post = new PostImage($data['title'], $data['media']);
            $post->setId($data['post_id']);

            var_dump($post);

        } catch (PDOException $e) {
            return NULL;

        }
    }

   

    public function getImage(){
        return $this->image;
    }
    
}


?>