<?php

namespace App\Controllers;

use Core\Validator;
use App\Services\PostService;

class PostController
{
    private $PostService;

    public function __construct($conn)
    {
        $this->PostService = new PostService($conn);
    }

    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $posts = $this->PostService->get($userId);
            renderView('dashboard', ['posts' => $posts]);
        } else {
            header("Location: /login");
            exit();
        }
    }

    public function store($userId, $title, $content)
    {
        if ($this->PostService->store($userId, $title, $content)) {
            return true;
        } else {
            error_log("Failed to add post");
            return false;
        };
    }

    public function update($postId, $title, $content)
    {
        if ($this->PostService->update($postId, $title, $content)) {
            return true;
        } else {
            error_log("Failed to update post");
            return false;
        };
    }

    public function destroy($postId)
    {
        if ($this->PostService->destroy($postId)) {
            return true;
        } else {
            error_log("Failed to delete post");
            return false;
        };
    }

    public function find($postId)
    {
        dd('show post Id');
        if ($this->PostService->find($postId)) {
            return true;
        } else {
            error_log("Failed to find post");
            return false;
        };
    }

    public function handlePostSubmission()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])) {

            $errors = [];
            $title = htmlspecialchars($_POST['title']);
            $content = htmlspecialchars($_POST['content']);

            if (! Validator::string($title, 1, 250)) {
                $errors['title'] = "Title of not more than 250 charakters is required.";
            }

            if (! Validator::string($content, 1, 3000)) {
                $errors['content'] = "Content can not exceed 300 charakters.";
            }

            if (empty(! $errors)) {
                return renderView('dashboard', [
                    'errors' => $errors
                ]);

            } else {

                if ($this->store($_SESSION['user_id'], $title, $content)) {
                    header("Location: /dashboard");
                    exit();
                } else {
                    echo "Error: Could not add post.";
                }
            }
        }
    }

    public function handlePostDelete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_delete'])) {
            $post_id = htmlspecialchars($_POST['post_id']);

            if ($this->destroy($post_id)) {
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
            $post_id = htmlspecialchars($_POST['post_id']);

            $post = $this->PostService->find($post_id);

            if (! $post) {
                $errors['no_post'] = "No such post to edit";
                renderView('post-edit', ['errors' => $errors]);
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
            $title = htmlspecialchars(trim($_POST['title']));
            $content = htmlspecialchars(trim($_POST['content']));

            if ($this->update($post_id, $title, $content)) {
                header("Location: /dashboard");
                exit();
            } else {
                echo "Error: Could not update the post.";
            }
        }
    }
}
