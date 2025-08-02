<?php
// Admin/Scholarship/delete.php
session_start();
include '../database/db_connection.php';

if (empty($_GET['id']) || ! is_numeric($_GET['id'])) {
  header('Location: list.php');
  exit;
}
$id = (int)$_GET['id'];

$stmt = $conn->prepare("
  DELETE FROM Scholarship_tbl
   WHERE scholarship_id = ?
  LIMIT 1
");
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
  $_SESSION['flash_success'] = "Scholarship #{$id} deleted.";
} else {
  $_SESSION['flash_error']   = "Delete failed: " . $stmt->error;
}

$stmt->close();
$conn->close();

header('Location: list.php');
exit;
