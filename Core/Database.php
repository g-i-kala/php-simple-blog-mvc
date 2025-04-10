<?php

namespace Core;

use PDO;
use PDOException;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

class Database
{
    private $dbHost;
    private $dbName;
    private $dbUser;
    private $dbPassword;
    private $charset = 'utf8mb4';
    public $conn;

    public function __construct()
    {
        $this->dbHost = $_ENV['DB_HOST'];
        $this->dbName = $_ENV['DB_NAME'];
        $this->dbUser = $_ENV['DB_USER'];
        $this->dbPassword = $_ENV['DB_PASS'];
    }

    public function connect()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO('mysql:dbname=' . $this->dbName . ';host=' . $this->dbHost, $this->dbUser, $this->dbPassword);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Connection failed. Error: " . $e->getMessage();
            error_log($e->getMessage());
            http_response_code(500);
            exit;
        }
        return $this->conn;
    }
}
