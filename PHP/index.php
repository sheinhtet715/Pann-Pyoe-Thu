<?php
// pick up any flash‐error or ‐success from login.php
session_start();
$error   = $_SESSION['login_error'] ?? '';
$success = $_SESSION['login_success'] ?? '';
unset($_SESSION['login_error'], $_SESSION['login_success']);
$active = 'home';
// DB connection and course controller logic
include "./db_connection.php";
include "./Controller/CoursesController.php";
$imgFolder = '../Courses page images/';

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

// Fetch data from course
$pcourse = new PopularCourse($conn);
$popularCourses = $pcourse->getPopularCourses();
$upcourse = new UpcomingCourse($conn);
$upcomingCourses = $upcourse->getUpcomingCourses();
?>
    <?php
ob_start();
?>
  
    <link rel="stylesheet" href="../CSS/Homepage.css">
 
    <div class="homepage">
        <main class="main-content">
            <div class="quote-box">
                <p>
                    <span class="highlight">"Pann Pyoe Thu</span> is dedicated to nurturing Myanmar's youth through quality education, practical guidance, and career empowerment."
                </p>
            </div>

            <section class="features">
                <div class="feature">
                    <img src="../HomePimg/ambitious.png" alt="Enhance skills" />
                    <h3>Enhance skills</h3>
                    <p>Develop practical and professional life skills</p>
                </div>
                <div class="feature">
                    <img src="../Counsellor_page_images/target_icon.png" alt="Guidance" />
                    <h3>Guidance</h3>
                    <p>Mentorship that opens doors to success</p>
                </div>
                <div class="feature">
                    <img src="../HomePimg/opportunitiesss.png" alt="Opportunities" />
                    <h3>Opportunities</h3>
                    <p>Career opportunities and growth</p>
                </div>
            </section>
        </main>

        <section class="introduction-section">
            <div class="intro-left">
                <div class="black-rectangle"></div>
                <div class="brown-rectangle"></div>
                <div class="intro-text">
                    <p class="subtext">Support young minds with</p>
                    <h1 class="maintext">
                        <span class="pann">Pann</span>
                        <span class="pyoe">Pyoe</span>
                        <span class="thu">Thu</span>
                    </h1>
                </div>
            </div>
            <div class="intro-right">
                <div class="video-placeholder">
                <iframe
                    width="100%"
                    height="315"
                    src="https://www.youtube.com/embed/07KJ3IAsJjQ?si=1zlI4jav5n3Y_bw8&start=1"
                    title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin"
                    allowfullscreen>
                </iframe>
                 </div>
            </div>
        </section>
    </div>

<!-- Counsellor Slide Start  -->
            <style>
            * {box-sizing: border-box;}
            .Counsellor {display: none;}
            img {vertical-align: middle;}

            /* Slideshow container */
            .slideshow-container {
            max-width: 1100px;
            position: relative;
            margin: auto;
            }

            /* Caption text */
            .text .word {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 10px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
            text-decoration: none;
            }

            /* The dots/bullets/indicators */
            .dot {
            height: 10px;
            width: 10px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
            }

            .active {
            background-color: #717171;
            }

            /* Fading animation */
            .fade {
            animation-name: fade;
            animation-duration: 2s;
            }

            @keyframes fade {
            from {opacity: .4} 
            to {opacity: 1}
            }

            /* On smaller screens, decrease text size */
            @media only screen and (max-width: 300px) {
            .text {font-size: 11px}
            }
            </style>

            <div class="slideshow-container">

            <div class="Counsellor fade">
            <img src="../HomePimg/C1.jpg" style="width:100%">
            <div class="text"><a  class="word" href= "../PHP/Counsellor.php">See details</a></div>
            </div>

            <div class="Counsellor fade">
            <img src="../HomePimg/C2.jpg" style="width:100%">
             <div class="text"><a class="word" href= "../PHP/Counsellor.php">See details</a></div>
            </div>

            <div class="Counsellor fade">
            <img src="../HomePimg/C3.jpg" style="width:100%">
             <div class="text"><a class="word" href= "../PHP/Counsellor.php">See details</a></div>
            </div>
            </div>
            <br>

            <div style="text-align:center">
            <span class="dot"></span> 
            <span class="dot"></span> 
            <span class="dot"></span> 
            </div>

            <script>
            let slideIndex = 0;
            showSlides();

            function showSlides() {
            let i;
            let slides = document.getElementsByClassName("Counsellor");
            let dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}    
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";  
            dots[slideIndex-1].className += " active";
            setTimeout(showSlides, 2000); // Change image every 2 seconds
            }
            </script>

    <!-- Counsellor End  -->

    <!-- Popular Courses Section -->
    <div class="popular-course">
        <h1>Popular Courses</h1>
        <div class="card-container">
                <?php
                     $colors = ['#EBD8C6', '#94C3CE', '#F2E1C1', '#9CC2CF','#BF9E8D']; // Initial colors for courses
                     $index = 0; 
                    foreach ($popularCourses as $row): 
                    $bgColor = $colors[$index % count($colors)];
                    ?>
            <div class="card " style="background-color: <?= $bgColor ?>;">
                <div class="card-image">
                    <img src="<?=htmlspecialchars($imgFolder.($row['image_url']))?>" 
                        alt="<?=htmlspecialchars($row['course_name'])?>">
                </div>
                <div class="card-text">
                    <h3><?=htmlspecialchars($row['course_name'])?></h3>
                    <p>Fees - <?=htmlspecialchars($row['fee'])?></p>
                    <p>Type - <?=htmlspecialchars($row['type'])?></p>
                </div>
                <div class="learn-card">
                    <a class="learn-more" href="Courses.php">Learn more</a>
                </div>
                </div>
                <?php
                $index++;
                endforeach; ?>

        </div>
    </div>
        <div class="stay-tuned">   
            <h1>Upcoming Course Offerings</h1>
            <div class="upcoming-course">
            <?php foreach ($upcomingCourses as $row): ?>
                <div class="course-offer cardupcoming">
                    <img src="<?= htmlspecialchars($imgFolder.($row['icon_url'])) ?>" 
                    alt="<?= htmlspecialchars($row['course_name']) ?> Icon">
                    <div class="offer-text">
                        <p><?= htmlspecialchars($row['course_name']) ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>


    <div class="speech">
        <p>"Education becomes more meaningful when guided by the right counselling, helping students choose the right course university and career."</p>
    </div>

    <div class="slider-wrapper">
        <div class="slider">
            <div class="slides">
                <div class="slide">
                    <img src="../HomePimg/e-learning.jpg" alt="Image 7">
                    <img src="../HomePimg/online learning.jpg" alt="Image 8">
                </div>
                <div class="slide">
                    <img src="../HomePimg/landscape counseling.jpg" alt="Image 9">
                    <img src="../HomePimg/scholarships.jpg" alt="Image 10">
                </div>
            </div>
        </div>
    </div>

    <div class="us-text">
        <a class="about-us" href="#">Tap here to learn more About Us</a>
    </div>



    <!-- Footer -->
        <?php
        include_once "Footer.php"
        ?>




<!-- 1) Load your libraries -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script src="../JavaScript/Homepage.js"></script>

<!-- 2) Fire the flash (only once!) and wire up open/close -->
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
    })
    .then(() => {
      openLogin();
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
