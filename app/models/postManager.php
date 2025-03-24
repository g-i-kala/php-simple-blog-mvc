<?php 
require_once __DIR__ . "/../../config/Database.php";

class PostManager {
    private $conn; 

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function fetchUserPosts($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM posts WHERE user_id = :userId ORDER BY created_at DESC");
        $stmt->execute(['userId' => $userId]);
        return $stmt->fetchAll();
    }

    public function getPostById($postId) {
        $stmt = $this->conn->prepare("SELECT title, content FROM posts WHERE id = :postId");
        $stmt->execute(['postId' => $postId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addPost($userId, $title, $content) {
        $stmt = $this->conn->prepare("INSERT INTO posts (user_id, title, content, created_at) VALUES (:user_id, :title, :content, NOW())");
        $stmt->execute(['user_id' => $userId, 'title' => $title, 'content' => $content]);
        return true;
    }

    public function deletePost($postId) {
        $stmt = $this->conn->prepare("DELETE FROM posts WHERE id = :postId");
        $stmt->execute(['postId' => $postId]);
        return true;
    }

    public function updatePost($postId, $title, $content) {
        $stmt = $this->conn->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :post_id");
        $stmt->execute(['post_id' => $postId, 'title' => $title, 'content' => $content]);
        return true;
    }
}