<?php session_start(); ?>
<form method="post">
<input name="email" required>
<input type="password" name="password" required>
<button name="login">Login</button>
</form>
<?php
require 'includes/db_connection.php';
if(isset($_POST['login'])){
$email=$_POST['email'];
$pass=$_POST['password'];
$q=$conn->query("SELECT * FROM users WHERE email='$email' AND password='$pass'");
if($q->num_rows>0){
$_SESSION['user']=$email;
header('Location: dashboard.php');
}
}
?>