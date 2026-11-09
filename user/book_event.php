<?php
require_once '../includes/db.php';
session_start();

$uid = $_SESSION['user_id'];
$eid = $_GET['id'];

if(isset($_POST['book'])){
    $conn->query("INSERT INTO BOOKING(User_ID,E_ID,B_Status)
    VALUES($uid,$eid,'Confirmed')");
    $bid = $conn->insert_id;

    foreach($_POST['seat'] as $s){
        $conn->query("INSERT INTO TICKET(Seat_ID,B_ID) VALUES($s,$bid)");
    }

    header("Location: payment.php?bid=$bid");
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<h2>🎟️ Select Seats</h2>

<div class="card">

<form method="post">

<?php
$res = $conn->query("
SELECT S.*, 
(SELECT COUNT(*) FROM TICKET T WHERE T.Seat_ID=S.Seat_ID) as booked
FROM SEAT S WHERE E_ID=$eid
");

while($s=$res->fetch_assoc()){
    if($s['booked'] == 0){
        echo "<input type='checkbox' name='seat[]' value='{$s['Seat_ID']}'> {$s['Seat_No']}<br>";
    } else {
        echo "<span style='color:red'>{$s['Seat_No']} (Booked)</span><br>";
    }
}
?>

<br>
<button class="btn" name="book">Confirm Booking</button>

</form>

</div>