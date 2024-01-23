<?php
namespace Marcosrivas\Instagram\lib;

class Model{
    private Database $db;
    public function __construct(){
        $this->db = new Database;
    }

    function query($query){
        return $this->db->connect()->query($query);
    }

    function prapare($query){
        return $this->db->connect()->prepare($query);
    }
}
?>