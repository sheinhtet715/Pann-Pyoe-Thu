<?php
    // pick up any flash‐error or ‐success from login.php
    // session_start();
    // $error   = $_SESSION['login_error'] ?? '';
    // $success = $_SESSION['login_success'] ?? '';
    // unset($_SESSION['login_error'], $_SESSION['login_success']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
   <link rel="icon" href="../HomePimg/Logo.ico" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../CSS/About Us.css">
  <title>About Us</title>
</head>
<body>
  
  <header class="header">
     <?php include './logo_container.php' ?>

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
            <li><a class="dropdown-item" href="About Us_Logout.php">Logout</a></li>
            </ul>
        </div>


            <?php else: ?>
            <!-- <div class="profile-icon" onclick="openLogin()">
                <img src="../HomePimg/Profile.png" alt="Profile" class="profile-img" />
            </div> -->
            <?php endif; ?>
  </header>

<div class="the-start">
  <img src="../About us Page Images/Title bg.png" alt="start" class="start-image">
  <div class="start-text">PannPyoe Thu</div>
</div>

<br>

<div class="the-speech">
  	<p>At Pann Pyoe Thu, we believe every student deserves access to clear guidance, supportive mentorship, and quality educational resources. We provide academic and career advising services to help students unlock their full potential, whether they are choosing courses, applying for scholarships, or planning for their future careers.</p>
</div>

<div class="vision">
<h1>
	🎯Vision
</h1>
<p>To become a trusted educational guidance platform that equips students across Myanmar (and beyond) with the</p>
</div>

<div class="vision-container">

  <div class="vision-left">
  <div class="vision-content">

    <div class="vision-item">
      <img src="../About us Page Images/Knowledge.png" alt="knowledge">
      <div class="vision-text">Knowledge</div>
    </div>
  
    <div class="vision-item">
      <img src="../About us Page Images/Confidence.png" alt="confidence">
      <div class="vision-text">Confidence</div>
    </div>

    <div class="vision-item">
      <img src="../About us Page Images/Tools.png" alt="tools">
      <div class="vision-text">Tools</div>
    </div>
  </div>
  <div class="vision-line"></div>
  </div>

  <div class="vision-right">
    <p>that makes them succeed academically and professionally</p>
    <div class="image-container">
    <img src="../About us Page Images/extra notes on about us page.jpg" alter="extra">
    <div class="photo-text">Study for your Future</div>
    </div>
  </div>
</div>

<div class="mission-container">
  <img src="../About us Page Images/au bg two.jpg" alt="chalkboard" class="mission-image">
  <div class="mission-text">
    <h1>💡Mission</h1>
    <ul>
      <li>To provide accessible, personalized academic and career counselling</li>
      <li>To support students in making informed decisions about their education and future</li>
      <li>To connect learners with the right resources, programs and opportunities</li>
      <li>To foster a supportive and motivating online learnig environment</li>
    </ul>
  </div>
</div>

<div class="core">
<h1>🧭 Core Values</h1>
</div>

<div class="core-container">
  <div class="core-row">
    <div class="core-card">
    <img src="../About us Page Images/empowerment_plate-removebg-preview.png" alt="small board">
    <div class="core-text">Empowerment</div>
  </div>
  <div class="core-card">
    <img src="../About us Page Images/empowerment_plate-removebg-preview.png" alt="small board">
    <div class="core-text">Integrity</div>
  </div>
  <div class="core-card">
    <img src="../About us Page Images/empowerment_plate-removebg-preview.png" alt="small board">
    <div class="core-text">Accessibility</div>
  </div>
</div>

<div class="core-row">
  <div class="core-card">
    <img src="../About us Page Images/empowerment_plate-removebg-preview.png" alt="small board">
    <div class="core-text">Growth</div>
  </div>
  <div class="core-card">
    <img src="../About us Page Images/empowerment_plate-removebg-preview.png" alt="small board">
    <div class="core-text">Support</div>
  </div>
</div>
</div>

<div class="team-section">
  <div class="cover">
    <img src="../About us Page Images/web_deco-removebg-preview.png" alt="logo">
    <div class="cover-text">
      Meet <span class="o">O</span><span class="u">U</span><span class="r">R</span> Team
    </div>
  </div>

<div class="member">
  <div class="member-header">MARINA AYE THIDAR TUN</div>
  <div class="member-info">
    <img class="profile-image" src="../About us Page Images/ma marina.jpg" alt="Marina Aye Thidar Tun">
  <div class="member-role">Project Manager</div>
  <div class="member-quote">
    " The difference between an educated individual and a graduate lies in the capacity for critical thinking, rather than merely acquiring certificates. So be WISE in choosing your dreams, not labels! "
</div>
</div>
</div>
  <div class="cover">
    <img src="../About us Page Images/web_deco-removebg-preview.png" alt="logo">
    <div class="cover-text">
      Meet <span class="o">O</span><span class="u">U</span><span class="r">R</span> Team
    </div>
  </div>
</div>

<div class="member-container">
  <div class="member">
  <div class="member-header">Abraham</div>
  <div class="member-info">
    <img class="profile-image" src="../About us Page Images/Abraham.jpg" alt="Abraham">
  <div class="member-role">Front-end Developer</div>
  <div class="member-quote">
    "Work hard, laugh harder."
</div>
</div>
</div>

<div class="member">
  <div class="member-header">JU NELSON MOE</div>
  <div class="member-info">
    <img class="profile-image" src="../About us Page Images/ju nelson moe.jpg" alt="Ju Nelson Moe">
  <div class="member-role">Designer</div>
  <div class="member-quote">
    " If you are bored, it's the end of the world. "
</div>
</div>
</div>

<div class="member">
  <div class="member-header">BHONE MYINT CHAIN</div>
  <div class="member-info">
    <img class="profile-image" src="../About us Page Images/Peter.jpg" alt="Bhone Myint Chain">
  <div class="member-role">Front-end Developer</div>
  <div class="member-quote">
    " Feel the burn, embrace the burn. "
</div>
</div>
</div>

<div class="member">
  <div class="member-header">HEIN HTET SAN</div>
  <div class="member-info">
    <img class="profile-image" src="../About us Page Images/Hein Htet San.jpg" alt="Hein Htet San">
  <div class="member-role">Back-end Developer</div>
  <div class="member-quote">
    " Learn more, grow faster and  find opportunities, using the resources and information we provide. "
</div>
</div>
</div>

<div class="member">
  <div class="member-header">NAW THIRI KYAW</div>
  <div class="member-info">
    <img class="profile-image" src="../About us Page Images/thiri kyaw.jpg" alt="Naw Thiri Kyaw">
  <div class="member-role">Data Collector</div>
  <div class="member-quote">
    " One must imagine Sisphys happy. "
</div>
</div>
</div>

<div class="member">
  <div class="member-header">AYE SU MON</div>
  <div class="member-info">
    <img class="profile-image" src="../About us Page Images/AYESUMON.jpg" alt="Aye Su Mon">
  <div class="member-role">Back-end Developer</div>
  <div class="member-quote">
    "  Learn today, Lead tomorrow. "
</div>
</div>
</div>
</div>

<div class="tree-container">
  <div class="tree-text">
    <p>TOGETHER, we are building</p>
  </div>

  <img src="../About us Page Images/middle.png" alt="photo-tree" class="tree-image">

  <div class="tree-text">
    <p>a world filled with knowledgable people.</p>
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
    </script>
</body>
</html>


