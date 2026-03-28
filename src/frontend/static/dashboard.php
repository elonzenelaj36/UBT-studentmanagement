<?php
session_start();

if(!isset($_SESSION['email'])){
    header("Location: Login.php");
    exit();
}

include_once '../../backend/Database.php';

$db = new Database();
$conn = $db->getConnection();

// 🔹 Drejtimet
$query = "SELECT * FROM programs";
$stmt = $conn->prepare($query);
$stmt->execute();
$programs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 🔹 Provimet
$query = "SELECT exams.*, programs.name AS program_name 
          FROM exams 
          JOIN programs ON exams.program_id = programs.id";

$stmt = $conn->prepare($query);
$stmt->execute();
$exams = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>

<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f5f7fa;
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

/* DASHBOARD */
.dashboard {
    padding: 40px;
}

.dashboard h1 {
    color: #0b3d91;
}

/* CARDS */
.cards {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
    margin-top: 20px;
}

.card {
    background: white;
    padding: 20px;
    border-radius: 10px;
    width: 220px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    text-align: center;
}

.card h3 {
    margin-bottom: 10px;
}

.card a {
    text-decoration: none;
    color: #0b3d91;
    font-weight: bold;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 30px;
    background: white;
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

/* BUTTON */
.btn {
    background-color: #0b3d91;
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
}

.btn:hover {
    background-color: #092c6b;
}

/* FOOTER */
footer {
    margin-top: 50px;
    background: #0b3d91;
    color: white;
    padding: 30px;
    text-align: center;
}
</style>

</head>
<body>

<!-- HEADER -->
<header class="ubt-header">
    <img src="../fotot/UBT-LOGO.png" alt="UBT Logo">
    <nav class="ubt-nav">
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="../../backend/logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<!-- DASHBOARD -->
<section class="dashboard">

<h1>Mirësevini, <?php echo $_SESSION['email']; ?> 👋</h1>
<br>

<!-- 🎓 DREJTIMET -->
<h2>🎓 Zgjedh drejtimin</h2>

<div class="cards">
<?php foreach($programs as $p): ?>
    <div class="card">
        <h3><?= $p['name'] ?></h3>
        <a href="materials.php?program_id=<?= $p['id'] ?>">
            Shiko materialet
        </a>
    </div>
<?php endforeach; ?>
</div>
<br><br><br><br>

<!-- 📝 PROVIMET -->
<h2>📝 Paraqit Provimet</h2>

<table>
<tr>
    <th>Provimi</th>
    <th>Drejtimi</th>
    <th>Action</th>
</tr>

<?php foreach($exams as $e): ?>
<tr>
    <td><?= $e['name'] ?></td>
    <td><?= $e['program_name'] ?></td>
    <td>
        <a class="btn" href="../../backend/register_exam.php?exam_id=<?= $e['id'] ?>">
            Paraqit
        </a>
    </td>
</tr>
<?php endforeach; ?>

</table>

</section>

<!-- FOOTER -->
<footer>
    <h3>UBT Student Management</h3>
    <p>© 2026 UBTStudentManagement. All rights reserved.</p>
    <p>Email: support@ubtstudentmanagement.com | Phone: +383 49 445 676</p>
</footer>

</body>
</html>