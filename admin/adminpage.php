<?php
include_once 'connection.php';

// Display site analytics
$stmt = $conn->prepare("SELECT COUNT(*) as total_users FROM users");
$stmt->execute();
$total_users = $stmt->fetchColumn();

$stmt = $conn->prepare("SELECT COUNT(*) as total_jobs FROM jobs");
$stmt->execute();
$total_jobs = $stmt->fetchColumn();

$stmt = $conn->prepare("SELECT COUNT(*) as total_applications FROM applications");
$stmt->execute();
$total_applications = $stmt->fetchColumn();

// Display user activity
$stmt = $conn->prepare("SELECT * FROM users ORDER BY last_activity DESC LIMIT 10");
$stmt->execute();
$recent_users = $stmt->fetchAll();

// Display reports on job postings and applications
$stmt = $conn->prepare("SELECT * FROM jobs ORDER BY created_at DESC LIMIT 10");
$stmt->execute();
$recent_jobs = $stmt->fetchAll();

$stmt = $conn->prepare("SELECT * FROM applications ORDER BY created_at DESC LIMIT 10");
$stmt->execute();
$recent_applications = $stmt->fetchAll();
?>

<!-- HTML code for the admin dashboard -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <div class="analytics">
        <h2>Site Analytics</h2>
        <p>Total Users: <?php echo $total_users; ?></p>
        <p>Total Jobs: <?php echo $total_jobs; ?></p>
        <p>Total Applications: <?php echo $total_applications; ?></p>
    </div>
    <div class="user-activity">
        <h2>User Activity</h2>
        <ul>
            <?php foreach ($recent_users as $user) { ?>
                <li><?php echo $user['username']; ?> (Last Active: <?php echo $user['last_activity']; ?>)</li>
            <?php } ?>
        </ul>
    </div>
    <div class="job-reports">
        <h2>Job Reports</h2>
        <ul>
            <?php foreach ($recent_jobs as $job) { ?>
                <li><?php echo $job['title']; ?> (Posted: <?php echo $job['created_at']; ?>)</li>
            <?php } ?>
        </ul>
    </div>
    <div class="application-reports">
        <h2>Application Reports</h2>
        <ul>
            <?php foreach ($recent_applications as $application) { ?>
                <li><?php echo $application['job_title']; ?> (Applied: <?php echo $application['created_at']; ?>)</li>
            <?php } ?>
        </ul>
    </div>
</body>
</html>