<?php
require_once '../includes/db.php';
session_start();

if($_POST){
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']);

    $res = $conn->query("SELECT * FROM ADMIN WHERE Email='$email' AND Password='$password'");

    if($res->num_rows > 0){
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
    } else {
        echo "Invalid Login";
    }
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<h2>Admin Login</h2>

<form method="post">
<label>Email:</label><br>
<input name="email" required><br><br>

<label>Password:</label><br>
<input type="password" name="password" required><br><br>

<button class="btn">Login</button>
</form>/form>