<?php
session_name('ADMINSESSID');
session_start();
include '../database/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_id = $_POST['payment_id'] ?? null;
    $enrollment_id = $_POST['enrollment_id'] ?? null;

    if ($payment_id && $enrollment_id) {
        // delete enrollment (payment will auto-delete via FK cascade)
        $sql = "DELETE FROM Enrollment_tbl WHERE enrollment_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $enrollment_id);

        if ($stmt->execute()) {
            echo "Enrollment and related payment deleted successfully.";
        } else {
            http_response_code(500);
            echo "Error deleting record.";
        }
    } else {
        http_response_code(400);
        echo "Invalid request.";
    }
}
