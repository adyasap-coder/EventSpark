<?php
require '../includes/db.php';

if(isset($_POST['add'])){
$name=$_POST['name'];

$conn->query("INSERT INTO EVENT(E_Name,E_Date,E_Time,Venue,Total_Seat,Ticket_Price,Category_ID)
VALUES('$name','2026-05-01','18:00:00','Hall',50,500,101)");

echo "Event Added";
}
?>

<form method="post">
<input name="name">
<button name="add">Add Event</button>
</form>

<?php ?>