<?php
// update_profile.php
session_start();
require_once './db_connection.php'; // should provide $conn (mysqli)

if (empty($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: profile.php');
    exit;
}

$old     = trim($_POST['oldPassword']    ?? '');
$new     = trim($_POST['newPassword']    ?? '');
$confirm = trim($_POST['confirmPassword'] ?? '');

if ($old === '' || $new === '' || $confirm === '') {
    $_SESSION['profile_error'] = 'Please fill in all fields.';
    header('Location: profile.php');
    exit;
}

if ($new !== $confirm) {
    $_SESSION['profile_error'] = 'New password and confirmation do not match.';
    header('Location: profile.php');
    exit;
}

if (strlen($new) < 8) {
    $_SESSION['profile_error'] = 'New password must be at least 8 characters.';
    header('Location: profile.php');
    exit;
}

if ($old === $new) {
    $_SESSION['profile_error'] = 'New password must be different from old password.';
    header('Location: profile.php');
    exit;
}

// fetch current hash
$stmt = $conn->prepare("SELECT password_hash FROM User_tbl WHERE user_id = ? LIMIT 1");
if (!$stmt) {
    $_SESSION['profile_error'] = 'Internal error (prepare failed).';
    header('Location: profile.php');
    exit;
}
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows !== 1) {
    $stmt->close();
    $_SESSION['profile_error'] = 'User not found.';
    header('Location: profile.php');
    exit;
}

$stmt->bind_result($currentHash);
$stmt->fetch();
$stmt->close();

// verify old password
$verified = false;

if (password_verify($old, $currentHash)) {
    $verified = true;
} elseif (md5($old) === $currentHash) {
    // legacy MD5 match — allow but rehash to modern algorithm below
    $verified = true;
} else {
    $_SESSION['profile_error'] = 'Old password is incorrect.';
    header('Location: profile.php');
    exit;
}

// hash new password with PHP's password_hash (bcrypt/argon2 depending on config)
$newHash = password_hash($new, PASSWORD_DEFAULT);

// update
$upd = $conn->prepare("UPDATE User_tbl SET password_hash = ? WHERE user_id = ?");
if (!$upd) {
    $_SESSION['profile_error'] = 'Internal error (prepare failed on update).';
    header('Location: profile.php');
    exit;
}
$upd->bind_param('si', $newHash, $_SESSION['user_id']);

if ($upd->execute()) {
    $_SESSION['profile_success'] = 'Password changed successfully.';
} else {
    $_SESSION['profile_error'] = 'Failed to update password. Please try again later.';
}
$upd->close();

header('Location: profile.php');
exit;
