<?php
require __DIR__ . "/config/Database.php";
require __DIR__ . "/User.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';

    $db = (new Database())->connect();
    $user = new User($db);

    $loginData = $user->login($email, $password);

    if ($loginData) {
        echo "Login successful! Welcome, " . $loginData['name'];
        // Mund të bësh session start këtu për të ruajtur login
        // session_start();
        // $_SESSION['user'] = $loginData;
    } else {
        echo "Invalid email or password!";
    }
} else {
    echo "Invalid request method.";
}
