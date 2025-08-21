<?php
// ===== login.php =====
// Handles sign-in and sign-up, records session_id in Login_tbl for session management.

session_start();
require_once "./db_connection.php"; // make sure this provides $conn (mysqli)

// Helper: sanitize incoming string inputs
function sv($v) {
    return trim($v ?? '');
}

$username = sv($_POST['user_name'] ?? '');
$email    = sv($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$error    = '';
$success  = '';

if (isset($_POST['signin'])) {
    // Basic validation
    if ($username === '' || $email === '' || $password === '') {
        $error = 'Please enter your username, email, and password.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif (!preg_match('/^[A-Za-z0-9_ ]{3,30}$/', $username)) {
        $error = 'Usernames must be 3–30 chars and only letters, numbers, underscores, and spaces.';
    } elseif (preg_match('/\s/', $password)) {
        $error = 'Password cannot contain spaces.';
    } else {
        // Look up user by email + username
        $sql = "
          SELECT user_id, user_name, email, password_hash, role, profile_path
            FROM user_tbl
           WHERE email = ?
             AND user_name = ?
           LIMIT 1
        ";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            $error = 'Internal error (prepare failed).';
        } else {
            $stmt->bind_param("ss", $email, $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result && $result->num_rows === 1) {
                $user = $result->fetch_assoc();

                $currentHash = $user['password_hash'] ?? '';
                $loginHashToStore = $currentHash; // value to record in Login_tbl (may be updated if we rehash)

                $passwordOk = false;

                // Preferred: modern verification
                if ($currentHash !== '' && password_verify($password, $currentHash)) {
                    $passwordOk = true;
                } elseif ($currentHash !== '' && md5($password) === $currentHash) {
                    // Legacy MD5 match — allow login but upgrade to password_hash
                    $passwordOk = true;
                    $newHash = password_hash($password, PASSWORD_DEFAULT);

                    // update user's hash in user_tbl
                    $uupd = $conn->prepare("UPDATE user_tbl SET password_hash = ? WHERE user_id = ?");
                    if ($uupd) {
                        $uupd->bind_param('si', $newHash, $user['user_id']);
                        $uupd->execute();
                        $uupd->close();
                        $loginHashToStore = $newHash; // store the upgraded hash in Login_tbl
                    } else {
                        // If update fails, still allow login but keep old hash in the login table
                        // (Alternatively, you could set an error here.)
                        // leave $loginHashToStore as-is
                    }
                }

                if ($passwordOk) {
                    // Success: regenerate session id, set session vars, and record session in Login_tbl
                    session_regenerate_id(true);
                    $sid = session_id();

                    $_SESSION['user_id']   = $user['user_id'];
                    $_SESSION['user_name'] = $user['user_name'];
                    $_SESSION['email']     = $user['email'];
                    if (!empty($user['profile_path'])) {
                        $_SESSION['profile_path'] = $user['profile_path'];
                    }

                    // client metadata
                    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
                    $ua = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 250);
                    $role = $user['role'] ?? 'user';

                    // Insert login/session row into Login_tbl
                    $insertLogin = $conn->prepare("
                      INSERT INTO Login_tbl (
                        user_id, session_id, user_name, email, password_hash, role, ip_address, user_agent, last_active
                      ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
                    ");
                    if ($insertLogin) {
                        $insertLogin->bind_param(
                            "isssssss",
                            $user['user_id'],
                            $sid,
                            $user['user_name'],
                            $user['email'],
                            $loginHashToStore,
                            $role,
                            $ip,
                            $ua
                        );
                        $insertLogin->execute();
                        $insertLogin->close();
                    }
                    $success = 'Signed in successfully.';
                } else {
                    $error = 'Incorrect password.';
                }
            } else {
                $error = 'No account matches that username & email.';
            }
            $stmt->close();
        }
    }
}

// -------- SIGN UP --------
if (isset($_POST['signup'])) {
    // Validation
    if ($username === '' || $email === '' || $password === '') {
        $error = 'Please enter your username, email, and password.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif (!preg_match('/^[A-Za-z0-9_ ]{3,30}$/', $username)) {
        $error = 'Usernames must be 3–30 chars and only letters, numbers, underscores, and spaces.';
    } elseif (preg_match('/\s/', $password)) {
        $error = 'Password cannot contain spaces.';
    } elseif (isset($_POST['phone']) && $_POST['phone'] !== '' && !preg_match('/^\+?\d{7,15}$/', $_POST['phone'])) {
        $error = 'Please enter a valid phone number (7-15 digits, optional +).';
    } else {
        // Check for existing account
        $sql = "SELECT 1 FROM user_tbl WHERE user_name = ? OR email = ? LIMIT 1";
        $chk = $conn->prepare($sql);
        if (!$chk) {
            $error = 'Internal error (prepare failed).';
        } else {
            $chk->bind_param("ss", $username, $email);
            $chk->execute();
            $res = $chk->get_result();
            if ($res->num_rows > 0) {
                $error = "That username or email is already taken.";
            } else {
                // Insert user
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $ins  = $conn->prepare("
                  INSERT INTO user_tbl
                    (user_name, email, password_hash)
                  VALUES (?, ?, ?)
                ");
                if (!$ins) {
                    $error = "Internal error (prepare failed on insert).";
                } else {
                    $ins->bind_param("sss", $username, $email, $hash);

                    if ($ins->execute()) {
                        $newUserId = $ins->insert_id;
                        $ins->close();

                        // Auto-login after signup: regenerate id, set session vars and record in Login_tbl
                        session_regenerate_id(true);
                        $sid = session_id();
                        $_SESSION['user_id']   = $newUserId;
                        $_SESSION['user_name'] = $username;
                        $_SESSION['email']     = $email;

                        $ip = $_SERVER['REMOTE_ADDR'] ?? '';
                        $ua = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 250);
                        $defaultRole = 'user';

                        $insLog = $conn->prepare("
                          INSERT INTO Login_tbl
                            (user_id, session_id, user_name, email, password_hash, role, ip_address, user_agent, last_active)
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
                        ");
                        if ($insLog) {
                            $insLog->bind_param(
                                "isssssss",
                                $newUserId,
                                $sid,
                                $username,
                                $email,
                                $hash,
                                $defaultRole,
                                $ip,
                                $ua
                            );
                            $insLog->execute();
                            $insLog->close();
                        }
                        $success = "Account created! You are now signed in.";
                    } else {
                        $error = "Signup failed: " . $ins->error;
                        $ins->close();
                    }
                }
            }
            $chk->close();
        }
    }
}

$conn->close();

// ─── FLASH IT ──────────────────────────────────────────────────────
// store messages in session so the caller page can display them
if ($error) {
    $_SESSION['login_error'] = $error;
}

if ($success) {
    $_SESSION['login_success'] = $success;
}

// Destination after login/signup
$return = $_POST['return'] ?? $_GET['return'] ?? 'index.php';

// Redirect back
header("Location: " . $return);
exit;
?>
