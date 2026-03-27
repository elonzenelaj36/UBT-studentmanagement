<?php
include_once 'Database.php';
include_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $db = new Database();
    $conn = $db->getConnection();
    $user = new User($conn);

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->register($name, $surname, $email, $password)) {
        header("Location: ../frontend/static/Login.php?success=1");
        exit;
    } else {
        header("Location: ../frontend/static/Register.php?error=1");
        exit;
    }

} else {
    header("Location: ../frontend/static/Register.php");
    exit;
}
?>