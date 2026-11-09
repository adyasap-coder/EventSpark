<?php
require_once '../includes/db.php';
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<h2>📋 All Bookings</h2>

<?php
$res = $conn->query("
SELECT B.B_ID, U.Name, E.E_Name, B.B_Status
FROM BOOKING B
JOIN USER U ON B.User_ID=U.User_ID
JOIN EVENT E ON B.E_ID=E.E_ID
");

while($b = $res->fetch_assoc()){
?>

<div class="card">
<b>Booking ID:</b> <?= $b['B_ID'] ?><br>
User: <?= $b['Name'] ?><br>
Event: <?= $b['E_Name'] ?><br>
Status: <?= $b['B_Status'] ?>
</div>

<?php } ?>