<?php
    // Counsellor.php
    session_start();

    // capture raw flash values then clear them
    $raw_login_error   = $_SESSION['login_error'] ?? '';
    $raw_login_success = $_SESSION['login_success'] ?? '';
    $raw_login_from    = $_SESSION['login_from'] ?? '';
    unset($_SESSION['login_error'], $_SESSION['login_success'], $_SESSION['login_from']);

    // default appointment error/success (these may be set by appointment POST handler later)
    $error   = '';
    $success = '';

    // If user is NOT logged in, decide what to show based on where the login came from
    if (empty($_SESSION['user_id'])) {
        if ($raw_login_from === 'appointment') {
            // login was attempted while booking an appointment — surface the error as appointment error
            $error = $raw_login_error;
        } else {
            // login was attempted from normal login flow — surface as login modal error instead
            // pass this to JS so the login modal shows the message (we'll set JS var `loginModalError`)
            $loginModalError = $raw_login_error;
        }
    } else {
        // logged-in user — ignore prior login errors
        $error = ''; 
        $loginModalError = '';
    }

    include "./db_connection.php";
    $active = 'counsellors';
    $user = null;
    if (! empty($_SESSION['user_id'])) {
        $stmt = $conn->prepare("SELECT user_name, profile_path FROM User_tbl WHERE user_id = ?");
        $stmt->bind_param('i', $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $user   = $result->fetch_assoc();
        $stmt->close();
    }
    // print_r($user);
    require_once "./Controller/CounsellorController.php";

    $imgFolder = '../Counsellor_page_images/';

 // ===== in Counsellor.php, inside your existing POST handler =====
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ! isset($_POST['signin']) && ! isset($_POST['signup'])) {
    if (empty($_SESSION['user_id'])) {
        $error = "❌ You must be signed in to book an appointment.";
    } elseif (!isset($_POST['email']) || $_POST['email'] !== ($_SESSION['email'] ?? '')) {
        $error = "❌ That email doesn’t match your logged-in account.";
    } else {
        $user_id      = (int) $_SESSION['user_id'];
        $advisor_name = trim((string)($_POST['advisor_name'] ?? ''));
        $description  = trim((string)($_POST['description'] ?? ''));
        $date         = trim((string)($_POST['appointment_date'] ?? ''));
        $time         = trim((string)($_POST['appointment_time'] ?? ''));

        // basic required fields
        if ($advisor_name === '' || $description === '' || $date === '' || $time === '') {
            $error = "Please fill in all fields.";
        } else {
            // Stronger date/time validation using DateTime
            $d = DateTime::createFromFormat('Y-m-d', $date);
            $t = DateTime::createFromFormat('H:i', $time) ?: DateTime::createFromFormat('H:i:s', $time);
            if (!($d && $d->format('Y-m-d') === $date)) {
                $error = "Invalid date format. Use YYYY-MM-DD.";
            } elseif (!($t && ($t->format('H:i') === substr($time,0,5) || $t->format('H:i:s') === $time))) {
                $error = "Invalid time format. Use HH:MM or HH:MM:SS.";
            } else {
                // 1) find counsellor id
                $cs = $conn->prepare("SELECT counsellor_id FROM Counsellor_tbl WHERE counsellor_name = ? LIMIT 1");
                if (! $cs) {
                    $error = "Server error (prepare): " . $conn->error;
                } else {
                    $cs->bind_param("s", $advisor_name);
                    $cs->execute();
                    $cres = $cs->get_result();

                    if (! $cres || $cres->num_rows === 0) {
                        $error = "⚠️ Counsellor “" . htmlspecialchars($advisor_name) . "” not found.";
                    } else {
                        $cid = (int) $cres->fetch_assoc()['counsellor_id'];
                        $cs->close();

                        // OPTIONAL: prevent double booking for same counsellor/date/time (excluding Cancelled if you want)
                        $chk = $conn->prepare("
                            SELECT COUNT(*) AS cnt
                              FROM Appointment_tbl
                             WHERE counsellor_id = ?
                               AND appointment_date = ?
                               AND appointment_time = ?
                               AND appointment_status <> 'Cancelled'
                        ");
                        if (! $chk) {
                            $error = "Server error (prepare chk): " . $conn->error;
                        } else {
                            $chk->bind_param("iss", $cid, $date, $time);
                            $chk->execute();
                            $cres2 = $chk->get_result();
                            $row = $cres2->fetch_assoc();
                            $count = (int)($row['cnt'] ?? 0);
                            $chk->close();

                            if ($count > 0) {
                                $error = "That time slot is already taken for this counsellor. Please choose another time.";
                            } else {
                                // insert appointment with default status = 'Pending'
                                $ins = $conn->prepare("
                                  INSERT INTO Appointment_tbl
                                    (user_id, counsellor_id, appointment_date, appointment_time, description, appointment_status)
                                  VALUES (?, ?, ?, ?, ?, ?)
                                ");
                                if (! $ins) {
                                    $error = "Server error (prepare insert): " . $conn->error;
                                } else {
                                    $status = 'Pending'; // default initial state
                                    $ins->bind_param("iissss", $user_id, $cid, $date, $time, $description, $status);

                                    if ($ins->execute()) {
                                        $success = "✅ Appointment booked successfully! Status: {$status}";
                                    } else {
                                        $error = "❌ Error inserting appointment: " . $ins->error;
                                    }
                                    $ins->close();
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}



    // 2) Fetch dynamic list of counsellors from DB
    $controller = new CounsellorController($conn);
    $advisors   = $controller->getAllCounsellors();

    $conn->close();
?>
  <?php
ob_start();
?>
  <link rel="stylesheet" href="../CSS/Counsellor.css" />
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <!-- SweetAlert2 JS -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>  -->


        <div class = "block" style="background-color:#1D2733; padding:35px;"></div>


      <script>
        document.addEventListener('DOMContentLoaded', () => {
        const isLoggedIn = <?php echo json_encode(! empty($_SESSION['user_id'])); ?>;
        const errorMsg   = <?php echo json_encode($error ?? ''); ?>;
        const successMsg = <?php echo json_encode($success ?? ''); ?>;
        const advisorVal = <?php echo json_encode($advisor_name ?? ($_POST['advisor_name'] ?? '')); ?>;
        const loginModalError = <?php echo json_encode($loginModalError ?? ''); ?>;

        // If login modal error exists and user not logged in, open login modal (not appointment popup)
        if (!isLoggedIn && loginModalError) {
          if (typeof openLogin === 'function') {
            // openLogin(); // open the login modal
          }
          Swal.fire({
            icon: 'error',
            title: 'Login failed',
            text: loginModalError,
            confirmButtonText: 'OK'
          });
          return;
        }

        // Appointment-specific behaviour (unchanged)
        if (errorMsg) {
          if (typeof openPopup === 'function') {
            openPopup(advisorVal, true);
          }
          // populate form fields...
          const form = document.querySelector('#appointment-popup form');
          if (form) {
            try {
              form.elements['user_name'].value         = <?php echo json_encode($_POST['user_name'] ?? '')?>;
              form.elements['description'].value      = <?php echo json_encode($_POST['description'] ?? '')?>;
              form.elements['email'].value            = <?php echo json_encode($_POST['email'] ?? '')?>;
              form.elements['appointment_date'].value = <?php echo json_encode($_POST['appointment_date'] ?? '')?>;
              form.elements['appointment_time'].value = <?php echo json_encode($_POST['appointment_time'] ?? '')?>;
              const advInput = document.getElementById('advisor-input');
              if (advInput) advInput.value = <?php echo json_encode($_POST['advisor_name'] ?? ''); ?>;
            } catch (e) {
              console.error('Failed to populate appointment form values', e);
            }
          }
          Swal.fire({
            icon: 'error',
            title: 'Oops…',
            text: errorMsg,
            confirmButtonText: 'Try Again'
          });
          return;
        }

        if (successMsg) {
          Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: successMsg.trim(),
            timer: 2000,
            showConfirmButton: false
          });
        }

        // Defensive guard: if some code tries to open login modal when user is logged in,
        // ensure appointment popup opens instead. This attaches safe behavior to appointment buttons.
        document.querySelectorAll('.appointment-btn').forEach(btn => {
          btn.addEventListener('click', (e) => {
            // If the button was meant to open login (not the case for logged-in view),
            // prevent that and open popup when user is already logged in.
            if (isLoggedIn) {
              // try to read counsellor name from onclick string or data attribute
              let advisorName = '';
              if (btn.dataset && btn.dataset.advisorName) {
                advisorName = btn.dataset.advisorName;
              } else {
                // fallback: parse name from inline onclick (if you have onclick="openPopup('Name')")
                const onclick = btn.getAttribute('onclick') || '';
                const m = onclick.match(/openPopup\(['"](.+?)['"]/);
                if (m) advisorName = m[1];
              }

              // ensure popup opens for logged-in users
              if (typeof openPopup === 'function') {
                e.preventDefault();  //stops the browser’s default action
                openPopup(advisorName);
              }
            }
          });
        });
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
        <a class="about-us" href="../PHP/About Us.php">About Us</a>
        
        <a class="education-counselling" href="../PHP/Counsellor.php">Education Counsellors</a>
      
        <a class="local-universities" href="../PHP/Local Uni.php">Local Universities</a>
        
        <a class="job-opportunities" href="../PHP/Jobs.php">Job Opportunities</a>
       
        <a class="scholarships" href="../PHP/Scholarship.php">Scholarships</a>
      
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
  </div>
  <!-- Appointment Popup -->
  <!-- Appointment Popup -->
  <div id="appointment-popup" class="popup">
    <form method="POST" action="Counsellor.php">
      <input type="hidden" name="advisor_name" id="advisor-input" />

      <div class="card">
        <!-- <span class="close-btn" onclick="closePopup()">&times;</span> -->
        <img src="../HomePimg/tulips-removebg-preview.png" class="flower-image" alt="flowers" />

        <div class="left">
          <h2>Get appointment with <span id="advisor-name">………</span></h2>
          <div class="textbox">
            <label>Enter your name</label>
            <input type="text" name="user_name" placeholder="Your name" required />

            <label>What kind of education counselling you want to get</label>
            <textarea name="description" placeholder="Your response…" required></textarea>

            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>" readonly />


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

  

  <!-- 4) Flash‐and‐SweetAlert2 trigger on login/signup errors or success -->
  <script>

//Mobile menu toggle function
    function toggleMobileMenu() {
        const nav = document.getElementById('nav-menu');
        nav.classList.toggle('active');
      }
</script>



  <script>
    // Expose login state for Counsellor.js and other scripts
    window.isLoggedIn =                        <?php echo json_encode(! empty($_SESSION['user_id'])); ?>;
  </script>
  <script src="../JavaScript/Counsellor.js"></script>
<?php
$content = ob_get_clean(); 
require './logo_container.php';
?>
