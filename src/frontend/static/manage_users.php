<?php
session_start();

if(!isset($_SESSION['role']) || $_SESSION['role'] != 'admin'){
    header("Location: dashboard.php");
    exit();
}

include_once '../../backend/Database.php';

$db = new Database();
$conn = $db->getConnection();

// USERS + PROVIMI + NOTA
$query = "SELECT u.*, e.id as exam_id, e.grade, ex.name as exam_name
          FROM user u 
          LEFT JOIN exam_registrations e ON u.id = e.user_id
          LEFT JOIN exams ex ON e.exam_id = ex.id
          WHERE u.role = 'user'";

$stmt = $conn->prepare($query);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Users</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
/* RESET */
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
    margin-left: 220px; /* hapësirë për sidebar */
    padding: 30px;
    max-width: 1100px;
}

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

/* BUTTONS */
.btn-grade {
    background: #ffc107;
    color: black;
    padding: 5px 10px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-size: 12px;
}

.btn-delete {
    background: #dc3545;
    color: white;
    padding: 5px 10px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 12px;
}

.btn-grade:hover {
    background: #e0a800;
}

.btn-delete:hover {
    background: #c82333;
}

/* MODAL */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.4);
}

.modal-content {
    background: white;
    margin: 15% auto;
    padding: 20px;
    border-radius: 10px;
    width: 300px;
    text-align: center;
}

.modal input {
    width: 80%;
    padding: 8px;
    margin: 10px 0;
    border-radius: 6px;
    border: 1px solid #ccc;
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

    .btn-grade, .btn-delete {
        font-size: 11px;
        padding: 4px 8px;
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
<h1>👤 Manage Users</h1>

<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Surname</th>
    <th>Email</th>
    <th>Provimi</th>
    <th>Nota</th>
    <th>Actions</th>
</tr>

<?php foreach($users as $u): ?>
<tr>
    <td><?= $u['id'] ?></td>
    <td><?= $u['name'] ?></td>
    <td><?= $u['surname'] ?></td>
    <td><?= $u['email'] ?></td>
    <td><?= $u['exam_name'] ? $u['exam_name'] : '—' ?></td>
    <td><?= $u['grade'] ? $u['grade'] : '—' ?></td>
    <td>
        <?php if($u['exam_id']): ?>
            <button class="btn-grade" onclick="openModal(<?= $u['exam_id'] ?>, '<?= $u['name'] ?>')">Grade</button>
        <?php else: ?>
            No exam
        <?php endif; ?>
        <a class="btn-delete" href="../../backend/delete_user.php?id=<?= $u['id'] ?>">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
</div>

<!-- MODAL -->
<div id="gradeModal" class="modal">
  <div class="modal-content">
    <h3>Vendos notën për <span id="modalName"></span></h3>
    <form method="post" action="../../backend/set_grade.php">
        <input type="hidden" name="id" id="modalId">
        <input type="number" name="grade" min="0" max="100" required>
        <br>
        <button type="submit" class="btn-grade">Save</button>
        <button type="button" class="btn-delete" onclick="closeModal()">Cancel</button>
    </form>
  </div>
</div>

<script>
function openModal(id, name){
    document.getElementById('gradeModal').style.display = 'block';
    document.getElementById('modalId').value = id;
    document.getElementById('modalName').innerText = name;
}

function closeModal(){
    document.getElementById('gradeModal').style.display = 'none';
}

window.onclick = function(event){
    if(event.target == document.getElementById('gradeModal')){
        closeModal();
    }
}
</script>

</body>
</html>