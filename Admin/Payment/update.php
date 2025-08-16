<?php
session_name('ADMINSESSID');
session_start();
include '../database/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_id = $_POST['payment_id'] ?? null;
    $enrollment_id = $_POST['enrollment_id'] ?? null;
    $payment_status = $_POST['payment_status'] ?? null;

    if ($payment_id && $enrollment_id && in_array($payment_status, ['pending','confirm','reject'])) {
        // Begin transaction
        $conn->begin_transaction();
        try {
            // Update Payment_tbl
            $sql1 = "UPDATE Payment_tbl SET payment_status=? WHERE payment_id=?";
            $stmt1 = $conn->prepare($sql1);
            $stmt1->bind_param("si", $payment_status, $payment_id);
            $stmt1->execute();

            // Update Enrollment_tbl
            $sql2 = "UPDATE Enrollment_tbl SET payment_status=? WHERE enrollment_id=?";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->bind_param("si", $payment_status, $enrollment_id);
            $stmt2->execute();

            $conn->commit();
            echo "Status updated in both tables.";
        } catch (Exception $e) {
            $conn->rollback();
            http_response_code(500);
            echo "Error updating: " . $e->getMessage();
        }
    } else {
        http_response_code(400);
        echo "Invalid request.";
    }
}
