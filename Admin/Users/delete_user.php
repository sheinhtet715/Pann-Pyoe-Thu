<?php
// delete_user.php
session_name('ADMINSESSID');
session_start();
require '../database/db_connection.php'; // make sure this defines $conn (mysqli)

// 1) Validate incoming id
if (empty($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['flash_error'] = 'Invalid user id.';
    header('Location: userlist.php');
    exit;
}

$id = (int) $_GET['id'];

// (Optional) check permissions - ensure only admins can delete
// if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
//     $_SESSION['flash_error'] = 'Permission denied.';
//     header('Location: userlist.php');
//     exit;
// }

// 2) Get the profile_path (so we can remove the file)
$profilePath = null;
$stmt = $conn->prepare("SELECT profile_path FROM User_tbl WHERE user_id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$res = $stmt->get_result();
if ($row = $res->fetch_assoc()) {
    $profilePath = $row['profile_path'];
} else {
    // user not found
    $_SESSION['flash_error'] = 'User not found.';
    $stmt->close();
    header('Location: userlist.php');
    exit;
}
$stmt->close();

// 3) Delete the user
$stmt = $conn->prepare("DELETE FROM User_tbl WHERE user_id = ? LIMIT 1");
$stmt->bind_param('i', $id);
$ok = $stmt->execute();
if (! $ok) {
    $_SESSION['flash_error'] = 'Failed to delete user: ' . $stmt->error;
    $stmt->close();
    header('Location: useruserlist.php');
    exit;
}
$stmt->close();

// 4) Remove profile image file (if any) — be careful with paths
if (!empty($profilePath)) {
    // profilePath in your app appears to be stored like "User_profile_images/filename.jpg"
    // build an absolute path and delete only if inside expected folder
    $file = __DIR__ . '/../' . $profilePath; // adjust if your stored path differs
    // basic safety: ensure path contains the expected folder name
    if (strpos($file, realpath(__DIR__ . '/../User_profile_images')) === 0) {
        if (file_exists($file) && is_file($file)) {
            @unlink($file);
        }
    }
}

// 5) Done
$_SESSION['flash_success'] = 'User deleted successfully.';
header('Location: userlist.php');
exit;
