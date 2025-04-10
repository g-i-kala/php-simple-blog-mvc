<?php

namespace App\Services;

use PDO;
use PDOException;

class PostService
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function get($userId)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM posts WHERE user_id = :userId ORDER BY created_at DESC");
            $stmt->execute(['userId' => $userId]);
            return $stmt->fetchAll();

        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function find($postId)
    {
        try {
            $stmt = $this->conn->prepare("SELECT title, content FROM posts WHERE id = :postId");
            $stmt->execute(['postId' => $postId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    public function store($userId, $title, $content)
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO posts (user_id, title, content, created_at) VALUES (:user_id, :title, :content, NOW())");
            $stmt->execute(['user_id' => $userId, 'title' => $title, 'content' => $content]);
            return true;

        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }

    }

    public function update($postId, $title, $content)
    {
        try {
            $stmt = $this->conn->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :post_id");
            $stmt->execute(['post_id' => $postId, 'title' => $title, 'content' => $content]);
            return true;

        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }

    }

    public function destroy($postId)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM posts WHERE id = :postId");
            $stmt->execute(['postId' => $postId]);
            return true;

        } catch (PDOException $e) {
            error_log($e->getMessage());
            return false;
        }

    }


}
