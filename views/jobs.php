<?php
include_once 'connection.php';

$stmt = $conn->prepare("SELECT * FROM jobs");
$stmt->execute();
$jobs = $stmt->fetchAll();

?>

<!-- HTML code for the jobs page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Jobs</title>
    <link rel="stylesheet" href="jobs.css">
</head>
<body>
    <h1>Manage Jobs</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Job Title</th>
                <th>Job Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jobs as $job) { ?>
                <tr>
                    <td><?php echo $job['id']; ?></td>
                    <td><?php echo $job['title']; ?></td>
                    <td><?php echo $job['description']; ?></td>
                    <td>
                        <a href="edit_job.php?id=<?php echo $job['id']; ?>">Edit</a>
                        <a href="delete_job.php?id=<?php echo $job['id']; ?>">Delete</a>
                        <a href="publish_job.php?id=<?php echo $job['id']; ?>">Publish</a>
                        <a href="unpublish_job.php?id=<?php echo $job['id']; ?>">Unpublish</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>