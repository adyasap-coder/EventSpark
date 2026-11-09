<?php
require_once '../includes/db.php';
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['add'])){
    $event = (int)$_POST['event'];
    $seat = $_POST['seat'];

    if($seat != ""){
        $conn->query("INSERT INTO SEAT(E_ID,Seat_No) VALUES($event,'$seat')");
    }
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<h2>💺 Manage Seats</h2>

<div class="card">

<form method="post">

<label>Select Event:</label>
<select name="event" required>
<option value="">Choose Event</option>
<?php
$res = $conn->query("SELECT * FROM EVENT");
while($e = $res->fetch_assoc()){
    echo "<option value='{$e['E_ID']}'>{$e['E_Name']}</option>";
}
?>
</select>

<label>Seat Number:</label>
<input name="seat" required>

<button class="btn" name="add">Add Seat</button>

</form>

</div>

<h3>📋 All Seats</h3>

<?php
$res = $conn->query("SELECT S.*, E.E_Name 
FROM SEAT S JOIN EVENT E ON S.E_ID=E.E_ID");

while($s = $res->fetch_assoc()){
?>

<div class="card">
Event: <?= $s['E_Name'] ?><br>
Seat: <?= $s['Seat_No'] ?>
</div>

<?php } ?>