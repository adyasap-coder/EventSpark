<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}
?>
<?php
require_once '../includes/db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

/* ADD EVENT */
if(isset($_POST['add'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $date = $_POST['date'];
    $venue = mysqli_real_escape_string($conn, $_POST['venue']);
    $price = (int)$_POST['price'];
    $cat = (int)$_POST['cat'];

    if($name != "" && $date != "" && $venue != "" && $price > 0 && $cat > 0){

        $sql = "INSERT INTO EVENT(E_Name, E_Date, Venue, Ticket_Price, Category_ID)
                VALUES('$name', '$date', '$venue', $price, $cat)";

        if($conn->query($sql)){
            echo "<p style='color:lightgreen;'>Event Added Successfully</p>";
        } else {
            echo "<p style='color:red;'>Error: ".$conn->error."</p>";
        }

    } else {
        echo "<p style='color:red;'>All fields are required!</p>";
    }
}

/* DELETE EVENT */
if(isset($_GET['delete'])){
    $id = (int)$_GET['delete'];
    $conn->query("DELETE FROM EVENT WHERE E_ID=$id");
    header("Location: manage_events.php");
}

/* FETCH EVENT FOR EDIT */
$editData = null;
if(isset($_GET['edit'])){
    $id = (int)$_GET['edit'];
    $res = $conn->query("SELECT * FROM EVENT WHERE E_ID=$id");
    $editData = $res->fetch_assoc();
}

/* UPDATE EVENT */
if(isset($_POST['update'])){
    $id = (int)$_POST['id'];
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $date = $_POST['date'];
    $venue = mysqli_real_escape_string($conn, $_POST['venue']);
    $price = (int)$_POST['price'];
    $cat = (int)$_POST['cat'];

    $sql = "UPDATE EVENT SET 
            E_Name='$name',
            E_Date='$date',
            Venue='$venue',
            Ticket_Price=$price,
            Category_ID=$cat
            WHERE E_ID=$id";

    if($conn->query($sql)){
        echo "<p style='color:lightgreen;'>Event Updated Successfully</p>";
    } else {
        echo "<p style='color:red;'>Error: ".$conn->error."</p>";
    }
}
?>

<link rel="stylesheet" href="../assets/css/style.css">

<h2>🎯 Manage Events</h2>

<!-- ADD / EDIT FORM -->
<div class="card">
<h3><?php echo $editData ? "Edit Event" : "Add New Event"; ?></h3>

<form method="post">

<?php if($editData): ?>
<input type="hidden" name="id" value="<?= $editData['E_ID'] ?>">
<?php endif; ?>

<label>Event Name:</label><br>
<input type="text" name="name" required
value="<?= $editData['E_Name'] ?? '' ?>"><br><br>

<label>Event Date:</label><br>
<input type="date" name="date" required
value="<?= $editData['E_Date'] ?? '' ?>"><br><br>

<label>Venue:</label><br>
<input type="text" name="venue" required
value="<?= $editData['Venue'] ?? '' ?>"><br><br>

<label>Ticket Price (₹):</label><br>
<input type="number" name="price" required
value="<?= $editData['Ticket_Price'] ?? '' ?>"><br><br>

<label>Category:</label><br>
<select name="cat" required>
<option value="">Select Category</option>
<?php
$res = $conn->query("SELECT * FROM EVENT_CATEGORY");
while($c = $res->fetch_assoc()){
    $selected = ($editData && $editData['Category_ID'] == $c['Category_ID']) ? "selected" : "";
    echo "<option value='{$c['Category_ID']}' $selected>{$c['Category_Name']}</option>";
}
?>
</select><br><br>

<?php if($editData): ?>
<button class="btn" name="update">Update Event</button>
<a href="manage_events.php" class="btn">Cancel</a>
<?php else: ?>
<button class="btn" name="add">Add Event</button>
<?php endif; ?>

</form>
</div>

<hr>

<!-- EVENT LIST -->
<h3>📋 Existing Events</h3>

<?php
$res = $conn->query("SELECT * FROM EVENT");

while($e = $res->fetch_assoc()){
?>

<div class="card">
<b><?= $e['E_Name'] ?></b><br>
Date: <?= $e['E_Date'] ?><br>
Venue: <?= $e['Venue'] ?><br>
Price: ₹<?= $e['Ticket_Price'] ?><br><br>

<a class="btn" href="?edit=<?= $e['E_ID'] ?>">Edit</a>
<a class="btn" href="?delete=<?= $e['E_ID'] ?>" onclick="return confirm('Delete this event?')">Delete</a>
</div>

<?php } ?>