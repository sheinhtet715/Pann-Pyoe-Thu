<?php
  // header.php
  if (session_status() === PHP_SESSION_NONE) session_start();
  include __DIR__ . "/db_connection.php";

  // fetch user info if logged in
  $user = null;
  if (! empty($_SESSION['user_id'])) {
      $stmt = $conn->prepare("SELECT user_name, profile_path FROM User_tbl WHERE user_id = ?");
      $stmt->bind_param('i', $_SESSION['user_id']);
      $stmt->execute();
      $user = $stmt->get_result()->fetch_assoc();
      $stmt->close();
  }
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

    <!-- <link rel="stylesheet" href="../CSS/Jobs.css"> -->


    <style>
    .header {
    background: #529AA6;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    position: sticky;
    top: 0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    
}
.logo-container {
    display: flex;
    align-items: center;
    gap: 0.7rem;
    flex-shrink: 0;
}

.logo-img {
    height: 40px;
    width: auto;
    border-radius: 8px;
    object-fit: contain;
}

.logo-text {
    margin-top: 5px;
    font-family: 'Great Vibes', cursive;
    font-size: 24px;
    color: black;
    text-shadow:
      -1px -1px 0 white,
        1px -1px 0 white,
      -1px  1px 0 white,
        1px  1px 0 white;
}

.nav {
    display: flex;
    gap: 1.5rem;
}

.nav a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    font-size: 1rem;
    transition: color 0.2s;
    transition: all 0.3s ease;
    border-radius: 5px;
}

.nav a:hover {
    background-color: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    color: #ffe6c7;
}

@media (max-width: 900px) {
    .login-container {
        flex-direction: column;
        width: 98vw;
        min-width: 0;
        max-width: 98vw;
        height: auto;
        border-radius: 22px;
        margin: 16px auto;
        box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        color: #ffffff;
    }
    .flower-img {
        width: 150px;
        height: 150px;
    }
}
@media (max-width: 600px) {
    .login-container {
        width: 100vw;
        min-width: 0;
        max-width: 100vw;
        padding: 0;
        border-radius: 0;
        height: 100vh;
        margin: 0;
        box-shadow: none;
    }
    .flower-img {
        width: 80px;
        height: 80px;
    }

}
@media (max-width: 480px) {
    .header {
        padding: 4px 1px;
    }
    .nav a {
        font-size: 12px;
        padding: 2px 3px;
    }
     .logo-text {
        font-size: 11px;
    }
    .login-container {
        height: 100vh;
        min-height: 0;
        max-height: 100vh;
        overflow-y: auto;
    }
    .flower-img {
        width: 80px;
        height: 80px;
    }

   
}

@media (max-width: 900px) {
    .nav {
        display: none;
        position: absolute;
        top: 70px;
        left: 0;
        width: 100vw;
        background: #529AA6;
        flex-direction: column;
        gap: 0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .nav.active {
        display: flex;
    }
    .nav a {
        padding: 1rem 2rem;
        border-bottom: 1px solid #417b87;
    }
    .mobile-menu-toggle {
        display: flex;
    }
}

    </style>
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
                        src="../<?php echo htmlspecialchars($user['profile_path']); ?>"
                        alt="Profile"
                        class="profile-img"
                        style="width:50px; height:50px; object-fit:cover;"
                    >
                <?php else: ?>
                    <img
                        src="../HomePimg/Profile.png"
                        alt="Profile"
                        class="profile-img"
                        style="width:28px; height:28px; object-fit:cover;"
                    >
                <?php endif; ?>
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
  <?= $content ?>
<?php include 'login_modal.php'; ?>
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
      text:            <?php echo json_encode($error) ?>,
      confirmButtonText: 'Try Again'
    })
    .then(() => {
      openLogin();
    });
  <?php elseif ($success): ?>
    Swal.fire({
      icon: 'success',
      title: 'Success!',
      text:            <?php echo json_encode($success) ?>,
      timer: 2000,
      showConfirmButton: false
    })

  <?php endif; ?>
});
</script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="…"
        crossorigin="anonymous"></script>

</body>
</html>