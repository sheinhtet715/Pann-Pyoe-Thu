<?php
// Admin/Appointments/status_update.php
session_name('ADMINSESSID');
session_start();
require '../database/db_connection.php';

if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php'); exit;
}

$id = isset($_GET['appointment_id']) ? (int)$_GET['appointment_id'] : 0;
$status = $_GET['status'] ?? '';

$allowed = ['Confirmed','Cancelled','Completed'];
if ($id <= 0 || !in_array($status, $allowed, true)) {
    $_SESSION['flash_error'] = 'Invalid request.';
    header('Location: appoinment.php'); exit;
}

$stmt = $conn->prepare("UPDATE Appointment_tbl SET appointment_status = ? WHERE appointment_id = ? LIMIT 1");
$stmt->bind_param('si', $status, $id);
if ($stmt->execute()) {
    $_SESSION['flash_success'] = 'Status updated.';
} else {
    $_SESSION['flash_error'] = 'Update failed: ' . $stmt->error;
}
$stmt->close();
header('Location: appoinment.php');
exit;
