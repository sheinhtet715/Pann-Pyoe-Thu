
<?php
// --- MERGED LOGIC ---
session_start();
include "./db_connection.php";

$imgFolder = '../Job page images/';
$error   = $_SESSION['login_error']   ?? '';
$success = $_SESSION['login_success'] ?? '';
unset($_SESSION['login_error'], $_SESSION['login_success']);

// Fetch job locations (PDO)
$locationStmt = $pdo->query("SELECT DISTINCT location FROM job_tbl ORDER BY location ASC");
$locations = $locationStmt->fetchAll(PDO::FETCH_COLUMN);
// Fetch unique company names (PDO)
$companyStmt = $pdo->query("SELECT DISTINCT org_name FROM job_tbl ORDER BY org_name ASC");
$companies = $companyStmt->fetchAll(PDO::FETCH_COLUMN);

// Fetch user profile image (MySQLi)
$profile_path = '../HomePimg/Profile.png'; // default
if (!empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    // Use MySQLi connection $conn (from db_connection.php)
    if (isset($conn)) {
        $stmt = $conn->prepare('SELECT profile_path FROM User_tbl WHERE user_id = ?');
        if ($stmt) {
            $stmt->bind_param('i', $user_id);
            $stmt->execute();
            $stmt->bind_result($db_profile_path);
            if ($stmt->fetch() && $db_profile_path && file_exists($db_profile_path)) {
                $profile_path = $db_profile_path;
            }
            $stmt->close();
        }
    }
}
// Do not close $conn here; other queries may use it later
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Jobs - Pann Pyoe Thu</title>
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes:400,700&display=swap" rel="stylesheet">

     <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../CSS/Jobs.css">
