<?php
require_once '../includes/db.php';
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

$revenue = $conn->query("SELECT SUM(Amount) as total FROM PAYMENT")->fetch_assoc();
$payments = $conn->query("SELECT COUNT(*) as total FROM PAYMENT")->fetch_assoc();
?>

<link rel="stylesheet" href="../assets/css/style.css">

<h2>📊 Reports</h2>

<div class="card">
<b>Total Revenue:</b> ₹<?= $revenue['total'] ?? 0 ?><br><br>
<b>Total Payments:</b> <?= $payments['total'] ?? 0 ?>
</div>