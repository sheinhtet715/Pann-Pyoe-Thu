<?php
    // pick up any flash‐error or ‐success from login.php
    session_start();
    $error   = $_SESSION['login_error'] ?? '';
    $success = $_SESSION['login_success'] ?? '';
    unset($_SESSION['login_error'], $_SESSION['login_success']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <link rel="icon" href="../HomePimg/Logo.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="../CSS/Local Uni.css">
    <title>Local Universities</title>
    
</head>
<body>
    <header class="header">
        <div class="logo">
            <img src="../HomePimg/Logo.ico" alt="Pann Pyoe Thu logo" class="logo-img" />
            <span class="logo-text">Pann Pyoe Thu</span>
        </div>

        <nav class="nav" id="nav-menu">
            <a href="../PHP/index.php">Home</a>
            <a href="../PHP/About Us.php">About Us</a>
            <a href="../PHP/Courses.php">Courses</a>
            <a href="../PHP/Counsellor.php">Educational Counsellors</a>
            <a href="../PHP/Scholarship.php">Scholarships</a>
            <a href="../PHP/Local Uni.php">Local Universities</a>
            <a href="../PHP/Jobs.php">Job Opportunities</a>
        </nav>
        <button class="mobile-menu-toggle" onclick="toggleMobileMenu()" aria-label="Toggle mobile menu">
        <span></span>
        <span></span>
        <span></span>
      </button>

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
          src="../<?php echo htmlspecialchars($user['profile_path'])?>"
          alt="Profile"
          class="profile-img"
          style="width:24px; height:24px; object-fit:cover;"
        >
        <?php else: ?>
            <!-- fallback SVG -->
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
            <path d="M12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12Z" fill="white"/>
            <path d="M12 14C7.58172 14 4 17.5817 4 22H20C20 17.5817 16.4183 14 12 14Z" fill="white"/>
            </svg>
        <?php endif; ?>
                </button>
            <ul class="dropdown-menu dropdown-menu-end"
                aria-labelledby="profileDropdownBtn">
            <li><a class="dropdown-item" href="Profile.php">My Profile</a></li>
            <li><a class="dropdown-item" href="settings.php">Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="Local Uni_Logout.php">Logout</a></li>
            </ul>
        </div>


            <?php else: ?>
            <div class="profile-icon" onclick="openLogin()">
                <img src="../HomePimg/Profile.png" alt="Profile" class="profile-img" />
            </div>
            <?php endif; ?>
    </header>

        <div class="starter-text">
            <h1>Local Universities</h1>
            <p>Discover the best local universities near you—each offering unique programs, vibrant student communities, and opportunities to shape your future. Find the right fit for your academic and career goals right here in your area.</p>
        </div>

    <div class="container">
        <div class="card university">
            <div class="uni-content">
                 <img src="../Local_uni_images/um1.jfif"  alt="Medicine1">
                    <div class="uni-text">
                        <h1>University of Medicine (1)</h1>
                            <p>Location - No.245, Myoma Kyaung Street, Lanmadaw Township, Yangon, Myanmar.</p>
                            <p>Academic - 7‑year M.B.,B.S including 1‑year internship</p>
                            <p>Admissions - High school science pass + qualifying aggregate</p>
                            <p>Curriculum - Mix of foundational, pre‑clinical, clinical, and field training</p>
                    </div>
            </div>
        </div>
                
        <div class="card uni-icon">
             <img src="../Local_uni_images/um1 front gate.jfif"  alt="University1">
                <div class="visit-container">
                    <div class="visit-text">
                    <a href="https://um1yangon.edu.mm/en/" target="_blank">Visit Website</a>
                </div>
        </div>
    </div>


    <div class="card university">
        <div class="uni-content">
        <img src="../Local_uni_images/um2 logo.png" alt="Medicine2">
        <div class="uni-text">
            <h1>University of Medicine (2)</h1>
            <p>Location - North Okkapala, Yangon</p>
            <p>Academic - 7years: Foundation → Pre‑clinical → Clinical → 1‑yr internship</p>
            <p>Admissions - High school science pass + qualifying aggregate</p>
            <p>Curriculum - Mix of foundational, pre‑clinical, clinical, and field training</p>
        </div>
        </div>
    </div>

    <div class="card uni-icon">
        <img src="../Local_uni_images/um2 front gate.jfif" alt="University2">
        <div class="visit-container">
        <div class="visit-text">
        <a href="https://um2ygn.edu.mm/" target="_blank">Visit Website</a>
        </div>
        </div>
    </div>   

    <div class="card university">
        <div class="uni-content">
        <img src="../Local_uni_images/um, magway.png" alt="Medicine3">
        <div class="uni-text">
        <h1>University of Medicine, Magway</h1>
        <p>Location - Magway City, Magway Region</p>
        <p>Academic - 6–7 years: Foundation → Pre‑clinical → Clinical → (Internship)</p>
        <p>Admissions - Science matriculation pass + qualifying entrance exam scores</p>
        <p>Curriculum - Integrated system modules + clinical rotations + community training</p>
        </div>
        </div>
    </div>

    <div class="card uni-icon">
        <img src="../Local_uni_images/um, magway front gate.JPG" alt="University3">
        <div class="visit-container">
        <div class="visit-text">
        <a href="https://www.ummg.edu.mm/" target="_blank">Visit Website</a>
        </div>
        </div>
    </div>

    <div class="card university">
        <div class="uni-content">
        <img src="../Local_uni_images/um taunggyi.jfif" alt="Medicine4">
        <div class="uni-text">
        <h1>University of Medicine, Taunggyi</h1>
        <p>Location - Taunggyi, Shan State</p>
        <p>Academic - 7‑year M.B.,B.S (250 credits, internship included)</p>
        <p>Admissions - Science matriculation pass + qualifying entrance exam scores></p>
        <p>Curriculum - Foundational → Pre‑clinical → Clinical → Internship with rural/community exposure</p>
        </div>
        </div>
    </div>

    <div class="card uni-icon">
        <img src="../Local_uni_images/Um taunggyi front gate.jpg" alt="University4">
        <div class="visit-container">
        <div class="visit-text">
        <a href="https://umtgi.edu.mm/" target="_blank">Visit Website</a>
        </div>
        </div>
    </div>

    <div class="card university">
        <div class="uni-content">
        <img src="../Local_uni_images/Eco-Dept-Logo.jpg" alt="Medicine4">
        <div class="uni-text">
        <h1>Yangon University of Economics</h1>
        <p>Location – Yangon, Kamayut Township</p>
        <p>Academic – Bachelor's, Master's, and Doctorate degrees </p>
        <p>Admissions – Matriculation pass + entrance exam for undergrad; bachelor’s with merit for postgrad.</p>
        <p>Curriculum – Core in economics, management, finance, stats, quantitative and policy modules, with fieldwork and internships.</p>
        </div>
        </div>
    </div>

    <div class="card uni-icon">
        <img src="../Local_uni_images/Eco front gate.jpg" alt="University4">
        <div class="visit-container">
        <div class="visit-text">
        <a href="https://yueco.edu.mm/?page_id=87" target="_blank">Visit Website</a>
        </div>
        </div>
    </div>

    <div class="card university">
        <div class="uni-content">
        <img src="../Local_uni_images/yufl logo.png" alt="Medicine4">
        <div class="uni-text">
        <h1>Yangon University of Foreign Languages</h1>
        <p>Location – Yangon, Kamayut Township</p>
        <p>Academic – Bachelor's and Master's degrees</p>
        <p>Admissions – Matriculation pass with qualifying entrance exam and interview</p>
        <p>Curriculum – Language theory, linguistics, cultural studies, translation and interpretation, plus language immersion programs and exchange partnerships</p>
        </div>
        </div>
    </div>

    <div class="card uni-icon">
        <img src="../Local_uni_images/yufl front gate.jpg" alt="University4">
        <div class="visit-container">
        <div class="visit-text">
        <a href="https://www.yufl.edu.mm/" target="_blank">Visit Website</a>
        </div>
        </div>
    </div>

    <div class="card university">
        <div class="uni-content">
        <img src="../Local_uni_images/Computer uni logo.png" alt="Medicine4">
        <div class="uni-text">
        <h1>University of Computer Studies, Yangon</h1>
        <p>Location – Yangon, Hlawga </p>
        <p>Academic – Bachelor's (4 years), Master's, and Doctorate degrees </p>
        <p>Admissions – Science matriculation pass with high entrance exam scores, particularly in Mathematics and English </p>
        <p>Curriculum – Programming, algorithms, software engineering, database systems, AI, networking, capstone projects, and IT industry internships</p>
        </div>
        </div>
    </div>

    <div class="card uni-icon">
        <img src="../Local_uni_images/computer uni front gate.jpg" alt="University4">
        <div class="visit-container">
        <div class="visit-text">
        <a href="https://www.ucsy.edu.mm/history.do" target="_blank">Visit Website</a>
        </div>
        </div>
    </div>

    <div class="card university">
        <div class="uni-content">
        <img src="../Local_uni_images/pharmacy logo.png" alt="Medicine4">
        <div class="uni-text">
        <h1>University of Pharmacy, Yangon</h1>
        <p>Location – Yangon, North Okkalapa Township</p>
        <p>Academic – 5-year B.Pharm degree</p>
        <p>Admissions – Science matriculation pass with qualifying entrance exam performance</p>
        <p>Curriculum – Pharmaceutical sciences, pharmacology, pharmaceutics, pharmacy practice, hospital and industrial attachments</p>
        </div>
        </div>
    </div>

    <div class="card uni-icon">
        <img src="../Local_uni_images/pharmacy front page.jfif" alt="University4">
        <div class="visit-container">
        <div class="visit-text">
        <a href="https://www.uopygn.gov.mm/" target="_blank">Visit Website</a>
        </div>
        </div>
    </div>

    <div class="card university">
        <div class="uni-content">
        <img src="../Local_uni_images/education logo.png" alt="Medicine4">
        <div class="uni-text">
        <h1>Yangon University of Education</h1>
        <p>Location – Yangon, Kamayut Township</p>
        <p>Academic – Bachelor's, Master's, and Doctorate degrees in education</p>
        <p>Admissions – Arts/Science matriculation pass with entrance exam or selection by the Ministry of Education</p>
        <p>Curriculum – Educational psychology, pedagogy, curriculum studies, teaching practicum, and special needs education modules</p>
        </div>
        </div>
    </div>

    <div class="card uni-icon">
        <img src="../Local_uni_images/education front gate.jpg" alt="University4">
        <div class="visit-container">
        <div class="visit-text">
        <a href="https://www.yuoe.edu.mm/" target="_blank">Visit Website</a>
        </div>
        </div>
    </div>

    <div class="card university">
        <div class="uni-content">
        <img src="../Local_uni_images/nursing logo.png" alt="Medicine4">
        <div class="uni-text">
        <h1>University of Nursing, Yangon</h1>
        <p>Location – Yangon, Lanmadaw Township </p>
        <p>Academic – 4-year B.N.Sc (Bachelor of Nursing Science)</p>
        <p>Admissions – Science matriculation pass with qualifying entrance exam and health check</p>
        <p>Curriculum – Fundamentals of nursing, medical-surgical nursing, maternal and child health, community health, clinical practicum, and hospital postings</p>
        </div>
        </div>
    </div>

    <div class="card uni-icon">
        <img src="../Local_uni_images/nursing front gate.jpg" alt="University4">
        <div class="visit-container">
        <div class="visit-text">
        <a href="https://www.uonygn.gov.mm/" target="_blank">Visit Website</a>
        </div>
        </div>
    </div>
</div>


       <!-- Footer -->
        <?php
        include_once "Footer.php"
        ?>


    <?php include 'login_modal.php'; ?>

<!-- 1) Load your libraries -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
</body>
</html>