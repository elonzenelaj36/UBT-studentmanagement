<?php
session_start();

if($_SESSION['role'] != 'admin'){
    header("Location: ../frontend/static/Login.php");
    exit();
}

include_once 'Database.php';

$db = new Database();
$conn = $db->getConnection();

$title = $_POST['title'];
$content = $_POST['content'];

$query = "INSERT INTO news (title, content) VALUES (:title, :content)";
$stmt = $conn->prepare($query);

$stmt->bindParam(':title', $title);
$stmt->bindParam(':content', $content);

$stmt->execute();

header("Location: ../frontend/static/add_content.php?success=1");
exit();
?>