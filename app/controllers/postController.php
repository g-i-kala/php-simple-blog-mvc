<?php 

require_once __DIR__ . "/../../config/db.php";
require_once __DIR__ . "/../models/postManager.php";

class PostController {
    private $postManager;

    public function __construct($conn) {
        $this->postManager = new PostManager($conn);
    }

    public function fetchUserPosts($userId) {
        return $this->postManager->fetchUserPosts($userId);
    }

    public function addPost($userId, $title, $content) {
        if ($this->postManager->addPost($userId, $title, $content)) {
            return true;
        } else {
            error_log("Failed to add post");
            return false;
        };
    }

    public function handlePostSubmission() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];
           
            // Call the addPost method
            if ($this->addPost($_SESSION['user_id'], $title, $content)) {
                header("Location: /dashboard"); // Redirect after adding the post
                exit();
            } else {
                echo "Error: Could not add post.";
            }
        }
    }
}

?>