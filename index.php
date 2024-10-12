<?php
session_start();

if (isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    include 'includes/db.php'; // Include the database connection file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modeling Agency Website</title>
    <link rel="stylesheet" href="assests/css/styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Models</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <?php if ($role == 'agency'): ?>
            <h2>Agency Dashboard</h2>
            <p>Here you can manage your models and bookings.</p>
            <!-- Add agency-specific features here -->
            <section class="post-feed">
                <?php include 'views/agencies.php'; ?>
            </section>
            <section class="suggested-models">
                <!-- Suggested models content will go here -->
            </section>
        <?php elseif ($role == 'model'): ?>
            <h2>Model Dashboard</h2>
            <p>Here you can view your bookings and profile.</p>
            <!-- Add model-specific features here -->
            <section class="post-feed">
                <?php include 'views/models.php'; ?>
            </section>
        <?php else: ?>
            <p>Invalid role!</p>
        <?php endif; ?>
    </main>
    <footer>
        <!-- Footer content will go here -->
    </footer>
    <script src="assests/js/script.js"></script>
    <a href="logout.php">Logout</a>
</body>
</html>

<?php
} else {
    // Display the home page
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modeling Agency Website</title>
    <link rel="stylesheet" href="assests/css/styles.css">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Models</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Welcome to our website!</h2>
        <p>This is the home page.</p>
        <p><a href="login.php">Login</a> or <a href="register.php">Register</a> to access more features.</p>
    </main>
    <footer>
        <!-- Footer content will go here -->
    </footer>
    <script src="assests/js/script.js"></script>
</body>
</html>

<?php
}
?>