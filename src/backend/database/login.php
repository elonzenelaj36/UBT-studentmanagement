<?php
require_once __DIR__ . "/config/database.php";
function getUserByEmail(string $password, string $email): ?array {

 $con = getConnection();

    $stmt = $con->prepare(
        "SELECT emri, mbiemri, email, role as \"role\"
         FROM users 
         WHERE email = ? and userpassword = ? 
         LIMIT 1"
    );

    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_assoc() ?: null;
}


?>