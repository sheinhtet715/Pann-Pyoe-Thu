<?php
    // profile.php
    session_start();
    require_once './db_connection.php';

    // Redirect if not logged in
    if (empty($_SESSION['user_id'])) {
        header('Location: index.php');
        exit;
    }

    // Fetch current user data
    $stmt = $conn->prepare("SELECT user_name, email, phone, profile_path FROM User_tbl WHERE user_id = ?");
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $user   = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    // DEBUG: check that the file on disk matches what’s in the DB
    $storedPath = $user['profile_path'] ?? '';
    if ($storedPath !== '') {
        // build the absolute path to the file
        $fullPath = realpath(__DIR__ . '/../' . $storedPath);
        if ($fullPath && file_exists($fullPath)) {
            error_log(" Display file exists at: $fullPath");
        } else {
            error_log(" Display file missing at: " . ($fullPath ?? 'unable to resolve') );
        }
    }
    // Flash messages
    $success = $_SESSION['profile_success'] ?? '';
    $error   = $_SESSION['profile_error'] ?? '';
    unset($_SESSION['profile_success'], $_SESSION['profile_error']);

    // Enrolled courses of user
    $imgFolder = "../Courses page Images/";
    $sql = "SELECT c.course_id, c.course_name, c.icon_url
            FROM  enrollment_tbl e
            INNER JOIN course_tbl c ON e.course_id = c.course_id
            WHERE e.user_id = ?
              AND e.payment_status ='confirm'";
    
    $stmt = $pdo->prepare($sql);
    $stmt ->execute([$_SESSION['user_id']]);
    $courses = $stmt-> fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="icon" href="../HomePimg/Logo.ico" type="image/x-icon">
  <title>Profile Page</title>
  <link rel="stylesheet" href="../CSS/Profile.css">
  
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
  <div class="container">
    <header>
      <div class="logo-section">
        <img src="../HomePimg/Logo.ico" alt="Logo" class="logo-img">
        <span class="brand-name">Pann Pyoe Thu</span>
              <nav class="nav" id="mainNav">
                <a href="../PHP/index.php">Home</a>
                </nav>
      </div>

      <form method="post" action="logout.php">
        <button type="submit" class="logout-btn">Log out</button>
      </form>
    </header>
    <main>
      <section class="profile-section">
        <div class="profile-pic-container">
          <div class="profile-pic-placeholder" id="profile-pic-placeholder">
            <?php if ($user['profile_path']): ?>
              <img src="../<?php echo htmlspecialchars($user['profile_path']) ?>" alt="Profile" class="profile-img">
            <?php else: ?>
              <img src="profile-placeholder.png" alt="Profile" class="profile-img">
            <?php endif; ?>
            <div class="spinner" id="profile-spinner" style="display:none;"></div>
            <button type="button" class="remove-img-btn" id="remove-img-btn" style="display:none;">✕</button>
          </div>
          <!-- Single upload control -->
          <!-- <label class="upload-label" for="profile-upload">
            <input type="file" id="profile-upload" name="profile_image" accept="image/*" style="display:none;">
            Upload your profile
          </label> -->
          
        </div>
    
        
      </section>
      <section class="edit-profile-section">
        <button type="button" class="btn btn-secondary" onclick="history.back();">Back</button>
        <h2>Edit Your Profile</h2>
        <form method="post" action="updatepassword.php"  id="profile-form" enctype="multipart/form-data">
          <label for="oldPassword">Old Password</label>
           <input type="password" name="oldPassword" class="form-control"
           placeholder="Enter Old Password..." required>

          <label for="password">New Password</label>
        <input type="password" name="newPassword" class="form-control"
               placeholder="Enter New Password..." required>
            <small style="color: muted;">At least 8 characters recommended.</small>         
          <label for="confirmPassword">Confirm Password</label>
         <input type="password" name="confirmPassword" class="form-control"
           placeholder="Enter Confirm Password..." required>
         
          
          <input type="submit" value="Save" class="btn btn-success">
        </form>
      </section>
    </main>
  </div>
  <script src="../JavaScript/Profile.js"></script>


  </script>

</body>
<style>
    .nav {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-left: 700px;
    }

    .nav a {
        color: white;
        text-decoration: none;
        font-size: 17px;
        padding: 5px 10px;
        transition: all 0.3s ease;
        border-radius: 5px;
    }

    .nav a:hover {
        background-color: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        color: #ffe6c7;
    }
</style>
</html>
