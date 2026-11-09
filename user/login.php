<?php
require_once '../includes/db.php';
session_start();

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $pass = hash('sha256', $_POST['password']);

    $res = $conn->query("SELECT * FROM USER WHERE Email='$email' AND Password='$pass'");

    if($res->num_rows > 0){
        $u = $res->fetch_assoc();
        $_SESSION['user_id'] = $u['User_ID'];
        header("Location: dashboard.php");
    } else {
        echo "Invalid Login";
    }
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<h2>User Login</h2>

<form method="post">
<label>Email:</label><br>
<input name="email" required><br>

<label>Password:</label><br>
<input type="password" name="password" required><br>

<button name="login">Login</button>
</form>