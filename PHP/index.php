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



    <!-- Consulting Section -->
    <div class="consult-slider">
        <div class="consult-slider-track">
            <div class="consult-slide">
                <div class="profile-slide">
                    <div class="consult">
                        <div class="consult-photo2">
                            <div class="background-box one"></div>
                            <div class="background-box two"></div>
                            <img src="../HomePimg/counsellor 1.png" alt="Cathy Doll">
                        </div>
                        <div class="consult-text">
                            <div class="consult-name">Name-Cathy Doll</div>
                            <h3>"Consult with us for your further academic studies"</h3>
                            <p>"Guidance is not about giving answers—it's about helping students ask the right questions."</p>
                            <p>Education counsellors walk beside students at crossroads—offering wisdom, support, and hope when decisions feel overwhelming and dreams feel distant.</p>
                            <div class="see">
                                <a href="#">See Profile...</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="consult-slide">
                <div class="profile-slide">
                    <div class="consult">
                        <div class="consult-photo1">
                            <div class="background-box three"></div>
                            <img src="../HomePimg/counsellor 2.png" alt="Mercy Donan">
                        </div>
                        <div class="consult-text">
                            <div class="consult-name1">Name-Mercy Donan</div>
                            <h3>"Consult with us for your further academic studies"</h3>
                            <p>"To guide a student is to shape a future, one decision at a time."</p>
                            <p>You don't need to have it all figured out. That's why I'm here—to help you discover your strengths, set your goals, and make confident decisions about your future..........</p>
                            <div class="see">
                                <a href="#">See Profile...</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="consult-slide">
                <div class="profile-slide">
                    <div class="consult">
                        <div class="consult-photo">
                            <div class="background-box four"></div>
                            <div class="background-box five"></div>
                            <img src="../HomePimg/counsellor 3.png" alt="David Johnson">
                        </div>
                        <div class="consult-text">
                            <div class="consult-name">Name-David Johnson</div>
                            <h3>"Consult with us for your further academic studies"</h3>
                            <p>"To guide a student is to shape a future, one decision at a time."</p>
                            <p>You don't need to have it all figured out. That's why I'm here—to help you discover your strengths, set your goals, and make confident decisions about your future..........</p>
                            <div class="see">
                                <a href="../PHP/Counsellor.php">See Profile...</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        <a class="about-us" href="../PHP/About Us.php">Tap here to learn more About Us</a>
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
