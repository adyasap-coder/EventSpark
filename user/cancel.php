<?php
require '../includes/db.php';

$id=$_GET['id'];

$conn->query("UPDATE BOOKING SET B_Status='Cancelled' WHERE B_ID=$id");

$conn->query("UPDATE SEAT SET Seat_Status='Available',B_ID=NULL WHERE B_ID=$id");

echo "Cancelled Successfully";
?>

<?php ?>