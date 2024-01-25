<?php
namespace  Marcosrivas\Instagram\models;

use Marcosrivas\Instagram\lib\Model;
use Marcosrivas\Instagram\lib\Database;

use PDO;
use PDOException;

    class Post extends Model{
        private int $id;
        private array $likes;
        private User $user;

       


        protected function __construct(private string $title){
            parent::__construct();
            $this->likes = [];    
        }

        public function getId():string{
            return $this->id; 
        }

        public function setId(string $id){
            $this->id = $id;
        }

       

        public function getTitle(){
            return $this->title;
        }



       

      

        public function getLikes(){
            return count($this->likes);
        }

        public function fetchLikes(){
            $items = [];


            try{
                $db = new Database();
                $query = $db->connect()->prepare('SELECT * FROM likes WHERE post_id = :post_id');

                $query -> execute(['post_id' => $this->id]);
           
           
                while($p =  $query ->fetch(PDO::FETCH_ASSOC) ){
                    $item = new Like($p['post_id'],$p['user_id'] );
                    $item -> setId($p['id']);

                    array_push($items, $item);
                } 
                $this->likes = $items;

                 
                //return $items;
            }catch(PDOException $e){

            }
        }

        public function addLike(User $user){
            //TODO: Revisar primero si le dio like, si es asi quitarle ese like
            $like = new Like($this->id, $user->getId());
            $like -> save();
            array_push($this->likes, $like);

        }

        public function getUser(){
            return $this->user;
        }

        public function setUser(User $user){
            $this->user = $user;
        }

       



    }
?>