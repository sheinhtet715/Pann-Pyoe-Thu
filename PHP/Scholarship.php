<?php
// Scholarship.php
session_start();
include "./db_connection.php";
require_once "./Controller/ScholarshipController.php";
// at top of your view
  $logoFolder = '../Scholarships_page_images/';
// current user (or null)
$error   = $_SESSION['login_error']   ?? '';
$success = $_SESSION['login_success'] ?? '';

unset($_SESSION['login_error'], $_SESSION['login_success']);
$userId = $_SESSION['user_id'] ?? null;

// 1) Handle favourite toggle
if ($_SERVER['REQUEST_METHOD']==='POST' && !empty($_POST['toggle_fav'])) {
  if (!$userId) {
    // non‑logged in will be caught by JS
  } else {
    $schId = intval($_POST['toggle_fav']);
    // check existing
    $check = $conn->prepare("
      SELECT 1 FROM FavouriteScholarship_tbl
       WHERE user_id = ? AND scholarship_id = ?
    ");
    $check->bind_param("ii", $userId, $schId);
    $check->execute();
    $res = $check->get_result();
    if ($res->num_rows) {
      // delete
      $del = $conn->prepare("
        DELETE FROM FavouriteScholarship_tbl
         WHERE user_id = ? AND scholarship_id = ?
      ");
      $del->bind_param("ii", $userId, $schId);
      $del->execute();
      $del->close();
    } else {
      // insert
      $ins = $conn->prepare("
        INSERT IGNORE INTO FavouriteScholarship_tbl(user_id,scholarship_id)
        VALUES(?,?)
      ");
      $ins->bind_param("ii", $userId, $schId);
      $ins->execute();
      $ins->close();
    }
    $check->close();
    // avoid repost
    header("Location: ".$_SERVER['REQUEST_URI']);
    exit;
  }
}

// 2) Fetch all scholarships + is_fav flag
$sql = "
  SELECT
    s.*,
    CASE WHEN f.scholarship_id IS NOT NULL THEN 1 ELSE 0 END AS is_fav
  FROM Scholarship_tbl s
  LEFT JOIN FavouriteScholarship_tbl f
    ON s.scholarship_id = f.scholarship_id
   AND f.user_id = ?
  ORDER BY s.intake_season, s.title
";
$stmt = $conn->prepare($sql);
$uid  = $userId ?: 0;
$stmt->bind_param("i",$uid);
$stmt->execute();
$result = $stmt->get_result();
$all = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// 3) Apply “My Favorites” and country filters
$countryFilter = $_GET['country']    ?? '';
$showFav       = ($_GET['showFavorites'] ?? '')==='1' && $userId;

// first, optionally only favorites
if ($showFav) {
  $filtered = array_filter($all, fn($s)=>!empty($s['is_fav']));
} else {
  $filtered = $all;
}
// then country
if ($countryFilter && $countryFilter!=='All') {
  $scholarships = array_filter(
    $filtered,
    fn($s)=>($s['country'] ?? '')===$countryFilter
  );
} else {
  $scholarships = $filtered;
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
      <!-- SweetAlert2 -->
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

    <style>
    .fav-btn { background:none; border:none; font-size:24px; cursor:pointer; }
    .fav-btn.fav { color: gold; }
    .filter-row { display:flex; gap:1rem; align-items:center; margin-bottom:1rem;}
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
            <li><a class="dropdown-item" href="scholarship_logout.php">Logout</a></li>
            </ul>
        </div>
    <?php else: ?>
      <div class="profile-icon" onclick="openLogin()">
        <img src="../HomePimg/Profile.png" alt="Profile" class="profile-img"/>
      </div>
    <?php endif; ?>
  </header>
  <!-- Shared Login Modal -->


    <!-- Block Bar -->
        <div class = "block" style="background-color:#1D2733; padding:35px;"></div>

    <!-- LOGIN MODAL -->
<!-- Shared Login Modal Markup -->
<?php include './login_modal.php'; ?>


    <div class="main-content">
        <div class="container">
            <h2>Find Scholarships</h2>
            
            <p>Looking for ways to fund your education? Explore a variety of scholarships tailored to your dreams and start your journey with confidence.</p>
        <!-- filters + show favorites -->
    <div class="filter-row">
      <form method="GET" style="display:inline-flex;gap:0.5rem;">
        <button class="filter-btn" disabled>Filter by Country</button>
        
        <select name="country" onchange="this.form.submit()">
          <option value="">All</option>
          <?php
            $countries = array_unique(array_column($all,'country'));
            sort($countries);
            foreach($countries as $c):
          ?>
          <option value="<?=htmlspecialchars($c)?>"
            <?=$c===$countryFilter?'selected':''?>>
            <?=htmlspecialchars($c)?>
          </option>
          <?php endforeach;?>
        </select>
      </form>
      <button
        type="button"
        id="show-fav"
        class="btn btn-secondary btn-sm <?= $showFav ? 'active' : '' ?>"
        onclick="toggleFavorites()"
        title="<?= $showFav ? 'Show all scholarships' : 'Show only my favorites' ?>"
      >
        <?= $showFav ? 'Show All' : 'Show Favorites' ?>
      </button>

    </div>

    <!-- scholarship list -->
    <div class="scholarship-list">
      <?php foreach($scholarships as $s): ?>
      <div class="scholarship-card">
        <div class="left">
          <div class="flag"
               style="background:url('https://flagcdn.com/<?=strtolower(substr($s['country'],0,2))?>.svg') center/cover;"></div>
          <div class="country"><?=htmlspecialchars($s['type'])?></div>
          <div class="info"><?=htmlspecialchars($s['intake_season'])?></div>
          <div class="info"><?=htmlspecialchars($s['degree_level'])?></div>
          <div class="date"><?=htmlspecialchars($s['deadline'])?></div>
        </div>
        <div class="center">
          <!-- <div class="logo"> -->
            <img
                src="<?= htmlspecialchars(
                  preg_match('~^https?://~', $s['logo_url'])
                    ? $s['logo_url']
                    : $logoFolder . $s['logo_url']
                ) ?>"
                alt="<?= htmlspecialchars($s['title']) ?> logo"
                style="width:130px;height:130px;object-fit:contain;"
              >
          <!-- </div> -->
          <div class="title"><?=htmlspecialchars($s['title'])?></div>
          <div class="coverage">
            Coverage<br><?=nl2br(htmlspecialchars($s['coverage']))?>
          </div>
          <div class="desc"><?=htmlspecialchars($s['description'])?></div>
          <div class="note"><?=htmlspecialchars($s['eligibility'])?></div>
        </div>
        <div class="right">
          <form method="POST" style="display:inline">
            <button
              type="submit"
              name="toggle_fav"
              value="<?= (int)$s['scholarship_id'] ?>"
              class="fav-btn <?= $s['is_fav']?'fav':'' ?>"
              title="Toggle favourite"
            ><?= $s['is_fav']?'★':'☆'?></button>
          </form>
          <a href="<?=htmlspecialchars($s['apply_link']??'#')?>"
             class="apply-btn" target="_blank"><span>Apply</span></a>
        </div>
      </div>
      <?php endforeach;?>
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
      <!-- 1) SweetAlert2 + Homepage.js -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <!-- 1) pull in your shared login‑modal markup -->
  <!-- 3) openLogin/closeLogin & click‐outside & showLogin=1 logic -->
  <!-- 2) openLogin/closeLogin + click‑outside + showLogin=1 logic -->
   <script>
    function openLogin() {
      const m = document.getElementById('loginModal');
      if (m) m.style.display = 'block';
    }
    function closeLogin() {
      const m = document.getElementById('loginModal');
      if (m) m.style.display = 'none';
    }
    // close on ✕ or clicking backdrop
    document.addEventListener('click', e => {
      const m = document.getElementById('loginModal');
      if (!m) return;
      if (e.target === m || e.target.classList.contains('close')) {
        closeLogin();
      }
    });
    // Honor ?showLogin=1 param
    (function(){
      const p = new URL(location).searchParams;
      if (p.get('showLogin') === '1') {
        openLogin();
        p.delete('showLogin');
        history.replaceState({}, '', location.pathname + (p.toString() ? `?${p}` : ''));
      }
    })();
  </script>

  <!-- 3) Flash → SweetAlert → then openLogin() on error -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      <?php if (! empty($error)): ?>
        Swal.fire({
          icon: 'error',
          title: 'Oops…',
          text: <?= json_encode($error) ?>,
          confirmButtonText: 'Try Again'
        }).then(openLogin);
      <?php elseif (! empty($success)): ?>
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: <?= json_encode($success) ?>,
          timer: 2000,
          showConfirmButton: false
        });
      <?php endif; ?>
    });
  </script>

  <!-- 4) Your Scholarship.js (only once) -->
  <script src="../JavaScript/Scholarship.js"></script>
  <!-- 3) Flash & SweetAlert2: error → then openLogin; success → alert only -->
  


  <script>
  document.addEventListener('DOMContentLoaded', function() {
    // 1) Profile menu toggle (unchanged)
    window.toggleProfileMenu = function() {
      var menu = document.getElementById('profile-menu');
      menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    };

    // 2) Filter functionality (unchanged)
    const select = document.querySelector('.filter-select');
    if (select) {
      const cards = document.querySelectorAll('.scholarship-card');
      select.addEventListener('change', function() {
        const value = select.value;
        cards.forEach(card => {
          const country = card.querySelector('.country')?.textContent?.trim();
          card.style.display = (value === '' || value === country) ? '' : 'none';
        });
      });
    }

    // 3) Favorites toggle + star‑button guard
    const isLoggedIn  = <?= $userId ? 'true' : 'false' ?>;
    const showFavBtn  = document.getElementById('show-fav');
    const favStarBtns = document.querySelectorAll('.fav-btn');

    // “My Favorites” / “Show All” button
    if (showFavBtn) {
      showFavBtn.addEventListener('click', function(e) {
        if (!isLoggedIn) {
          e.preventDefault();
          Swal.fire({
            icon: 'warning',
            title: 'Please log in',
            text:  'You must be signed in to view your favorites.'
          });
          return;
        }
        const params = new URLSearchParams(window.location.search);
        if (params.get('showFavorites') === '1') {
          params.delete('showFavorites');
          showFavBtn.textContent = 'My Favorites';
        } else {
          params.set('showFavorites', '1');
          showFavBtn.textContent = 'Show All';
        }
        window.location.search = params.toString();
      });
    }

    // Star buttons: block if not logged in
    favStarBtns.forEach(btn => {
      btn.addEventListener('click', function(e) {
        if (!isLoggedIn) {
           e.preventDefault();
            Swal.fire({
              icon: 'warning',
              title: 'Please log in',
              text: 'You must be signed in to favorite a scholarship.'
            }).then(() => {
              window.location = 'login.php?return=' + encodeURIComponent(window.location.href) + '&showLogin=1';

            });
        }
        // otherwise let the form submit
      });
    });
  });
</script>

</body>
</html>    