<?php
// delete_user.php
ini_set('display_errors',1);
error_reporting(E_ALL);

session_name('ADMINSESSID');
session_start();
require '../database/db_connection.php'; // $conn (mysqli)

// Validate id
if (empty($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['flash_error'] = 'Invalid user id.';
    header('Location: userlist.php');
    exit;
}
$id = (int)$_GET['id'];

try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $inTransaction = false;

    // 1) Get profile_path first (so we can remove file later)
    $profilePath = null;
    $stmt = $conn->prepare("SELECT profile_path FROM User_tbl WHERE user_id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        $profilePath = $row['profile_path'];
    } else {
        $stmt->close();
        $_SESSION['flash_error'] = 'User not found.';
        header('Location: userlist.php');
        exit;
    }
    $stmt->close();

    // 2) Start transaction
    $conn->begin_transaction();
    $inTransaction = true;

    // 3) Delete payments that reference the user's enrollments
    $stmt = $conn->prepare("
        DELETE p
        FROM payment_tbl p
        INNER JOIN enrollment_tbl e ON p.enrollment_id = e.enrollment_id
        WHERE e.user_id = ?
    ");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $deletedPayments = $stmt->affected_rows;
    $stmt->close();

    // 4) Delete other tables that reference user_tbl directly (adjust table names if needed)
    $directTables = ['appointment_tbl', 'favouritescholarship_tbl', 'login_tbl', 'user_course_tbl'];
    foreach ($directTables as $t) {
        $q = "DELETE FROM {$t} WHERE user_id = ?";
        $stmt = $conn->prepare($q);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
    }

    // 5) Delete enrollments for the user
    $stmt = $conn->prepare("DELETE FROM enrollment_tbl WHERE user_id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $deletedEnrollments = $stmt->affected_rows;
    $stmt->close();

    // 6) Delete the user
    $stmt = $conn->prepare("DELETE FROM User_tbl WHERE user_id = ? LIMIT 1");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $deletedUsers = $stmt->affected_rows;
    $stmt->close();

    if ($deletedUsers !== 1) {
        // rollback & abort if user wasn't deleted
        $conn->rollback();
        $inTransaction = false;
        $_SESSION['flash_error'] = 'User could not be deleted (no rows affected).';
        header('Location: userlist.php');
        exit;
    }

    // 7) Commit transaction
    $conn->commit();
    $inTransaction = false;

    // 8) Immediately remove session files for that user (force logout)
    //    We already deleted login_tbl rows above; but to be safe, find any session ids that were stored earlier.
    //    If you want to find them prior to deleting login_tbl, you can query BEFORE step 4.
    // (We attempt to remove session files named sess_<session_id> in session_save_path)
    $savePath = session_save_path();
    if (empty($savePath)) $savePath = sys_get_temp_dir();
    // If session files are stored inside a subdir, ensure you have correct path.

    // Attempt to remove session files by scanning for sess_<id> that contain the user_id
    // (fallback if login_tbl rows were already deleted above). This is a best-effort attempt.
    $pattern = '/sess_/';

    if (is_dir($savePath) && ($dh = opendir($savePath))) {
        while (($file = readdir($dh)) !== false) {
            if (strpos($file, 'sess_') === 0) {
                $full = $savePath . DIRECTORY_SEPARATOR . $file;
                // Best-effort: if file contains the user id inside (some apps write user id in session data)
                // read small portion to avoid heavy IO
                $contents = @file_get_contents($full, false, null, 0, 4096);
                if ($contents !== false && strpos($contents, (string)$id) !== false) {
                    @unlink($full);
                }
            }
        }
        closedir($dh);
    }

    // NOTE: If you stored session_id values in Login_tbl before deleting them (preferred),
    // you can remove those specific files. Example (if you captured session ids earlier):
    // foreach ($sids as $sid) { @unlink(rtrim($savePath, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'sess_' . $sid); }

    // 9) Remove profile image file after commit
    if (!empty($profilePath)) {
        $uploadDir = realpath(__DIR__ . '/../User_profile_images');
        $filePath = realpath(__DIR__ . '/../' . $profilePath);
        if ($uploadDir && $filePath && strpos($filePath, $uploadDir) === 0) {
            if (file_exists($filePath) && is_file($filePath)) {
                @unlink($filePath);
            }
        }
    }

    $_SESSION['flash_success'] = 'User deleted successfully. Payments deleted: ' . $deletedPayments . '; Enrollments deleted: ' . $deletedEnrollments;
    header('Location: userlist.php');
    exit;

} catch (Exception $e) {
    if (isset($inTransaction) && $inTransaction) {
        $conn->rollback();
    }
    error_log('delete_user error: ' . $e->getMessage());
    $_SESSION['flash_error'] = 'Failed to delete user: ' . htmlspecialchars($e->getMessage());
    header('Location: userlist.php');
    exit;
}
