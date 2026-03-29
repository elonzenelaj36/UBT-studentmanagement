<?php
session_start();

if($_SESSION['role'] != 'admin'){
    header("Location: ../frontend/static/Login.php");
    exit();
}

include_once 'Database.php';

$db = new Database();
$conn = $db->getConnection();

$exam_id = $_POST['id'];
$grade = $_POST['grade'];

$query = "UPDATE exam_registrations 
          SET grade = :grade 
          WHERE id = :id";

$stmt = $conn->prepare($query);
$stmt->bindParam(':grade', $grade);
$stmt->bindParam(':id', $exam_id);
$stmt->execute();

header("Location: ../frontend/static/manage_users.php");
exit();
?>