<?php
// Include the database connection file
include_once 'connection.php';

// Check if the query parameter is set
if (isset($_GET['query'])) {
    // Validate the query parameter
    $query = trim($_GET['query']);
    if (empty($query)) {
        echo "Please enter a search query.";
        exit;
    }

    // Prepare the SQL queries
    $stmt = $conn->prepare("SELECT * FROM jobs WHERE title LIKE ? OR description LIKE ?");
    $stmt->bind_param("ss", $query, $query);
    $stmt->execute();
    $jobs = $stmt->get_result();

    $stmt = $conn->prepare("SELECT * FROM applications WHERE job_title LIKE ? OR applicant_name LIKE ?");
    $stmt->bind_param("ss", $query, $query);
    $stmt->execute();
    $applications = $stmt->get_result();

    // Check for errors
    if ($stmt->errno) {
        echo "Error: " . $stmt->error;
        exit;
    }
}

// Display the search results
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="search.css">
</head>
<body>
    <h1>Search</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <label>Search:</label>
        <input type="text" name="query" value="<?php echo isset($query) ? $query : ''; ?>">
        <br>
        <input type="submit" value="Search">
    </form>

    <?php if (isset($jobs) && $jobs->num_rows > 0) { ?>
        <h2>Jobs</h2>
        <ul>
            <?php while ($job = $jobs->fetch_assoc()) { ?>
                <li>
                    <a href="edit_job.php?id=<?php echo $job['id']; ?>"><?php echo $job['title']; ?></a>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>

    <?php if (isset($applications) && $applications->num_rows > 0) { ?>
        <h2>Applications</h2>
        <ul>
            <?php while ($application = $applications->fetch_assoc()) { ?>
                <li>
                    <a href="edit_application.php?id=<?php echo $application['id']; ?>"><?php echo $application['job_title']; ?> (<?php echo $application['applicant_name']; ?>)</a>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
</body>
</html>