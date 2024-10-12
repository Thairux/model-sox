<?php
include_once 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];

        $stmt = $conn->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
        $stmt->execute([$username, $email, $id]);

        header('Location: users.php');
        exit;
    }
}

?>

<!-- HTML code for the edit user page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="edit_user.css">
</head>
<body>
    <h1>Edit User</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $id; ?>" method="post">
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $user['username']; ?>">
        <br>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>">
        <br>
        <input type="submit" name="submit" value="Update">
    </form>
</body>
</html>