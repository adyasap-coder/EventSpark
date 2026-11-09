<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}
?>
<?php require_once '../includes/db.php'; ?>

<link rel="stylesheet" href="../assets/css/style.css">

<h2>Admin Dashboard</h2>

<a class="btn" href="manage_events.php">Manage Events</a>
<a class="btn" href="manage_categories.php">Manage Categories</a>
<a class="btn" href="manage_users.php">Manage Users</a>
<a class="btn" href="manage_seats.php">Manage Seats</a>
<a class="btn" href="view_bookings.php">View Bookings</a>
<a class="btn" href="reports.php">Reports</a>
<a href="logout.php" class="btn">Logout</a>

<hr>

<?php
$users = $conn->query("SELECT COUNT(*) as c FROM USER")->fetch_assoc();
$events = $conn->query("SELECT COUNT(*) as c FROM EVENT")->fetch_assoc();
$bookings = $conn->query("SELECT COUNT(*) as c FROM BOOKING")->fetch_assoc();

echo "Total Users: ".$users['c']."<br>";
echo "Total Events: ".$events['c']."<br>";
echo "Total Bookings: ".$bookings['c']."<br>";
?>