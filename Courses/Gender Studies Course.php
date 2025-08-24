<?php
  if (session_status() === PHP_SESSION_NONE) session_start();
    include '../PHP/db_connection.php';
      $user = null;
  if (! empty($_SESSION['user_id'])) {
      $stmt = $conn->prepare("SELECT user_name, profile_path FROM User_tbl WHERE user_id = ?");
      $stmt->bind_param('i', $_SESSION['user_id']);
      $stmt->execute();
      $user = $stmt->get_result()->fetch_assoc();
      $stmt->close();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../HomePimg/Logo.ico" type="image/x-icon">
     <link href="https://fonts.googleapis.com/css?family=Great+Vibes:400,700&display=swap" rel="stylesheet">
    <title>Gender Studies</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <link rel="stylesheet" href="../Courses/Gender.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">
            <img src="../HomePimg/Logo.ico" alt="Pann Pyoe Thu logo" class="logo-img" />
            <span class="logo-text">Pann Pyoe Thu</span>
        </div>
        <nav class="nav">
            <a href="../PHP/index.php" class="<?= ($active==='home')    ? 'active' : '' ?>">Home</a>
        <a href="../PHP/About Us.php" class="<?= ($active==='about')    ? 'active' : '' ?>">About us</a>
        <a href="../PHP/Courses.php" class="<?= ($active==='courses')    ? 'active' : '' ?>">Courses</a>
        <a href="../PHP/Counsellor.php" class="<?= ($active==='counsellors')    ? 'active' : '' ?>">Educational Counsellors</a>
        <a href="../PHP/Scholarship.php" class="<?= ($active==='scholarships')    ? 'active' : '' ?>">Scholarships</a>
        <a href="../PHP/Local Uni.php" class="<?= ($active==='localuni')    ? 'active' : '' ?>">Local Universities</a>
        <a href="../PHP/Jobs.php" class="<?= ($active==='jobs')    ? 'active' : '' ?>">Job Opportunities</a>
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
                <li><a class="dropdown-item" href="../PHP/Profile.php">My Profile</a></li>
                <li><a class="dropdown-item" href="../PHP/logout.php">Logout</a></li>
            </ul>
        </div>
        <?php else: ?>
        <div class="profile-icon" onclick="openLogin()">
            <img src="../HomePimg/Profile.png" alt="Profile" class="profile-img" />
        </div>
        <?php endif; ?>
             
    </header>   

    <!-- Main Content -->
    <div class="course-container">
        <!-- Course Header -->
        <div class="course-header">
            <h1>Gender Studies</h1>
            <div class="course-info">
                <div>Type - Online Course</div>
                <div>Language - English</div>
                <div>Duration - 4 Modules</div>
            </div>
        </div>

        <!-- Sidebar - Module Navigation -->
        <div class="module-nav">
            <h3>Modules</h3>
            <ul>
                <li class="active" data-module="module1">Module 1</li>
                <li data-module="module2">Module 2</li>
                <li data-module="module3">Module 3</li>
                <li data-module="module4">Module 4</li>
                <li data-module="quiz" class="quiz-nav" style="display: none;">Quiz</li>
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="main-content">
            <!-- Module 1 -->
            <section id="module1" class="module active">
                <h2>MODULE 1</h2>
                <h3>Gender attitudinal changes are highly complex, fluid and multi-dimensional.</h3>
                
                <!-- Image 1 at start of Module 1 -->
                <img src="Courses_images/Gender Studies Images/Gender 0.png" alt="Gender 0" class="module-image">


                <p>Describe our culture, what is lgbtgia+, and why does it discriminate against them?</p>

                <br>

                <p>Heteronormativity, sexual orientation , and regard as not normal.</p>
                
                <br>

                <p>#Traditional beliefs around male power ( patriarchy - male dominance) decision making #Gender stereotype (hair, makeup and nail are considered to be feminie in society and male to be masculine and don't show emotion) and gender norms in which men are judged by their talent but women by virtues, the limitations of structural and cultural perspectives.  
                </p>

                <br>

                <p>Gender attitudinal changes are highly complex, fluid and multi-dimensional (Knight and Brinton, 2017; Scarborough et al., 2019)</p>

                <br>

                <p>Prior research on adolescents identifies the important role of parents’ gender attitudes and gendered behavior in the formation of children’s gender role attitudes (Cano and Hofmeister, 2022; Kim and Fong, 2014). Thus, questions remain about parents’ influence in adulthood.</p>

                <p>Both structural and cultural perspectives help to uncover the opportunities and the constraints women face in patriarchal structures in different contexts, which affect gender role attitudes.</p>

                <p>To further convert Haslanger’s philosophical terms to sociological language, I shall use Swidler’s (1986) distinction between ‘settled and unsettled times’. In settled patriarchy, at least in theory, gender roles assign men to dominant social roles and women to subordinate roles in both public and private spheres across economic, social, political, religious and family and kinship domains.</p>
            </section>

            <!-- Module 2 -->
            <section id="module2" class="module">
                <h2>MODULE 2</h2>
                <h3>Heteronormativity</h3>

                <br>

                <p>Most feminists saw that oppression of women came from the underlying bias of a patriarchal society.</p>

                <img src="Courses_images/Gender Studies Images/Gender 1.jpg" alt="Gender 1" class="module-image">

                <p>Gerda Lerner's 1986 history classic, The Creation of Patriarchy, traces the development of the patriarchy to the second millennium B.C.E. in the middle east, putting gender relations at the center of the story of civilization's history. She argues that before this development, male dominance was not a feature of human society in general. Women were key to the maintenance of human society and community, but with a few exceptions, social and legal power was wielded by men. If patriarchy was created by culture, it can be overturned by a new culture. </p>

                <p>Heteronormativity is the concept that heterosexuality is the preferred or normal sexual orientation. It assumes the gender binary (i.e., that there are only two distinct, opposite genders) and that sexual and marital relations are most fitting between people of opposite sex.</p>

                <br>

                <p>Heteronormativity creates and upholds a social hierarchy based on sexual orientation with the practice and belief that heterosexuality is deemed as the societal norm. A heteronormative view, therefore, involves alignment of biological sex, sexuality, gender identity and gender roles. Heteronormativity has been linked to heterosexism and homophobia, and the effects of societal heteronormativity on lesbian, gay and bisexual individuals have been described as heterosexual or "straight" privilege.</p>

                <p>In Patriarchy, gender roles and stereotypes may be different in each social class, age, and culture but through the mechanisms, structures, and institutions, it makes these roles and stereotypes seem natural and universal. In any given Patriarchy, not all men will enjoy the same privileges or have the same power. </p>


                <a href="https://en.wikipedia.org/wiki/Same-sex_marriage_in_the_United_Kingdom">Learn More</a>
            </section>

            <!-- Module 3 -->
            <section id="module3" class="module">
                <h2>MODULE 3</h2>
                <h3>The Criminalization of Same-Sex Behaviors:</h3>

                <br>
                
                <p>   The criminalization of same-sex behaviors has a long and dark history, particularly in Europe where sodomy laws influenced by religious beliefs were prevalent. These laws often prescribed severe punishments, including death, for individuals engaged in same-sex relationships. For example, in England, the Buggery Act of 1533 criminalized anal intercourse, punishable by death. Similarly, in the United States, sodomy laws were widespread, with many states criminalizing consensual same-sex sexual activity until as recently as the 2000s.</p>

                <br>

                <img src="Courses_images/Gender Studies Images/Gender 2.jpg" alt="Gender 2" class="module-image">

                <p>   One notable case study is that of Alan Turing, a pioneering mathematician and cryptanalyst who played a crucial role in breaking the German Enigma code during World War II. Despite his contributions to the war effort, Turing was prosecuted for homosexual acts in 1952 under the UK's gross indecency laws. He was subjected to chemical castration as an alternative to imprisonment and tragically died by suicide in 1954. Turing's persecution highlights the devastating impact of anti-LGBTQIA+ laws and the stigma surrounding same-sex behaviors.</p>

                <br>

                <p>   Despite the abolition of many sodomy laws in the latter half of the 20th century, same-sex relationships are still punishable by imprisonment or death in some countries today. For example, in several countries in Africa and the Middle East, homosexuality is criminalized, leading to a culture of fear and secrecy within LGBTQIA+ communities. The existence of such laws perpetuates stigma, discrimination, and violence against LGBTQIA+ individuals, impeding progress towards equality and human rights.</p>

                <br>

                <h3>Framing LGBTQIA+ Identities as Disorders:</h3>

                <br>

                <p>   The medicalization of gender diversity has historically pathologized non-binary and transgender identities, framing them as disorders to be treated rather than valid expressions of human diversity. This medicalization has had devastating consequences for LGBTQIA+ individuals, leading to harmful practices such as conversion therapy, which seeks to change an individual's sexual orientation or gender identity against their will.</p>

                <br>

                <img src="Courses_images/Gender Studies Images/Gender 3.jpg" alt="Gender 3" class="module-image">

                <p>   One prominent case study is that of Alan Turing, whose homosexuality was deemed a "disorder" by medical professionals of his time. Turing was subjected to chemical castration as a form of "treatment," which had severe psychological consequences and ultimately led to his death. His case underscores the harm inflicted by medicalization and conversion therapy on LGBTQIA+ individuals, highlighting the urgent need for ethical and affirming approaches to healthcare.</p>

                <br>

                <p>   Despite advancements in understanding gender diversity and the DE pathologization of transgender identities in many parts of the world, conversion therapy and other harmful practices continue to be employed in some regions. Efforts to combat medicalization and promote affirmative care for LGBTQIA+ individuals are ongoing, with advocacy organizations and medical professionals calling for bans on conversion therapy and improved access to gender-affirming healthcare.</p>

            </section>

            <!-- Module 4 -->
            <section id="module4" class="module">
                <h2>MODULE 4</h2>
                <h3> Providing Support Networks and Resources to LGBTQIA+ Communities:</h3>
                
                <!-- Image 4 at start of Module 4 -->
                <img src="path/to/module4-image.jpg" alt="Active Listening in PFA" class="module-image">
                
                <p>   Cultural activism has played a crucial role in challenging stereotypes and promoting LGBTQIA+ visibility and representation. Artists, activists, and community organizations have used art, media, and cultural events to foster greater acceptance and understanding of LGBTQIA+ identities.</p>
                
                <br>

                <p>   One notable example is the impact of LGBTQIA+ musicians and performers such as Freddie Mercury and David Bowie on mainstream culture. Through their music and public personas, Mercury and Bowie challenged gender norms and stereotypes, opening up conversations about sexuality and identity in mainstream media. Their visibility and success helped to humanize LGBTQIA+ experiences and pave the way for greater acceptance and representation in popular culture.</p>

                <br>

                <p>   In addition to cultural activism, support networks and resources play a crucial role in providing community and assistance to LGBTQIA+ individuals. Organizations such as The Trevor Project, GLAAD, and local LGBTQIA+ community centers offer a range of services, including counseling, support groups, and educational resources. These resources provide vital support to LGBTQIA+ individuals facing discrimination, stigma, and other challenges, helping to build resilience and foster a sense of belonging within the community.</p>

                <a href="https://youtu.be/UD9IOllUR4k?si=vsbqDqNNiNIgyj7S" target="_blank">
                        <i class="fab fa-youtube"></i> Video
                </a>

                <p>Excellent — I’ll create a 10-item multiple choice quiz based on these Gender Studies modules with an answer key as well:</p>
                
            <div class="gender-last">

                <img src="Courses_images/Gender Studies Images/Gender 4.jpg" alt="Gender 4">              
            
                <img src="Courses_images/Gender Studies Images/Gender 5.jpg" alt="Gender 5">

            </div>

            </section>

            <!-- Quiz Section -->
            <section id="quiz" class="module">
                <div class="quiz-section">
                    <h2>Gender Studies Quiz</h2>
                    <p style="text-align: center; margin-bottom: 2rem;">Test your knowledge of Modules 1-4</p>
                    
                    <div class="quiz-question">
                        <h3>1. What is heteronormativity?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q1a" name="question1">
                                <label for="q1a">(A) A belief that all gender identities are equally valid</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q1b" name="question1">
                                <label for="q1b">(B) The concept that heterosexuality is the preferred or normal sexual orientation</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q1c" name="question1">
                                <label for="q1c">(C) A medical condition related to gender identity</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q1d" name="question1">
                                <label for="q1d">(D) A social movement promoting equality</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>2. According to patriarchal norms, how are men and women typically judged in society?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q2a" name="question2">
                                <label for="q2a">(A) Men by appearance, women by achievements</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q2b" name="question2">
                                <label for="q2b">(B) Both equally by their emotional expression</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q2c" name="question2">
                                <label for="q2c">(C) Men by their talents, women by their virtues</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q2d" name="question2">
                                <label for="q2d">(D) Men by their relationships, women by their wealth</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>3. What does Gerda Lerner’s work The Creation of Patriarchy argue about patriarchy’s origins?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q3a" name="question3">
                                <label for="q3a">(A) It was always a natural part of human society</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q3b" name="question3">
                                <label for="q3b">(B) It emerged in the second millennium B.C.E. in the Middle East and can be overturned by culture</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q3c" name="question3">
                                <label for="q3c">(C) It was created by women</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q3d" name="question3">
                                <label for="q3d">(D) It originated with modern capitalism</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>4. What effect has heteronormativity had on LGBTQIA+ individuals?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q4a" name="question4">
                                <label for="q4a">(A) It promoted equality and acceptance</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q4b" name="question4">
                                <label for="q4b">(B) It created a hierarchy favoring heterosexuality, leading to privilege, heterosexism, and homophobia</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q4c" name="question4">
                                <label for="q4c">(C) It had no impact on their social experience</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q4d" name="question4">
                                <label for="q4d">(D) It ended discrimination</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>5. Which historical figure’s life illustrates the harm of criminalizing same-sex behavior in the UK?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q5a" name="question5">
                                <label for="q5a">(A) David Bowie</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q5b" name="question5">
                                <label for="q5b">(B) Alan Turing</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q5c" name="question5">
                                <label for="q5c">(C) Freddie Mercury</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q5d" name="question5">
                                <label for="q5d">(D) Gerda Lerner</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>6. What harmful practice has historically been used to try to "treat" LGBTQIA+ individuals?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q6a" name="question6">
                                <label for="q6a">(A) Gender-affirming care</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q6b" name="question6">
                                <label for="q6b">(B) Conversion therapy</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q6c" name="question6">
                                <label for="q6c">(C) Affirmative counseling</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q6d" name="question6">
                                <label for="q6d">(D) Social activism</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>7. According to Module 1, gender attitudes are shaped by which of the following factors during adolescence?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q7a" name="question7">
                                <label for="q7a">(A) The weather</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q7b" name="question7">
                                <label for="q7b">(B) The media alone</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q7c" name="question7">
                                <label for="q7c">(C) Parents' gender attitudes and behaviors</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q7d" name="question7">
                                <label for="q7d">(D) Social media influencers</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>8. In a patriarchal system, what makes gender stereotypes seem natural and universal?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q8a" name="question8">
                                <label for="q8a">(A) Different beliefs in each social class</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q8b" name="question8">
                                <label for="q8b">(B) Structures and institutions reinforcing them</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q8c" name="question8">
                                <label for="q8c">(C) The absence of media representation</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q8d" name="question8">
                                <label for="q8d">(D) Equality laws</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>9. Which of the following is an example of cultural activism promoting LGBTQIA+ visibility?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q9a" name="question9">
                                <label for="q9a">(A) Legal restrictions on same-sex marriage</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q9b" name="question9">
                                <label for="q9b">(B) Music and performances by artists like Freddie Mercury and David Bowie</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q9c" name="question9">
                                <label for="q9c">(C) Gender-based legal discrimination</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q9d" name="question9">
                                <label for="q9d">(D) Banning LGBTQIA+ literature</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>10. What kind of services do support organizations like The Trevor Project and GLAAD provide?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q10a" name="question10">
                                <label for="q10a">(A) Investment advice</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q10b" name="question10">
                                <label for="q10b">(B) Counseling, support groups, and educational resources for LGBTQIA+ individuals</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q10c" name="question10">
                                <label for="q10c">(C) Tax filing services</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q10d" name="question10">
                                <label for="q10d">(D) Employment in government positions</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-buttons">
                        <button class="quiz-btn" onclick="submitQuiz()">Submit Quiz</button>
                    </div>
                </div>
                
                <!-- <div class="highlight" style="margin-top: 2rem;">
                    <h3>Answer Key:</h3>
                    <p>1️⃣ B | 2️⃣ C | 3️⃣ B | 4️⃣ B | 5️⃣ B | 6️⃣ B | 7️⃣ C | 8️⃣ B | 9️⃣ B | 🔟 B</p>
                </div> -->
            </section>
        </div>
    </div>

    <!-- Footer -->
   <div class="bottom">
        <div class="bottom-left">
            <h4>Quick Links</h4>
            <a href="../PHP/About Us.php">About Us</a>
            <a href="../PHP/Courses.php">Courses</a>
            <a href="../PHP/Counsellor.php">Counsellors</a>
            <a href="../PHP/Scholarship.php">Scholarships</a>
        </div>
        <div class="bottom-middle">
            <h4>Services</h4>
            <a href="../PHP/Local Uni.php">Local Universities</a>
            <a href="../PHP/Jobs.php">Jobs</a>
            <a href="../PHP/Counsellor.php">Counsellors</a>
            <a href="../PHP/Scholarship.php">Scholarships</a>
        </div>
        <div class="bottom-right">
            <h4>Connect With Us</h4>
            <a href="#"><i class="fab fa-facebook"></i> Facebook</a>
            <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
            <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
            <p>© 2025 Pann Pyoe Thu. All rights reserved.</p>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

<script>
        // Module navigation functionality
        document.addEventListener('DOMContentLoaded', function() {
            const moduleNavItems = document.querySelectorAll('.module-nav li');
            const modules = document.querySelectorAll('.module');
            const quizNav = document.querySelector('.quiz-nav');
            
            // Show first module by default
            modules.forEach((module, index) => {
                if (index === 0) {
                    module.style.display = 'block';
                } else {
                    module.style.display = 'none';
                }
            });
            
            // Module navigation click handlers
            moduleNavItems.forEach((item, index) => {
                item.addEventListener('click', function() {
                    const targetModule = this.getAttribute('data-module');
                    
                    // Remove active class from all items
                    moduleNavItems.forEach(navItem => navItem.classList.remove('active'));
                    
                    // Add active class to clicked item
                    this.classList.add('active');
                    
                    // Show corresponding module
                    modules.forEach(module => {
                        if (module.id === targetModule) {
                            module.style.display = 'block';
                        } else {
                            module.style.display = 'none';
                        }
                    });
                });
            });
            
            // Check if all modules are completed and show quiz
            function checkModuleCompletion() {
                // This would typically check against a database or localStorage
                // For now, we'll show quiz after Module 4 is viewed
                const module4 = document.getElementById('module4');
                if (module4 && module4.style.display === 'block') {
                    quizNav.style.display = 'block';
                }
            }
            
            // Check completion when navigating to Module 4
            moduleNavItems.forEach((item, index) => {
                if (item.getAttribute('data-module') === 'module4') {
                    item.addEventListener('click', function() {
                        setTimeout(checkModuleCompletion, 100);
                    });
                }
            });
        });

        // Quiz submission function
        function submitQuiz() {
            const correctAnswers = ['q1b', 'q2c', 'q3b', 'q4b', 'q5b', 'q6b', 'q7c', 'q8bS', 'q9b', 'q10b'];
            let score = 0;
            let totalQuestions = correctAnswers.length;
            
            correctAnswers.forEach((correctAnswer, index) => {
                const selectedAnswer = document.querySelector(`input[name="question${index + 1}"]:checked`);
                if (selectedAnswer && selectedAnswer.id === correctAnswer) {
                    score++;
                }
            });
            
            const percentage = Math.round((score / totalQuestions) * 100);
            
            // Show results
            const quizSection = document.querySelector('.quiz-section');
            quizSection.innerHTML = `
                <h2>Quiz Results</h2>
                <div style="text-align: center; padding: 30px;">
                    <h3 style="color: #BF9E8D; font-size: 2rem; margin-bottom: 20px;">
                        You got ${score} out of ${totalQuestions} correct! (${percentage}%)
                    </h3>
                    <p style="font-size: 1.2rem; margin-bottom: 20px;">
                        ${percentage >= 80 ? '🎉 Excellent! You have a strong understanding of PFA principles!' : 
                          percentage >= 60 ? '👍 Good job! You have a solid grasp of PFA concepts.' : 
                          '📚 Keep studying! Review the modules and try again.'}
                    </p>
                      ${percentage >= 60 
                      ? `<button class="quiz-btn" id="generateBtn">Generate Certificate</button>`
                     : '<button class="quiz-btn" onclick="location.reload()">Take Quiz Again</button>'
                    }
                </div>
            `;
            if (percentage >= 60) {
                const courseName = "Gender Studies Course"; 
                const userName = "<?= $_SESSION['user_name']?>";

               document.getElementById('generateBtn').addEventListener('click', function() {
                  
                  window.location.href = `../Courses/Certificate/generate_certificate.php?course_name=${encodeURIComponent(courseName)}&user_name=${encodeURIComponent(userName)}`;
              });
            }
        }

        // Login modal functionality (placeholder)
        function openLogin() {
            // Add login modal functionality here
            console.log('Login modal opened');
        }
    </script>
</body>
</html>