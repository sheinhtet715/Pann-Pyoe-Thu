<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Vollkorn:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Pann Pyoe Thu - Home</title>
</head>
<body>
    <div class="homepage">
        <header class="header">
            <div class="logo">
                <img src="Logo.ico" alt="Pann Pyoe Thu logo" class="logo-img" />
                <span class="logo-text">Pann Pyoe Thu</span>
            </div>
            <nav class="nav">
                <a href="#home">Home</a>
                <a href="#about">About us</a>
                <a href="#courses">Courses</a>
                <a href="#counsellors">Educational Counsellors</a>
                <a href="#scholarships">Scholarships</a>
                <a href="#universities">Local Universities</a>
                <a href="#jobs">Job Opportunities</a>
            </nav>
            <div class="profile-icon" onclick="openLogin()">
                <img src="Profile.png" alt="Profile" class="profile-img" />
            </div>
        </header>

        <main class="main-content">
            <div class="quote-box">
                <p>
                    <span class="highlight">"Pann Pyoe Thu</span> is dedicated to nurturing Myanmar's youth through quality education, practical guidance, and career empowerment."
                </p>
            </div>

            <section class="features">
                <div class="feature">
                    <img src="unlock skills.jpg" alt="Enhance skills" />
                    <h3>Enhance skills</h3>
                    <p>Develop practical and professional life skills</p>
                </div>
                <div class="feature">
                    <img src="guidance.jpg" alt="Guidance" />
                    <h3>Guidance</h3>
                    <p>Mentorship that opens doors to success</p>
                </div>
                <div class="feature">
                    <img src="opportunities.jpg" alt="Opportunities" />
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
                    <video controls width="100%">
                        <source src="Introduction.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
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
                <img src="tulips-removebg-preview.png" alt="Flowers" class="flower-img" />
            </div>

            <!-- Right side -->
            <div class="login-right">
                <span class="close" onclick="closeLogin()">&times;</span>
                <img src="Logo.ico" class="login-logo" alt="logo" />
                <div class="login-box">
                    <input type="text" placeholder="Username" />
                    <input type="email" placeholder="Email" />
                    <input type="password" placeholder="Password" />
                    <div class="login-buttons">
                        <button class="signin">Sign in</button>
                        <button class="signup">Sign up</button>
                    </div>
                    <a href="#" class="forgot">Forgot your password?</a>
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
                            <img src="counsellor 1.png" alt="Cathy Doll">
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
                            <img src="counsellor 2.png" alt="Mercy Donan">
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
                            <img src="counsellor 3.png" alt="David Johnson">
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
                    <img src="equality.jpg" alt="Equality">
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
                    <img src="thinking.jpg" alt="Thinking">
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
                    <img src="ICT.jpg" alt="ICT Programming">
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
                <img src="programming.png" alt="Programming">    
                <div class="course-text">
                    <p>Programming</p>
                </div>
            </div>

            <div class="course-offer card4">
                <img src="languages.png" alt="Languages">
                <div class="course-text">
                    <p>Languages</p>
                </div>
            </div>

            <div class="course-offer card4">
                <img src="music.png" alt="Music">
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
                    <img src="e-learning.jpg" alt="Image 7">
                    <img src="online learning.jpg" alt="Image 8">
                </div>
                <div class="slide">
                    <img src="landscape counseling.jpg" alt="Image 9">
                    <img src="scholarships.jpg" alt="Image 10">
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

    <script src="script.js"></script>
</body>
</html>