</head>
<body>
    <header class="header">
      <div class="logo-container">
        <img src="../HomePimg/Logo.ico" alt="Pann Pyoe Thu logo" class="logo-img" />
        <span class="logo-text">Pann Pyoe Thu</span>
      </div>
      <nav class="nav" id="nav-menu">
        <a href="../PHP/index.php">Home</a>
        <a href="../PHP/About Us.php">About us</a>
        <a href="../PHP/Courses.php">Courses</a>
        <a href="../PHP/Counsellor.php">Educational Counsellors</a>
        <a href="../PHP/Scholarship.php">Scholarships</a>
        <a href="../PHP/Local Uni.php">Local Universities</a>
        <a href="../PHP/Jobs.php">Job Opportunities</a>
      </nav>

   <?php if (!empty($_SESSION['user_id'])): ?>

      
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
                <?php if (!empty($user['profile_path'])): ?>
                    <img src="../<?php echo htmlspecialchars($user['profile_path']); ?>" alt="Profile" class="profile-img" style="width:50px; height:50px; object-fit:cover;">
                <?php else: ?>
                    <img src="../HomePimg/Profile.png" alt="Profile" class="profile-img" style="width:28px; height:28px; object-fit:cover;">
                <?php endif; ?>
            </button>
            <ul class="dropdown-menu dropdown-menu-end"
                aria-labelledby="profileDropdownBtn">
                <li><a class="dropdown-item" href="Profile.php">My Profile</a></li>
                <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="scholarship_logout.php">Logout</a></li>
            </ul>
        </div>
      <?php else: ?>
        <div class="profile-icon" onclick="openLogin()">
            <img src="../HomePimg/Profile.png" alt="Profile" class="profile-img" />
        </div>
      <?php endif; ?>
  </header>
    

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
                <li><a class="dropdown-item" href="job_logout.php">Logout</a></li>
              </ul>
        </div>
      <?php else: ?>
         <div class="profile-icon" onclick="openLogin()" role="button" tabindex="0" aria-label="Open login menu">
            <img src="../HomePimg/Profile.png" alt="Profile" class="profile-img" />
          </div>
      <?php endif; ?>
    </header>

    <main>
      <section class="intro">
        <h1>Find Your Next Job</h1>
        <p>Discover the best job opportunities from top companies in Myanmar. Use the filters below to find your perfect match.</p>
      </section>

      <section class="filter-bar sticky">
        <form id="filter-form" method="post">
            <input type="text" name="search" id="search-bar" placeholder="Search job title or keyword...">
            <select name="type" id="filter-type">
              <option value="">All Job Types</option>
              <option value="Full Time">Full Time</option>
              <option value="Part Time">Part Time</option>
              <option value="Internship">Internship</option>
            </select>
            <select name="location" id="filter-location">
              <option value="">All Locations</option>
              <?php foreach ($locations as $location): ?>
                <option value="<?= htmlspecialchars($location) ?>"><?= htmlspecialchars($location) ?></option>
              <?php endforeach; ?>
            </select>
            <select name="company" id="filter-company">
              <option value="">All Companies</option>
              <?php foreach ($companies as $company): ?>
                <option value="<?= htmlspecialchars($company) ?>"><?= htmlspecialchars($company) ?></option>
              <?php endforeach; ?>
            </select>
          <button type="submit" style="display:none"></button>
        </form>
      </section>

      <section class="jobs-grid" id="jobs-grid">
        <?php
        // Initial page load: show all jobs
        $stmt = $pdo->query("SELECT * FROM job_tbl");
        $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($jobs as $job): 
        ?>
          <div class="job-card"
               data-title="<?= htmlspecialchars($job['job_title']) ?>"
               data-type="<?= htmlspecialchars($job['job_type']) ?>"
               data-location="<?= htmlspecialchars($job['location']) ?>"
               data-company="<?= htmlspecialchars($job['org_name']) ?>">
            <div class="job-card-header">
              <img src="<?= htmlspecialchars($imgFolder . $job['imglogo_url']) ?>"
                   alt="<?= htmlspecialchars($job['org_name']) ?>"
                   class="company-logo">
              <div>
                <div class="job-title"><?= htmlspecialchars($job['job_title']) ?></div>
                <div class="company-name"><?= htmlspecialchars($job['org_name']) ?></div>
                <span class="job-type"><?= htmlspecialchars($job['job_type']) ?></span>
              </div>
            </div>
            <div class="job-location"><?= htmlspecialchars($job['location']) ?></div>
            <div class="job-summary"><strong>Summary JD:</strong> <?= htmlspecialchars($job['description']) ?></div>
            <div class="job-desc"><?= htmlspecialchars($job['requirement']) ?></div>
            <a class="apply-btn" href="<?= htmlspecialchars($job['job_attachment']) ?>" target="_blank">Apply now</a>
          </div>
        <?php endforeach; ?>
      </section>

      <div class="load-more-container" style="display: flex; justify-content: center; margin-bottom: 40px;">
          <button id="load-more-btn" class="page-btn">Load More</button>
      </div>
    </main>

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

    <script>
      // function toggleMobileMenu() {
      //   const nav = document.getElementById('nav-menu');
      //   nav.classList.toggle('active');
      // }
      // function openLogin() {
      //   alert('Login menu would open here.');
      // }

      function closeLogin() {
        alert('Login menu would close here.');
      }

      const searchBar = document.getElementById('search-bar');
      const typeFilter = document.getElementById('filter-type');
      const locationFilter = document.getElementById('filter-location');
      const companyFilter = document.getElementById('filter-company');
      const jobsGrid = document.getElementById('jobs-grid');
      const loadMoreBtn = document.getElementById('load-more-btn');
      let allJobs = Array.from(jobsGrid.querySelectorAll('.job-card'));
      let jobsPerPage = 6;
      let shownJobs = 0;
      let filteredJobs = [];

      function filterJobs() {
        const search = searchBar.value.toLowerCase();
        const type = typeFilter.value;
        const location = locationFilter.value;
        const company = companyFilter.value;
        filteredJobs = allJobs.filter(card => {
          const matchTitle = card.dataset.title.toLowerCase().includes(search);
          const matchType = !type || card.dataset.type === type;
          const matchLocation = !location || card.dataset.location === location;
          const matchCompany = !company || card.dataset.company === company;
          return matchTitle && matchType && matchLocation && matchCompany;
        });
        allJobs.forEach(card => card.style.display = 'none');
        shownJobs = 0;
        showMoreJobs();
      }

      function showMoreJobs() {
        let toShow = Math.min(shownJobs + jobsPerPage, filteredJobs.length);
        filteredJobs.forEach((card, i) => {
          card.style.display = (i < toShow) ? '' : 'none';
        });
        shownJobs = toShow;
        loadMoreBtn.style.display = (shownJobs < filteredJobs.length) ? '' : 'none';
      }

      loadMoreBtn.addEventListener('click', showMoreJobs);
      searchBar.addEventListener('input', filterJobs);
      typeFilter.addEventListener('change', filterJobs);
      locationFilter.addEventListener('change', filterJobs);
      companyFilter.addEventListener('change', filterJobs);

      // Initial load
      filterJobs();

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


        <!-- ...existing job cards... -->