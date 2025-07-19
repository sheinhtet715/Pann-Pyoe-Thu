<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Jobs - Pann Pyoe Thu</title>
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes:400,700&display=swap" rel="stylesheet">
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
      <button class="mobile-menu-toggle" onclick="toggleMobileMenu()" aria-label="Toggle mobile menu">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <div class="profile-icon" onclick="openLogin()" role="button" tabindex="0" aria-label="Open login menu">
        <img src="../HomePimg/Profile.png" alt="Profile" class="profile-img" />
      </div>
    </header>
    <main>
      <section class="intro">
        <h1>Find Your Next Job</h1>
        <p>Discover the best job opportunities from top companies in Myanmar. Use the filters below to find your perfect match.</p>
      </section>
      <section class="filter-bar sticky">
        <input type="text" id="search-bar" placeholder="Search job title or keyword...">
        <select id="filter-type">
          <option value="">All Job Types</option>
          <option value="Full Time">Full Time</option>
          <option value="Part Time">Part Time</option>
          <option value="Internship">Internship</option>
        </select>
        <select id="filter-location">
          <option value="">All Locations</option>
          <option value="Yangon">Yangon</option>
          <option value="Mandalay">Mandalay</option>
          <option value="Naypyitaw">Naypyitaw</option>
          <option value="Myawaddy">Myawaddy</option>
        </select>
        <select id="filter-company">
          <option value="">All Companies</option>
          <option value="KBZ Bank">KBZ Bank</option>
          <option value="AYA Bank">AYA Bank</option>
          <option value="Ooredoo Myanmar">Ooredoo Myanmar</option>
          <option value="Telenor Myanmar">Telenor Myanmar</option>
          <option value="Shwe Mingalar Spa">Shwe Mingalar Spa</option>
          <option value="CHID Bank">CHID Bank</option>
          <option value="Icon Electric Shop">Icon Electric Shop</option>
        </select>
      </section>
      <section class="jobs-grid" id="jobs-grid">
        <!-- All job cards go here (at least 28, as previously added) -->
        <!-- 20 Example job cards, real titles/companies -->
        <div class="job-card" data-title="Software Engineer" data-type="Full Time" data-location="Yangon" data-company="Ooredoo Myanmar">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2e/Ooredoo_logo.svg" alt="Ooredoo Myanmar" class="company-logo">
            <div>
              <div class="job-title">Software Engineer</div>
              <div class="company-name">Ooredoo Myanmar</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Yangon</div>
          <div class="job-summary"><strong>Summary JD:</strong> Design, develop, and maintain scalable web applications for telecom services.</div>
          <div class="job-desc">Develop and maintain scalable web applications. 2+ years experience required.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Branch Manager" data-type="Full Time" data-location="Mandalay" data-company="KBZ Bank">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="KBZ Bank" class="company-logo">
            <div>
              <div class="job-title">Branch Manager</div>
              <div class="company-name">KBZ Bank</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Mandalay</div>
          <div class="job-summary"><strong>Summary JD:</strong> Lead branch operations and sales, manage client relationships, and ensure customer satisfaction.</div>
          <div class="job-desc">Lead branch operations and sales. 5+ years banking experience preferred.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Customer Service Officer" data-type="Full Time" data-location="Yangon" data-company="AYA Bank">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="AYA Bank" class="company-logo">
            <div>
              <div class="job-title">Customer Service Officer</div>
              <div class="company-name">AYA Bank</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Yangon</div>
          <div class="job-summary"><strong>Summary JD:</strong> Provide excellent customer support and resolve client issues, maintain client relationships.</div>
          <div class="job-desc">Provide excellent customer support and resolve client issues.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Network Engineer" data-type="Full Time" data-location="Naypyitaw" data-company="Telenor Myanmar">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="Telenor Myanmar" class="company-logo">
            <div>
              <div class="job-title">Network Engineer</div>
              <div class="company-name">Telenor Myanmar</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Naypyitaw</div>
          <div class="job-summary"><strong>Summary JD:</strong> Maintain and optimize network infrastructure, ensure network reliability and security.</div>
          <div class="job-desc">Maintain and optimize network infrastructure. CCNA/CCNP preferred.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Beauty Aesthetic Manager" data-type="Full Time" data-location="Yangon" data-company="Shwe Mingalar Spa">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="Shwe Mingalar Spa" class="company-logo">
            <div>
              <div class="job-title">Beauty Aesthetic Manager</div>
              <div class="company-name">Shwe Mingalar Spa</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Yangon</div>
          <div class="job-summary"><strong>Summary JD:</strong> Oversee spa operations and staff, manage client relationships, ensure high-quality services.</div>
          <div class="job-desc">Oversee spa operations and staff. Experience in beauty industry required.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Data Analyst" data-type="Full Time" data-location="Yangon" data-company="CHID Bank">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="CHID Bank" class="company-logo">
            <div>
              <div class="job-title">Data Analyst</div>
              <div class="company-name">CHID Bank</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Yangon</div>
          <div class="job-summary"><strong>Summary JD:</strong> Analyze financial data and generate reports, provide insights for decision-making.</div>
          <div class="job-desc">Analyze financial data and generate reports. Excel & SQL skills required.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Electrician" data-type="Full Time" data-location="Myawaddy" data-company="Icon Electric Shop">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="Icon Electric Shop" class="company-logo">
            <div>
              <div class="job-title">Electrician</div>
              <div class="company-name">Icon Electric Shop</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Myawaddy</div>
          <div class="job-summary"><strong>Summary JD:</strong> Install and repair electrical systems, ensure safety and efficiency.</div>
          <div class="job-desc">Install and repair electrical systems. 3+ years experience required.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <!-- 13 more job cards for a total of 20 -->
        <div class="job-card" data-title="Marketing Specialist" data-type="Full Time" data-location="Yangon" data-company="Ooredoo Myanmar">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2e/Ooredoo_logo.svg" alt="Ooredoo Myanmar" class="company-logo">
            <div>
              <div class="job-title">Marketing Specialist</div>
              <div class="company-name">Ooredoo Myanmar</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Yangon</div>
          <div class="job-summary"><strong>Summary JD:</strong> Plan and execute marketing campaigns, manage digital marketing efforts.</div>
          <div class="job-desc">Plan and execute marketing campaigns. Digital marketing experience a plus.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="HR Officer" data-type="Full Time" data-location="Mandalay" data-company="KBZ Bank">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="KBZ Bank" class="company-logo">
            <div>
              <div class="job-title">HR Officer</div>
              <div class="company-name">KBZ Bank</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Mandalay</div>
          <div class="job-summary"><strong>Summary JD:</strong> Manage recruitment and employee relations, handle HR administration.</div>
          <div class="job-desc">Manage recruitment and employee relations. HR diploma preferred.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="IT Support" data-type="Full Time" data-location="Yangon" data-company="AYA Bank">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="AYA Bank" class="company-logo">
            <div>
              <div class="job-title">IT Support</div>
              <div class="company-name">AYA Bank</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Yangon</div>
          <div class="job-summary"><strong>Summary JD:</strong> Provide technical support for bank staff and systems, troubleshoot issues.</div>
          <div class="job-desc">Provide technical support for bank staff and systems.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Sales Executive" data-type="Full Time" data-location="Naypyitaw" data-company="Telenor Myanmar">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="Telenor Myanmar" class="company-logo">
            <div>
              <div class="job-title">Sales Executive</div>
              <div class="company-name">Telenor Myanmar</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Naypyitaw</div>
          <div class="job-summary"><strong>Summary JD:</strong> Drive sales and manage client relationships, achieve sales targets.</div>
          <div class="job-desc">Drive sales and manage client relationships. 2+ years experience required.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Spa Receptionist" data-type="Part Time" data-location="Yangon" data-company="Shwe Mingalar Spa">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="Shwe Mingalar Spa" class="company-logo">
            <div>
              <div class="job-title">Spa Receptionist</div>
              <div class="company-name">Shwe Mingalar Spa</div>
              <span class="job-type">Part Time</span>
            </div>
          </div>
          <div class="job-location">Yangon</div>
          <div class="job-summary"><strong>Summary JD:</strong> Greet clients and manage appointments, provide excellent customer service.</div>
          <div class="job-desc">Greet clients and manage appointments. Good communication skills required.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Finance Officer" data-type="Full Time" data-location="Yangon" data-company="CHID Bank">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="CHID Bank" class="company-logo">
            <div>
              <div class="job-title">Finance Officer</div>
              <div class="company-name">CHID Bank</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Yangon</div>
          <div class="job-summary"><strong>Summary JD:</strong> Oversee financial transactions and reporting, manage financial records.</div>
          <div class="job-desc">Oversee financial transactions and reporting. CPA preferred.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Field Technician" data-type="Full Time" data-location="Myawaddy" data-company="Icon Electric Shop">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="Icon Electric Shop" class="company-logo">
            <div>
              <div class="job-title">Field Technician</div>
              <div class="company-name">Icon Electric Shop</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Myawaddy</div>
          <div class="job-summary"><strong>Summary JD:</strong> Install and maintain electrical equipment at client sites, ensure safety and efficiency.</div>
          <div class="job-desc">Install and maintain electrical equipment at client sites.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Business Analyst" data-type="Full Time" data-location="Yangon" data-company="Ooredoo Myanmar">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2e/Ooredoo_logo.svg" alt="Ooredoo Myanmar" class="company-logo">
            <div>
              <div class="job-title">Business Analyst</div>
              <div class="company-name">Ooredoo Myanmar</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Yangon</div>
          <div class="job-summary"><strong>Summary JD:</strong> Analyze business processes and recommend improvements, provide strategic insights.</div>
          <div class="job-desc">Analyze business processes and recommend improvements.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Loan Officer" data-type="Full Time" data-location="Mandalay" data-company="KBZ Bank">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="KBZ Bank" class="company-logo">
            <div>
              <div class="job-title">Loan Officer</div>
              <div class="company-name">KBZ Bank</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Mandalay</div>
          <div class="job-summary"><strong>Summary JD:</strong> Evaluate and approve loan applications, manage loan portfolios.</div>
          <div class="job-desc">Evaluate and approve loan applications. Banking experience required.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Accountant" data-type="Full Time" data-location="Yangon" data-company="AYA Bank">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="AYA Bank" class="company-logo">
            <div>
              <div class="job-title">Accountant</div>
              <div class="company-name">AYA Bank</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Yangon</div>
          <div class="job-summary"><strong>Summary JD:</strong> Prepare and review financial statements, manage financial records.</div>
          <div class="job-desc">Prepare and review financial statements. ACCA/CPA preferred.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Project Manager" data-type="Full Time" data-location="Naypyitaw" data-company="Telenor Myanmar">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="Telenor Myanmar" class="company-logo">
            <div>
              <div class="job-title">Project Manager</div>
              <div class="company-name">Telenor Myanmar</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Naypyitaw</div>
          <div class="job-summary"><strong>Summary JD:</strong> Lead cross-functional teams to deliver telecom projects on time, manage project timelines.</div>
          <div class="job-desc">Lead cross-functional teams to deliver telecom projects on time.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Spa Therapist" data-type="Full Time" data-location="Yangon" data-company="Shwe Mingalar Spa">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="Shwe Mingalar Spa" class="company-logo">
            <div>
              <div class="job-title">Spa Therapist</div>
              <div class="company-name">Shwe Mingalar Spa</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Yangon</div>
          <div class="job-summary"><strong>Summary JD:</strong> Provide spa treatments and therapies, ensure client satisfaction.</div>
          <div class="job-desc">Provide spa treatments and therapies. Certification required.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Risk Analyst" data-type="Full Time" data-location="Yangon" data-company="CHID Bank">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="CHID Bank" class="company-logo">
            <div>
              <div class="job-title">Risk Analyst</div>
              <div class="company-name">CHID Bank</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Yangon</div>
          <div class="job-summary"><strong>Summary JD:</strong> Assess and manage financial risks, identify potential issues.</div>
          <div class="job-desc">Assess and manage financial risks. Analytical skills required.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Storekeeper" data-type="Full Time" data-location="Myawaddy" data-company="Icon Electric Shop">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="Icon Electric Shop" class="company-logo">
            <div>
              <div class="job-title">Storekeeper</div>
              <div class="company-name">Icon Electric Shop</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Myawaddy</div>
          <div class="job-summary"><strong>Summary JD:</strong> Manage inventory and supplies for the shop, ensure stock levels.</div>
          <div class="job-desc">Manage inventory and supplies for the shop. Experience preferred.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Logistics Coordinator" data-type="Full Time" data-location="Yangon" data-company="DHL Myanmar">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="DHL Myanmar" class="company-logo">
            <div>
              <div class="job-title">Logistics Coordinator</div>
              <div class="company-name">DHL Myanmar</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Yangon</div>
          <div class="job-summary"><strong>Summary JD:</strong> Coordinate shipments and manage warehouse operations, ensure efficient logistics.</div>
          <div class="job-desc">Coordinate shipments and manage warehouse operations. Experience in logistics required.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Retail Store Manager" data-type="Full Time" data-location="Yangon" data-company="City Mart">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="City Mart" class="company-logo">
            <div>
              <div class="job-title">Retail Store Manager</div>
              <div class="company-name">City Mart</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Yangon</div>
          <div class="job-summary"><strong>Summary JD:</strong> Oversee daily operations of the retail store, manage staff, ensure customer experience.</div>
          <div class="job-desc">Oversee daily operations of the retail store. Retail management experience required.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Telecom Sales Representative" data-type="Full Time" data-location="Mandalay" data-company="Mytel">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="Mytel" class="company-logo">
            <div>
              <div class="job-title">Telecom Sales Representative</div>
              <div class="company-name">Mytel</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Mandalay</div>
          <div class="job-summary"><strong>Summary JD:</strong> Promote and sell telecom products and services, manage client relationships.</div>
          <div class="job-desc">Promote and sell telecom products and services. Sales experience preferred.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Software QA Engineer" data-type="Full Time" data-location="Yangon" data-company="Unilever Myanmar">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="Unilever Myanmar" class="company-logo">
            <div>
              <div class="job-title">Software QA Engineer</div>
              <div class="company-name">Unilever Myanmar</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Yangon</div>
          <div class="job-summary"><strong>Summary JD:</strong> Test and ensure quality of software products, identify and report defects.</div>
          <div class="job-desc">Test and ensure quality of software products. QA/testing experience required.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Cabin Crew" data-type="Full Time" data-location="Yangon" data-company="Myanmar National Airlines">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="Myanmar National Airlines" class="company-logo">
            <div>
              <div class="job-title">Cabin Crew</div>
              <div class="company-name">Myanmar National Airlines</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Yangon</div>
          <div class="job-summary"><strong>Summary JD:</strong> Ensure passenger safety and comfort during flights, provide excellent service.</div>
          <div class="job-desc">Ensure passenger safety and comfort during flights. Good communication skills required.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Civil Engineer" data-type="Full Time" data-location="Naypyitaw" data-company="YCDC">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="YCDC" class="company-logo">
            <div>
              <div class="job-title">Civil Engineer</div>
              <div class="company-name">YCDC</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Naypyitaw</div>
          <div class="job-summary"><strong>Summary JD:</strong> Plan and supervise construction projects, ensure project quality and timelines.</div>
          <div class="job-desc">Plan and supervise construction projects. BEng in Civil Engineering required.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Mobile App Developer" data-type="Full Time" data-location="Yangon" data-company="KBZPay">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="KBZPay" class="company-logo">
            <div>
              <div class="job-title">Mobile App Developer</div>
              <div class="company-name">KBZPay</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Yangon</div>
          <div class="job-summary"><strong>Summary JD:</strong> Develop and maintain mobile payment applications, ensure secure and user-friendly interface.</div>
          <div class="job-desc">Develop and maintain mobile payment applications. Android/iOS experience required.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Content Writer" data-type="Part Time" data-location="Yangon" data-company="Yoma Bank">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="Yoma Bank" class="company-logo">
            <div>
              <div class="job-title">Content Writer</div>
              <div class="company-name">Yoma Bank</div>
              <span class="job-type">Part Time</span>
            </div>
          </div>
          <div class="job-location">Yangon</div>
          <div class="job-summary"><strong>Summary JD:</strong> Write and edit content for digital platforms, ensure accurate and engaging content.</div>
          <div class="job-desc">Write and edit content for digital platforms. Excellent English required.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Customer Care Agent" data-type="Full Time" data-location="Yangon" data-company="MPT">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="MPT" class="company-logo">
            <div>
              <div class="job-title">Customer Care Agent</div>
              <div class="company-name">MPT</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Yangon</div>
          <div class="job-summary"><strong>Summary JD:</strong> Handle customer inquiries and provide support, ensure customer satisfaction.</div>
          <div class="job-desc">Handle customer inquiries and provide support. Call center experience a plus.</div>
          <button class="apply-btn">Apply now</button>
        </div>
        <div class="job-card" data-title="Graphic Designer" data-type="Full Time" data-location="Yangon" data-company="Unilever Myanmar">
          <div class="job-card-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/KBZ_Bank_logo.svg/1200px-KBZ_Bank_logo.svg.png" alt="Unilever Myanmar" class="company-logo">
            <div>
              <div class="job-title">Graphic Designer</div>
              <div class="company-name">Unilever Myanmar</div>
              <span class="job-type">Full Time</span>
            </div>
          </div>
          <div class="job-location">Yangon</div>
          <div class="job-summary"><strong>Summary JD:</strong> Design marketing materials and digital assets, ensure brand consistency.</div>
          <div class="job-desc">Design marketing materials and digital assets. Proficiency in Adobe Suite required.</div>
          <button class="apply-btn">Apply now</button>
        </div>
      </section>
      <div class="load-more-container" style="display: flex; justify-content: center; margin-bottom: 40px;">
        <button id="load-more-btn" class="page-btn">Load More</button>
      </div>
    </main>
    <script>
      function toggleMobileMenu() {
        const nav = document.getElementById('nav-menu');
        nav.classList.toggle('active');
      }
      function openLogin() {
        alert('Login menu would open here.');
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
</body>
</html> 