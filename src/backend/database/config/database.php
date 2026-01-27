<?php
class Database {
    private $host = "localhost";
    private $dbname = "ubt";
    private $username = "root";
    private $password = "";
    private $conn;

    public function __construct() {
        $this->conn = new PDO(
            "mysql:host={$this->host};dbname={$this->dbname}",
            $this->username,
            $this->password
        );
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection() {
        return $this->conn;
    }
}

?>