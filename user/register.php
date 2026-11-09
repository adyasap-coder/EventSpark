<?php
require_once '../includes/db.php';

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = hash('sha256', $_POST['password']);
    $phone = $_POST['phone'];
    $addr = $_POST['address'];

    $conn->query("INSERT INTO USER(Name,Email,Password,Phone,Address)
    VALUES('$name','$email','$pass','$phone','$addr')");

    echo "Registered Successfully";
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<h2>User Register</h2>

<form method="post">
<label>Name:</label><br>
<input name="name" required><br>

<label>Email:</label><br>
<input name="email" required><br>

<label>Password:</label><br>
<input type="password" name="password" required><br>

<label>Phone:</label><br>
<input name="phone"><br>

<label>Address:</label><br>
<input name="address"><br>

<button name="register">Register</button>
</form>