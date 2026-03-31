<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: Login.php");
    exit();
}

include_once '../../backend/Database.php';

$db = new Database();
$conn = $db->getConnection();

$user_id = $_SESSION['user_id'];

// 🔹 User data
$query = "SELECT * FROM user WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// 🔹 Exams + grades
$query = "SELECT e.name AS exam, er.grade
          FROM exam_registrations er
          JOIN exams e ON er.exam_id = e.id
          WHERE er.user_id = :user_id";

$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$exams = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>Profile</title>

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f5f7fa;
}

/* HEADER */
.ubt-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 30px;
    background-color: #0b3d91;
}

.ubt-header img {
    height: 40px;
}

.ubt-nav ul {
    list-style: none;
    display: flex;
    gap: 20px;
    margin: 0;
}

.ubt-nav a {
    color: white;
    text-decoration: none;
    font-weight: 600;
}

/* PROFILE */
.profile-container {
    max-width: 900px;
    margin: 40px auto;
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.profile-header {
    display: flex;
    align-items: center;
    gap: 20px;
}

/* PROFILE IMAGE */
.profile-img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: #ccc;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 30px;
    color: white;
}

/* INFO */
.profile-info h2 {
    margin: 0;
    color: #0b3d91;
}

.profile-info p {
    margin: 5px 0;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 30px;
}

th {
    background-color: #0b3d91;
    color: white;
    padding: 12px;
}

td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #eee;
}

/* FOOTER */
footer {
    margin-top: 50px;
    background: #0b3d91;
    color: white;
    padding: 20px;
    text-align: center;
}
</style>

</head>
<body>

<!-- HEADER -->
<header class="ubt-header">
    <img src="../fotot/UBT-LOGO.png">
    <nav class="ubt-nav">
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="../../backend/logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<!-- PROFILE -->
<div class="profile-container">

    <div class="profile-header">
        
        <!-- FOTO PROFILI (initials) -->
        <div class="profile-img">
            <?= strtoupper(substr($user['name'],0,1)) ?>
        </div>

        <div class="profile-info">
            <h2><?= $user['name'] . " " . $user['surname'] ?></h2>
            <p><strong>ID:</strong> <?= $user['id'] ?></p>
            <p><strong>Email:</strong> <?= $user['email'] ?></p>
        </div>

    </div>

    <hr>

    <h3>📚 Provimet e paraqitura</h3>

    <table>
        <tr>
            <th>Provimi</th>
            <th>Nota</th>
        </tr>

        <?php foreach($exams as $e): ?>
        <tr>
            <td><?= $e['exam'] ?></td>
            <td>
                <?= $e['grade'] ? $e['grade'] : 'Nuk është vendosur' ?>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>

</div>
<br><br><br><br><br><br>

<!-- FOOTER -->
<footer>
        <h3>UBT-Student Management</h3>
        <p>© 2025 UBTStudentManagement. All rights reserved.</p>
        <p>Email: support@ubtstudentmanagement.com</p>
        <p>Phone: +383 49 445 676</p>
</footer>

</body>
</html>