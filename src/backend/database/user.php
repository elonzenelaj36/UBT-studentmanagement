<?php
class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }
    // REGISTER (opsionale, vetëm për referencë)
    public function register($name, $surname, $password) {
        $sql = "INSERT INTO users (name, surname, password) VALUES (:name, :surname, :password)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ":name" => $name,
            ":surname" => $surname,
            ":password" => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }
    // LOGIN
    public function login($email, $password) {
        $stmt = $this->conn->prepare(
            "SELECT id, name, surname, email, password FROM users WHERE email = :email LIMIT 1"
        );
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']); // hiq password për siguri
            return $user;
        }
        return null;
    }


}
