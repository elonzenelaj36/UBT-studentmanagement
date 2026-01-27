<?php
header("Content-Type: application/json; charset=UTF-8");
include __DIR__ . '/../database/user.php';
include __DIR__ . '/../database/config/database.php';


$user = new User((new Database())->getConnection()); 

if (isset($_GET["name"], $_GET["surname"], $_GET["email"], $_GET["password"])) {

    $name = $_GET["name"];
    $surname = $_GET["surname"];
    $email = $_GET["email"];
    $password = $_GET["password"];

    $s = $user->register($name, $surname, $email, $password);

    if ($s) {
        echo json_encode([
            "success" => true,
            "message" => "Registered!"
        ]);
    } else {
        echo json_encode([
            "success" => false,
            "message" => "Failed to register"
        ]);
    }

} else {
    echo json_encode([
        "success" => false,
        "message" => "Missing parameters"
    ]);
}