<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link rel="icon" href="../HomePimg/Logo.ico" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Vollkorn:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Rowdies:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../CSS/Counsellor.css" />
  <title>Educational Counsellors</title>
  <script src="../JavaScript/Counsellor.js"></script>
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
        <a href="../PHP/Counsellors.php">Educational Counsellors</a>
        <a href="../PHP/Scholarship.php">Scholarships</a>
        <a href="#universities">Local Universities</a>
        <a href="#jobs">Job Opportunities</a>
      </nav>
      <div class="profile-icon" onclick="openLogin()">
        <img src="../HomePimg/Profile.png" alt="Profile" class="profile-img" />
      </div>
    </header>

        <div class = "block" style="background-color:#1D2733; padding:35px;"></div>

    <div class="title">“Consult with us for your further academic studies”</div>
    <div class="divider"></div>

    <div class="container">
      <div class="advisor">
        <div class="advisor-content">
         <div>
            <img src="../Counsellor_page_images/Cathy Doll.png" alt="Cathy Doll" class="advisor-img"> 
            <button class="appointment-btn" onclick="openPopup('Cathy Doll')">Get Appointment</button>
             <img class= "appimg" src ="../HomePimg/tulips-removebg-preview.png">
           </div>

          <div>
            <div class="advisor-header">Cathy Doll</div>
            <div class="advisor-title">Academic & Career Advisor</div>
            <p>🎓 B.A. in Guidance & Counselling</p>
            <p>🎯 Academic planning, course registration, scholarships</p>
            <p>📞 +95 9 123 456 789</p>
            <p> 📧 cathy.doll@pannpyoethu.edu.mm</p>
            <div class="advisor-experience">
              <h4>Experience Highlights:</h4>
              <ul>
                <li>200+ counselling sessions</li>
                <li>Helped with registration, major selection, scholarships</li>
                <li>Empathetic advising and tracking</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
   

      <div class="advisor">
        <div class="advisor-content">
         <div>
            <img src="../Counsellor_page_images/Mery Donan.png" alt="Mercy Donan" class="advisor-img"> 
            <button class="appointment-btn" onclick="openPopup('Mercy Donan')">Get Appointment</button>
             <img class= "appimg" src ="../HomePimg/tulips-removebg-preview.png">
           </div>
          <div>
            <div class="advisor-header">Mercy Donan</div>
            <div class="advisor-title">Academic & Career Advisor</div>
            <p>🎓 B.A. in Education</p>
            <p>🎯 Major selection, career fairs, academic mentorship</p>
            <p>📞 +95 9 987 654 321</p>
            <p>📧 mercy.donan@pannpyoethu.edu.mm</p>
            <div class="advisor-experience">
              <h4>Experience Highlights:</h4>
              <ul>
                <li>4+ years supporting students</li>
                <li>Organized events and fairs</li>
                <li>Strategic advising</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="advisor">
        <div class="advisor-content">
           <div>
            <img src="../Counsellor_page_images/David Johnson.png" alt="David Johnson" class="advisor-img">
            <button class="appointment-btn" onclick="openPopup('David Johnson')">Get Appointment</button>
             <img class= "appimg" src ="../Counsellor_page_images/Pink Tulip.png">
           </div>
          
          <div>
            <div class="advisor-header">David Johnson</div>
            <div class="advisor-title">Academic & Career Advisor</div>
            <p>🎓 B.A. in Education</p>
            <p>🎯 University apps, study skills, transitions</p>
            <p>📞 +95 9 555 123 456</p>
            <p>📧 david.johnson@pannpyoethu.edu.mm</p>
            <div class="advisor-experience">
              <h4>Experience Highlights:</h4>
              <ul>
                <li>10 years of academic advising</li>
                <li>Led workshops for study skills</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="advisor">
        <div class="advisor-content"> 
          <div>
            <img src="../Counsellor_page_images/Linda Mae.png" alt="Linda Mae" class="advisor-img">
            <button class="appointment-btn" onclick="openPopup('Linda Mae')">Get Appointment</button>
             <img class= "appimg" src ="../Counsellor_page_images/Pink Tulip.png">
           </div>
          <div>
            <div class="advisor-header">Linda Mae</div>
            <div class="advisor-title">Academic & Career Advisor</div>
            <p>🎓 B.A. in Psychology</p>
            <p>🎯 First-gen support, transitions, long-term planning</p>
            <p>📞 +95 9 777 888 999</p>
            <p>📧 linda.mae@pannpyoethu.edu.mm</p>
            <div class="advisor-experience">
              <h4>Experience Highlights:</h4>
              <ul>
                <li>Support for first-gen students</li>
                <li>Community college experience</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="advisor">
        <div class="advisor-content">
          <div>
            <img src="../Counsellor_page_images/Sophia Lwin.png" alt="Sophia Lwin" class="advisor-img">
            <button class="appointment-btn" onclick="openPopup('Sophia Lwin')">Get Appointment</button>
             <img class= "appimg" src ="../Counsellor_page_images/White Tulip.png">
           </div>

          <div>
            <div class="advisor-header">Sophia Lwin</div>
            <div class="advisor-title">Academic & Career Advisor</div>
            <p>🎓 B.A. in Human Services</p>
            <p>🎯 Retention, intervention, internships</p>
            <p>📞 +95 9 444 222 111</p>
            <p>📧 sophia.lwin@pannpyoethu.edu.mm</p>
            <div class="advisor-experience">
              <h4>Experience Highlights:</h4>
              <ul>
                <li>6+ years supporting student success</li>
                <li>NGO and business internship collabs</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="advisor">
        <div class="advisor-content">
          <div>
            <img src="../Counsellor_page_images/Michael Tun.png" alt="Michael Tun" class="advisor-img">
            <button class="appointment-btn" onclick="openPopup('Michael Tun')">Get Appointment</button>
             <img class= "appimg" src ="../Counsellor_page_images/White Tulip.png">
           </div>
          
          <div>
            <div class="advisor-header">Michael Tun</div>
            <div class="advisor-title">Academic & Career Advisor</div>
            <p>🎓 B.A. in Sociology</p>
            <p>🎯 Resume help, career pathway, adult learners</p>
            <p>📞 +95 9 222 333 444</p>
            <p>📧 michael.tun@pannpyoethu.edu.mm</p>
            <div class="advisor-experience">
              <h4>Experience Highlights:</h4>
              <ul>
                <li>8+ years advising and coaching</li>
                <li>Mock interviews and resume sessions</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
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
  </div>

  <div id="appointment-popup" class="popup">
    <div class="card">
      <span class="close-btn" onclick="closePopup()">&times;</span>
      <img src="../Counsellor_page_images/tulips-removebg-preview.png" class="flower-image" alt="flowers" />
      <div class="left">
        <h2>Get appointment with <span id="advisor-name">...............</span></h2>
        <div class="textbox">
          <label>Enter your name</label>
          <input type="text" placeholder="Your name" />

          <label>What kind of education counselling you want to get</label>
          <textarea placeholder="Your response..."></textarea>

          <label>Email</label>
          <input type="email" placeholder="your@email.com" />

          <p class="disclaimer">We'll reach out to you via email once the appointment date and time have been arranged.</p>
        </div>
      </div>
      <div class="right">
        <img src="../Counsellor_page_images/Logo.ico" class="top-logo" alt="logo" />
        <label>Preferred date</label>
        <input type="date" />

        <label>Backup date</label>
        <input type="date" />

        <div class="button-group">
          <button class="cancel-btn" onclick="closePopup()">Cancel</button>
          <button class="confirm-btn">Confirm</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Login Modal -->
  <div id="loginModal" class="modal">
    
    <div class="modal-content login-container">
      <!-- Left side -->
      <div class="login-left">
        <h1>Welcome to Pann Pyoe Thu</h1>
        <img src="../Counsellor_page_images/tulips-removebg-preview.png" alt="Flowers" class="flower-img" />
      </div>
  
      <!-- Right side -->
      <div class="login-right">
        <span class="close" onclick="closeLogin()">&times;</span>
        <img src="../Counsellor_page_images/Logo.ico" class="login-logo" alt="logo" />
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

</body>
</html>
