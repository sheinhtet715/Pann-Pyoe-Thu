<?php
// ===== login.php =====
session_start();
require_once "./db_connection.php";

$username = trim($_POST['user_name'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$error    = '';
$success  = '';

// 1) All three fields are required:
if (isset($_POST['signin'])) {
    if ($username === '' || $email === '' || $password === '') {
        $error = 'Please enter your username, email, and password.';
    }
    // 2) Simple email format check
    elseif (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    }
    // 3) (Optional) enforce your username rules
    elseif (! preg_match('/^[A-Za-z0-9_]{3,30}$/', $username)) {
        $error = 'Usernames must be 3–30 chars and only letters, numbers and underscores.';
    }
    // 4) Now do the lookup using AND
    else {
        $sql = "
          SELECT user_id, user_name, email, password_hash, profile_path
            FROM user_tbl
           WHERE email = ?
             AND user_name = ?
           LIMIT 1
        ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password_hash'])) {
                // success
                $_SESSION['user_id']   = $user['user_id'];
                $_SESSION['user_name'] = $user['user_name'];
                $_SESSION['email']     = $user['email'];
                // ➊ record login in Login_tbl
                $insertLogin = $conn->prepare("
              INSERT INTO Login_tbl (
                user_id, user_name, email, password_hash, role, last_login
              ) VALUES (?, ?, ?, ?, ?, NOW())
            ");
                // if you have roles in User_tbl, you may need to fetch it first
                $role = $user['role'] ?? 'user';
                $insertLogin->bind_param(
                    "issss",
                    $user['user_id'],
                    $user['user_name'],
                    $user['email'],
                    $user['password_hash'],
                    $role
                );
                $insertLogin->execute();
                $insertLogin->close();

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

// -------- SIGN UP --------
if (isset($_POST['signup'])) {
    // 1) check for existing account
    $sql = "SELECT 1 FROM user_tbl WHERE user_name = ? OR email = ? LIMIT 1";
    $chk = $conn->prepare($sql);
    $chk->bind_param("ss", $username, $email);
    $chk->execute();
    $res = $chk->get_result();
    if ($res->num_rows > 0) {
        $error = "That username or email is already taken.";
    } else {
        // 2) hash password and insert into User_tbl
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $ins  = $conn->prepare("
          INSERT INTO User_tbl
            (user_name, email, password_hash)
          VALUES (?, ?, ?)
        ");
        $ins->bind_param("sss", $username, $email, $hash);

        if ($ins->execute()) {
            $newUserId = $ins->insert_id;

            // 3) also record initial login in Login_tbl
            $insLog = $conn->prepare("
              INSERT INTO Login_tbl
                (user_id, user_name, email, password_hash, role, last_login)
              VALUES (?, ?, ?, ?, ?, NOW())
            ");
            $defaultRole = 'user';
            $insLog->bind_param(
                "issss",
                $newUserId,
                $username,
                $email,
                $hash,
                $defaultRole
            );
            $insLog->execute();
            $insLog->close();

            $success = "Account created! You can now sign in.";
        } else {
            $error = "Signup failed: " . $ins->error;
        }

        $ins->close();
    }

    $chk->close();
}

$conn->close();

// ─── FLASH IT ──────────────────────────────────────────────────────
// whichever happened, store it in session so the caller page can pick it up:
if ($error) {
    $_SESSION['login_error'] = $error;
}

if ($success) {
    $_SESSION['login_success'] = $success;
}

$return = $_POST['return'] ?? $_GET['return'] ?? ($_SERVER['HTTP_REFERER'] ?? null) ?? 'index.php';

header("Location: " . $return);
exit;
