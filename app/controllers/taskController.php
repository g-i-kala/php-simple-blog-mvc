<?php 

require_once __DIR__ . "/../../config/db.php";
require_once __DIR__ . "/../models/postManager.php";

class TaskController {
    private $postManager;

    public function __construct($conn) {
        $this->postManager = new PostManager($conn);
    }

    public function addPost($userId, $title, $content) {
        if ($this->postManager->addPost($userId, $title, $content)) {
            return true;
        } else {
            error_log("Failed to add post");
            return false;
        };
    }

    public function displayPosts() {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $posts = $this->postManager->fetchUserPosts($userId);
            $this->renderView('dashboard', ['posts' => $posts]);
        } else {
            header("Location: /login"); 
            exit();
        }
    }

    private function renderView($viewName, $data = []) {
        extract($data); // Makes the array keys available as variables in the view
        require_once __DIR__ . "/../views/{$viewName}.php";
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