<?php
require '../includes/db.php';

$id=$_GET['id'];

$conn->query("DELETE FROM EVENT WHERE E_ID=$id");

header("Location: dashboard.php");
?>

<?php ?>