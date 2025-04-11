<?php

namespace App\Controllers;

use Core\Validator;
use App\Services\PostService;

class PostController
{
    private $postService;

    public function __construct($conn)
    {
        $this->postService = new PostService($conn);
    }

    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $posts = $this->postService->get($userId);
            renderView('dashboard', ['posts' => $posts]);
        } else {
            header("Location: /login");
            exit();
        }
    }

    public function store()
    {
        if (isset($_POST['add_post'])) {

            $userId = $_SESSION['user_id'];
            $title = htmlspecialchars($_POST['title']);
            $content = htmlspecialchars($_POST['content']);
            $errors = [];

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

                if (! $this->postService->store($userId, $title, $content)) {

                    $errors['store'] = "Couldn't add post. Try again.";
                    renderView('dashboard', [
                        'posts' => $this->index(),
                        'errors' => $errors,
                    ]);

                } else {
                    header("Location: /dashboard");
                    exit();
                }
            }
        }
    }

    public function destroy()
    {
        if (isset($_POST['post_delete'])) {
            $postId = htmlspecialchars($_POST['post_id']);
            $errors = [];

            if (! $this->postService->destroy($postId)) {
                $errors['delete'] = "Error: Could not delete the post.";
                renderView('dashboard', [
                    'posts' => $this->index(),
                    'errors' => $errors,
                ]);
            } else {
                header("Location: /dashboard");
                exit();
            }
        }
    }

    public function find()
    {
        dd('show post Id');
        $postId = htmlspecialchars($_POST['post_id']);
        if (! $this->postService->find($postId)) {
            $errors = [];
            renderView('dashboard', [
                'posts' => $this->index(),
                'errors' => $errors,
            ]);
        } else {
            // Show single post view
        };
    }
}
