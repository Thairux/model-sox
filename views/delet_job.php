<?php
include_once 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM jobs WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: jobs.php');
    exit;
}
?>