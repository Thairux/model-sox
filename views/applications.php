<?php
include_once 'connection.php';

$stmt = $conn->prepare("SELECT * FROM applications");
$stmt->execute();
$applications = $stmt->fetchAll();

?>

<!-- HTML code for the applications page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Applications</title>
    <link rel="stylesheet" href="applications.css">
</head>
<body>
    <h1>Manage Applications</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Job Title</th>
                <th>Applicant Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($applications as $application) { ?>
                <tr>
                    <td><?php echo $application['id']; ?></td>
                    <td><?php echo $application['job_title']; ?></td>
                    <td><?php echo $application['applicant_name']; ?></td>
                    <td>
                        <a href="edit_application.php?id=<?php echo $application['id']; ?>">Edit</a>
                        <a href="delete_application.php?id=<?php echo $application['id']; ?>">Delete</a>
                        <a href="respond_application.php?id=<?php echo $application['id']; ?>">Respond</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>