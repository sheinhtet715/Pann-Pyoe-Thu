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
            WHERE e.user_id = ?";
    
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
          <a href="" id="change-photo-link">Change profile picture</a>
        </div>
    
        <div class="enrolled-courses">
          <span>Enrolled courses</span>
          <div class="courses-slider">
            <button class="slider-arrow left-arrow" id="left-arrow" aria-label="Previous courses">&#60;</button>
            <ul class="courses-list" id="enrolled-courses-list">
              <!-- course items here -->
               <?php foreach($courses as $course): ?>
                <?php $redirectFile = $course['course_name'];?>
                <li class="course-circle" data-cousrse-id="<?=$course['course_id']?>">
                  <a href="../Courses/<?= $redirectFile?>.php"<?= urldecode($course['course_id'])?>>
                  
                    <img src="<?= htmlspecialchars($imgFolder.($course['icon_url']))?>" alt="<?=htmlspecialchars($course['course_name'])?>" class="course-img">
                    <span class="course-name"><?= htmlspecialchars($course['course_name']) ?></span>
                  </a>
                </li>
               <?php endforeach; ?> 
            </ul>
            <button class="slider-arrow right-arrow" id="right-arrow" aria-label="Next courses">&#62;</button>
          </div>
        </div>
      </section>
      <section class="edit-profile-section">
        <h2>Edit Your Profile</h2>
        <form method="post" action="update_profile.php"  id="profile-form" enctype="multipart/form-data">
          <label for="name">Name</label>
          <input type="text" id="name" name="user_name" placeholder="Your name" value="<?php echo htmlspecialchars($user['user_name']) ?>" required>

          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Your email" value="<?php echo htmlspecialchars($user['email']) ?>" required>

          <label for="phone">Phone Number</label>
          <input type="tel" id="phone" name="phone" placeholder="Your phone number" value="<?php echo htmlspecialchars($user['phone']) ?>">
           <label class="upload-label" for="profile-upload-form" style="display:none">
          
           <input
            type="file"
            id="profile-upload-form"
            name="profile_image"
            accept="image/*"
            style="display:none"
          >
          Upload your profile picture
        </label>
          <input type="submit" value="Save" class="btn btn-success">
        </form>
      </section>
    </main>
  </div>
  <script src="../JavaScript/Profile.js"></script>
  <script>
  document.addEventListener('DOMContentLoaded', function() {
      const link = document.getElementById('change-photo-link');
      const fileInput = document.getElementById('profile-upload-form');
      const form = document.getElementById('profile-form');

      link.addEventListener('click', function(e) {
        e.preventDefault();
        fileInput.click();
      });

      fileInput.addEventListener('change', function() {
        if (fileInput.files.length) {
          form.submit();
        }
      });

      // SweetAlert feedback
      <?php if ($success): ?>
        Swal.fire({
          icon: 'success',
          title: 'Success',
          text: '<?= htmlspecialchars($success) ?>'
        });
      <?php endif; ?>

      <?php if ($error): ?>
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: '<?= htmlspecialchars($error) ?>'
        });
      <?php endif; ?>
    });
  </script>
  <script>
        const courseList = document.getElementById('enrolled-courses-list');
    const leftArrow = document.getElementById('left-arrow');
    const rightArrow = document.getElementById('right-arrow');

    // Scroll distance per click (adjust if needed)
    const scrollAmount = 100;

    leftArrow.addEventListener('click', () => {
        courseList.scrollBy({
            left: -scrollAmount,
            behavior: 'smooth'
        });
    });

    rightArrow.addEventListener('click', () => {
        courseList.scrollBy({
            left: scrollAmount,
            behavior: 'smooth'
        });
    });

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
