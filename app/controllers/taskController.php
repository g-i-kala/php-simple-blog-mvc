<?php 

require_once __DIR__ . "/../../config/Database.php";
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

    public function deletePost($postId) {
        if ($this->postManager->deletePost($postId)) {
            return true;
        } else {
            error_log("Failed to delete post");
            return false;
        };
    }

    public function updatePost($postId, $title, $content) {
        if ($this->postManager->updatePost($postId, $title, $content)) {
            return true;
        } else {
            error_log("Failed to update post");
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
        extract($data); 
        require_once __DIR__ . "/../views/{$viewName}.view.php";
    }

    public function handlePostSubmission() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];
           
            if ($this->addPost($_SESSION['user_id'], $title, $content)) {
                header("Location: /dashboard"); 
                exit();
            } else {
                echo "Error: Could not add post.";
            }
        }
    }

    public function handlePostDelete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_post'])) {
            $post_id = $_POST['post_id'];
            //echo $_SESSION['user_id'] . " id " . $post_id;
            // Call the deletePost method
            if ($this->deletePost($post_id)) {
                header("Location: /dashboard"); // Redirect after deleting the post
                exit();
            } else {
                echo "Error: Could not delete the post.";
            }
        }
    }

    public function updatePostInline() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && ($_POST['action'] === 'update_post_inline')) {
            $_SESSION['edit_post_id'] = $_POST['post_id'];
            $post_id = $_POST['post_id'];
            $post = $this->postManager->getPostById($post_id);

            $_SESSION['edit_post_data'] = $post;

            header('Location: /dashboard#edit__post__section'); 
            exit();
        }
    }

    public function handlePostUpdate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && ($_POST['action'] === 'update_post')) {
            $post_id = $_POST['post_id'];
            $title = $_POST['title'];
            $content = $_POST['content'];

            if ($this->updatePost($post_id, $title, $content)) {
                header("Location: /dashboard");
                exit();
            } else {
                echo "Error: Could not delete the post.";
            }
        }
    }
}

?>