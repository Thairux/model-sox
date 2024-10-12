<?php
// Database connection
$conn = mysqli_connect("localhost", "username", "password", "database_name");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
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

// Query to retrieve bookings
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);
$bookings = array();
while($row = $result->fetch_assoc()) {
    $bookings[] = $row;
}

// Display bookings
?>
<h2>Bookings</h2>
<div class="booking-grid">
    <?php foreach($bookings as $booking) { ?>
        <div class="booking-card">
            <h3>Model: <?php echo getModelName($booking['model_id']); ?></h3>
            <p>Agency: <?php echo getAgencyName($booking['agency_id']); ?></p>
            <p>Booking Date: <?php echo $booking['booking_date']; ?></p>
            <p>Start Time: <?php echo $booking['start_time']; ?></p>
            <p>End Time: <?php echo $booking['end_time']; ?></p>
            <p>Location: <?php echo $booking['location']; ?></p>
        </div>
    <?php } ?>
</div>

<!-- Create New Booking Form -->
<h2>Create New Booking</h2>
<form action="views/bookings.php" method="post">
    <label for="model_id">Model ID:</label>
    <input type="number" id="model_id" name="model_id" required><br><br>
    <label for="agency_id">Agency ID:</label>
    <input type="number" id="agency_id" name="agency_id" required><br><br>
    <label for="booking_date">Booking Date:</label>
    <input type="date" id="booking_date" name="booking_date" required><br><br>
    <label for="start_time">Start Time:</label>
    <input type="time" id="start_time" name="start_time" required><br><br>
    <label for="end_time">End Time:</label>
    <input type="time" id="end_time" name="end_time" required><br><br>
    <label for="location">Location:</label>
    <input type="text" id="location" name="location" required><br><br>
    <input type="submit" value="Create Booking">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['model_id'])) {
    $model_id = $_POST["model_id"];
    $agency_id = $_POST["agency_id"];
    $booking_date = $_POST["booking_date"];
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];
    $location = $_POST["location"];

    $sql = "INSERT INTO bookings (model_id, agency_id, booking_date, start_time, end_time, location) VALUES ('$model_id', '$agency_id', '$booking_date', '$start_time', '$end_time', '$location')";
    $conn->query($sql);
}
?>

<!-- Update Booking Form -->
<h2>Update Booking</h2>
<form action="views/bookings.php" method="post">
    <label for="id">Booking ID:</label>
    <input type="number" id="id" name="id" required><br><br>
    <label for="model_id">Model ID:</label>
    <input type="number" id="model_id" name="model_id"><br><br>
    <label for="agency_id">Agency ID:</label>
    <input type="number" id="agency_id" name="agency_id"><br><br>
    <label for="booking_date">Booking Date:</label>
    <input type="date" id="booking_date" name="booking_date"><br><br>
    <label for="start_time">Start Time:</label>
    <input type="time" id="start_time" name="start_time"><br><br>
    <label for="end_time