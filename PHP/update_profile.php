<?php
// update_profile.php
session_start();
require_once './db_connection.php';

// Redirect if not logged in
if (empty($_SESSION['user_id'])) {
    header('Location: profile.php');
    exit;
}

$userId   = $_SESSION['user_id'];
$newName  = trim($_POST['user_name'] ?? '');
$newEmail = trim($_POST['email']     ?? '');
$newPhone = trim($_POST['phone']     ?? '');
$uploadDir   = __DIR__ . '/../User_profile_images/';
$profilePath = null;
// Prepare file upload if provided

if (!empty($_FILES['profile_image']['name'])) {
    $origName   = basename($_FILES['profile_image']['name']);
    $ext        = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
    $allowed    = ['jpg','jpeg','png','gif'];

    if (!in_array($ext, $allowed)) {
        $_SESSION['profile_error'] = 'Invalid file type.';
        header('Location: profile.php'); exit;
    }

    $targetName = uniqid('prof_', true) . '.' . $ext;
    $targetFile = $uploadDir . $targetName;

    if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFile)) {
        $_SESSION['profile_error'] = 'Failed to upload image.';
        header('Location: profile.php'); exit;
    }

    // this is exactly the folder you just uploaded into:
    $profilePath = 'User_profile_images/' . $targetName;
}

// Build dynamic UPDATE
$fields = ['user_name = ?', 'email = ?', 'phone = ?'];
$params = [$newName, $newEmail, $newPhone];
$types  = 'sss';

if ($profilePath !== null) {
    $fields[]  = 'profile_path = ?';
    $params[]  = $profilePath;
    $types    .= 's';
}

$sql = 'UPDATE User_tbl SET ' . implode(', ', $fields) . ' WHERE user_id = ?';
$params[] = $userId;
$types   .= 'i';

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);

if ($stmt->execute()) {
    $_SESSION['profile_success'] = 'Profile updated successfully.';
} else {
    $_SESSION['profile_error'] = 'Update failed: ' . $stmt->error;
}

$stmt->close();
$conn->close();

header('Location: profile.php');
exit;
