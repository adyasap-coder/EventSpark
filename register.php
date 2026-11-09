<?php session_start(); ?>
<form method="post">
<input name="name" required>
<input name="email" required>
<input name="password" required>
<button name="reg">Register</button>
</form>
<?php
require 'includes/db_connection.php';
if(isset($_POST['reg'])){
$n=$_POST['name'];
$e=$_POST['email'];
$p=$_POST['password'];
$conn->query("INSERT INTO users(name,email,password) VALUES('$n','$e','$p')");
}
?>