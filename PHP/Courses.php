<?php
// Courses.php
session_start();
include "./db_connection.php";
require_once "./Controller/CoursesController.php";



$imgFolder = '../Courses page Images/'; 
$error   = $_SESSION['login_error']   ?? '';
$success = $_SESSION['login_success'] ?? '';

unset($_SESSION['login_error'], $_SESSION['login_success']);

//  Handle form POST (unchanged)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['signin']) && !isset($_POST['signup'])) {
    if (empty($_SESSION['user_id'])) {
        $error = "❌ You must be signed in to book an Enrollment.";
    } elseif ($_POST['email'] !== ($_SESSION['email'] ?? '')) {
        $error = "❌ That email doesn’t match your logged‑in account.";
    } else {
        $user_id      = $_SESSION['user_id'];
        $course_name  = trim($_POST['course_name'] ?? '');
        $fee          = trim($_POST['fee'] ?? '');
        $type         = trim($_POST['type'] ?? '');
        $language     = trim($_POST['language'] ?? '');

        
        // a) find course_id
        $cs = $conn->prepare("
            SELECT course_id
              FROM Course_tbl
             WHERE course_name = ?
        ");
        $cs->bind_param("s", $course_name);
        $cs->execute();
        $cres = $cs->get_result();

        if (!$cres->num_rows) {
            $error = "⚠️ Course “{$course_name}” not found.";
        } else {
            $courseid = $cres->fetch_assoc()['course_id'];
            $cs->close();

            // b) insert into enrollment table
            $date = date('d-m-Y');
            $ins = $conn->prepare("
                INSERT INTO Enrollment_tbl
                  (user_id,course_id,enrollment_date,payment_status)
                VALUES (?, ?, ?, 'YES')
            ");
            $ins->bind_param("iis", $user_id, $courseid, $date);

            if ($ins->execute()) {
                $success = "✅ Enrollment booked successfully!";
            } else {
                $error = "❌ Error inserting Enrollment: " . $ins->error;
            }
            $ins->close();
        }
    }
}

// 2) Fetch dynamic list of courses from DB
$controller = new CoursesController($conn);
$courses    = $controller->getAllCourses();
$mcourses = new mostPopularCourse($conn);
$mostPopularCourses = $mcourses->getMostPopularCourses();
$upcourse = new UpcomingCourse($conn);
$upcomingCourses = $upcourse->getUpcomingCourses();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <link rel="icon" href="../HomePimg/Logo.ico" type="image/x-icon">
   <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="../CSS/Courses.css">
   <!-- load Courses.js, which needs window.isLoggedIn -->
  <script src="../JavaScript/Courses.js"></script>
	<title>Courses</title>
</head>

<body>
<header class="header">
    <div class="logo-area">
      <div class="logo-img">
        <img src="../HomePimg/Logo.ico" alt="Logo">
      </div>
      <div class="logo-text">Pann Pyoe Thu</div>
    </div>

    <nav class ="nav">
       <a href="../PHP/index.php">Home</a>
        <a href="../PHP/About Us.php">About us</a>
        <a href="../PHP/Courses.php">Courses</a>
        <a href="../PHP/Counsellor.php">Educational Counsellor</a>
        <a href="../PHP/Scholarship.php">Scholarships</a>
        <a href="../PHP/Local Uni.php">Local Universities</a>
         <a href="../PHP/Jobs.php">Job Opportunities</a>
    </nav>

      <button class="mobile-menu-toggle" onclick="toggleMobileMenu()" aria-label="Toggle mobile menu">
        <span></span>
        <span></span>
        <span></span>
      </button>
   
      <?php if (!empty($_SESSION['user_id'])): ?>
        <div class="dropdown">
            <button
                class="btn btn-secondary dropdown-toggle p-0 border-0 bg-transparent"
                type="button"
                id="profileDropdownBtn"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                >
                <!-- your SVG icon as the button’s content: -->
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" fill="white"/>
                    <path d="M12 14C7.58172 14 4 17.5817 4 22H20C20 17.5817 16.4183 14 12 14Z" fill="white"/>
                </svg>
                </button>
            <ul class="dropdown-menu dropdown-menu-end"
                aria-labelledby="profileDropdownBtn">
                <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                <li><a class="dropdown-item" href="Profile.php">My Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="course_logout.php">Logout</a></li>
            </ul>
        </div>
    <?php else: ?>
      <div class="profile-icon" onclick="openLogin()">
        <img src="../HomePimg/Profile.png" alt="Profile" class="profile-img">
      </div>
    <?php endif; ?>
</header>


  <h1>Explore our wide range of courses designed to meet your goals.</h1>

 

 <div class="course-container">
<?php 
  $colors = ['#529AA6','#E8D9C4', '#9CC2CF','#BF9E8D','#F2E1C1']; // Initial colors for courses
  $index = 0;
  foreach ($courses as $row): 
    $bgColor = $colors[$index % count($colors)];
  ?>
  <div class="course course1" style="background-color: <?= $bgColor ?>;">
    <div class="course-image">
      <img src="<?= htmlspecialchars($imgFolder.($row['image_url'])) ?>" 
        alt="<?= htmlspecialchars($row['course_name']) ?>">
    </div>
    <div class="photo-enroll">
      <img class="icon" src="<?= htmlspecialchars($imgFolder.($row['icon_url'])) ?>" alt="Icon">
      <a class="enroll" href="">Enroll</a>
    </div>
    <div class="course-text">
      <p><?= htmlspecialchars($row['course_name']) ?></p>
      <p>Fee - <?= htmlspecialchars($row['fee']) ?></p>
      <p>Type - <?= htmlspecialchars($row['type']) ?></p>
      <p>Language - <?= htmlspecialchars($row['language']) ?></p>
    </div>
  </div>
  
<?php 
  $index++;
  endforeach; ?>
 </div>

<div class="most-popular">
<h1>The most popular course</h1>
</div>

<div class="course-discount">
  <?php 
     
     $colors = ['#529AA6', '#E8D9C4', '#9CC2CF','#BF9E8D','#F2E1C1']; // Initial colors for courses
     $index = 0; 
    foreach ($mostPopularCourses as $row): 
    $bgColor = $colors[$index % count($colors)];
  ?>
  <div class="course course1" style="background-color: <?= $bgColor ?>;">
    <div class="course-image">
      <img src="<?= htmlspecialchars($imgFolder.($row['image_url'])) ?>" 
        alt="<?= htmlspecialchars($row['course_name']) ?>">
    </div>
    <div class="photo-enroll">
      <img class="icon" 
        src="<?= htmlspecialchars($imgFolder.($row['icon_url'])) ?>" 
        alt="<?= htmlspecialchars($row['course_name']) ?> Icon">
      <a class="enroll" href="">Enroll</a>
    </div>

    <div class="course-text">
      <p><?= htmlspecialchars($row['course_name']) ?></p>
      <p>Fees - <?= htmlspecialchars($row['fee']) ?></p>
      <p>Type - <?= htmlspecialchars($row['type']) ?></p>
      <p>Language - <?= htmlspecialchars($row['language']) ?></p>
    </div>
  </div>
  
    <?php 
      $index++;
      endforeach; ?>

  <div class="last-part">
    <div class="box-one"></div>
    <div class="box-two">
      <p>Get <span class="red">25%</span> discount for the very first enrolled course.</p>
      <br> 
      <p>Two courses enrolled and get <span class="red">50%</span> discount.</p>
    </div>
  </div>
</div>


  <div class="stay-tuned">
  <h1>Stay tuned for the upcoming courses</h1>
</div>

<div class="upcoming-course">
  <?php foreach ($upcomingCourses as $row): ?>
  <div class="offer-course card">
    <img src="<?= htmlspecialchars($imgFolder.($row['icon_url'])) ?>" alt="<?= htmlspecialchars($row['course_name']) ?> Icon">
    <div class="offer-text">
      <p><?= htmlspecialchars($row['course_name']) ?></p>
    </div>
  </div>
  <?php endforeach; ?>
</div> 

    <div class="bottom">
        <div class="bottom-left">
            <a class="about-us" href="../PHP/About Us.php">About Us</a>
            <br>
            <a class="education-counselling" href="../PHP/Counsellor.php">Education Counselling</a>
            <br>
            <a class="local-universities" href="../PHP/local Uni.php">Local Universities</a>
            <a class="job-opportunities" href="../PHP/Jobs.php">Job Opportunities</a>
            <br>
            <a class="scholarships" href="../PHP/Scholarships.php">Scholarships</a>
            <br>
            <a class="available-courses" href="../PHP/Courses.php">Available Courses</a>
        </div>

        <div class="bottom-middle">
            <p>Contact Us:</p>
            <p>09672659692</p>
            <p>pannpyoethu26@gmail.com</p>
        </div>

        <div class="bottom-right">
            <p>Follow Us On:</p>
            <i class="fab fa-facebook"></i>
            <i class="fab fa-instagram"></i>
            <i class="fab fa-twitter"></i>
        </div>
    </div>

    <!-- Mobile Menu Toggle -->
    <script>
      function toggleMobileMenu() {
        const nav = document.getElementById('nav-menu');
        nav.classList.toggle('active');
      }
      function openLogin() {
        alert('Login menu would open here.');
      }

      function closeLogin() {
        alert('Login menu would close here.');
      }
    </script>
    <!-- Login Modal -->
  <!--  -->
  <!-- 1) pull in your shared login modal markup -->
  <!-- 0) Expose login state for Counsellor.js -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- 1) pull in your shared login‑modal markup -->
   <?php include './login_modal.php'; ?>
  <!-- 3) openLogin/closeLogin & click‐outside & showLogin=1 logic -->
  <script>
    function openLogin() {
      const m = document.getElementById('loginModal');
      if (m && m.style.display !== 'block') m.style.display = 'block';
    }
    function closeLogin() {
      const m = document.getElementById('loginModal');
      if (m) m.style.display = 'none';
    }

    // Clicking the ✕ or outside the modal closes it
    document.addEventListener('click', e => {
      const m = document.getElementById('loginModal');
      if (!m) return;
      if (e.target.classList.contains('close') || e.target === m) {
        closeLogin();
      }
    });

    // Honor ?showLogin=1 in URL
    (function(){
      let auto = false;
      const params = new URL(location).searchParams;
      if (params.get('showLogin') === '1' && !auto) {
        auto = true;
        openLogin();
        params.delete('showLogin');
        history.replaceState({}, '', location.pathname + (params.toString() ? `?${params}` : ''));
      }
    })();
  </script>

   <!-- 4) Flash‐and‐SweetAlert2 trigger on login/signup errors or success -->
  <script>
document.addEventListener('DOMContentLoaded', () => {
  <?php if ($error): ?>
    Swal.fire({
      icon: 'error',
      title: 'Oops…',
      text: <?= json_encode($error) ?>,
      confirmButtonText: 'Try Again'
    })
    .then(() => {
      openLogin();
    });
  <?php elseif ($success): ?>
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: <?= json_encode($success) ?>,
      timer: 2000,
      showConfirmButton: false
    })
  <?php endif; ?>
});
</script>

</body>
</html>