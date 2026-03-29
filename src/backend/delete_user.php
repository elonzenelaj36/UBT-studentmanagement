<?php
session_start();

// vetëm admin
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: ../frontend/static/Login.php");
    exit();
}

include_once 'Database.php';

$db = new Database();
$conn = $db->getConnection();

$id = $_GET['id'];

// mos e fshi veten 😄
if($id == $_SESSION['user_id']){
    header("Location: ../frontend/static/manage_users.php");
    exit();
}

$query = "DELETE FROM `user` WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();

header("Location: ../frontend/static/manage_users.php");
exit();
?>