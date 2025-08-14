<?php
session_name('ADMINSESSID');
session_start();

require '../database/db_connection.php';

// Assume admin user_id is stored in session

$user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : ($_SESSION['user_id'] ?? 1);

// Fetch user info
$sql = "SELECT * FROM User_tbl WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Set default image
$imgSrc = $user['profile_path'] ?: '../uploads/1000_F_64675209_7ve2XQANuzuHjMZXP3aIYIpsDKEbF5dD.jpg';

ob_start();
?>

<!-- Page content -->
<div class="container">
    <div class="card shadow-sm">
        <div class="card-body">
                <h4 class="mb-3">Profile</h4>

                <div class="row">
                    <!-- Profile picture -->
                    <div class="col-md-4 text-center mb-3">
                         <div class="col-md-4 text-center mb-3">
                        <?php if ($user['profile_path']): ?>
              <img src="../../<?php echo htmlspecialchars($user['profile_path']) ?>" alt="Profile"  style="width:200px; height:200px; object-fit:cover;" class="rounded-circle">
            <?php else: ?>
              <img src="../uploads/1000_F_64675209_7ve2XQANuzuHjMZXP3aIYIpsDKEbF5dD.jpg" alt="Profile"  style="width:200px; height:200px; object-fit:cover;" class="rounded-circle">
            <?php endif; ?>
                    </div>
                    </div>
                
                <!-- Profile form -->
                <div class="col-md-8">
                    <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="user_name" class="form-control"
                                   value="<?php echo htmlspecialchars($user['user_name']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                   value="<?php echo htmlspecialchars($user['email']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control"
                                   value="<?php echo htmlspecialchars($user['phone']); ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Profile Picture</label>
                            <input type="file" name="profile_pic" accept="image/*" class="form-control">
                            <small class="text-muted"></small>
                        </div>

                        <button type="submit" class="btn btn-success">Update Profile</button>
                        <a href="changepassword.php" class="btn btn-outline-secondary">Change Password</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- SweetAlert2 CDN (only if you want nice messages) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Inline styles for small enhancements -->
<style>
  /* If your master already contains bootstrap, these are tiny additions for spacing */
  .profile-card .profile-img { max-width: 100%; border-radius: 50%; }
  @media (max-width: 576px) {
    #profilePreview { width:160px; height:160px; }
  }
</style>

<?php
$content = ob_get_clean();
require '../layouts/master.php';
?>
