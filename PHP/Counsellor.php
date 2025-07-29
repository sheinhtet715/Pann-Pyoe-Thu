<?php
    // Counsellor.php
    session_start();
    $error   = $_SESSION['login_error'] ?? '';
    $success = $_SESSION['login_success'] ?? '';
    unset($_SESSION['login_error'], $_SESSION['login_success']);
    include "./db_connection.php";
    $user = null;
    if (! empty($_SESSION['user_id'])) {
        $stmt = $conn->prepare("SELECT user_name, profile_path FROM User_tbl WHERE user_id = ?");
        $stmt->bind_param('i', $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $user   = $result->fetch_assoc();
        $stmt->close();
    }
    require_once "./Controller/CounsellorController.php";

    $imgFolder = '../Counsellor_page_images/';

    // 1) Handle form POST (unchanged)
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && ! isset($_POST['signin']) && ! isset($_POST['signup'])) {
        if (empty($_SESSION['user_id'])) {
            $error = "❌ You must be signed in to book an appointment.";
        } elseif ($_POST['email'] !== ($_SESSION['email'] ?? '')) {
            $error = "❌ That email doesn’t match your logged‑in account.";
        } else {
            $user_id      = $_SESSION['user_id'];
            $advisor_name = trim($_POST['advisor_name'] ?? '');
            $description  = trim($_POST['description'] ?? '');
            $date         = trim($_POST['appointment_date'] ?? '');
            $time         = trim($_POST['appointment_time'] ?? '');

            // a) find counsellor_id
            $cs = $conn->prepare("
            SELECT counsellor_id
              FROM Counsellor_tbl
             WHERE counsellor_name = ?
        ");
            $cs->bind_param("s", $advisor_name);
            $cs->execute();
            $cres = $cs->get_result();

            if (! $cres->num_rows) {
                $error = "⚠️ Counsellor “{$advisor_name}” not found.";
            } else {
                $cid = $cres->fetch_assoc()['counsellor_id'];
                $cs->close();

                // b) insert appointment
                $ins = $conn->prepare("
                INSERT INTO Appointment_tbl
                  (user_id,counsellor_id,appointment_date,appointment_time,description,appointment_status)
                VALUES (?, ?, ?, ?, ?, 'Confirmed')
            ");
                $ins->bind_param("iisss", $user_id, $cid, $date, $time, $description);

                if ($ins->execute()) {
                    $success = "✅ Appointment booked successfully!";
                } else {
                    $error = "❌ Error inserting appointment: " . $ins->error;
                }
                $ins->close();
            }
        }
    }

    // 2) Fetch dynamic list of counsellors from DB
    $controller = new CounsellorController($conn);
    $advisors   = $controller->getAllCounsellors();

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="icon" href="../HomePimg/Logo.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Vollkorn:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../CSS/Counsellor.css" />
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

  <!-- SweetAlert2 JS -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>  -->
  <title>Educational Counsellors</title>

</head>
<body>
  <div class="homepage">
    <header class="header">
      <div class="logo">
        <img src="../HomePimg/Logo.ico" alt="Pann Pyoe Thu logo" class="logo-img" />
        <span class="logo-text">Pann Pyoe Thu</span>
      </div>
      <nav class="nav">
       <a href="../PHP/index.php">Home</a>
        <a href="../PHP/About Us.php">About us</a>
        <a href="../PHP/Courses.php">Courses</a>
        <a href="../PHP/Counsellor.php">Educational Counsellors</a>
        <a href="../PHP/Scholarship.php">Scholarships</a>
        <a href="../PHP/Local Uni.php">Local Universities</a>
         <a href="../PHP/Jobs.php">Job Opportunities</a>
    </nav>
      <!-- <div class="profile-icon" onclick="openLogin()">
        <img src="../HomePimg/Profile.png" alt="Profile" class="profile-img" />
      </div> -->

      <?php if (! empty($_SESSION['user_id'])): ?>
        <div class="dropdown">
            <button
                class="btn btn-secondary dropdown-toggle p-0 border-0 bg-transparent"
                type="button"
                id="profileDropdownBtn"
                data-bs-toggle="dropdown"
                aria-expanded="false"
            >
                <?php if (! empty($user['profile_path'])): ?>
                     <img
                        src="../<?php echo htmlspecialchars($user['profile_path']); ?>"
                        alt="Profile"
                        class="profile-img"
                        style="width:50px; height:50px; object-fit:cover;"
                    >
                <?php else: ?>
                    <img src="../HomePimg/Profile.png" alt="Profile" class="profile-img" style="width:28px; height:28px; object-fit:cover;">
                <?php endif; ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end"
                aria-labelledby="profileDropdownBtn">
                <li><a class="dropdown-item" href="Profile.php">My Profile</a></li>
                <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="counsellor_logout.php">Logout</a></li>
            </ul>
        </div>
      <?php else: ?>
        <div class="profile-icon" onclick="openLogin()">
            <img src="../HomePimg/Profile.png" alt="Profile" class="profile-img" />
        </div>
      <?php endif; ?>
  </header>


        <div class = "block" style="background-color:#1D2733; padding:35px;"></div>


  <!-- your scripts for openPopup/closePopup, etc. -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && ! empty($error)): ?>
    // Always show the appointment popup on booking error
    openPopup(<?php echo json_encode($advisor_name ?? ($_POST['advisor_name'] ?? ''))?>, true);
    const form = document.querySelector('#appointment-popup form');
    if (form) {
      form.elements['user_name'].value         = <?php echo json_encode($_POST['user_name'] ?? '')?>;
      form.elements['description'].value       = <?php echo json_encode($_POST['description'] ?? '')?>;
      form.elements['email'].value             = <?php echo json_encode($_POST['email'] ?? '')?>;
      form.elements['appointment_date'].value  = <?php echo json_encode($_POST['appointment_date'] ?? '')?>;
      form.elements['appointment_time'].value  = <?php echo json_encode($_POST['appointment_time'] ?? '')?>;
    }
    Swal.fire({
      icon: 'error',
      title: 'Oops…',
      text: <?php echo json_encode($error)?>,
      confirmButtonText: 'Try Again'
    });
  <?php elseif (! empty($success)): ?>
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: <?php echo json_encode(trim($success))?>,
      timer: 2000,
      showConfirmButton: false
    });
  <?php endif; ?>
});
</script>

      <div class="title">“Consult with us for your further academic studies”</div>
    <div class="divider"></div>

    <div class="container">
      <?php foreach ($advisors as $a): ?>
        <div class="advisor">
          <div class="advisor-content">
            <div style="position:relative;">
              <img src="<?php echo htmlspecialchars($imgFolder . ($a['image_url'] ?? 'default.jpg'))?>"
                   alt="<?php echo htmlspecialchars($a['counsellor_name'])?>"
                   class="advisor-img" />

              <?php if (! empty($_SESSION['user_id'])): ?>
                <button class="appointment-btn"
        onclick="openPopup('<?php echo $a['counsellor_name']?>')">
  Get Appointment
