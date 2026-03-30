<?php
session_start();

if($_SESSION['role'] != 'admin'){
    header("Location: ../frontend/static/Login.php");
    exit();
}

include_once 'Database.php';

$db = new Database();
$conn = $db->getConnection();

$id = $_GET['id'];

$query = "DELETE FROM news WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();

header("Location: ../frontend/static/add_content.php");
exit();
?>