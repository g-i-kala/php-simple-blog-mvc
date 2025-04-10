<?php

use Core\Database;
use App\Controllers\AuthController;
use App\Controllers\PostController;

session_start();

$conn = new Database()->connect();

$PostController = new PostController($conn);
$AuthController = new AuthController($conn);

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// echo "Requested URI: " . $uri . "<br>";
// echo "Request Method: " . $_SERVER['REQUEST_METHOD'] . "<br>";

$isLoggedin = $AuthController->isLoggedin();
//echo var_dump($isLoggedin);

if ($uri === '/' && !$isLoggedin) {
    require_once __DIR__ . '/../app/views/login.view.php';
    exit();
} elseif ($uri === '/' && $isLoggedin) {
    $posts = $PostController->index();
    exit();
} elseif ($uri === '/dashboard' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $PostController->index();
    exit();
} elseif ($uri === '/login' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once __DIR__ . '/../app/views/login.view.php';
    exit();
} elseif ($uri === '/register' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once __DIR__ . '/../app/views/register.view.php';
    exit();
} elseif ($uri === '/register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $AuthController->handleRegister();
} elseif ($uri === '/login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $AuthController->handleLogin();
} elseif ($uri === '/add_post' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $PostController->handlePostSubmission();
} elseif ($uri === '/post/delete' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $PostController->handlePostDelete();
} elseif ($uri === '/post/edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $PostController->handlePostEdit();
} elseif ($uri === '/post/edit' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    require_once __DIR__ . '/../app/views/post-edit.view.php';
    exit();
} elseif ($uri === '/post/update' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $PostController->handlePostUpdate();
} elseif ($uri === '/logout' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $AuthController->logOut();
} else {
    abort(404);
}


function routeToController($uri, $routes)
{
    if (array_key_exists($uri, $routes)) {
        require_once __DIR__ . $routes[$uri];
    } else {
        abort();
    }
}

function abort($code = 404)
{
    http_response_code($code);
    require_once __DIR__ . "/../app/views/{$code}.php";
    exit();
}

//routeToController($uri, $routes);
