<?php
require_once '../includes/db.php';
session_start();

$uid = $_SESSION['user_id'];

if(isset($_POST['update'])){
$conn->query("UPDATE USER SET 
Name='{$_POST['name']}',
Phone='{$_POST['phone']}',
Address='{$_POST['address']}'
WHERE User_ID=$uid");
}

$res = $conn->query("SELECT * FROM USER WHERE User_ID=$uid");
$u = $res->fetch_assoc();
?>

<form method="post">
<label>Name:</label>
<input name="name" value="<?= $u['Name'] ?>"><br>

<label>Phone:</label>
<input name="phone" value="<?= $u['Phone'] ?>"><br>

<label>Address:</label>
<input name="address" value="<?= $u['Address'] ?>"><br>

<button name="update">Update</button>
</form>