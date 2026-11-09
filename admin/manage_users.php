<?php
require_once '../includes/db.php';
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

if(isset($_GET['delete'])){
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM USER WHERE User_ID=$id");
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<h2>👥 Manage Users</h2>

<?php
$res = $conn->query("SELECT * FROM USER");

while($u = $res->fetch_assoc()){
?>

<div class="card">
<b><?= $u['Name'] ?></b><br>
Email: <?= $u['Email'] ?><br>
Phone: <?= $u['Phone'] ?><br><br>

<a class="btn" href="?delete=<?= $u['User_ID'] ?>" 
onclick="return confirm('Delete this user?')">Delete</a>
</div>

<?php } ?>