<?php

namespace App\Controllers;

use Core\Validator;
use App\Services\PostService;

class PostEditController
{
    private $postService;

    public function __construct($conn)
    {
        $this->postService = new PostService($conn);
    }

    public function update()
    {
        if (isset($_POST['action']) && ($_POST['action'] === 'post_update')) {
            $postId = htmlspecialchars($_POST['post_id']);
            $title = htmlspecialchars(trim($_POST['title']));
            $content = htmlspecialchars(trim($_POST['content']));
            $errors = [];

            if (!Validator::string($title, 1, 250)) {
                $errors['title'] = "Title must be between 1 and 250 characters.";
            }

            if (!Validator::string($content, 1, 3000)) {
                $errors['content'] = "Content must be between 1 and 3000 characters.";
            }

            if (!empty($errors)) {
                return renderView('post-edit', [
                    'errors' => $errors,
                    'post' => ['title' => $title, 'content' => $content]
                ]);
            }

            if (! $this->postService->update($postId, $title, $content)) {
                $errors['update'] = "Update post failed.";
                renderView('post-edit', ['errors' => $errors]);
            } else {
                header("Location: /dashboard");
                exit();
            }
        }
    }

    public function handlePostEdit()
    {
        if (isset($_POST['action']) && ($_POST['action'] === 'post_edit')) {

            $postId = htmlspecialchars($_POST['post_id']);
            $post = $this->postService->find($postId);
            $errors = [];

            if (! $post) {
                $errors['no_post'] = "No such post to edit";
                renderView('post-edit', ['errors' => $errors]);
            }

            $_SESSION['edit_post_data'] = $post;
            $_SESSION['edit_post_id'] = $postId;

            header("Location: /post/edit");
            exit();
        }
    }
}
