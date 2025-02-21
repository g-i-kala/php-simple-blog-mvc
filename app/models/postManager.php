<?php 
require_once __DIR__ . "/../../config/db.php";

class PostManager {
    private $conn; 

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function fetchUserPosts($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM posts WHERE user_id = :userId ");
        $stmt->execute(['userId' => $userId]);
        return $stmt->fetchAll();
    }

    public function addPost($userId, $title, $content) {
        $stmt = $this->conn->prepare("INSERT INTO posts (user_id, title, content, created_at) VALUES (:user_id, :title, :content, NOW())");
        $stmt->execute(['user_id' => $userId, 'title' => $title, 'content' => $content]);
        return true;
    }

}