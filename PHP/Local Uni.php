<?php
    // pick up any flash‐error or ‐success from login.php
    $active = 'localuni';
    session_start();
    $error   = $_SESSION['login_error'] ?? '';
    $success = $_SESSION['login_success'] ?? '';
    unset($_SESSION['login_error'], $_SESSION['login_success']);
    include "./db_connection.php";
    // Fetch user info for profile image
    $user = null;
    if (! empty($_SESSION['user_id'])) {
        $stmt = $conn->prepare("SELECT user_name, profile_path FROM User_tbl WHERE user_id = ?");
        $stmt->bind_param('i', $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $user   = $result->fetch_assoc();
        $stmt->close();
    }
?>
    <?php
ob_start();
?>
	<link rel="stylesheet" href="../CSS/Local Uni.css">
  


        <div class="starter-text">
            <h1>Local Universities</h1>
            <p>Discover the best local universities near you—each offering unique programs, vibrant student communities, and opportunities to shape your future. Find the right fit for your academic and career goals right here in your area.</p>
        </div>

    <div class="container">
        <div class="card university">
            <div class="uni-content">
                 <img src="../Local_uni_images/um1.jfif"  alt="Medicine1">
                    <div class="uni-text">
                        <h1>University of Medicine (1)</h1>
                            <p>Location - No.245, Myoma Kyaung Street, Lanmadaw Township, Yangon, Myanmar.</p>
                            <p>Academic - 7‑year M.B.,B.S including 1‑year internship</p>
                            <p>Admissions - High school science pass + qualifying aggregate</p>
                            <p>Curriculum - Mix of foundational, pre‑clinical, clinical, and field training</p>
                    </div>
            </div>
        </div>

        <div class="card uni-icon">
             <img src="../Local_uni_images/um1 front gate.jfif"  alt="University1">
                <div class="visit-container">
                    <div class="visit-text">
                    <a href="https://um1yangon.edu.mm/en/" target="_blank">Visit Website</a>
                </div>
        </div>
    </div>


    <div class="card university">
        <div class="uni-content">
        <img src="../Local_uni_images/um2 logo.png" alt="Medicine2">
        <div class="uni-text">
            <h1>University of Medicine (2)</h1>
            <p>Location - North Okkapala, Yangon</p>
            <p>Academic - 7years: Foundation → Pre‑clinical → Clinical → 1‑yr internship</p>
            <p>Admissions - High school science pass + qualifying aggregate</p>
            <p>Curriculum - Mix of foundational, pre‑clinical, clinical, and field training</p>
        </div>
        </div>
    </div>

    <div class="card uni-icon">
        <img src="../Local_uni_images/um2 front gate.jfif" alt="University2">
        <div class="visit-container">
        <div class="visit-text">
        <a href="https://um2ygn.edu.mm/" target="_blank">Visit Website</a>
        </div>
        </div>
    </div>

    <div class="card university">
        <div class="uni-content">
        <img src="../Local_uni_images/um, magway.png" alt="Medicine3">
        <div class="uni-text">
        <h1>University of Medicine, Magway</h1>
        <p>Location - Magway City, Magway Region</p>
        <p>Academic - 6–7 years: Foundation → Pre‑clinical → Clinical → (Internship)</p>
        <p>Admissions - Science matriculation pass + qualifying entrance exam scores</p>
        <p>Curriculum - Integrated system modules + clinical rotations + community training</p>
        </div>
        </div>
    </div>

    <div class="card uni-icon">
        <img src="../Local_uni_images/um, magway front gate.JPG" alt="University3">
        <div class="visit-container">
        <div class="visit-text">
        <a href="https://www.ummg.edu.mm/" target="_blank">Visit Website</a>
        </div>
        </div>
    </div>

    <div class="card university">
        <div class="uni-content">
        <img src="../Local_uni_images/um taunggyi.jfif" alt="Medicine4">
        <div class="uni-text">
        <h1>University of Medicine, Taunggyi</h1>
        <p>Location - Taunggyi, Shan State</p>
        <p>Academic - 7‑year M.B.,B.S (250 credits, internship included)</p>
        <p>Admissions - Science matriculation pass + qualifying entrance exam scores></p>
        <p>Curriculum - Foundational → Pre‑clinical → Clinical → Internship with rural/community exposure</p>
        </div>
        </div>
    </div>

    <div class="card uni-icon">
        <img src="../Local_uni_images/Um taunggyi front gate.jpg" alt="University4">
        <div class="visit-container">
        <div class="visit-text">
        <a href="https://umtgi.edu.mm/" target="_blank">Visit Website</a>
        </div>
        </div>
    </div>

    <div class="card university">
        <div class="uni-content">
        <img src="../Local_uni_images/Eco-Dept-Logo.jpg" alt="Medicine4">
        <div class="uni-text">
        <h1>Yangon University of Economics</h1>
        <p>Location – Yangon, Kamayut Township</p>
        <p>Academic – Bachelor's, Master's, and Doctorate degrees </p>
        <p>Admissions – Matriculation pass + entrance exam for undergrad; bachelor’s with merit for postgrad.</p>
        <p>Curriculum – Core in economics, management, finance, stats, quantitative and policy modules, with fieldwork and internships.</p>
        </div>
        </div>
    </div>

    <div class="card uni-icon">
        <img src="../Local_uni_images/Eco front gate.jpg" alt="University4">
        <div class="visit-container">
        <div class="visit-text">
        <a href="https://yueco.edu.mm/?page_id=87" target="_blank">Visit Website</a>
        </div>
        </div>
    </div>

    <div class="card university">
        <div class="uni-content">
        <img src="../Local_uni_images/yufl logo.png" alt="Medicine4">
        <div class="uni-text">
        <h1>Yangon University of Foreign Languages</h1>
        <p>Location – Yangon, Kamayut Township</p>
        <p>Academic – Bachelor's and Master's degrees</p>
        <p>Admissions – Matriculation pass with qualifying entrance exam and interview</p>
        <p>Curriculum – Language theory, linguistics, cultural studies, translation and interpretation, plus language immersion programs and exchange partnerships</p>
        </div>
        </div>
    </div>

    <div class="card uni-icon">
        <img src="../Local_uni_images/yufl front gate.jpg" alt="University4">
        <div class="visit-container">
        <div class="visit-text">
        <a href="https://www.yufl.edu.mm/" target="_blank">Visit Website</a>
        </div>
        </div>
    </div>

    <div class="card university">
        <div class="uni-content">
        <img src="../Local_uni_images/Computer uni logo.png" alt="Medicine4">
        <div class="uni-text">
        <h1>University of Computer Studies, Yangon</h1>
        <p>Location – Yangon, Hlawga </p>
        <p>Academic – Bachelor's (4 years), Master's, and Doctorate degrees </p>
        <p>Admissions – Science matriculation pass with high entrance exam scores, particularly in Mathematics and English </p>
        <p>Curriculum – Programming, algorithms, software engineering, database systems, AI, networking, capstone projects, and IT industry internships</p>
        </div>
        </div>
    </div>

    <div class="card uni-icon">
        <img src="../Local_uni_images/computer uni front gate.jpg" alt="University4">
        <div class="visit-container">
        <div class="visit-text">
        <a href="https://www.ucsy.edu.mm/history.do" target="_blank">Visit Website</a>
        </div>
        </div>
    </div>

    <div class="card university">
        <div class="uni-content">
        <img src="../Local_uni_images/pharmacy logo.png" alt="Medicine4">
        <div class="uni-text">
        <h1>University of Pharmacy, Yangon</h1>
        <p>Location – Yangon, North Okkalapa Township</p>
        <p>Academic – 5-year B.Pharm degree</p>
        <p>Admissions – Science matriculation pass with qualifying entrance exam performance</p>
        <p>Curriculum – Pharmaceutical sciences, pharmacology, pharmaceutics, pharmacy practice, hospital and industrial attachments</p>
        </div>
        </div>
    </div>

    <div class="card uni-icon">
        <img src="../Local_uni_images/pharmacy front page.jfif" alt="University4">
        <div class="visit-container">
        <div class="visit-text">
        <a href="https://www.uopygn.gov.mm/" target="_blank">Visit Website</a>
        </div>
        </div>
    </div>

    <div class="card university">
        <div class="uni-content">
        <img src="../Local_uni_images/education logo.png" alt="Medicine4">
        <div class="uni-text">
        <h1>Yangon University of Education</h1>
        <p>Location – Yangon, Kamayut Township</p>
        <p>Academic – Bachelor's, Master's, and Doctorate degrees in education</p>
        <p>Admissions – Arts/Science matriculation pass with entrance exam or selection by the Ministry of Education</p>
        <p>Curriculum – Educational psychology, pedagogy, curriculum studies, teaching practicum, and special needs education modules</p>
        </div>
        </div>
    </div>

    <div class="card uni-icon">
        <img src="../Local_uni_images/education front gate.jpg" alt="University4">
        <div class="visit-container">
        <div class="visit-text">
        <a href="https://www.yuoe.edu.mm/" target="_blank">Visit Website</a>
        </div>
        </div>
    </div>

    <div class="card university">
        <div class="uni-content">
        <img src="../Local_uni_images/nursing logo.png" alt="Medicine4">
        <div class="uni-text">
        <h1>University of Nursing, Yangon</h1>
        <p>Location – Yangon, Lanmadaw Township </p>
        <p>Academic – 4-year B.N.Sc (Bachelor of Nursing Science)</p>
        <p>Admissions – Science matriculation pass with qualifying entrance exam and health check</p>
        <p>Curriculum – Fundamentals of nursing, medical-surgical nursing, maternal and child health, community health, clinical practicum, and hospital postings</p>
        </div>
        </div>
    </div>

    <div class="card uni-icon">
        <img src="../Local_uni_images/nursing front gate.jpg" alt="University4">
        <div class="visit-container">
        <div class="visit-text">
        <a href="https://www.uonygn.gov.mm/" target="_blank">Visit Website</a>
        </div>
        </div>
    </div>
</div>


       <!-- Footer -->
        <?php
            include_once "Footer.php";
        ?>







  <!-- 4) Flash‐and‐SweetAlert2 trigger on login/signup errors or success -->
  <script>



//Mobile menu toggle function
    function toggleMobileMenu() {
        const nav = document.getElementById('nav-menu');
        nav.classList.toggle('active');
      }

</script>
<?php
$content = ob_get_clean(); 
require './logo_container.php';
?>
