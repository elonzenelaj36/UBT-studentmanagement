<?php
session_start();

// vetëm admin
if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: Login.php");
    exit();
}

include_once '../../backend/Database.php';

$db = new Database();
$conn = $db->getConnection();

$query = "SELECT * FROM contact_messages ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->execute();

$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>Reports</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background: #f4f6f9;
}

/* SIDEBAR */
.sidebar {
    width: 220px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    background: #0b3d91;
    color: white;
    padding: 20px;
}

.sidebar h2 {
    margin-bottom: 30px;
}

.sidebar a {
    display: block;
    color: white;
    text-decoration: none;
    margin: 15px 0;
    padding: 10px;
    border-radius: 6px;
    transition: 0.2s;
}

.sidebar a:hover {
    background: rgba(255,255,255,0.2);
}

/* MAIN */
.main {
    margin-left: 300px;
    padding: 30px;
    max-width: 1100px;
}

/* TITLE */
h1 {
    color: #0b3d91;
    margin-bottom: 20px;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
}

th {
    background: #0b3d91;
    color: white;
    padding: 12px;
    font-size: 14px;
}

td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #eee;
    font-size: 13px;
}

tr:hover {
    background: #f1f1f1;
}

/* RESPONSIVE */
@media screen and (max-width: 768px) {
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
        padding: 15px;
    }

    .main {
        margin-left: 0;
        padding: 15px;
    }

    table, th, td {
        font-size: 12px;
    }
}
</style>

</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Admin</h2>
    <a href="admin.php">🏠 Dashboard</a>
    <a href="../../backend/logout.php">🚪 Logout</a>
</div>

<!-- MAIN -->
<div class="main">

<h1>📩 Contact Messages</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Phone</th>
        <th>Message</th>
        <th>Date</th>
    </tr>

    <?php foreach($messages as $m): ?>
    <tr>
        <td><?= $m['id'] ?></td>
        <td><?= $m['name'] ?></td>
        <td><?= $m['phone'] ?></td>
        <td><?= $m['message'] ?></td>
        <td><?= $m['created_at'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</div>

</body>
</html>