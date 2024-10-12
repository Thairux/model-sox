<?php
// Database connection
$conn = mysqli_connect("localhost", "username", "password", "database_name");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the booking ID from the URL
$booking_id = $_GET['id'];

// Query the database to retrieve the booking details
$stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ?");
$stmt->bind_param("i", $booking_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<h2>Booking Details</h2>";
    echo "<p>ID: " . $row["id"]. "</p>";
    echo "<p>Model: " . getModelName($row["model_id"]). "</p>";
    echo "<p>Agency: " . getAgencyName($row["agency_id"]). "</p>";
    echo "<p>Booking Date: " . $row["booking_date"]. "</p>";
    echo "<p>Start Time: " . $row["start_time"]. "</p>";
    echo "<p>End Time: " . $row["end_time"]. "</p>";
    echo "<p>Location: " . $row["location"]. "</p>";
} else {
    echo "Booking not found";
}

// Function to get model name
function getModelName($model_id) {
    global $conn;
    $sql = "SELECT name FROM models WHERE id = '$model_id'";
    $result = $conn->query($sql);
    $model = $result->fetch_assoc();
    return $model['name'];
}

// Function to get agency name
function getAgencyName($agency_id) {
    global $conn;
    $sql = "SELECT name FROM agencies WHERE id = '$agency_id'";
    $result = $conn->query($sql);
    $agency = $result->fetch_assoc();
    return $agency['name'];
}
?>