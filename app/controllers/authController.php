<?php

require_once __DIR__ . "/../../config/Database.php";
require_once __DIR__ . "/../models/Auth.php";



class AuthController {
    private $auth;

    public function __construct($conn) {
        $this->auth = new Auth($conn);
    }

    public function handleRegister () {
    if ($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['register'])) {
        
        $username = htmlspecialchars((trim($_POST['username'])));
        $email = htmlspecialchars((trim($_POST['email'])));
        $password = $_POST['password'];
    
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Please fill in a valid email address.";
            header("Location: /register?error=". urlencode($error));
            exit();
        }

        if (strlen($password)<6) {
            $error = "Password must to be at least 6 charcters long.";
            header("Location: /register?error=" . urlencode($error));
            exit();
        }

        $result = $this->auth->register($username,$password,$email);

        if ($result === "✅ Registration successful!") {
            header("Location: ../login?success=" . urlencode($result));
            exit();
        } else {
            header("Location: /register?error=" . urlencode($result) .
            "&username=" . urlencode($username)."&email=" . urlencode($email));
            exit();
        }
    }
    }
    public function handleLogin() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['login'])) {
        
        $email = htmlspecialchars((trim($_POST['email'])));
        $password = $_POST['password'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Please fill in a valid email address.";
            header("Location: /login?error=". urlencode($error));
            exit();
        }

        $result = $this->auth->login($email, $password);

        if ($result === true) {
            header("Location: /dashboard?success=loggedin");
            exit();
        } else {
            header("Location:/login?error=" . urlencode($result) . "&email=" . urlencode($email));
            exit();
        }
    }
    }

    public function isLoggedin() {
        return isset($_SESSION['user_id']);
    }

    public function logOut() {
        if (isset($_SESSION['user_id'])){
            $_SESSION = []; 
            session_destroy();
            header("Location: /login");
        };
    }
}