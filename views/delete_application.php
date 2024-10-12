<?php
include_once 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM applications WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: applications.php');
    exit;
}
?>