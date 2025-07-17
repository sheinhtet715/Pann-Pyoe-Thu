<?php
// Scholarship.php
session_start();
include "./db_connection.php";
require_once "./Controller/ScholarshipController.php";

// current user (or null)
$userId = $_SESSION['user_id'] ?? null;

// 1) Handle favourite toggle
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['toggle_fav']) && $userId) {
    $schId = intval($_POST['toggle_fav']);

    // check if already favourited
    $check = $conn->prepare("
      SELECT 1 
        FROM FavouriteScholarship_tbl
       WHERE user_id = ? 
         AND scholarship_id = ?
    ");
    $check->bind_param("ii", $userId, $schId);
    $check->execute();
    $res = $check->get_result();

    if ($res->num_rows) {
        // remove favourite
        $del = $conn->prepare("
          DELETE FROM FavouriteScholarship_tbl
           WHERE user_id = ? 
             AND scholarship_id = ?
        ");
        $del->bind_param("ii", $userId, $schId);
        $del->execute();
        $del->close();
    } else {
        // verify scholarship exists
        $schCheck = $conn->prepare("
          SELECT 1 
            FROM Scholarship_tbl 
           WHERE scholarship_id = ?
        ");
        $schCheck->bind_param("i", $schId);
        $schCheck->execute();
        $schRes = $schCheck->get_result();

        if ($schRes->num_rows > 0) {
            // insert favourite
            $ins = $conn->prepare("
              INSERT INTO FavouriteScholarship_tbl (user_id, scholarship_id)
              VALUES (?, ?)
            ");
            $ins->bind_param("ii", $userId, $schId);
            $ins->execute();
            $ins->close();
        }
        $schCheck->close();
    }
    $check->close();
}

// 2) Fetch via controller (will include apply_link, is_fav, etc.)
$controller    = new ScholarshipController($conn, $userId);
$allScholarships = $controller->getAllScholarships();

// 3) Country filter
$countryFilter = $_GET['country'] ?? '';
if ($countryFilter && $countryFilter !== 'All') {
    $scholarships = array_filter(
        $allScholarships,
        fn($s) => ($s['country'] ?? '') === $countryFilter
    );
} else {
    $scholarships = $allScholarships;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Scholarships!</title>
       <link rel="icon" href="../HomePimg/Logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/Scholarship.css">
    <style>
    .fav-btn { background:none; border:none; font-size:24px; cursor:pointer; }
    .fav-btn.fav { color: gold; }
  </style>
</head>
<body>
    <header class="header">
      <div class="logo-container">
        <img src="../HomePimg/Logo.ico" alt="Pann Pyoe Thu logo" class="logo-img" />
        <span class="logo-text">Pann Pyoe Thu</span>
      </div>
        <nav class="nav">
        <a href="../PHP/index.php">Home</a>
        <a href="#about">About us</a>
        <a href="#courses">Courses</a>
        <a href="../PHP/Counsellor.php">Educational Counsellors</a>
        <a href="../PHP/Scholarship.php">Scholarships</a>
        <a href="../PHP/LocalUni.php">Local Universities</a>
        <a href="#jobs">Job Opportunities</a>
      </nav>
      <?php if (! empty($_SESSION['user_id'])): ?>
  <!-- Logged in -->
  <div class="user-bar">
    <span class="welcome">
      Welcome, <?= htmlspecialchars($_SESSION['user_name'] ?? $_SESSION['email']) ?>!
    </span>
    <a href="logout.php" class="btn-logout">Logout</a>
  </div>
<?php else: ?>
  <!-- Not logged in → redirect to index and trigger showLogin -->
  <div class="profile-icon"
       onclick="window.location.href='index.php?showLogin=1';">
    <img src="../HomePimg/Profile.png" alt="Profile" class="profile-img" />
  </div>
<?php endif; ?>
    </header>

    <!-- Block Bar -->
        <div class = "block" style="background-color:#1D2733; padding:35px;"></div>

    <!-- LOGIN MODAL -->
<div id="loginModal" class="modal">
  <div class="modal-content login-container">
    <div class="login-left">
      <h1>Welcome to Pann Pyoe Thu</h1>
      <img src="../HomePimg/tulips-removebg-preview.png" alt="Flowers" class="flower-img" />
    </div>
    <div class="login-right">
      <span class="close" onclick="closeLogin()">&times;</span>
      <img src="../HomePimg/Logo.ico" class="login-logo" alt="logo" />
      <form method="POST" action="login.php" class="login-box">
        <input type="text"   name="user_name" placeholder="Username" required />
        <input type="email"  name="email"     placeholder="Email"    required />
        <input type="password" name="password" placeholder="Password" required />
        <div class="login-buttons">
          <button type="submit" name="signin">Sign in</button>
          <button type="button" onclick="window.location='signup.php'">Sign up</button>
        </div>
      </form>
      <a href="forgot_password.php" class="forgot">Forgot your password?</a>
    </div>
  </div>
</div>
    <div class="main-content">
        <div class="container">
            <h2>Find Scholarships</h2>
            
            <p>Looking for ways to fund your education? Explore a variety of scholarships tailored to your dreams and start your journey with confidence.</p>
            <form method="GET" class="filter-row">
        <button class="filter-btn" disabled>Filter by</button>
        <span>Country</span>
        <select name="country" class="filter-select" onchange="this.form.submit()">
          <option value="">All</option>
          <?php 
            $countries = array_unique(array_column($allScholarships, 'country'));
            sort($countries);
            foreach ($countries as $c): 
          ?>
            <option
              value="<?= htmlspecialchars($c) ?>"
              <?= $c === $countryFilter ? 'selected' : '' ?>
            >
              <?= htmlspecialchars($c) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </form>

      <div class="scholarship-list">
        <?php foreach ($scholarships as $s): ?>
          <div class="scholarship-card">
            <div class="left">
              <div class="flag"
                   style="background:url('https://flagcdn.com/<?= strtolower(substr($s['country'],0,2)) ?>.svg') center/cover;">
              </div>
              <div class="country"><?= htmlspecialchars($s['type']) ?></div>
              <div class="info"><?= htmlspecialchars($s['intake_season']) ?></div>
              <div class="info"><?= htmlspecialchars($s['degree_level']) ?></div>
              <div class="date"><?= htmlspecialchars($s['deadline']) ?></div>
            </div>
            <div class="center">
              <div class="logo">
                <img src="<?= htmlspecialchars($s['logo_url'] ?? '../default-logo.png') ?>"
                     alt="<?= htmlspecialchars($s['title']) ?> logo"
                     style="width:40px;height:40px;object-fit:contain">
              </div>
              <div class="title"><?= htmlspecialchars($s['title']) ?></div>
              <div class="coverage">
                Coverage<br><?= nl2br(htmlspecialchars($s['coverage'])) ?>
              </div>
              <div class="desc"><?= htmlspecialchars($s['description']) ?></div>
              <div class="note"><?= htmlspecialchars($s['eligibility']) ?></div>
            </div>
            <div class="right">
              <form method="POST" style="display:inline">
                <button
                  type="submit"
                  name="toggle_fav"
                  value="<?= (int)$s['scholarship_id'] ?>"
                  class="fav-btn <?= $s['is_fav'] ? 'fav' : '' ?>"
                  title="Toggle favourite"
                ><?= $s['is_fav'] ? '★' : '☆' ?></button>
              </form>
              <a
                href="<?= htmlspecialchars($s['apply_link'] ?? '#') ?>"
                class="apply-btn"
                target="_blank"
              >Apply</a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    </div>
    <footer>
      <div>
        <h4>Explore</h4>
        <p><a href="#">About us</a></p>
        <p><a href="#">Education counselling</a></p>
        <p><a href="#">Scholarships</a></p>
        <p><a href="#">Available courses</a></p>
        <p><a href="#">Job opportunities</a></p>
      </div>
      <div>
        <h4>Contact us</h4>
        <p>09672659692</p>
        <p>pannpyoethu26@gmail.com</p>
      </div>
      <div>
        <h4>Follow us on:</h4>
        <div class="social-icons">
          <a href="#" class="social-link" aria-label="Facebook">
            <div class="social-icon-square">
              <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="28" height="28" rx="7" fill="#1877F3"/>
                <path d="M19.5 14.5H17V22H14V14.5H12.5V12H14V10.5C14 9.39543 14.8954 8.5 16 8.5H19V11H17C16.7239 11 16.5 11.2239 16.5 11.5V12H19.5V14.5Z" fill="white"/>
              </svg>
            </div>
          </a>
          <a href="#" class="social-link" aria-label="Instagram">
            <div class="social-icon-square">
              <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" alt="Instagram" class="social-img" />
            </div>
          </a>
          <a href="#" class="social-link" aria-label="Twitter">
            <div class="social-icon-square">
              <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="28" height="28" rx="7" fill="#1DA1F2"/>
                <path d="M22 9.5c-.6.3-1.2.5-1.8.6.6-.4 1.1-1 1.3-1.7-.6.4-1.3.7-2 .9-.6-.6-1.5-1-2.4-1-1.8 0-3.2 1.7-2.8 3.4-2.4-.1-4.5-1.3-5.9-3.1-.3.5-.5 1-.5 1.6 0 1.1.6 2 1.5 2.5-.6 0-1.1-.2-1.6-.4v0c0 1.5 1.1 2.7 2.5 3-.3.1-.7.2-1 .2-.2 0-.5 0-.7-.1.5 1.3 1.7 2.2 3.2 2.2-1.2.9-2.7 1.4-4.3 1.2 1.3.8 2.9 1.3 4.6 1.3 5.5 0 8.5-4.6 8.5-8.5 0-.1 0-.2 0-.3.6-.4 1.1-1 1.5-1.6z" fill="white"/>
              </svg>
            </div>
          </a>
        </div>
      </div>
    </footer>
    <script src="../JavaScript/Scholarship.js"></script>
    <script>
      function toggleProfileMenu() {
        var menu = document.getElementById('profile-menu');
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
      }

      // Filter functionality
      document.addEventListener('DOMContentLoaded', function() {
        const select = document.querySelector('.filter-select');
        const cards = document.querySelectorAll('.scholarship-card');
        select.addEventListener('change', function() {
          const value = select.value;
          cards.forEach(card => {
            const country = card.querySelector('.country')?.textContent?.trim();
            if (value === 'All' || country === value) {
              card.style.display = '';
            } else {
              card.style.display = 'none';
            }
          });
        });
      });
    </script>
</body>
</html>    