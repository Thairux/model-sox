<?php
// Get the booking ID from the URL
$booking_id = $_GET['id'];

// Query the database to retrieve the booking details
$sql = "SELECT * FROM bookings WHERE id = $booking_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h2>Booking Details</h2>";
    echo "<p>ID: " . $row["id"]. "</p>";
    echo "<p>Name: " . $row["name"]. "</p>";
    echo "<p>Email: " . $row["email"]. "</p>";
    echo "<p>Booking Date: " . $row["booking_date"]. "</p>";
    echo "<p>Booking Time: " . $row["booking_time"]. "</p>";
} else {
    echo "Booking not found";
}
?>