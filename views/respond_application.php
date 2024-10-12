<?php
include_once 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM applications WHERE id = ?");
    $stmt->execute([$id]);
    $application = $stmt->fetch();

    if (isset($_POST['submit'])) {
        $response = $_POST['response'];

        $stmt = $conn->prepare("UPDATE applications SET response = ? WHERE id = ?");
        $stmt->execute([$response, $id]);

        header('Location: applications.php');
        exit;
    }
}

?>

<!-- HTML code for the respond application page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respond to Application</title>
    <link rel="stylesheet" href="respond_application.css">
</head>
<body>
    <h1>Respond to Application</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $id; ?>" method="post">
        <label>Response:</label>
        <textarea name="response"><?php echo $application['response']; ?></textarea>
        <br>
        <input type="submit" name="submit" value="Respond">
    </form>
</body>
</html>