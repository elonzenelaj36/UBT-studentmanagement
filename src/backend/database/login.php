<?php
session_start();

include_once 'Database.php';
include_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $db = new Database();
    $conn = $db->getConnection();
    $user = new User($conn);

    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->login($email, $password)) {

        // 🔥 REDIRECT SIPAS ROLIT
        if ($_SESSION['role'] == 'admin') {
            header("Location: ../frontend/static/admin.php");
        } else {
            header("Location: ../frontend/static/dashboard.php");
        }

        exit();

    } else {
        header("Location: ../frontend/static/Login.php?error=1");
        exit();
    }

} else {
    header("Location: ../frontend/static/Login.php");
    exit();
}
?>