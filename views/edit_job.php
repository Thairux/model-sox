<?php
include_once 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM jobs WHERE id = ?");
    $stmt->execute([$id]);
    $job = $stmt->fetch();

    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $description = $_POST['description'];

        $stmt = $conn->prepare("UPDATE jobs SET title = ?, description = ? WHERE id = ?");
        $stmt->execute([$title, $description, $id]);

        header('Location: jobs.php');
        exit;
    }
}

?>

<!-- HTML code for the edit job page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Job</title>
    <link rel="stylesheet" href="edit_job.css">
</head>
<body>
    <h1>Edit Job</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $id; ?>" method="post">
        <label>Job Title:</label>
        <input type="text" name="title" value="<?php echo $job['title']; ?>">
        <br>
        <label>Job Description:</label>
        <textarea name="description"><?php echo $job['description']; ?></textarea>
        <br>
        <input type="submit" name="submit" value="Update">
    </form>
</body>
</html>