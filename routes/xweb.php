<?php
session_start();

require_once __DIR__ . '/../app/controllers/taskController.php';
require_once __DIR__ . '/../app/controllers/authController.php';
require_once __DIR__ . '/../config/db.php';

$taskController = new TaskController($conn);
$authController = new AuthController($conn);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// echo "Requested URI: " . $uri . "<br>";
// echo "Request Method: " . $_SERVER['REQUEST_METHOD'] . "<br>";

$isLoggedin = $authController->isLoggedin();
//echo var_dump($isLoggedin);

if ($uri === '/' && !$isLoggedin) {
    require_once __DIR__ . '/../app/views/login.php';
    exit();
} elseif ($uri === '/' && $isLoggedin) {
    $posts = $taskController->displayPosts();
    exit();
} elseif ($uri === '/dashboard' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $taskController->displayPosts();
    exit();
} elseif ($uri === '/login' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once __DIR__ . '/../app/views/login.php';
    exit();
} elseif ($uri === '/register' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once __DIR__ . '/../app/views/register.php';
    exit();
} elseif ($uri === '/register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $authController->handleRegister();
} elseif ($uri === '/login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $authController->handleLogin();
} elseif ($uri === '/add_post' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskController->handlePostSubmission();
} elseif ($uri === '/delete_post' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskController->handlePostDelete();
} elseif ($uri === '/update_post_inline' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskController->updatePostInline();
} elseif ($uri === '/update_post' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskController->handlePostUpdate();
} elseif ($uri === '/logout' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $authController->logOut(); 
} else {
    http_response_code(404);
    require_once __DIR__ . '/../app/views/404.php';
    exit();
}



function routeToController($uri, $routes) {
    if (array_key_exists($uri, $routes)) {
        require_once __DIR__ . $routes[$uri];
    } else {
        abort();
    }
}

function abort($code = 404) {
    http_response_code($code);
    require_once __DIR__ . "/../app/views/{$code}.php";
    exit();
}

routeToController($uri, $routes);


?>
