<?php
// Connect to database
require_once '../includes/db.php';

// Fetch agencies from database
$sql = "SELECT * FROM agencies";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    echo '<h2>Agencies</h2>';
    echo '<div class="agency-grid">';
    while ($agency = mysqli_fetch_assoc($result)) {
        echo '<div class="agency-card">';
        echo '<img src="' . $agency['profile_picture'] . '" alt="' . $agency['name'] . '">';
        echo '<h3>' . $agency['name'] . '</h3>';
        echo '<p>' . $agency['email'] . '</p>';
        echo '<p>' . $agency['phone'] . '</p>';
        echo '<p>' . $agency['address'] . '</p>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo "No agencies found.";
}

// Close connection
mysqli_close($conn);
?>