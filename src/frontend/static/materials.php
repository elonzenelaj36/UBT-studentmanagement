<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: Login.php");
    exit();
}

include_once '../../backend/Database.php';

$db = new Database();
$conn = $db->getConnection();

// 🔹 merr program_id nga URL
if(!isset($_GET['program_id'])){
    echo "Program not selected!";
    exit();
}

$program_id = $_GET['program_id'];

// 🔹 merr emrin e drejtimit
$query = "SELECT name FROM programs WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $program_id);
$stmt->execute();
$program = $stmt->fetch(PDO::FETCH_ASSOC);

// 🔹 merr materialet
$query = "SELECT * FROM materials WHERE program_id = :program_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':program_id', $program_id);
$stmt->execute();
$materials = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>Materials</title>

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f5f7fa;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
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
}

.ubt-nav a {
    color: white;
    text-decoration: none;
    font-weight: 600;
}

/* CONTAINER */
.container {
    padding: 40px;
    padding: 40px;
    flex: 1; 
}

/* TITLE */
h1 {
    color: #0b3d91;
}

/* MATERIAL CARDS */
.materials {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-top: 20px;
}

.material-card {
    background: white;
    padding: 20px;
    border-radius: 10px;
    width: 220px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    text-align: center;
}

.material-card h3 {
    font-size: 16px;
}

/* BUTTON */
.btn {
    display: inline-block;
    margin-top: 10px;
    background: #0b3d91;
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
}

.btn:hover {
    background: #092c6b;
}

/* EMPTY */
.empty {
    margin-top: 20px;
    font-style: italic;
    color: gray;
}

/* FOOTER */
footer {
    margin-top: 50px;
    background: #0b3d91;
    color: white;
    text-align: center;
    padding: 20px;
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
            <li><a href="profile.php">Profile</a></li>
            <li><a href="../../backend/logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<!-- CONTENT -->
<div class="container">

<h1>📚 Materialet - <?= $program['name'] ?></h1>

<div class="materials">

<?php if(count($materials) > 0): ?>

    <?php foreach($materials as $m): ?>
        <div class="material-card">
            <h3>📄 <?= $m['title'] ?></h3>

            <a class="btn" href="/UBT-studentmanagement/src/uploads/<?= $m['file'] ?>" target="_blank">
                Shkarko
            </a>
        </div>
    <?php endforeach; ?>

<?php else: ?>

    <p class="empty">Nuk ka materiale për këtë drejtim.</p>

<?php endif; ?>

</div>

</div>

<!-- FOOTER -->
<footer>
        <h3>UBT-Student Management</h3>
        <p>© 2025 UBTStudentManagement. All rights reserved.</p>
        <p>Email: support@ubtstudentmanagement.com</p>
        <p>Phone: +383 49 445 676</p>
</footer>

</body>
</html>