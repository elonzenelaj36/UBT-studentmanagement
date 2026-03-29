<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../frontend/static/Login.php");
    exit();
}

include_once 'Database.php';

$db = new Database();
$conn = $db->getConnection();

$user_id = $_SESSION['user_id'];
$exam_id = $_GET['exam_id'];

// mos lejo duplicate
$query = "SELECT * FROM exam_registrations 
          WHERE user_id = :user_id AND exam_id = :exam_id";

$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->bindParam(':exam_id', $exam_id);
$stmt->execute();

if($stmt->rowCount() == 0){

    $query = "INSERT INTO exam_registrations (user_id, exam_id) 
              VALUES (:user_id, :exam_id)";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':exam_id', $exam_id);
    $stmt->execute();
}

header("Location: ../frontend/static/dashboard.php");
exit();
?>