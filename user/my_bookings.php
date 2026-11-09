<?php
session_start();
require '../includes/db.php';

$uid=$_SESSION['user'];

$r=$conn->query("SELECT * FROM BOOKING WHERE User_ID=$uid");

while($row=$r->fetch_assoc()){
echo "Booking ID: ".$row['B_ID']." - ".$row['B_Status'];
echo "<a href='cancel.php?id=".$row['B_ID']."'> Cancel</a><br>";
}
?>