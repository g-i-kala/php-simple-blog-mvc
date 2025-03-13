<?php
require_once __DIR__ . '/../controllers/authController.php';

class Auth {
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
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
    public function login($email,$password){
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email'=>$email]);
        $user = $stmt->fetch();

        if(!$user) {
            return "❌ Invalid email or password.";
        }

       if ($user && password_verify($password,$user['password'])) {
            $_SESSION['user_id'] = $user ['id'];
            $_SESSION['username'] = $user ['username'];
            return true;
       } 
       return "❌ Invalid email or password."; //login failed
    }
}