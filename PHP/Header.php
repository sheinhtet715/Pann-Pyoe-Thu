<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" href="../HomePimg/Logo.ico" type="image/x-icon">
    <title>Find Jobs - Pann Pyoe Thu</title>
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes:400,700&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="../CSS/Jobs.css"> -->
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
      <div class="profile-icon" onclick="openLogin()">
  <img src="../HomePimg/Profile.png" alt="Profile" class="profile-img" />
</div>
    </header>
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
    <style>
        
/* Header Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
.header {
    background: #529AA6;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 2rem;
    position: sticky;
    top: 0;
    z-index: 1000;
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
}

.nav a:hover {
    color: #BF9E8D;
}

.profile-icon {
    margin-left: 1.5rem;
    cursor: pointer;
    display: flex;
    align-items: center;
}

.profile-img {
    height: 36px;
    width: 36px;
    border-radius: 50%;
    object-fit: cover;
    background: #fff;
    border: 2px solid #BF9E8D;
}

.mobile-menu-toggle {
    display: none;
    flex-direction: column;
    gap: 4px;
    background: none;
    border: none;
    cursor: pointer;
    margin-left: 1rem;
}

.mobile-menu-toggle span {
    display: block;
    width: 24px;
    height: 3px;
    background: #fff;
    border-radius: 2px;
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
</html> 