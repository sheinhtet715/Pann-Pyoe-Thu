<?php
// delete.php (for courses)
session_name('ADMINSESSID');
session_start();
include '../database/db_connection.php'; // should define $pdo as PDO

if (empty($_GET['course_id']) || !is_numeric($_GET['course_id'])) {
    // invalid or missing ID → redirect back
    header('Location: list.php');
    exit;
}

$course_id = (int) $_GET['course_id'];

try {
    $stmt = $pdo->prepare("DELETE FROM Course_tbl WHERE course_id = ? LIMIT 1");
    $stmt->execute([$course_id]);
    // optionally add a success flash message here
} catch (PDOException $e) {
    $_SESSION['flash_error'] = "Failed to delete record: " . $e->getMessage();
}

header('Location: list.php');
exit;
