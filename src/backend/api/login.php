<?php
header("Content-Type: application/json; charset=UTF-8");
include __DIR__ . '/../database/login.php';

if (isset($_POST['email']) && isset($_POST['password'])) {

$student = getUserByEmail(strval($_POST['password']), strval($_POST['email'])); 

if ($student) {
    // User found
    echo json_encode([
        "success" => true,
        "student" => $student
    ]); 
} else {
    // User not found
    echo json_encode([
        "success" => false,
        "message" => "Invalid email or password"
    ]); 
}
}
?>