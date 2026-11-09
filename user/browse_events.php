<?php
session_start();
require '../includes/db.php';

// Fetch events with available seats
$q = "SELECT E.*, 
             (E.Total_Seat - COUNT(S.Seat_ID)) AS Available
      FROM EVENT E
      LEFT JOIN SEAT S 
      ON E.E_ID = S.E_ID AND S.Seat_Status = 'Booked'
      GROUP BY E.E_ID
      ORDER BY E.E_Date ASC";

$r = $conn->query($q);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Events</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="container">
<h2>🎉 Events</h2>

<?php if($r->num_rows > 0): ?>
    <?php while($row = $r->fetch_assoc()): ?>
        <h3><?php echo htmlspecialchars($row['E_Name']); ?></h3>
        <p>Venue: <?php echo htmlspecialchars($row['Venue']); ?></p>
        <p>Available Seats: <?php echo intval($row['Available']); ?></p>

        <?php if(intval($row['Available']) > 0): ?>
            <a href="book.php?event_id=<?php echo intval($row['E_ID']); ?>">Book</a>
        <?php else: ?>
            <span style="color:red; font-weight:bold;">Sold Out</span>
        <?php endif; ?>

        <hr>
    <?php endwhile; ?>
<?php else: ?>
    <p>No events available at the moment.</p>
<?php endif; ?>

</div>
</body>
</html>