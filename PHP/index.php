<?php
  // pick up any flash‐error or ‐success from login.php
  session_start();
  $error   = $_SESSION['login_error']   ?? '';
  $success = $_SESSION['login_success'] ?? '';
  unset($_SESSION['login_error'], $_SESSION['login_success']);
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
     <link rel="icon" href="../HomePimg/Logo.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Vollkorn:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../CSS/Homepage.css">
    <title>Pann Pyoe Thu</title>
</head>
<body>
   <div class="homepage">
        <header class="header">
            <div class="logo">
                <img src="../HomePimg/Logo.ico" alt="Pann Pyoe Thu logo" class="logo-img" />
                <span class="logo-text">Pann Pyoe Thu</span>
            </div>

            <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Open navigation menu" tabindex="0">
                <span></span>
                <span></span>
                <span></span>
            </button>

            <nav class="nav" id="mainNav">
                <a href="../PHP/index.php">Home</a>
                    <a href="../PHP/About Us.php">About us</a>
                    <a href="../PHP/Courses.php">Courses</a>
                    <a href="../PHP/Counsellor.php">Educational Counsellors</a>
                    <a href="../PHP/Scholarship.php">Scholarships</a>
                    <a href="../PHP/Local Uni.php">Local Universities</a>
                    <a href="../PHP/Jobs.php">Job Opportunities</a>
                </nav> 
                
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
            <li><a class="dropdown-item" href="Profile.php">My Profile</a></li>
            <li><a class="dropdown-item" href="settings.php">Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
        </div>
                            

            <?php else: ?>
            <div class="profile-icon" onclick="openLogin()">
                <img src="../HomePimg/Profile.png" alt="Profile" class="profile-img" />
            </div>
            <?php endif; ?>
        </header>

        <div class="search-bar">
            <input type="text" placeholder="Search..." />
            <button>🔍</button>
        </div>
        
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
                                <a href="#">See Profile...</a>
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
            <div class="card card1">
                <div class="card-image">
                    <img src="../Courses page Images/equality-removebg-preview.png" alt="Equality">
                </div>
                <div class="card-text">
                    <h3>Gender Studies Courses</h3>
                    <p>Fees - Free</p>
                    <p>Type - Paper Format</p>
                </div>
                <div class="learn-card">
                    <a class="learn-more" href="#">Learn more</a>
                </div>
            </div>

            <div class="card card2">
                <div class="card-image">
                    <img src="../Courses page Images/critical thinking.jpg" alt="Thinking">
                </div>
                <div class="card-text1">
                    <h3>Critical Thinking Courses</h3>
                    <p>Fees - Free</p>
                    <p>Type - Paper Format</p>
                </div>
                <div class="learn-card1">
                    <a class="learn-more1" href="#">Learn more</a>
                </div>
            </div>

            <div class="card card3">
                <div class="card-image">
                    <img src="../Courses page Images/project-removebg-preview.png" alt="ICT Programming">
                </div>
                <div class="card-text">
                    <h3>ICT Projectment Course</h3>
                    <p>Fees - 30000 kyats</p>
                    <p>Type - Video Lectures</p>
                </div>
                <div class="learn-card">
                    <a class="learn-more" href="#">Learn more</a>
                </div>
            </div>
        </div>

        <h1>Upcoming Course Offerings</h1>
        <div class="card-container">
            <div class="course-offer card4">
                <img src="../Courses page Images/programming.png" alt="Programming">    
                <div class="course-text">
                    <p>Programming</p>
                </div>
            </div>

            <div class="course-offer card4">
                <img src="../Courses page Images/languages.png" alt="Languages">
                <div class="course-text">
                    <p>Languages</p>
                </div>
            </div>

            <div class="course-offer card4">
                <img src="../Courses page Images/musicpic.png" alt="Music">
                <div class="course-text">
                    <p>Music Lessons</p>
                </div>
            </div>
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
<<<<<<< HEAD
    </div> 





     <!-- … your header, form, etc … -->
=======
    </div>
     
    
  <script>
document.addEventListener('DOMContentLoaded', () => {
  const avatar = document.getElementById('profileAvatar');
  const menu   = document.getElementById('profileDropdownMenu');

  if (avatar && menu) {
    // Toggle the dropdown on avatar click
    avatar.addEventListener('click', e => {
      e.stopPropagation();
      menu.classList.toggle('show');
    });

    // Clicking anywhere else closes it
    document.addEventListener('click', () => {
      menu.classList.remove('show');
    });
  }
});
</script>





    
    <!-- … your header, form, etc … -->
>>>>>>> 8c174fda73f63aa29b7b65a3c407437182756938
<?php include 'login_modal.php'; ?>

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
