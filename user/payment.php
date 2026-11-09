<?php
require_once '../includes/db.php';

$bid = $_GET['bid'];

if(isset($_POST['pay'])){
    $method = $_POST['method'];
    $status = "Success";

    $conn->query("INSERT INTO PAYMENT(B_ID,Amount,P_Status,P_Method)
    VALUES($bid,500,'$status','$method')");

    echo "<p style='color:lightgreen;'>Payment Successful!</p>";
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<h2>💳 Payment</h2>

<div class="card">

<form method="post">

<label>Select Payment Method:</label><br><br>

<select name="method">
<option>UPI</option>
<option>Card</option>
<option>Net Banking</option>
</select>

<br><br>

<button class="btn" name="pay">Pay Now</button>

</form>

</div>