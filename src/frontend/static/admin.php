<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: dashboard.php");
    exit();
}

include_once '../../backend/Database.php';

$db = new Database();
$conn = $db->getConnection();

// Merr të dhënat e admin-it
$query = "SELECT * FROM user WHERE email = :email LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bindParam(':email', $_SESSION['email']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Stats
$users = $conn->query("SELECT COUNT(*) FROM user")->fetchColumn();
$materials = $conn->query("SELECT COUNT(*) FROM materials")->fetchColumn();
$exams = $conn->query("SELECT COUNT(*) FROM exams")->fetchColumn();

// Recent activity
$query = "SELECT u.name, u.surname, e.name AS exam
          FROM exam_registrations er
          JOIN user u ON er.user_id = u.id
          JOIN exams e ON er.exam_id = e.id
          ORDER BY er.id DESC LIMIT 5";

$stmt = $conn->prepare($query);
$stmt->execute();
$recent = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f4f6f9;
}

/* HEADER MODERN */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 30px;
    background: #0b3d91;
    color: white;
    position: sticky;
    top: 0;
    z-index: 1000;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    border-bottom-left-radius: 12px;
    border-bottom-right-radius: 12px;
}

.header-left {
    display: flex;
    align-items: center;
    gap: 15px;
}

.avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: white;
    color: #0b3d91;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 24px;
    font-weight: bold;
    border: 2px solid #0b3d91;
}

.user-info h3 {
    margin: 0;
    font-size: 16px;
}

.user-info p {
    margin: 2px 0 0;
    font-size: 13px;
    opacity: 0.8;
}

/* LOGOUT BUTTON MODERN */
.logout-btn {
    padding: 8px 18px;
    border: 2px solid white;
    border-radius: 8px;
    background: transparent;
    color: white;
    font-weight: bold;
    text-decoration: none;
    transition: all 0.3s ease;
}

.logout-btn:hover {
    background: white;
    color: #0b3d91;
    box-shadow: 0 2px 6px rgba(0,0,0,0.3);
}

/* MAIN CONTENT */
.main {
    max-width: 1000px;
    margin: 30px auto;
    padding: 0 20px;
}

/* STATS */
.stats {
    display: flex;
    gap: 20px;
    margin-top: 20px;
}

.stat-card {
    flex: 1;
    background: white;
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.stat-card h2 {
    color: #0b3d91;
}

/* CARDS */
.cards {
    display: flex;
    gap: 30px;
    margin-top: 40px;
}

.card {
    flex: 1;
    background: white;
    padding: 25px;
    border-radius: 10px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    transition: 0.2s;
}

.card:hover {
    transform: translateY(-5px);
}

.btn {
    display: inline-block;
    margin-top: 10px;
    background: #0b3d91;
    color: white;
    padding: 8px 14px;
    border-radius: 6px;
    text-decoration: none;
}

/* TABLE */
table {
    width: 100%;
    margin-top: 40px;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
}

th {
    background: #0b3d91;
    color: white;
    padding: 10px;
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
    padding: 30px;
    text-align: center;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
    font-size: 14px;
}
</style>
</head>
<body>

<!-- HEADER -->
<header class="header">
    <div class="header-left">
        <div class="avatar"><?= strtoupper(substr($user['name'],0,1)) ?></div>
        <div class="user-info">
            <h3><?= $user['name'] ?> <?= $user['surname'] ?></h3>
            <p><?= $user['email'] ?></p>
        </div>
    </div>
    <a class="logout-btn" href="../../backend/logout.php">Log Out</a>
</header>

<div class="main">
    <br><br>

<h1> Admin Dashboard</h1>

<!-- STATS -->
<div class="stats">
    <div class="stat-card">
        <h2><?= $users ?></h2>
        <p>Users</p>
    </div>

    <div class="stat-card">
        <h2><?= $materials ?></h2>
        <p>Materials</p>
    </div>

    <div class="stat-card">
        <h2><?= $exams ?></h2>
        <p>Exams</p>
    </div>
</div>

<!-- ACTION CARDS -->
<div class="cards">

    <div class="card">
        <h3>👤 Manage Users</h3>
        <p>Menaxho studentët dhe notat</p>
        <a class="btn" href="manage_users.php">Hap</a>
    </div>

    <div class="card">
        <h3>📚 Add Content</h3>
        <p>Shto materiale për studentët</p>
        <a class="btn" href="add_content.php">Hap</a>
    </div>

    <div class="card">
        <h3>📊 Reports</h3>
        <p>Shiko mesazhet nga kontaktet</p>
        <a class="btn" href="reports.php">Hap</a>
    </div>

</div>
<br><br><br><br>

<!-- RECENT ACTIVITY -->
<h2>🕒 Aktivitetet e fundit</h2>

<table>
<tr>
    <th>Studenti</th>
    <th>Provimi</th>
</tr>

<?php foreach($recent as $r): ?>
<tr>
    <td><?= $r['name'] . " " . $r['surname'] ?></td>
    <td><?= $r['exam'] ?></td>
</tr>
<?php endforeach; ?>

</table>

</div>

<!-- FOOTER -->
<footer>
    <h3>UBT Student Management</h3>
    <p>© 2026 UBTStudentManagement. All rights reserved.</p>
    <p>Email: support@ubtstudentmanagement.com | Phone: +383 49 445 676</p>
</footer>

</body>
</html>