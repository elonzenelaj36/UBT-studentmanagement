<?php
session_start();

if($_SESSION['role'] != 'admin'){
    header("Location: Login.php");
    exit();
}

include_once '../../backend/Database.php';

$db = new Database();
$conn = $db->getConnection();

$id = $_GET['id'];

$query = "SELECT * FROM news WHERE id = :id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();

$news = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit News</title>
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
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* CONTAINER */
.container {
    background: white;
    padding: 30px;
    border-radius: 12px;
    width: 100%;
    max-width: 500px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}

/* TITLE */
h1 {
    text-align: center;
    color: #0b3d91;
    margin-bottom: 20px;
}

/* FORM */
input, textarea {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 14px;
}

textarea {
    height: 120px;
    resize: none;
}

/* BUTTONS */
.btn {
    width: 100%;
    padding: 10px;
    margin-top: 15px;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.2s;
}

.btn-update {
    background: #0b3d91;
    color: white;
}

.btn-update:hover {
    background: #082c6c;
}

.btn-back {
    display: inline-block;
    text-align: center;
    margin-top: 15px;
    text-decoration: none;
    color: #0b3d91;
    font-weight: bold;
    transition: 0.2s;
}

.btn-back:hover {
    text-decoration: underline;
}

/* RESPONSIVE */
@media (max-width: 500px) {
    .container {
        padding: 20px;
    }
}
</style>

</head>
<body>

<div class="container">

    <h1>✏️ Edit News</h1>

    <form action="../../backend/update_news.php" method="POST">
        <input type="hidden" name="id" value="<?= $news['id'] ?>">

        <input type="text" name="title" value="<?= $news['title'] ?>" required>

        <textarea name="content" required><?= $news['content'] ?></textarea>

        <button type="submit" class="btn btn-update">Update</button>
    </form>

    <a href="add_content.php" class="btn-back">⬅ Back</a>

</div>

</body>
</html>