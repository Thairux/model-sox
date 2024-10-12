<?php
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'modelsox';

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    $error = 'Failed to connect to MySQL: ' . mysqli_connect_error();
} else {
    if (isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['role'])) {
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['role'])) {
            $error = 'Please complete the registration form';
        } else {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);
            $role = trim($_POST['role']);

            if ($stmt = $con->prepare('SELECT id FROM agencies WHERE email = ? UNION SELECT id FROM models WHERE email = ?')) {
                $stmt->bind_param('ss', $email, $email);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows > 0) {
                    $error = 'Email already exists, please choose another!';
                } else {
                    if ($role == 'agency') {
                        if ($stmt = $con->prepare('INSERT INTO agencies (name, email, password, role) VALUES (?, ?, ?, ?)')) {
                            $password = password_hash($password, PASSWORD_DEFAULT);
                            $stmt->bind_param('ssss', $name, $email, $password, $role);
                            if ($stmt->execute()) {
                                $success = 'You have successfully registered as an agency!';
                            } else {
                                $error = 'An error occurred: ' . $stmt->error;
                            }
                        } else {
                            $error = 'An error occurred, please try again!';
                        }
                    } elseif ($role == 'model') {
                        if ($stmt = $con->prepare('INSERT INTO models (name, email, password, role) VALUES (?, ?, ?, ?)')) {
                            $password = password_hash($password, PASSWORD_DEFAULT);
                            $stmt->bind_param('ssss', $name, $email, $password, $role);
                            if ($stmt->execute()) {
                                $success = 'You have successfully registered as a model!';
                            } else {
                                $error = 'An error occurred: ' . $stmt->error;
                            }
                        } else {
                            $error = 'An error occurred, please try again!';
                        }
                    } else {
                        $error = 'Invalid role, please try again!';
                    }
                }
            }
        }
    }
}

// Close the database connection
$con->close();
?>

<!-- HTML code remains the same -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>
    <?php if (isset($error)) { echo '<p style="color: red;">' . $error . '</p>'; } ?>
    <?php if (isset($success)) { echo '<p style="color: green;">' . $success . '</p>'; } ?>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name"><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <label for="role">Role:</label>
        <select id="role" name="role">
            <option value="agency">Agency</option>
            <option value="model">Model</option>
        </select><br><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>