<?php
include_once 'Database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $db = new Database();
    $conn = $db->getConnection();

    $name = $_POST['contactName'];
    $phone = $_POST['contactPhone'];
    $message = $_POST['contactMessage'];

    $query = "INSERT INTO contact_messages (name, phone, message) 
              VALUES (:name, :phone, :message)";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':message', $message);

    $stmt->execute();

    // redirect back
    header("Location: ../frontend/static/index.php?success=1");
    exit();
}
?>