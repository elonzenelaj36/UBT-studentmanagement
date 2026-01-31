<?php

class Database {
    private $host = "localhost";
    private $db = "auth_system";
    private $user = "root";
    private $pass = "";
    public $conn;

    public function connect() {
        try {
            $this->conn = new PDO(
                "mysql:host=$this->host;dbname=$this->db;charset=utf8",
                $this->user,
                $this->pass
            );

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
            die("DB Error: " . $e->getMessage());
        }

        return $this->conn;
    }
}
