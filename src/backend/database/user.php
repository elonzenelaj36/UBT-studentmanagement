<?php
class User {
    private $conn;
    //private $table = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

public function register($name, $surname, $email, $password) {
    $sql = "INSERT INTO users (emri, mbiemri, email, userpassword, role)
            VALUES (:name, :surname, :email, :password, 'student')";

    $stmt = $this->conn->prepare($sql);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":surname", $surname);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $hashedPassword);

    return $stmt->execute();
}

  public function login(string $email, string $password): ?array {
    // get user by email
    $stmt = $this->conn->prepare(
        "SELECT emri, mbiemri, email, userpassword, role 
         FROM users 
         WHERE email = :email 
         LIMIT 1"
    );
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['userpassword'])) {
        unset($user['userpassword']);
        return $user;
    }

    return null;
}
}
