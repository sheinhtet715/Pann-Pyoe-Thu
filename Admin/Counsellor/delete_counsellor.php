<?php
// delete_counsellor.php
session_start();
include '../database/db_connection.php';

if (empty($_GET['id']) || ! is_numeric($_GET['id'])) {
    // no valid ID → back to list
    header('Location: list.php');
    exit;
}

$id = (int) $_GET['id'];

// 1) Prepare & execute the DELETE
$stmt = $conn->prepare("
    DELETE FROM Counsellor_tbl
     WHERE counsellor_id = ?
    LIMIT 1
");
$stmt->bind_param('i', $id);

if (! $stmt->execute()) {
    // optionally, set an error in session to show on listing page
    $_SESSION['flash_error'] = "Failed to delete record: " . $stmt->error;
}

$stmt->close();
$conn->close();

// 2) Redirect back to the list
header('Location: list.php');
exit;
