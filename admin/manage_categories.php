<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}
?>
<?php require_once '../includes/db.php'; ?>

<link rel="stylesheet" href="../assets/css/style.css">

<h2>Manage Categories</h2>

<form method="post">
<label>Category Name:</label>
<input name="name" required>
<button name="add">Add</button>
</form>

<?php
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $conn->query("INSERT INTO EVENT_CATEGORY(Category_Name) VALUES('$name')");
}

if(isset($_GET['delete'])){
    $conn->query("DELETE FROM EVENT_CATEGORY WHERE Category_ID=".$_GET['delete']);
}

$res = $conn->query("SELECT * FROM EVENT_CATEGORY");
while($c=$res->fetch_assoc()){
    echo $c['Category_Name']." 
    <a href='?delete=".$c['Category_ID']."'>Delete</a><br>";
}
?>