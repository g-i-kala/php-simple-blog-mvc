<?php
require_once '../config/db.php';

class Auth {
    private $conn;

    public function __construct($db)
    {
        $this->conn = new $db;
    }

    //register user
    public function register($username,$password,$email) {
       //check if user exists
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email OR username = :username");
        $stmt->execute(['email'=>$email, 'username'=>$username]);
        if ($stmt->fetch()) {
            return "❌ Username or Email already exists.";
        };
        
        //Hash the password 
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        //insert user to database
        $stmt = $this->conn->prepare("INSERT INTO users (username, email, password, user_type) VALUES (:username, :email, :password, 'user')");
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ]);

        return "✅ Registration successful!";
    }

    //log in
    public function login($password,$email){
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email'=>$email]);
        $user = $stmt->fetch();

       if ($user && password_verify($password,$user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user ['id'];
            $_SESSION['username'] = $user ['username'];
            return true;
       } 
       return false; //login failed
    }
}