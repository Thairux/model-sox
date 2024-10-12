<?php
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'modelsox';

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Check if the form has been submitted
if (isset($_POST['email'], $_POST['password'])) {
    // Now we check if the data was submitted, isset() function will check if the data exists.
    if (!isset($_POST['email'], $_POST['password'])) {
        // Could not get the data that should have been sent.
        exit('Please complete the registration form!');
    }

    // Make sure the submitted registration values are not empty.
    if (empty($_POST['email']) || empty($_POST['password'])) {
        // One or more values are empty.
        exit('Please complete the registration form');
    }

    // Check if the email and password are correct.
    if ($stmt = $con->prepare('SELECT id, password, role FROM agencies WHERE email = ? UNION SELECT id, password, role FROM models WHERE email = ?')) {
        $stmt->bind_param('ss', $_POST['email'], $_POST['email']);
        $stmt->execute();
        $stmt->store_result();

        // If the email and password are correct, we show the user the dashboard.
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $password, $role);
            $stmt->fetch();

            // Verify the password.
            if (password_verify($_POST['password'], $password)) {
                // Create a session for the user.
                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['role'] = $role;

                // Redirect the user to the dashboard.
                if ($role == 'agency') {
                    header("Location: index.php");
                } elseif ($role == 'model') {
                    header("Location: index.php");
                } else {
                    exit('Invalid role!');
                }
            } else {
                exit('Incorrect password!');
            }
        } else {
            exit('Email does not exist!');
        }
    }
} else {
    // Display the login form
    ?>
    <h2>Login</h2>
    <form action="" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
    <?php
}
?>