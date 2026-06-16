<?php
class Database
{
    private static $instance = null;
    private $conn;

    private function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", "manga");
        if ($this->conn->connect_error) {
            throw new Exception("Connessione fallita: " . $this->conn->connect_error);
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
}
