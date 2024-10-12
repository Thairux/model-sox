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
    <label for="end_time">End Time:</label>
    <input type="time" id="end_time" name="end_time"><br><br>
    <label for="location">Location:</label>
    <input type="text" id="location" name="location"><br><br>
    <input type="submit" value="Update Booking">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST["id"];
    $model_id = $_POST["model_id"];
    $agency_id = $_POST["agency_id"];
    $booking_date = $_POST["booking_date"];
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];
    $location = $_POST["location"];

    $sql = "UPDATE bookings SET model_id='$model_id', agency_id='$agency_id', booking_date='$booking_date', start_time='$start_time', end_time='$end_time', location='$location' WHERE id='$id'";
    $conn->query($sql);
}
?>
<!-- Delete Booking Form -->
<h2>Delete Booking</h2>
<form action="views/bookings.php" method="post">
    <label for="id">Booking ID:</label>
    <input type="number" id="id" name="id" required><br><br>
    <input type="submit" value="Delete Booking">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST["id"];

    $sql = "DELETE FROM bookings WHERE id='$id'";
    $conn->query($sql);
}
?>
<!-- Search Bookings Form -->
<h2>Search Bookings</h2>
<form action="views/bookings.php" method="get">
    <label for="search">Search by Name:</label>
    <input type="text" id="search" name="search" required>
    <input type="submit" value="Search">
</form>
<?php
$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = "SELECT * FROM bookings WHERE name LIKE '%$search%'";
} else {
    $sql = "SELECT * FROM bookings";
}

// Pagination
$limit = 10; // Number of bookings per page
$page = 1; // Current page
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

$offset = ($page - 1) * $limit;

$sql .= " LIMIT $offset, $limit";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["email"]. "</td><td><a href='booking_details.php?id=" . $row["id"] . "'>View Details</a></td></tr>";
    }
    echo "</table>";

    // Pagination links
    $total_rows = $conn->query("SELECT COUNT(*) FROM bookings")->fetch_assoc()['COUNT(*)'];
    $total_pages = ceil($total_rows / $limit);
    echo "<ul>";
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<li><a href='?page=$i'>$i</a></li>";
    }
    echo "</ul>";
} else {
    echo "0 results";
}
?>