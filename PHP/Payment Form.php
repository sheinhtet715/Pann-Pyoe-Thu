<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['payment_method'])) {
    $method = $_POST['payment_method'];
    echo "<h2>You selected: $method</h2>";
  } else {
    echo "<p>No payment method selected.</p>";
  }
}
?>
<?php
session_start();
include "./db_connection.php";

// Enable strict MySQLi reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Store errors/success in session
$error   = $_SESSION['login_error']   ?? '';
$success = $_SESSION['login_success'] ?? '';
unset($_SESSION['login_error'], $_SESSION['login_success']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (empty($_SESSION['user_id'])) {
            throw new Exception("❌ You must be signed in to enroll.");
        }

        if (!isset($_POST['email']) || $_POST['email'] !== ($_SESSION['email'] ?? '')) {
            throw new Exception("❌ That email doesn’t match your logged-in account.");
        }

        $user_id        = $_SESSION['user_id'];
        $email          = $_SESSION['email'];
        $phone          = $_POST['phone'] ?? '';
        $user_name      = $_POST['user_name'] ?? '';
        $course_name    = $_POST['course_name'] ?? '';
        $payment_method = $_POST['payment_method'] ?? '';
        $enrollment_date = date('Y-m-d');
        $payment_date    = date('Y-m-d');

        // Get course
        $stmt = $conn->prepare("SELECT course_id, fee FROM course_tbl WHERE course_name = ?");
        $stmt->bind_param("s", $course_name);
        $stmt->execute();
        $course = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        if (!$course) throw new Exception("❌ Course not found.");

        $course_id = $course['course_id'];
        $course_fee = strtolower(trim($course['fee']));

        
        $conn->begin_transaction();

        // Update phone if provided
        if (!empty($phone)) {
            $stmt = $conn->prepare("UPDATE user_tbl SET phone = ? WHERE user_id = ?");
            $stmt->bind_param("si", $phone, $user_id);
            $stmt->execute();
            $stmt->close();
        }

        // ✅ Check if already enrolled
        $check = $conn->prepare("SELECT enrollment_id FROM enrollment_tbl WHERE user_id = ? AND course_id = ?");
        $check->bind_param("ii", $user_id, $course_id);
        $check->execute();
        $result = $check->get_result();
        if ($result->num_rows > 0) {
            // Roll back transaction if already enrolled
            $conn->rollback();
            echo "<script>
                alert('⚠️ You are already enrolled in this course.');
                window.history.back();
            </script>";
            exit;
        }
        $check->close();

        // Insert into Enrollment
        $stmt = $conn->prepare("INSERT INTO enrollment_tbl (user_id, course_id, enrollment_date) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $user_id, $course_id, $enrollment_date);
        $stmt->execute();
        $enrollment_id = $stmt->insert_id;
        $stmt->close();

        // Paid course = upload + insert payment
        if ($course_fee !== 'free') {
            if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                // Validate file type
                $allowed_ext = ['jpg', 'jpeg', 'png', 'pdf'];

                // Extract file extension
                $file_ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));

                // Check if file type is allowed
                if (!in_array($file_ext, $allowed_ext)) {
                    throw new Exception("❌ Invalid file type.");
                }

                // Create upload directory if it doesn't exist
                $upload_dir = __DIR__ . "/uploads/payment_receipts/";
                if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

                // Generate unique file name
                $new_file_name = uniqid("receipt_", true) . "." . $file_ext;

                // Move uploaded file
                $file_path = $upload_dir . $new_file_name;

                if (!move_uploaded_file($_FILES['file']['tmp_name'], $file_path)) {
                    throw new Exception("❌ Failed to upload file.");
                }

                // Save relative path to DB
                $relative_path = "uploads/payment_receipts/" . $new_file_name;

                // Insert payment record
                $amount = (float) filter_var($course_fee, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

                $stmt = $conn->prepare("INSERT INTO payment_tbl (enrollment_id, amount, payment_date, payment_method, payment_receipt) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("idsss", $enrollment_id, $amount, $payment_date, $payment_method, $relative_path);
                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception("❌ Receipt upload is required.");
            }
        }

        $conn->commit();
        $courseName = $course_name;
        $redirectFile = $courseName.'.php';
        echo "<script>
               alert('✅ Enrollment successful!'');
        $redirectFile = '';
              window.location.href = '../Courses/$redirectFile';
              </script>";
        exit;
    } catch (Exception $e) {
        $conn->rollback();
        $_SESSION['login_error'] = $e->getMessage();
        header("Location: Courses.php");
        exit;
    }
}
?>


<script>

// Profile‑menu toggle
function toggleProfileMenu() {
  const menu = document.getElementById("profile-menu");
  if (menu) menu.classList.toggle("show");
}
document.addEventListener('click', (e) => {
  const section = document.querySelector('.profile-section');
  const menu    = document.getElementById("profile-menu");
  if (section && menu && !section.contains(e.target)) {
    menu.classList.remove("show");
  }
});
</script>
