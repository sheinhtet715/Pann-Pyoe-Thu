<?php
session_start();
include "db_connection.php";

// grab POSTed values (or empty strings)
$username = trim($_POST['user_name'] ?? '');
$email    = trim($_POST['email']     ?? '');
$password = $_POST['password']       ?? '';

// -------- SIGN IN --------
if (isset($_POST['signin'])) {
    $sql  = "SELECT user_id, user_name, email, password_hash
             FROM user_tbl
             WHERE email = ? OR user_name = ?
             LIMIT 1";
    $stmt = $conn->prepare($sql);
    if (! $stmt) {
        die("❌ SQL Error on prepare(): " . $conn->error);
    }

    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password_hash'])) {
            // success!
            $_SESSION['user_id']   = $user['user_id'];
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['email']     = $user['email'];
            header("Location: ./index.php");
            exit;
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "No account found with that email or username.";
    }

    $stmt->close();
}

// -------- SIGN UP --------
if (isset($_POST['signup'])) {
    // 1. check for existing account
    $sql = "SELECT 1 FROM user_tbl WHERE user_name = ? OR email = ? LIMIT 1";
    $chk = $conn->prepare($sql);
    if (! $chk) {
        die("❌ SQL Error on prepare(): " . $conn->error);
    }

    $chk->bind_param("ss", $username, $email);
    $chk->execute();
    $res = $chk->get_result();

    if ($res->num_rows > 0) {
        $error = "❌ That username or email is already taken.";
    } else {
        // 2. hash the password
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // 3. insert into user_tbl
        $ins = $conn->prepare("
            INSERT INTO user_tbl
              (user_name, email, password_hash)
            VALUES (?, ?, ?)
        ");
        if (! $ins) {
            die("❌ SQL Error on prepare(): " . $conn->error);
        }

        $ins->bind_param("sss", $username, $email, $hash);
        if (! $ins->execute()) {
            $error = "❌ Signup failed — please try again. (" . $ins->error . ")";
        } else {
            // 4. grab the newly created user_id
            $user_id = $conn->insert_id;

            // 5. insert into Login_tbl as well
            $loginIns = $conn->prepare("
                INSERT INTO Login_tbl
                  (user_id, user_name, password_hash, email, role, last_login)
                VALUES (?, ?, ?, ?, 'user', NOW())
            ");
            if (! $loginIns) {
                die("❌ SQL Error on prepare(): " . $conn->error);
            }

            $loginIns->bind_param("isss", $user_id, $username, $hash, $email);
            if ($loginIns->execute()) {
                $success = "✅ Account created and login registered! You can now sign in.";
            } else {
                $error = "⚠️ Account created but failed to register login: " . $loginIns->error;
            }
            $loginIns->close();
        }
        $ins->close();
    }
    $chk->close();
}

$conn->close();
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
    
    <link rel="stylesheet" href="../CSS/Homepage.css">
    
  <?php if (!empty($error)): ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Sign‑In Failed',
        text: <?= json_encode($error) ?>,
        confirmButtonText: 'Try Again'
      });
    </script>
  <?php elseif (!empty($success)): ?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Great!',
        text: <?= json_encode($success) ?>,
        timer: 2000,
        showConfirmButton: false
      });
    </script>
  <?php endif; ?>
    <title>Pann Pyoe Thu</title>
</head>
<body>
    <div class="homepage">
        <header class="header">
            <div class="logo">
                <img src="../HomePimg/Logo.ico" alt="Pann Pyoe Thu logo" class="logo-img" />
                <span class="logo-text">Pann Pyoe Thu</span>
            </div>
            <nav class="nav">
                <a href="../PHP/index.php">Home</a>
                <a href="#about">About us</a>
                <a href="#courses">Courses</a>
                <a href="./Counsellor.php">Educational Counsellors</a>
                <a href="../PHP/Scholarship.php">Scholarships</a>
                <a href="#universities">Local Universities</a>
                <a href="#jobs">Job Opportunities</a>
            </nav>
            <?php if (!empty($_SESSION['user_id'])): ?>
        <div class="user-bar">
            <span class="welcome">Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>!</span>
            <a href="logout.php" class="btn-logout">Logout</a>
        </div>
            <?php else: ?>
            <div class="profile-icon" onclick="openLogin()">
                <img src="../HomePimg/Profile.png" alt="Profile" class="profile-img" />
            </div>
            <?php endif; ?>
        </header>

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

        <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content login-container">
            <!-- Left side -->
            <div class="login-left">
                <h1>Welcome to Pann Pyoe Thu</h1>
                <img src="../HomePimg/tulips-removebg-preview.png" alt="Flowers" class="flower-img" />
            </div>

            <!-- Right side -->
            <div class="login-right">
                <span class="close" onclick="closeLogin()">&times;</span>
                <img src="../HomePimg/Logo.ico" class="login-logo" alt="logo" />
                <div class="login-box">
                    <?php if (!empty($error))   echo "<p class='error'>$error</p>"; ?>
                    <?php if (!empty($success)) echo "<p class='success'>$success</p>"; ?>
                    <form method="POST" action="index.php" class="login-box">
                    <input type="text" name="user_name" placeholder="Username" required />
                    <input type="email" name="email" placeholder="Email"  required />
                    <input type="password" name="password" placeholder="Password" required />
                    <div class="login-buttons">
                        <button class="signin" type="submit" name="signin">Sign in</button>
                        <button class="signup" type="submit" name="signup">Sign up</button>
                    </div>
                    <a href="#" class="forgot">Forgot your password?</a>
                    </form>
                </div>
                
            </div>
        </div>
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
    </div>
     <!-- … your header, form, etc … -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="../JavaScript/Homepage.js"></script>
    
    <script>
  function openLogin() {
    document.getElementById('loginModal').style.display = 'block';
  }

  function closeLogin() {
    document.getElementById('loginModal').style.display = 'none';
  }

  window.onclick = function(event) {
    const modal = document.getElementById('loginModal');
    if (event.target === modal) {
      modal.style.display = 'none';
    }
  };
</script>
<script>
  Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: <?= json_encode($error) ?>,
    confirmButtonText: 'Try Again'
  }).then(() => {
    // reopen the login modal so they can type again:
    openLogin();
  });
</script>
</body>
</html>