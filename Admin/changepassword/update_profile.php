<?php
session_name('ADMINSESSID');
session_start();
require '../database/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: profile.php');
    exit;
}

$user_id   = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
$user_name = trim($_POST['user_name'] ?? '');
$email     = trim($_POST['email'] ?? '');
$phone     = trim($_POST['phone'] ?? '');

// Basic validation
if ($user_id <= 0 || $user_name === '' || $email === '') {
    die('Missing required fields.');
}

// File upload handling
$profile_path= null;
if (!empty($_FILES['profile_pic']['name']) && $_FILES['profile_pic']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = __DIR__ . '/../../User_profile_images/'; // server filesystem path
    if (!is_dir($upload_dir)) {
        if (!mkdir($upload_dir, 0755, true)) {
            die('Failed to create upload directory.');
        }
    }

    $origName = $_FILES['profile_pic']['name'];
    $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
    $allowed = [
        // Raster formats
        'jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'tif', 'webp', 'heif', 'heic', 'avif',

        // Camera RAW formats
        'cr2', 'cr3', 'nef', 'arw', 'orf', 'rw2', 'dng',

        // Vector formats
        'svg', 'ai', 'eps', 'pdf',

        // Special / less common
        'ico', 'cur', 'xcf', 'psd', 'psb', 'hdr', 'exr', 'tga'
    ];
    if (!in_array($ext, $allowed)) {
        die('File type not allowed. Use JPG/PNG/GIF.');
    }

    // Unique filename: userID_time_random.ext
    $newFileName = $user_id . '_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
    $targetFile = $upload_dir . $newFileName;

    if (!move_uploaded_file($_FILES['profile_pic']['tmp_name'], $targetFile)) {
        die('Failed to move uploaded file. Check permissions on uploads/ folder.');
    }

    // Store relative web path (no ../) so the frontend can use <img src="uploads/filename">
    $profile_path = '/User_profile_images/' . $newFileName;
}

// Use prepared statements to avoid injection
if ($profile_path) {
    $sql = "UPDATE User_tbl SET user_name = ?, email = ?, phone = ?, profile_path = ? WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssssi', $user_name, $email, $phone, $profile_path, $user_id);
} else {
    $sql = "UPDATE User_tbl SET user_name = ?, email = ?, phone = ? WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssi', $user_name, $email, $phone, $user_id);
}

if (!$stmt) {
    die('Prepare failed: ' . mysqli_error($conn));
}

if (mysqli_stmt_execute($stmt)) {
    // optional: check affected rows
    $affected = mysqli_stmt_affected_rows($stmt);
    // Redirect back to profile page for the updated user (so profile.php shows the updated row)
    header("Location: profile.php?user_id={$user_id}&updated=1");
    exit;
} else {
    // show DB error for debugging (replace with nicer UI in production)
    die('Update failed: ' . mysqli_error($conn));
}
?>
