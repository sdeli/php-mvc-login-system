<?php
namespace App\Model\Posts;
use Core\Model\Model as Model; 
use PDO;

class Posts extends Model
{
    static function getAllPosts()
    {
        $pdoConn = static::getPdoConnection();   
        $stmt = $pdoConn->prepare("SELECT * FROM posts");
        $stmt->execute(); 
        $posts = $stmt->fetchAll();
        return $posts;
    }
}
