<?php
// Courses.php
session_start();
include "./db_connection.php";
require_once "./Controller/CoursesController.php";



$imgFolder = '../Courses page Images/'; 
$error   = $_SESSION['login_error']   ?? '';
$success = $_SESSION['login_success'] ?? '';
$active = 'courses';
unset($_SESSION['login_error'], $_SESSION['login_success']);

// Fetch user info for profile image
$user = null;
if (!empty($_SESSION['user_id'])) {
    $stmt = $conn->prepare("SELECT user_name, profile_path FROM User_tbl WHERE user_id = ?");
    $stmt->bind_param('i', $_SESSION['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
}



//  Handle form POST (unchanged)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['signin']) && !isset($_POST['signup'])) {
    if (empty($_SESSION['user_id'])) {
        $error = "❌ You must be signed in to book an Enrollment.";
    } elseif (isset($_POST['email']) && $_POST['email'] !== ($_SESSION['email'] ?? '')) {
        $error = "❌ That email doesn’t match your logged‑in account.";
    } else {
        $user_id      = $_SESSION['user_id'];
        $course_name  = trim($_POST['course_name'] ?? '');
       

        
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

            // b) check if already enrolled
             $check = $conn->prepare("
                 SELECT enrollment_id
                 FROM Enrollment_tbl
                 WHERE user_id = ? AND course_id = ?
             ");
             $check->bind_param("ii", $user_id, $courseid);
             $check->execute();
             $checkResult = $check->get_result();

             if ($checkResult->num_rows > 0) {
                 // User already enrolled → show alert, no insert
                 echo "<script>
                        alert('⚠️ You are already enrolled in this course.');
                        window.history.back();
                                
                      </script>";
                 exit;
                 
             }
             $check->close();

            // c) insert into enrollment table
            $date = date('Y-m-d');
            $ins = $conn->prepare("
                INSERT INTO Enrollment_tbl
                  (user_id,course_id,enrollment_date,payment_status)
                VALUES (?, ?, ?, 1)
            ");
            $ins->bind_param("iis", $user_id, $courseid, $date);

            if ($ins->execute()) {
                $courseName = $course_name;
                $redirectFile = $courseName.'.php';
                echo " <script>              
                  alert('✅ Enrollment booked successfully!');
                  window.location.href = '../Courses/$redirectFile';
                  </script>";
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

$dcourses = new discountCourse($conn);
$discountCourses = $dcourses->getDiscountCourses();

?>
 <?php
ob_start();
?>
   <link rel="stylesheet" href="../CSS/Courses.css">	
   <link rel="stylesheet" href="../CSS/Payment.css">

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

      <?php if(strtolower(trim($row['fee']))==='free'): ?>
              <!-- free course -->
               <?php if (!empty($_SESSION['user_id'])): ?>
              <form method="POST" action ="" style="display:inline;">
                <input type="hidden" name="course_name" value="<?= htmlspecialchars($row['course_name']) ?>">
                <button type ="submit" class="enroll" 
                      onclick="openPopup(
                      '<?= htmlspecialchars($row['course_name']) ?>',
                      '<?= htmlspecialchars($row['fee']) ?>',
                      '<?= htmlspecialchars($row['course_id']) ?>'
                      )">Enroll</button>
              </form>
              <?php else: ?>
                  <button class="enroll"
                          onclick="
                            Swal.fire({
                              icon: 'warning',
                              title: 'Please sign in',
                              text: 'You must be signed in to enroll in a course.'
                            }).then(() => {
                              openLogin();
                            });
                          ">
                    Enroll
                  </button>
              <?php endif; ?>
              
              <?php else: ?>
              <!-- paid course -->
              <?php if (!empty($_SESSION['user_id'])): 
                $_SESSION['course_name'] = $row['course_name']; 
                $course_name = $_SESSION['course_name'] ?? '';  
              ?>
               <button class="enroll" 
                      onclick="openPopup(
                        '<?= htmlspecialchars($row['course_name']) ?>', 
                        '<?= htmlspecialchars($row['fee']) ?>', 
                        '<?= htmlspecialchars($row['course_id']) ?>'
                      )">
                  Enroll
              </button>
              <?php else: ?>
                <button class="enroll"
                        onclick="
                          Swal.fire({
                            icon: 'warning',
                            title: 'Please sign in',
                            text: 'You must be signed in to enroll in a course.'
                          }).then(() => {
                            openLogin();
                          });
                        ">
                  Enroll
                </button>
              <?php endif; ?>
            <?php endif; ?>
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
      <?php if(strtolower(trim($row['fee']))==='free'): ?>
              <!-- free course -->
               <?php if (!empty($_SESSION['user_id'])): ?>
              <form method="POST" action ="" style="display:inline;">
                <input type="hidden" name="course_name" value="<?= htmlspecialchars($row['course_name']) ?>">
                <button type ="submit" class="enroll" 
                      onclick="openPopup(
                      '<?= htmlspecialchars($row['course_name']) ?>',
                      '<?= htmlspecialchars($row['fee']) ?>',
                      '<?= htmlspecialchars($row['course_id']) ?>'
                      )">Enroll</button>
              </form>
              <?php else: ?>
                  <button class="enroll"
                          onclick="
                            Swal.fire({
                              icon: 'warning',
                              title: 'Please sign in',
                              text: 'You must be signed in to enroll in a course.'
                            }).then(() => {
                              openLogin();
                            });
                          ">
                    Enroll
                  </button>
              <?php endif; ?>
              
              <?php else: ?>
              <!-- paid course -->
              <?php if (!empty($_SESSION['user_id'])): 
                $_SESSION['course_name'] = $row['course_name']; 
                $course_name = $_SESSION['course_name'] ?? '';  
              ?>
               <button class="enroll" 
                      onclick="openPopup(
                        '<?= htmlspecialchars($row['course_name']) ?>', 
                        '<?= htmlspecialchars($row['fee']) ?>', 
                        '<?= htmlspecialchars($row['course_id']) ?>'
                      )">
                  Enroll
              </button>
              <?php else: ?>
                <button class="enroll"
                        onclick="
                          Swal.fire({
                            icon: 'warning',
                            title: 'Please sign in',
                            text: 'You must be signed in to enroll in a course.'
                          }).then(() => {
                            openLogin();
                          });
                        ">
                  Enroll
                </button>
              <?php endif; ?>
            <?php endif; ?>
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
      <?php if (!empty($discountCourses)): ?>
        <h2>Discount Courses</h2>
        <?php foreach ($discountCourses as $percent): ?>
          <p>Get <span class="red"><?= (int)$percent ?>%</span> discount for the very first enrolled course.</p>
          <br>
          <p>Two courses enrolled and get <span class="red"><?=min((int) $percent * 2 ,100)?>%</span> discount.</p>
        <?php endforeach; ?>
      <?php else:?>
        <p>Promotion coming soon!</p>
        <?php endif; ?>
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

    
    <!-- Payment Popup -->
    <div id="payment-popup" class="popup">
      <form method="POST" action="Payment Form.php" enctype="multipart/form-data">
        <input type="hidden" name="payment_name" id="payment-input" />
        <input type="hidden" name="course_name"  value="<?= htmlspecialchars($course_name ?? '') ?>">
      

      <div class="payment"> 
        <div class="left">
          <div class="Logo-title"><img src="../HomePimg/Logo.ico" class="logo-image" alt="logo">
            <h2>PAYMENT FORM</h2></div>
          <img src="../Counsellor_page_images/White Tulip.png" class="flower-image1" alt="logo">
          <img src="../Counsellor_page_images/Pink Tulip.png" class="flower-image" alt="logo">
          <div class="textbox">

            <label>Name</label>
            <input type="text" name="user_name" value="<?= htmlspecialchars($user_name ?? '') ?>" placeholder="Your name" required />

            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" placeholder="your@email.com" required /
            >
            <label>Phone Number</label>
            <input type="phone" name="phone" value="<?= htmlspecialchars($phone ?? '') ?>" placeholder="+95: 09..." required />

            <p class="disclaimer">
              We requestyou to remit the paymet to:<br><br>
                <strong>Kpay Number: 09-12345678 </strong><br>
                <strong>Wave Number: 09-12345678 </strong><br><br>
                We will notify you once the payment has been successfully completed.
            </p>
          </div>
        </div>
        <div class="right">
          <p>Payment Method</p>
          <img src="../HomePimg/tulips-removebg-preview.png" class="flower-image2" alt="logo">

          <div class="payment-options">
            <label class="payment-option">
              <input type="radio" name="payment_method" value="KBZpay" style="display:none;">
              <img src="../Courses page Images/kpay.png" onclick="selectMethod('KBZpay')" />
            </label>

            <label class="payment-option">
              <input type="radio" name="payment_method" value="Wave Money" style="display:none;">
              <img src="../Courses page Images/wave pay.png" onclick="selectMethod('Wave Money')" />
            </label>

            <label class="payment-option">
              <input type="radio" name="payment_method" value="Paypal" style="display:none;">
              <img src="../Courses page Images/paypal.png" onclick="selectMethod('Paypal')" />
            </label>
          </div>

          <div class="thank"> "Thanks for choosing us! Let’s make learning powerful and enjoyable together."
          </div>
          <div class="Transcription">
            <p >Payment Transcription</p>
            <P><strong>REQUIRED</strong></P>
          </div>

          <input class="file" type="file" name="file" accept=".jpg, .jpeg, .png, .pdf" id="payment_file" required>
          <div class="button-group">
            <button type="button" class="cancel-btn" onclick="closePopup()">Cancel</button>
            <button type="submit" class="confirm-btn">Save</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
  <!-- load Courses.js, which needs window.isLoggedIn -->
  <script src="../JavaScript/Courses.js"></script>
  <script>
    window.isLoggedIn = <?= !empty($_SESSION['user_id']) ? 'true' : 'false' ?>;
 </script>
  

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

  <!-- 3) openLogin/closeLogin & click‐outside & showLogin=1 logic -->
  <script>
    //Mobile menu toggle function 
    function toggleMobileMenu() {
        const nav = document.getElementById('nav-menu');
        nav.classList.toggle('active');
      }


  </script>

<?php
$content = ob_get_clean(); 
require './logo_container.php';
?>
