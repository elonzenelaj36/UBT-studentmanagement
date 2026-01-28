<?php
class User {
    private $conn;
    private $table = "user";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($name, $surname, $password) {
        $sql = "INSERT INTO {$this->table} (name, surname, password)
                VALUES (:name, :surname, :password)";

        $stmt = $this->conn->prepare($sql);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":surname", $surname);
        $stmt->bindParam(":password", $hashedPassword);

        return $stmt->execute();
    }
}
