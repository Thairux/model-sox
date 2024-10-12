<?php
include_once 'connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("UPDATE users SET banned = 1 WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: users.php');
    exit;
}
?>