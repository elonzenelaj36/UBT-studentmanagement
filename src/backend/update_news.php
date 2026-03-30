<?php
session_start();

if($_SESSION['role'] != 'admin'){
    header("Location: ../frontend/static/Login.php");
    exit();
}

include_once 'Database.php';

$db = new Database();
$conn = $db->getConnection();

$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];

$query = "UPDATE news SET title = :title, content = :content WHERE id = :id";
$stmt = $conn->prepare($query);

$stmt->bindParam(':id', $id);
$stmt->bindParam(':title', $title);
$stmt->bindParam(':content', $content);

$stmt->execute();

header("Location: ../frontend/static/add_content.php");
exit();
?>