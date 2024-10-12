<?php
// C:\xampp\htdocs\project-ai-gen\model-sox\load-more-posts.php
require_once 'includes/db.php';

// Fetch more posts from database
$sql = "SELECT * FROM posts LIMIT 10 OFFSET " . $_GET['offset'];
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="post">';
        echo '<img src="' . $row['image_url'] . '" alt="' . $row['caption'] . '">';
        echo '<p>' . $row['caption'] . '</p>';
        echo '</div>';
    }
} else {
    echo "No more posts found.";
}

// Close connection
mysqli_close($conn);
?>