<?php
include_once "Database.php";
include_once "User.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $password = $_POST["password"];

    $db = new Database();
    $conn = $db->getConnection();

    $user = new User($conn);

    if ($user->register($name, $surname, $password)) {
        echo "Regjistrimi u krye me sukses!";
    } else {
        echo "Gabim gjatë regjistrimit!";
    }
}
?>