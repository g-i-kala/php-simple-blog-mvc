<?php
session_start();

require_once __DIR__ . '/../app/controllers/postController.php';
require_once __DIR__ . '/../app/controllers/authController.php';
require_once __DIR__ . '/../config/db.php';

$postController = new PostController($conn);
$authController = new AuthController($conn);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

echo "Requested URI: " . $uri . "<br>";
echo "Request Method: " . $_SERVER['REQUEST_METHOD'] . "<br>";



if ($uri === '/dashboard' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    include __DIR__ . '/../app/views/dashboard.php';
} elseif ($uri === '/login' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    include __DIR__ . '/../app/views/login.php';
} elseif ($uri === '/register' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    include __DIR__ . '/../app/views/register.php';
} elseif ($uri === '/register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $authController->handleRegister();
} elseif ($uri === '/login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $authController->handleLogin();
} elseif ($uri === '/add_post' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $postController->handlePostSubmission();
} else {
    http_response_code(404);
    echo "404 Not Found";
}
    
?>