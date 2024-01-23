<?php
namespace  Marcosrivas\Instagram\models;

use Marcosrivas\Instagram\lib\Model;
use PDOException;

    class Like extends Model{
        private int $id;
        public function __construct(private int $post_id, private int $user_id){
            parent::__construct();
        }

        public function save(){
            try{

                $query = $this->prapare("INSERT INTO likes (post_id, user_id) values (:post_id, :user_id)");

                $query ->execute(
                    [
                        'post_id' => $this->post_id,
                        'user_id' => $this->user_id
                    ]
                    );
                return true;
            }catch(PDOException $e){
                
                return false;
            }
        }

        public function setUserId($value){
            $this->user_id = $value;
        }

        public function setId($value){
            $this->id = $value;
        }

        public function getId(){
            return $this->id;
        }

        public function getPostId(){
            return $this->post_id;
        }
    
    }
?>