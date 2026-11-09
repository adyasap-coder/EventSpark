<?php
require_once '../includes/db.php';
session_start();

$uid = $_SESSION['user_id'];

if(isset($_GET['cancel'])){
    $conn->query("UPDATE BOOKING SET B_Status='Cancelled' WHERE B_ID=".$_GET['cancel']);
}

$res = $conn->query("SELECT * FROM BOOKING WHERE User_ID=$uid");

while($b=$res->fetch_assoc()){
    echo "Booking#".$b['B_ID']." - ".$b['B_Status']."
    <a href='?cancel=".$b['B_ID']."'>Cancel</a><br>";
}
?>