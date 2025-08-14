      
      <?php
session_name('ADMINSESSID');
session_start();

require '../database/db_connection.php'; // adjust path if needed

// make sure user is logged in
if (empty($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old      = trim($_POST['oldPassword']    ?? '');
    $new      = trim($_POST['newPassword']    ?? '');
    $confirm  = trim($_POST['confirmPassword'] ?? '');

    // basic validations
    if ($old === '' || $new === '' || $confirm === '') {
        $error = 'Please fill in all fields.';
    } elseif ($new !== $confirm) {
        $error = 'New password and confirmation do not match.';
    } elseif (strlen($new) < 8) {
        $error = 'New password must be at least 8 characters.';
    } else {
        // fetch current hash for this user
        $stmt = $conn->prepare("SELECT password_hash FROM User_tbl WHERE user_id = ? LIMIT 1");
        $stmt->bind_param('i', $_SESSION['user_id']);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows !== 1) {
            $error = 'User not found.';
        } else {
            $stmt->bind_result($currentHash);
            $stmt->fetch();

            // compare old password (your system currently uses md5)
            if (md5($old) !== $currentHash) {
                $error = 'Old password is incorrect.';
            } else {
                // update password (keeping md5 for compatibility with your current login logic)
                $newHash = md5($new);

                $upd = $conn->prepare("UPDATE User_tbl SET password_hash = ? WHERE user_id = ?");
                $upd->bind_param('si', $newHash, $_SESSION['user_id']);

                if ($upd->execute()) {
                    $success = 'Password changed successfully.';
                } else {
                    $error = 'Failed to update password. Please try again later.';
                }
            }
        }

        $stmt->close();
    }
}
?>
<?php ob_start(); ?>
    

   <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="">
                        <div class="row">
                            <div class="col-8 offset-2">

                                <div class="card">
                                    <div class="card-body shadow">
                                         <form action="" method="post" class="p-3 rounded">
                        <div class="mb-3">
                            <label class="form-label">Old Password</label>
                            <input type="password" name="oldPassword" class="form-control"
                                   placeholder="Enter Old Password..." required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" name="newPassword" class="form-control"
                                   placeholder="Enter New Password..." required>
                            <small class="form-text text-muted">At least 8 characters recommended.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="confirmPassword" class="form-control"
                                   placeholder="Enter Confirm Password..." required>
                        </div>

                        <div>
                            <input type="submit" value="Change" class="btn bg-dark text-white">
                        </div>
                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
<?php
$content = ob_get_clean();
require '../layouts/master.php';
?>
<script>
(function(){
    const form = document.getElementById('changePasswordForm');

    // Show server-side result (if any) using SweetAlert2
    const phpError = <?php echo json_encode($error ?: null); ?>;
    const phpSuccess = <?php echo json_encode($success ?: null); ?>;
    if (phpError) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: phpError
        });
    } else if (phpSuccess) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: phpSuccess
        });
    }

    // client-side submit handler: validate, confirm, then submit
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const oldVal = document.getElementById('oldPassword').value.trim();
        const newVal = document.getElementById('newPassword').value.trim();
        const confVal = document.getElementById('confirmPassword').value.trim();

        // client-side validation
        if (!oldVal || !newVal || !confVal) {
            Swal.fire({
                icon: 'warning',
                title: 'Missing fields',
                text: 'Please fill in all fields.'
            });
            return;
        }
        if (newVal.length < 8) {
            Swal.fire({
                icon: 'warning',
                title: 'Weak password',
                text: 'New password must be at least 8 characters.'
            });
            return;
        }
        if (newVal !== confVal) {
            Swal.fire({
                icon: 'warning',
                title: 'Password mismatch',
                text: 'New password and confirmation do not match.'
            });
            return;
        }

        // confirmation
        Swal.fire({
            title: 'Change password?',
            text: "Are you sure you want to change your password?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, change it',
            cancelButtonText: 'Cancel',
            focusCancel: true,
            preConfirm: () => {
                // show a loading popup while the form submits
                Swal.showLoading();
                // submit the form programmatically
                // small timeout gives the loading animation a chance to render
                return new Promise((resolve) => {
                    setTimeout(() => {
                        form.submit();
                        resolve();
                    }, 150);
                });
            }
        });
    });
})();
</script>
