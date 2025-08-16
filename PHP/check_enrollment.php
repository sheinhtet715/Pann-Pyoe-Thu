<?php
declare(strict_types=1);
session_start();

header('Content-Type: application/json; charset=UTF-8');
require './db_connection.php'; 
try {
    // Ensure user logged in
    if (empty($_SESSION['user_id'])) {
        echo json_encode(['status' => 'unauthenticated']);
        exit;
    }
    $user_id = (int) $_SESSION['user_id'];

    // Validate input
    $course_name = trim($_POST['course_name'] ?? '');
    if ($course_name === '') {
        echo json_encode(['status' => 'invalid', 'message' => 'Missing course_name']);
        exit;
    }

    // Find course_id
    $stmt = $conn->prepare('SELECT course_id FROM course_tbl WHERE course_name = ? LIMIT 1');
    $stmt->bind_param('s', $course_name);
    $stmt->execute();
    $res = $stmt->get_result();
    if (!$res || !$res->num_rows) {
        echo json_encode(['status' => 'not_found', 'message' => 'Course not found']);
        exit;
    }
    $course_id = (int) $res->fetch_assoc()['course_id'];
    $stmt->close();

    // Check enrollment
    $check = $conn->prepare('SELECT 1 FROM enrollment_tbl WHERE user_id = ? AND course_id = ? LIMIT 1');
    $check->bind_param('ii', $user_id, $course_id);
    $check->execute();
    $exists = $check->get_result()->num_rows > 0;
    $check->close();

    echo json_encode(['status' => $exists ? 'exists' : 'not_enrolled']);
} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Server error']);
}
