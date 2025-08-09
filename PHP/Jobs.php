
<?php
    // --- MERGED LOGIC ---
session_start();

    include "./db_connection.php";
    $active = 'jobs';
    $imgFolder = '../Job page images/';
    $error     = $_SESSION['login_error'] ?? '';
    $success   = $_SESSION['login_success'] ?? '';
    unset($_SESSION['login_error'], $_SESSION['login_success']);

    // Fetch job locations (PDO)
    $locationStmt = $pdo->query("SELECT DISTINCT location FROM job_tbl ORDER BY location ASC");
    $locations    = $locationStmt->fetchAll(PDO::FETCH_COLUMN);
    // Fetch unique company names (PDO)
    $companyStmt = $pdo->query("SELECT DISTINCT org_name FROM job_tbl ORDER BY org_name ASC");
    $companies   = $companyStmt->fetchAll(PDO::FETCH_COLUMN);
  
// Fetch user info for profile image

?>
    <?php
ob_start();
?>



    <link rel="stylesheet" href="../CSS/Jobs.css">

     




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
                <option value="<?php echo htmlspecialchars($location)?>"><?php echo htmlspecialchars($location)?></option>
              <?php endforeach; ?>
            </select>
            <select name="company" id="filter-company">
              <option value="">All Companies</option>
              <?php foreach ($companies as $company): ?>
                <option value="<?php echo htmlspecialchars($company)?>"><?php echo htmlspecialchars($company)?></option>
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
               data-title="<?php echo htmlspecialchars($job['job_title'])?>"
               data-type="<?php echo htmlspecialchars($job['job_type'])?>"
               data-location="<?php echo htmlspecialchars($job['location'])?>"
               data-company="<?php echo htmlspecialchars($job['org_name'])?>">
            <div class="job-card-header">
              <img src="<?php echo htmlspecialchars($imgFolder . $job['imglogo_url'])?>"
                   alt="<?php echo htmlspecialchars($job['org_name'])?>"
                   class="company-logo">
              <div>
                <div class="job-title"><?php echo htmlspecialchars($job['job_title'])?></div>
                <div class="company-name"><?php echo htmlspecialchars($job['org_name'])?></div>
                <span class="job-type"><?php echo htmlspecialchars($job['job_type'])?></span>
              </div>
            </div>
            <div class="job-location"><?php echo htmlspecialchars($job['location'])?></div>
            <div class="job-summary"><strong>Summary JD:</strong> <?php echo htmlspecialchars($job['description'])?></div>
            <div class="job-desc"><?php echo htmlspecialchars($job['requirement'])?></div>
            <a class="apply-btn text-decoration-none" href="<?php echo htmlspecialchars($job['job_attachment'])?>" target="_blank">Apply now</a>
          </div>
        <?php endforeach; ?>
      </section>

      <div class="load-more-container" style="display: flex; justify-content: center; margin-bottom: 40px;">
          <button id="load-more-btn" class="page-btn">Load More</button>
      </div>
    </main>

       <!-- Footer -->
        <?php
            include_once "Footer.php";
        ?>




<!-- 1) Load your libraries -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>





    <script>


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



<?php
$content = ob_get_clean(); 
require './logo_container.php';
?>

        <!-- ...existing job cards... -->