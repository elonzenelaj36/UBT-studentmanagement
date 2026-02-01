<?php

require __DIR__ . "/config/Database.php";
require __DIR__ . "/User.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = $_POST["name"] ?? "";
    $surname = $_POST["surname"] ?? "";
    $password = $_POST["password"] ?? "";

    $db = (new Database())->connect();
    $user = new User($db);

    if ($user->register($name, $surname, $password)) {
        echo "Regjistrimi u krye me sukses";
    } else {
        echo "Gabim gjatë regjistrimit";
    }

    
}