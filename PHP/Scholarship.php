<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Scholarships!</title>
       <link rel="icon" href="../HomePimg/Logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/Scholarship.css">
    <script src="../JavaScript/Scholarship.js"></script>
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
        <a href="../PHP/Counsellor.html">Educational Counsellors</a>
        <a href="../PHP/Scholarship.html">Scholarships</a>
        <a href="../PHP/LocalUni.php">Local Universities</a>
        <a href="#jobs">Job Opportunities</a>
      </nav>
      <div class="profile-icon" onclick="openLogin()">
        <img src="../HomePimg/Profile.png" alt="Profile" class="profile-img" />
      </div>
    </header>

     <!-- Login Modal -->
    <div id="loginModal" class="modal">
        <div class="modal-content login-container">
            <!-- Left side -->
            <div class="login-left">
                <h1>Welcome to Pann Pyoe Thu</h1>
                <img src="../HomePimg//tulips-removebg-preview.png" alt="Flowers" class="flower-img" />
            </div>

            <!-- Right side -->
            <div class="login-right">
                <span class="close" onclick="closeLogin()">&times;</span>
                <img src="../HomePimg/Logo.ico" class="login-logo" alt="logo" />
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
    <div class="main-content">
        <div class="container">
            <h2>Find Scholarships</h2>
            <p>Looking for ways to fund your education? Explore a variety of scholarships tailored to your dreams and start your journey with confidence.</p>
            <div class="filter-row">
                <button class="filter-btn">Filter by</button>
                <span style="color:#fff;font-size:14px;">Country</span>
                <select class="filter-select">
                    <option>All</option>
                    <option>United States</option>
                    <option>Australia</option>
                    <option>Netherlands</option>
                    <option>Japan</option>
                    <option>Italy</option>
                    <option>Turkey</option>
                    <option>United Kingdom</option>
                    <option>Germany</option>
                    <option>Taiwan</option>
                    <option>Canada</option>
                </select>
            </div>
            <div class="scholarship-list">
                <!-- Card 1 -->
                <div class="scholarship-card">
                    <div class="left">
                        <div class="flag" style="background:url('https://flagcdn.com/us.svg') center/cover;"></div>
                        <div class="country">United States</div>
                        <div class="info">Fall 2025</div>
                        <div class="info">April 1</div>
                        <div class="date">April 30, 2025</div>
                    </div>
                    <div class="center">
                        <div class="logo"><img src="https://upload.wikimedia.org/wikipedia/en/b/b7/Stanford_University_seal_2003.svg" alt="Stanford" style="width:40px;height:40px;"></div>
                        <div class="title">Stanford Graduate Fellowship</div>
                        <div class="coverage">Coverage<br>Tuition, partial living expenses</div>
                        <div class="desc">Apply now</div>
                        <div class="note">Scholarships for international students not from outside EU/EEA.</div>
                    </div>
                    <div class="right">
                        <button class="apply-btn">Apply now</button>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="scholarship-card">
                    <div class="left">
                        <div class="flag" style="background:url('https://flagcdn.com/us.svg') center/cover;"></div>
                        <div class="country">United States</div>
                        <div class="info">Fall 2025</div>
                        <div class="info">April 1</div>
                        <div class="date">April 30, 2025</div>
                    </div>
                    <div class="center">
                        <div class="logo"><img src="https://upload.wikimedia.org/wikipedia/commons/7/7e/Flag_of_Europe.svg" alt="Erasmus" style="width:40px;height:40px;"></div>
                        <div class="title">Erasmus University, Holland Scholarship</div>
                        <div class="coverage">Coverage<br>Tuition, partial living expenses</div>
                        <div class="desc">Apply now</div>
                        <div class="note">Scholarships for international students not from outside EU/EEA.</div>
                    </div>
                    <div class="right">
                        <button class="apply-btn">Apply now</button>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="scholarship-card">
                    <div class="left">
                        <div class="flag" style="background:url('https://flagcdn.com/au.svg') center/cover;"></div>
                        <div class="country">Australia</div>
                        <div class="info">Spring 2025</div>
                        <div class="info">April 1</div>
                        <div class="date">March 31, 2025</div>
                    </div>
                    <div class="center">
                        <div class="logo"><img src="https://upload.wikimedia.org/wikipedia/en/2/2e/Monash_University_coat_of_arms.svg" alt="Monash" style="width:40px;height:40px;"></div>
                        <div class="title">Monash International, Merit-Scholarship</div>
                        <div class="coverage">Coverage<br>Tuition, living, travel allowance</div>
                        <div class="desc">Apply now</div>
                        <div class="note">Awards for students with excellent academic records.</div>
                    </div>
                    <div class="right">
                        <button class="apply-btn">Apply now</button>
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="scholarship-card">
                    <div class="left">
                        <div class="flag" style="background:url('https://flagcdn.com/us.svg') center/cover;"></div>
                        <div class="country">New York</div>
                        <div class="info">Spring 2025</div>
                        <div class="info">July 1</div>
                        <div class="date">August 31, 2025</div>
                    </div>
                    <div class="center">
                        <div class="logo"><img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Yale_University_Shield_1.svg" alt="Yale" style="width:40px;height:40px;"></div>
                        <div class="title">Yale University</div>
                        <div class="coverage">Coverage<br>Tuition, living, travel allowance</div>
                        <div class="desc">Apply now</div>
                        <div class="note">Awards for students with excellent academic records.</div>
                    </div>
                    <div class="right">
                        <button class="apply-btn">Apply now</button>
                    </div>
                </div>
                <!-- New Card 1: MEXT Japanese Studies Scholarship 2026 -->
                <div class="scholarship-card">
                    <div class="left">
                        <div class="flag" style="background:url('https://flagcdn.com/jp.svg') center/cover;"></div>
                        <div class="country">Japan</div>
                        <div class="info">October 2026</div>
                        <div class="info">Undergraduate</div>
                        <div class="date">Application: January 2026; Deadline: TBD</div>
                    </div>
                    <div class="center">
                        <div class="logo"><img src="https://upload.wikimedia.org/wikipedia/commons/9/9e/Flag_of_Japan.svg" alt="Japan" style="width:40px;height:40px;"></div>
                        <div class="title">MEXT Japanese Studies Scholarship 2026</div>
                        <div class="coverage">Coverage<br>Tuition, monthly stipend, travel expenses</div>
                        <div class="desc">One-year scholarship for undergraduates to study Japanese language and culture in Japan</div>
                        <div class="note">Eligibility: Must be an undergraduate student at a university outside Japan, majoring in Japanese language or culture. Must meet age limits and academic requirements. Applications typically open the winter before the scholarship year.</div>
                        <div class="right">
                            <a href="https://www.nashville.us.emb-japan.go.jp/itpr_en/00_000307.html" class="apply-btn" target="_blank">Apply / Source</a>
                        </div>
                    </div>
                </div>
                <!-- New Card 2: Study in Italy Program for Myanmar Students -->
                <div class="scholarship-card">
                    <div class="left">
                        <div class="flag" style="background:url('https://flagcdn.com/it.svg') center/cover;"></div>
                        <div class="country">Italy</div>
                        <div class="info">2025–2026</div>
                        <div class="info">UG, Graduate</div>
                        <div class="date">Varies by University</div>
                    </div>
                    <div class="center">
                        <div class="logo"><img src="https://upload.wikimedia.org/wikipedia/commons/0/03/Flag_of_Italy.svg" alt="Italy" style="width:40px;height:40px;"></div>
                        <div class="title">Study in Italy Program for Myanmar Students</div>
                        <div class="coverage">Coverage<br>Tuition reductions, university scholarships, housing benefits</div>
                        <div class="desc">Support and scholarship opportunities for Myanmar students wishing to study at Italian universities. Includes guidance on enrollment, visa, tuition, and eligibility for fee reductions and scholarships.</div>
                        <div class="note">Eligibility: Myanmar students with a minimum 12 years of schooling (or alternative conditions) applying to Italian universities. Language proficiency in Italian or English required. Income-based fee reduction available upon proof. Declaration of Value required for enrollment.</div>
                        <div class="right">
                            <a href="https://ambyangon.esteri.it/en/servizi-consolari-e-visti/servizi-per-il-cittadino-straniero/studying-in-italy/" class="apply-btn" target="_blank">Apply / Source</a>
                        </div>
                    </div>
                </div>
                <!-- New Card 3: Octavius Catto Scholarship -->
                <div class="scholarship-card">
                    <div class="left">
                        <div class="flag" style="background:url('https://flagcdn.com/us.svg') center/cover;"></div>
                        <div class="country">United States</div>
                        <div class="info">Fall & Spring</div>
                        <div class="info">Associate</div>
                        <div class="date">No separate application</div>
                    </div>
                    <div class="center">
                        <div class="logo"><img src="https://upload.wikimedia.org/wikipedia/commons/a/a4/Community_College_of_Philadelphia_logo.png" alt="CCP" style="width:40px;height:40px;"></div>
                        <div class="title">Octavius Catto Scholarship</div>
                        <div class="coverage">Coverage<br>Tuition-free, all course materials, stipend, support services</div>
                        <div class="desc">A no-debt, tuition-free scholarship at Community College of Philadelphia with stipends, academic resources, and holistic student support to empower low-income Philadelphians toward upward economic mobility.</div>
                        <div class="note">Eligibility: New, first-time CCP students, transfer students with 30 or fewer credits, or former CCP students with a 2.0 GPA returning after one year. Must be a Philadelphia resident for 12 months, attend full-time, have a high school diploma or equivalent, FAFSA with SAI ≤ $8,000, and place college-ready or one level below in English and Math.</div>
                        <div class="right">
                            <a href="https://www.ccp.edu/admission-aid/paying-college/scholarships/octavius-catto-scholarship" class="apply-btn" target="_blank">Apply / Source</a>
                        </div>
                    </div>
                </div>
                <!-- New Card 4: Türkiye Scholarships – Bachelor's Program -->
                <div class="scholarship-card">
                    <div class="left">
                        <div class="flag" style="background:url('https://flagcdn.com/tr.svg') center/cover;"></div>
                        <div class="country">Turkey</div>
                        <div class="info">Fall</div>
                        <div class="info">Bachelor's</div>
                        <div class="date">Dec–Feb (annual)</div>
                    </div>
                    <div class="center">
                        <div class="logo"><img src="https://upload.wikimedia.org/wikipedia/commons/b/b4/Flag_of_Turkey.svg" alt="Turkey" style="width:40px;height:40px;"></div>
                        <div class="title">Türkiye Scholarships – Bachelor's Program</div>
                        <div class="coverage">Coverage<br>Tuition, stipend, accommodation, insurance, Turkish course, flights</div>
                        <div class="desc">Scholarships for undergraduate students in various fields in Türkiye.</div>
                        <div class="note">Eligibility: Open to international students. Must verify field equivalence in home country.</div>
                        <div class="right">
                            <a href="https://www.turkiyeburslari.gov.tr/en" class="apply-btn" target="_blank">Apply / Source</a>
                        </div>
                    </div>
                </div>
                <!-- New Card 5: Chevening Scholarships -->
                <div class="scholarship-card">
                    <div class="left">
                        <div class="flag" style="background:url('https://flagcdn.com/gb.svg') center/cover;"></div>
                        <div class="country">United Kingdom</div>
                        <div class="info">Fall 2026</div>
                        <div class="info">Masters</div>
                        <div class="date">Aug–Nov 2025</div>
                    </div>
                    <div class="center">
                        <div class="logo"><img src="https://upload.wikimedia.org/wikipedia/commons/a/ae/Flag_of_the_United_Kingdom.svg" alt="UK" style="width:40px;height:40px;"></div>
                        <div class="title">Chevening Scholarships</div>
                        <div class="coverage">Coverage<br>Tuition, living, travel, allowances</div>
                        <div class="desc">UK govt scholarship for master's</div>
                        <div class="note">Eligibility: International emerging leaders</div>
                        <div class="right">
                            <a href="https://www.chevening.org/scholarships/who-can-apply/" class="apply-btn" target="_blank">Apply / Source</a>
                        </div>
                    </div>
                </div>
                <!-- New Card 6: DAAD Helmut‑Schmidt Masters Scholarship -->
                <div class="scholarship-card">
                    <div class="left">
                        <div class="flag" style="background:url('https://flagcdn.com/de.svg') center/cover;"></div>
                        <div class="country">Germany</div>
                        <div class="info">Sept/Oct 2026</div>
                        <div class="info">Master's</div>
                        <div class="date">31 July 2025</div>
                    </div>
                    <div class="center">
                        <div class="logo"><img src="https://upload.wikimedia.org/wikipedia/commons/b/ba/Flag_of_Germany.svg" alt="Germany" style="width:40px;height:40px;"></div>
                        <div class="title">DAAD Helmut‑Schmidt Masters Scholarship</div>
                        <div class="coverage">Coverage<br>Tuition + monthly stipend</div>
                        <div class="desc">Postgraduate public policy & governance in Germany</div>
                        <div class="note">Eligibility: Open to Myanmar students</div>
                        <div class="right">
                            <a href="https://daad.de/go/en/stipa57692564" class="apply-btn" target="_blank">Apply / Source</a>
                        </div>
                    </div>
                </div>
                <!-- New Card 7: MOFA Taiwan Scholarship -->
                <div class="scholarship-card">
                    <div class="left">
                        <div class="flag" style="background:url('https://flagcdn.com/tw.svg') center/cover;"></div>
                        <div class="country">Taiwan</div>
                        <div class="info">Fall 2026</div>
                        <div class="info">Bachelor's, Master's</div>
                        <div class="date">Varies; usually Spring</div>
                    </div>
                    <div class="center">
                        <div class="logo"><img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Flag_of_the_Republic_of_China.svg" alt="Taiwan" style="width:40px;height:40px;"></div>
                        <div class="title">MOFA Taiwan Scholarship</div>
                        <div class="coverage">Coverage<br>NT$25,000–30,000 monthly + tuition waiver</div>
                        <div class="desc">Taiwan govt scholarship</div>
                        <div class="note">Eligibility: Non‑Taiwanese nationals</div>
                        <div class="right">
                            <a href="https://en.mofa.gov.tw/cp.aspx?n=1325" class="apply-btn" target="_blank">Apply / Source</a>
                        </div>
                    </div>
                </div>
                <!-- New Card 8: Jardine Scholarship -->
                <div class="scholarship-card">
                    <div class="left">
                        <div class="flag" style="background:url('https://upload.wikimedia.org/wikipedia/commons/4/4c/Flag_of_Oxford.svg') center/cover;"></div>
                        <div class="country">United Kingdom</div>
                        <div class="info">Fall 2026</div>
                        <div class="info">Undergraduate</div>
                        <div class="date">Around Oct 2025</div>
                    </div>
                    <div class="center">
                        <div class="logo"><img src="https://upload.wikimedia.org/wikipedia/commons/a/ae/Flag_of_the_United_Kingdom.svg" alt="UK" style="width:40px;height:40px;"></div>
                        <div class="title">Jardine Scholarship</div>
                        <div class="coverage">Coverage<br>Full tuition and living expenses</div>
                        <div class="desc">Prestigious full scholarship to Oxford/Cambridge</div>
                        <div class="note">Eligibility: From Asia-Pacific; academic excellence</div>
                        <div class="right">
                            <a href="https://www.jardines.com/en/sustainability/our-focus-areas/shaping-social-inclusion/jardine-foundation" class="apply-btn" target="_blank">Apply / Source</a>
                        </div>
                    </div>
                </div>
                <!-- New Card 9: University of Windsor Global Conflict Relief Bursary -->
                <div class="scholarship-card">
                    <div class="left">
                        <div class="flag" style="background:url('https://flagcdn.com/ca.svg') center/cover;"></div>
                        <div class="country">Canada</div>
                        <div class="info">Fall 2025</div>
                        <div class="info">Undergraduate</div>
                        <div class="date">Oct 15, 2025</div>
                    </div>
                    <div class="center">
                        <div class="logo"><img src="https://upload.wikimedia.org/wikipedia/commons/c/cf/Flag_of_Canada.svg" alt="Canada" style="width:40px;height:40px;"></div>
                        <div class="title">University of Windsor Global Conflict Relief Bursary</div>
                        <div class="coverage">Coverage<br>CAD 10,000</div>
                        <div class="desc">Bursary for international students affected by global conflicts</div>
                        <div class="note">Eligibility: International undergrad; open Aug 1–Oct 15 2025</div>
                        <div class="right">
                            <a href="https://www.uwindsor.ca/studentawards/international-students-scholarships" class="apply-btn" target="_blank">Apply / Source</a>
                        </div>
                    </div>
                </div>
                <!-- New Card 10: UWindsor Open Entrance Scholarship -->
                <div class="scholarship-card">
                    <div class="left">
                        <div class="flag" style="background:url('https://flagcdn.com/ca.svg') center/cover;"></div>
                        <div class="country">Canada</div>
                        <div class="info">Fall 2025</div>
                        <div class="info">Undergraduate</div>
                        <div class="date">TBD closing 2025‑26</div>
                    </div>
                    <div class="center">
                        <div class="logo"><img src="https://upload.wikimedia.org/wikipedia/commons/c/cf/Flag_of_Canada.svg" alt="Canada" style="width:40px;height:40px;"></div>
                        <div class="title">UWindsor Open Entrance Scholarship</div>
                        <div class="coverage">Coverage<br>CAD 1,000</div>
                        <div class="desc">Automatic merit based for incoming international students</div>
                        <div class="note">Eligibility: International undergrad, auto‑considered</div>
                        <div class="right">
                            <a href="https://www.uwindsor.ca/studentawards/international-students-scholarships" class="apply-btn" target="_blank">Apply / Source</a>
                        </div>
                    </div>
                </div>
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