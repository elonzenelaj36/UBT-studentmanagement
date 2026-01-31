<?php
require __DIR__ . "/Database.php";
require __DIR__ . "/User.php";

$db = (new Database())->connect();
$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST["name"] ?? '';
    $surname = $_POST["surname"] ?? '';
    $password = $_POST["password"] ?? '';

    if ($name && $surname && $password) {
        if ($user->register($name, $surname, $password)) {
            echo "Regjistrimi u krye me sukses! <a href='../../../frontend/static/Login.html'>Login</a>";
        } else {
            echo "Gabim gjatë regjistrimit.";
        }
    } else {
        echo "Ju lutem plotësoni të gjitha fushat!";
    }
} else {
    echo "Invalid request method.";
}
