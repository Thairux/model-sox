<!-- C:\xampp\htdocs\project-ai-gen\model-sox\views\models.php -->
<?php
// Connect to database
require_once '../includes/db.php';

// Fetch models from database
$sql = "SELECT * FROM models";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="model-card">';
        echo '<img src="' . $row['image_url'] . '" alt="' . $row['name'] . '">';
        echo '<h2>' . $row['name'] . '</h2>';
        echo '<p>' . $row['bio'] . '</p>';
        echo '</div>';
    }
} else {
    echo "No models found.";
}

// Close connection
mysqli_close($conn);
?>