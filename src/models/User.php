<?php	
namespace Marcosrivas\Instagram\models;

use Marcosrivas\Instagram\lib\Database;
use  Marcosrivas\Instagram\lib\Model;

use PDO;
use PDOException;

class User extends Model{
    private int $id;
    private int $id2;

    private array $post;
    private string $profile;
    private $posts;

    public function __construct(private string $username, private string $password){
        parent::__construct();
        $this->post = [];
        $this->profile = "";
        $this->id = -1;
    }

    public function save(){
        try {
            //Validar si existe primero el usuario 36:34
            $hash = $this->getHashedPassword($this->password);
            $query = $this->prapare("INSERT INTO users (username, password, profile) VALUES(:username, :password, :profile)");
            $query -> execute([
                'username' => $this->username,
                'password' => $hash,
                'profile' => $this->profile,

            ]);
            return true;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    private function getHashedPassword($password){
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 10]);
    }

   
        public function fetchPost(){
            $this->posts = PostImage::getAll($this->id);
        }



    public static function exists($username){
        try{
            $db = new Database();
            $query = $db -> connect()->prepare("SELECT username FROM users WHERE username = :username");
            $query ->execute(['username' => $username] );
            if($query -> rowCount()>0){
                return true;
            }else{
                return false;
            }
        }catch(PDOException $e){
            error_log($e -> getMessage());
            return false;
        }
    }



    public static function get($username): User{
        try {
            $db = new Database();
            $query = $db -> connect()->prepare("SELECT * FROM users WHERE username = :username");
            $query ->execute(['username' => $username] );
        
            $data = $query->fetch(PDO::FETCH_ASSOC);


            
            $user = new User($data['username'], $data['password']);
            $user->setId($data['user_id']);
            $user->setProfile($data['profile']);

            return $user;



        } catch (PDOException $e) {
            error_log($e -> getMessage());
            return NULL;

        }
    }

    public static function getById(string $user_id): User{
        try {
            $db = new Database();
            $query = $db -> connect()->prepare("SELECT * FROM users WHERE user_id = :user_id");
            $query ->execute(['user_id' => $user_id] );
        
            $data = $query->fetch(PDO::FETCH_ASSOC);


            
            $user = new User($data['username'], $data['password']);
            $user->setId($data['user_id']);
            $user->setProfile($data['profile']);

            return $user;



        } catch (PDOException $e) {
            error_log($e -> getMessage());
            return NULL;

        }
    }

    public function comparePasswords(string $password):bool{
        return password_verify($password, $this->password);
    }

    public function publish(PostImage $post){
        try {
            $db = new Database();
            $query = $db->connect()->prepare("INSERT INTO posts (user_id, title, media) values (:user_id, :title, :media)");


            $query -> execute([
                'user_id' => $this->id,
                'title' => $post ->getTitle(),
                'media' => $post -> getImage()

            ]);
            return true;

        } catch (PDOException $e) {
            echo "Error";
            return false;

        }
    }


    public function getId(){
        return $this->id;
    }

    public function setId($value){
        $this->id = $value;
    }
   

    public function getUsername(){
        return $this->username;
    }

    public function setUsername($value){
        $this->username = $value;

    }


    public function getProfile(){
        return $this-> profile;
    }

    public function setProfile($value){
        $this->profile = $value;
    }

    public function getPosts():array{
        return $this->posts;
    }

    public function setPost($value){
        $this->post = $value;
    }

}

?>