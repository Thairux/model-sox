<?php include_once 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("UPDATE jobs SET published = 1 WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: jobs.php');
    exit;
}
?>