</button>
<?php else: ?>
  <button class="appointment-btn"
          onclick="
            Swal.fire({
              icon: 'warning',
              title: 'Please sign in',
              text: 'You must be signed in to book an appointment.'
            }).then(() => {
      openLogin();
    });
          ">
    Get Appointment
  </button>
<?php endif; ?>


              <img class="appimg"
                   src="../HomePimg/tulips-removebg-preview.png"
                   alt="">
            </div>

            <div>
              <div class="advisor-header"><?php echo htmlspecialchars($a['counsellor_name'])?></div>
              <div class="advisor-title"><?php echo htmlspecialchars($a['degree'])?></div>
              <p>🎯 <?php echo htmlspecialchars($a['specialization'])?></p>
              <p>📞 <?php echo htmlspecialchars($a['phone'])?></p>
              <p>📧 <?php echo htmlspecialchars($a['email'])?></p>
              <div class="advisor-experience">
                <h4>Experience Highlights:</h4>
                <ul>
                  <?php foreach (explode(";", $a['experiences']) as $exp): ?>
                    <li><?php echo htmlspecialchars(trim($exp))?></li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="bottom">
      <div class="bottom-left">
        <a class="about-us" href="#">About Us</a>
        <br>
        <a class="education-counselling" href="#">Education Counselling</a>
        <br>
        <a class="local-universities" href="#">Local Universities</a>
        <br>
        <a class="job-opportunities" href="#">Job Opportunities</a>
        <br>
        <a class="scholarships" href="#">Scholarships</a>
        <br>
        <a class="available-courses" href="#">Available Courses</a>
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
  </div>
  <!-- Appointment Popup -->
  <!-- Appointment Popup -->
  <div id="appointment-popup" class="popup">
    <form method="POST" action="Counsellor.php">
      <input type="hidden" name="advisor_name" id="advisor-input" />

      <div class="card">
        <span class="close-btn" onclick="closePopup()">&times;</span>
        <img src="../HomePimg/tulips-removebg-preview.png" class="flower-image" alt="flowers" />

        <div class="left">
          <h2>Get appointment with <span id="advisor-name">………</span></h2>
          <div class="textbox">
            <label>Enter your name</label>
            <input type="text" name="user_name" placeholder="Your name" required />

            <label>What kind of education counselling you want to get</label>
            <textarea name="description" placeholder="Your response…" required></textarea>

            <label>Email</label>
            <input type="email" name="email" placeholder="your@email.com" required />

            <p class="disclaimer">
              We'll reach out to you via email once the appointment date and time have been arranged.
            </p>
          </div>
        </div>

        <div class="right">
          <img src="../HomePimg/Logo.ico" class="top-logo" alt="logo" />

          <label>Appointment Date</label>
          <input type="date" name="appointment_date" required />

          <label>Appointment Time</label>
          <input type="time" name="appointment_time" required />

          <div class="button-group">
            <button type="button" class="cancel-btn" onclick="closePopup()">Cancel</button>
            <button type="submit" class="confirm-btn">Confirm</button>
          </div>
        </div>
      </div>
    </form>
  </div>


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
      text: <?php echo json_encode($error)?>,
      confirmButtonText: 'Try Again'
    });
  <?php elseif ($success): ?>
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text: <?php echo json_encode($success)?>,
      timer: 2000,
      showConfirmButton: false
    })
  <?php endif; ?>
});
</script>



  <script>
    // Expose login state for Counsellor.js and other scripts
    window.isLoggedIn =                        <?php echo json_encode(! empty($_SESSION['user_id'])); ?>;
  </script>
  <script src="../JavaScript/Counsellor.js"></script>
</body>
</html>

