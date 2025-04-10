<?php

namespace App\Controllers;

use App\Services\PostService;

class TaskController
{
    private $PostService;

    public function __construct($conn)
    {
        $this->PostService = new PostService($conn);
    }

    public function addPost($userId, $title, $content)
    {
        if ($this->PostService->addPost($userId, $title, $content)) {
            return true;
        } else {
            error_log("Failed to add post");
            return false;
        };
    }

    public function deletePost($postId)
    {
        if ($this->PostService->deletePost($postId)) {
            return true;
        } else {
            error_log("Failed to delete post");
            return false;
        };
    }

    public function updatePost($postId, $title, $content)
    {
        if ($this->PostService->updatePost($postId, $title, $content)) {
            return true;
        } else {
            error_log("Failed to update post");
            return false;
        };
    }

    public function displayPosts()
    {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $posts = $this->PostService->fetchUserPosts($userId);
            $this->renderView('dashboard', ['posts' => $posts]);
        } else {
            header("Location: /login");
            exit();
        }
    }

    private function renderView($viewName, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../views/{$viewName}.view.php";
    }

    public function handlePostSubmission()
    {
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

    public function handlePostDelete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_delete'])) {
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

    public function handlePostEdit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && ($_POST['action'] === 'post_edit')) {
            $errors = [];
            $_SESSION['edit_post_id'] = $_POST['post_id'];
            $post_id = $_POST['post_id'];

            $post = $this->PostService->getPostById($post_id);

            if (! $post) {
                $errors['no_post'] = "No such post to edit";
                require __DIR__ . "./../views/post-edit.view.php";
            } else {
                $_SESSION['edit_post_data'] = $post;
                $_SESSION['edit_post_id'] = $post_id;

                header("Location: /post/edit");
            }
        }
    }

    public function handlePostUpdate()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && ($_POST['action'] === 'post_update')) {
            $post_id = $_POST['post_id'];
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);

            if ($this->updatePost($post_id, $title, $content)) {
                header("Location: /dashboard");
                exit();
            } else {
                echo "Error: Could not delete the post.";
            }
        }
    }
}
