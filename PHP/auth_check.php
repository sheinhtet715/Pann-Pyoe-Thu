<?php
session_start();
require_once './db_connection.php';

if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Check user exists in DB
$stmt = $conn->prepare("SELECT user_id FROM user_tbl WHERE user_id = ? LIMIT 1");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    // User deleted or missing — destroy session and redirect
    session_unset();
    session_destroy();

    header('Location: login.php?msg=account_deleted');
    exit;
}
$stmt->close();
$conn->close();
?>
