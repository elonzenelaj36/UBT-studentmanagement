<?php
header("Content-Type: application/json; charset=UTF-8");
include __DIR__ . '/../database/login.php';

if (isset($_POST['email']) && isset($_POST['password'])) {

 $user = getUserByEmail(strval($_POST['password']), strval($_POST['email'])); 

if ($user) {
   
    echo json_encode([
        "success" => true,
        "user" => $user
    ]); 
} else {

    echo json_encode([
        "success" => false,
        "message" => "Invalid email or password"
    ]); 
}
}
?>