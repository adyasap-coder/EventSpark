<?php
require_once '../includes/db.php';
session_start();
if(!isset($_SESSION['user_id'])) header("Location: login.php");
?>

<link rel="stylesheet" href="../assets/css/style.css">

<h2>Events</h2>

<?php
$res = $conn->query("SELECT E.*, C.Category_Name 
FROM EVENT E JOIN EVENT_CATEGORY C ON E.Category_ID=C.Category_ID");

while($e = $res->fetch_assoc()){
?>

<div class="card">
<b><?= $e['E_Name'] ?></b><br>
Category: <?= $e['Category_Name'] ?><br>
Date: <?= $e['E_Date'] ?><br>
Venue: <?= $e['Venue'] ?><br>
Price: ₹<?= $e['Ticket_Price'] ?><br><br>

<a class="btn" href="book_event.php?id=<?= $e['E_ID'] ?>">Book</a>
</div>

<?php } ?>

<a href="bookings.php" class="btn">My Bookings</a>
<a href="profile.php" class="btn">Profile</a>
<a href="logout.php" class="btn">Logout</a>