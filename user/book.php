<?php
session_start();
require '../includes/db.php';

if(!isset($_GET['event_id']) || empty($_GET['event_id'])){
    die("Invalid Request: Event ID missing.");
}

$event_id = intval($_GET['event_id']);

// Fetch event details
$stmt = $conn->prepare("SELECT * FROM EVENT WHERE E_ID = ?");
$stmt->bind_param("i", $event_id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows == 0){
    die("Event not found.");
}

$event = $result->fetch_assoc();

// Assign variables
$e_name = isset($event['E_Name']) ? $event['E_Name'] : 'Event Name';
$e_date = isset($event['E_Date']) ? $event['E_Date'] : 'N/A';
$e_time = isset($event['E_Time']) ? $event['E_Time'] : 'N/A';
$venue = isset($event['Venue']) ? $event['Venue'] : 'N/A';
$ticket_price = isset($event['Ticket_Price']) ? $event['Ticket_Price'] : 0;

// Redirect to login if not logged in
if(!isset($_SESSION['user_id'])){
    $redirect_url = "login.php?redirect=" . urlencode("book.php?event_id=$event_id");
    header("Location: $redirect_url");
    exit();
}

// Handle booking submission
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $tickets = intval($_POST['tickets'] ?? 1); // Default 1 ticket
    if($tickets < 1){
        die("Please enter a valid number of tickets.");
    }

    $user_id = intval($_SESSION['user_id']);

    // Insert booking into DB
    $stmt = $conn->prepare("INSERT INTO BOOKING (B_Date, Tickets, B_Status, User_ID, E_ID) VALUES (NOW(), ?, 'Confirmed', ?, ?)");
    $stmt->bind_param("iii", $tickets, $user_id, $event_id);
    $stmt->execute();

    $b_id = $stmt->insert_id;

    header("Location: payment.php?b_id=$b_id");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Tickets - EventSpark</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Container */
        .container {
            max-width: 700px;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            font-family: 'Segoe UI', sans-serif;
        }

        /* Heading */
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 10px;
        }

        /* Event card */
        .event-card {
            background: #f7f7f7;
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .event-card h3 {
            margin: 0 0 10px;
            color: #ff416c;
        }

        .event-card p {
            margin: 5px 0;
            font-size: 16px;
            color: #555;
        }

        /* Ticket input */
        input[name="tickets"] {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        /* Stylish Pay Now button */
        .btn-pay {
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            padding: 12px 30px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            width: 100%;
        }

        .btn-pay:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(255,75,43,0.6);
        }

        /* Small note */
        .note {
            text-align: center;
            color: gray;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">

<h2>🎟 Ticket Booking</h2>
<p class="note">You are booking tickets for the selected event</p>

<div class="event-card">
    <h3><?php echo htmlspecialchars($e_name); ?></h3>
    <p><b>Date:</b> <?php echo htmlspecialchars($e_date); ?></p>
    <p><b>Time:</b> <?php echo htmlspecialchars($e_time); ?></p>
    <p><b>Venue:</b> <?php echo htmlspecialchars($venue); ?></p>
    <p><b>Ticket Price:</b> ₹<?php echo htmlspecialchars($ticket_price); ?></p>
</div>

<form method="post">
    <label><b>Enter Number of Tickets:</b></label>
    <input type="number" name="tickets" value="1" required>

    <button type="submit" class="btn-pay">💳 Pay Now</button>
</form>

</div>

</body>
</html>