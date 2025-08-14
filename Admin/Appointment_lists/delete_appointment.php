<?php
// Admin/Appointments/delete_appoinment.php
session_name('ADMINSESSID');
session_start();
require '../database/db_connection.php';



$id = isset($_GET['appointment_id']) ? (int)$_GET['appointment_id'] : 0;
if ($id <= 0) {
    $_SESSION['flash_error'] = 'Invalid id.';
    header('Location: appoinment.php'); exit;
}

$stmt = $conn->prepare("DELETE FROM Appointment_tbl WHERE appointment_id = ? LIMIT 1");
$stmt->bind_param('i', $id);
if ($stmt->execute()) {
    $_SESSION['flash_success'] = 'Appointment deleted.';
} else {
    $_SESSION['flash_error'] = 'Delete failed: ' . $stmt->error;
}
$stmt->close();
header('Location: appoinment.php');
exit;
