<?php
session_start();
if($_SESSION['role'] != 'admin'){
    header("Location: Login.php");
    exit();
}

include_once '../../backend/Database.php';

$db = new Database();
$conn = $db->getConnection();

// NEWS
$query = "SELECT * FROM news ORDER BY created_at DESC";
$stmt = $conn->prepare($query);
$stmt->execute();
$news = $stmt->fetchAll(PDO::FETCH_ASSOC);

// PROGRAMS
$stmt = $conn->prepare("SELECT * FROM programs");
$stmt->execute();
$programs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Content</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
/* RESET */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

/* BODY */
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
    margin-left: 280px; /* per te lënë vend për sidebar */
    padding: 30px;
    max-width: 1100px;
}

/* HEADINGS */
h1 {
    color: #0b3d91;
    margin-bottom: 15px;
}

/* CARDS */
.card {
    background: white;
    padding: 20px;
    border-radius: 10px;
    margin-bottom: 25px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

/* FORM ELEMENTS */
input, textarea, select, button {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    margin-top: 10px;
    font-size: 14px;
}

textarea {
    height: 100px;
}

button {
    background: #0b3d91;
    color: white;
    border: none;
    cursor: pointer;
    transition: 0.2s;
}

button:hover {
    background: #082c6c;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
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

tr:hover {
    background: #f1f1f1;
}

/* ACTIONS */
.action a {
    text-decoration: none;
    margin: 0 5px;
    padding: 5px 8px;
    border-radius: 5px;
    font-size: 13px;
}

.edit {
    background: #ffc107;
    color: black;
}

.delete {
    background: #dc3545;
    color: white;
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

    input, textarea, select, button {
        font-size: 13px;
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

<h1>➕ Add Content</h1>

<!-- ADD NEWS -->
<div class="card">
    <h2>📰 Add News</h2>
    <form action="../../backend/add_news.php" method="POST">
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="content" placeholder="Content" required></textarea>
        <button type="submit">Add News</button>
    </form>
</div>

<!-- ADD MATERIAL -->
<div class="card">
    <h2>📚 Add Material</h2>
    <form action="../../backend/add_material.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Title" required>
        <select name="program_id" required>
            <?php foreach($programs as $p): ?>
                <option value="<?= $p['id'] ?>"><?= $p['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="file" name="file" required>
        <button type="submit">Upload</button>
    </form>
</div>

<!-- ALL NEWS -->
<div class="card">
    <h2>📰 All News</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Action</th>
        </tr>
        <?php foreach($news as $n): ?>
        <tr>
            <td><?= $n['id'] ?></td>
            <td><?= $n['title'] ?></td>
            <td class="action">
                <a class="edit" href="edit_news.php?id=<?= $n['id'] ?>">Edit</a>
                <a class="delete" href="../../backend/delete_news.php?id=<?= $n['id'] ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

</div>

</body>
</html>