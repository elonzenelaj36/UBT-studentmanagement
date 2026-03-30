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
$program_id = $_POST['program_id'];

$file_name = $_FILES['file']['name'];
$tmp = $_FILES['file']['tmp_name'];

move_uploaded_file($tmp, "../uploads/" . $file_name);

$query = "INSERT INTO materials (title, file, program_id) 
          VALUES (:title, :file, :program_id)";

$stmt = $conn->prepare($query);

$stmt->bindParam(':title', $title);
$stmt->bindParam(':file', $file_name);
$stmt->bindParam(':program_id', $program_id);

$stmt->execute();

header("Location: ../frontend/static/add_content.php");
exit();
?>