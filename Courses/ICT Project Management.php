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
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes:400,700&display=swap" rel="stylesheet">
    <link rel="icon" href="../HomePimg/Logo.ico" type="image/x-icon">
    <title>ICT Project Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../Courses/ICT.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">
            <img src="../HomePimg/Logo.ico" alt="Pann Pyoe Thu logo" class="logo-img" />
            <span class="logo-text">Pann Pyoe Thu</span>
        </div>
          <nav class="nav"  id="nav-menu">
            <a href="../PHP/index.php" class="<?= ($active==='home')    ? 'active' : '' ?>">Home</a>
            <a href="../PHP/About Us.php" class="<?= ($active==='about')    ? 'active' : '' ?>">About us</a>
            <a href="../PHP/Courses.php" class="<?= ($active==='courses')    ? 'active' : '' ?>">Courses</a>
            <a href="../PHP/Counsellor.php" class="<?= ($active==='counsellors')    ? 'active' : '' ?>">Educational Counsellors</a>
            <a href="../PHP/Scholarship.php" class="<?= ($active==='scholarships')    ? 'active' : '' ?>">Scholarships</a>
            <a href="../PHP/Local Uni.php" class="<?= ($active==='localuni')    ? 'active' : '' ?>">Local Universities</a>
            <a href="../PHP/Jobs.php" class="<?= ($active==='jobs')    ? 'active' : '' ?>">Job Opportunities</a>
        </nav>
        <div class="profile-icon" onclick="openLogin()">
            <img src="../HomePimg/Profile.png" alt="Profile" class="profile-img" />
        </div>
    </header>

    <div class="course-container">
        <!-- Course Header -->
        <div class="course-header">
            <h1>ICT Project Management Course</h1>
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
                <li data-module="module3">Module 3
                    <ul>
                        <li>1. Managing Teams</li>
                        <li>2. Plans for Communication</li>
                        <li>3. ICT Progress Report</li>
                        <li>4. Reasoned Assessment</li>
                    </ul>
                </li>
                <li data-module="module4">Module 4
                    <ul>
                        <li>Agile</li>
                        <li>The Scrum Framework and Agile</li>
                    </ul>
                </li>
                <li data-module="quiz" class="quiz-nav" style="display: none;">Quiz</li>
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="main-content">
            <!-- Module 1 -->
            <section id="module1" class="module active">
                <h2>MODULE 1</h2>
                <h3>Introduction to ICT Project Management</h3>
                
                <!-- Image 1 at start of Module 1 -->
                <img src="Courses_images/ICT Project Management Images/ICT 0.png" alt="ICT 0" class="module-image">
                
                <p>A project: what is it?</p>

                <p>A short-term project started with the goal of producing a special good, service, or outcome.
                Projects differ from operations in that they come to an end when their goals are met or the project is closed.</p>
                
               <h3>Project Life Cycle</h3>

               <p>A project life cycle is a set of project phases. Some businesses utilize standardized life cycles for all projects, while others adhere to industry conventions dependent on project type. Project life cycles outline tasks, deliverables, team members, and management approval processes at each step.</p>

            </section>

            <!-- Module 2 -->
            <section id="module2" class="module">
                <h2>MODULE 2</h2>
                <h3>Project Planning</h3>
                
                <img src="Courses_images/ICT Project Management Images/ICT 1.jpg" alt="ICT 1" class="module-image">

                <p>Project constraints—triple constraint</p>

                <p>Scope: What is the project aiming to achieve? What specific product or service does the customer or sponsor anticipate from the project?</p>
                <p>Time: How long should it take to finish the project? What is the schedule for the project?</p>
                <p>Cost: How much should the project cost?</p>

                <br>

                <p>E. ICT Project Management [Power point slides]. Eaindray.</p>

                
                <h3>Work Breakdown Structure (WBS)</h3>
                
                <img src="Courses_images/ICT Project Management Images/ICT 2.jpg" alt="ICT 2" class="module-image">

                <p>Breaking down work into smaller tasks is a typical productivity method that makes it more manageable and approachable. The Work Breakdown Structure (WBS) is a tool that uses this technique and is one of the most significant project management papers. It integrates scope, cost, and schedule baselines, guaranteeing that project plans are in sync.</p>

                <br>

                <p>The Project Management Institute's (PMI) Project Management Book of Knowledge (PMBOK) defines the Work Breakdown Structure as a "deliverable-oriented hierarchical decomposition of the work to be executed by the project team." There are two types of work breakdown structures (WBS): deliverable-based and phase-based. The Deliverable-Based approach is the most commonly used and favored method.</p>

                <a href="https://www.workbreakdownstructure.com/">Learn More</a>
            </section>

            <!-- Module 3 -->
            <section id="module3" class="module">
                <h2>MODULE 3</h2>
                <h3>Project Execution</h3>
                
                <br>

                <h3>Managing Teams</h3>
                
                <ul>
                    <li> Due to the nature of IT projects, the participants have a wide range of backgrounds and skill sets.</li>
                    <li> Graduates with degrees in unrelated fields are intentionally hired by many companies.</li>
                    <li> Such as the liberal arts, business, or mathematics to offer other viewpoints on IT initiatives.</li>
                    <li> The majority of IT project workers have common job titles, including business analyst, programmer, network specialist, database analyst, quality assurance expert, technical writer, security specialist, hardware engineer, software engineer, and system architect, despite their varied educational backgrounds.</li>
                </ul>
                
                <h3>Plans for Communication</h3>

                <img src="Courses_images/ICT Project Management Images/ICT 3.jpg" alt="ICT 3" class="module-image">

                <ul>
                    <li> Due to the fact that people speak different languages, work in different time zones, come from diverse cultural backgrounds, and observe different holidays,</li>
                    <li> It's critical to discuss how people will communicate effectively and promptly. A plan for managing communications is essential.</li>
                    <li> Trust: For every team, but particularly for international teams, trust is a critical issue.</li>
                    <li> Typical work procedures: Aligning work procedures and creating a style of operation that everyone accepts and feels at ease with are crucial.</li>
                    <li> Tools: IT is essential to globalization, particularly for improving work procedures and communications. A lot of individuals communicate using free resources like social networking, Google Docs, and Skype.</li>
                </ul>

                <h3>ICT Progress Report</h3>

                <p>An ICT progress report template would normally include sections for project summary, progress updates, obstacles, future goals, and key performance indicators (KPIs). It is a structured document that gives a clear and simple picture of the ICT project's status, promoting transparency and facilitating stakeholder contact.</p>

                <img src="Courses_images/ICT Project Management Images/ICT 4.jpg" alt="ICT 4" class="module-image">

                <ol>
                    <li> Here's a more extensive breakdown of common sections</li>
                    <li> Preoject Overview</li>
                    <li> Project Title: Clearly identifies the name of the ICT Project</li>
                    <li>Project Manager: Identifies the person in charge of the project</li>
                    <li> The reporting peroid specifies the timeframe covered by the report (e.g, weekly, monthly or quarterly).</li>
                </ol>

                <p>Executive Summary: A quick overview of the project's current status, important accomplishments, and any major challenges.</p>

                <h3>Reasoned Assessment</h3>

                <p>A crucial element of higher order thinking is reasoned judgment, which is making deliberate decisions after carefully weighing the pros and cons of various options and logically analyzing the available data. This ability to think critically is crucial in both professional and academic contexts. Important components of reasoned judgment consist of:</p>

                <ol>
                    <li> Collecting and evaluating data objectively</li>
                    <li> Assessing the reliability and applicability of the evidence</li>
                    <li> Taking into account various viewpoints before making judgments</li>
                    <li> Using sound reasoning and logical inference to make decisions</li>
                </ol>

                <p>As an illustration, a high school science instructor designs an experiment using reasoned judgment, closely monitoring and evaluating the findings before formulating conclusions regarding the hypothesis.</p>

            </section>

            <!-- Module 4 -->
            <section id="module4" class="module">
                <h2>MODULE 4</h2>
                <h3>Agile</h3>
                
                <!-- Image 4 at start of Module 4 -->
                <img src="Courses_images/ICT Project Management Images/ICT 5.jpg" alt="ICT 5" class="module-image"> 
                
                <p>Being agile means having the ability to move swiftly and effortlessly. Agile project management is an approach to project management that prioritizes iterative development—the process of dividing a project into smaller steps—customer satisfaction, adaptability, and teamwork. A project is divided into brief, incremental cycles known as sprints using the Agile methodology.</p>

                <h3>The Scrum framework and Agile</h3>

                <p>Agile and the Scrum framework can be thought of as techniques that divide a large project into multiple smaller ones, each with its own scope. Scrum is the best approach for people who need to achieve results rapidly because it is less flexible and more rigid. Scrum is utilized more for innovative and experimental techniques, whereas Agile is better suited for smaller teams and those that want a more simple design and execution.</p>

            </section>

            <!-- Quiz Section -->
            <section id="quiz" class="module">
                <div class="quiz-section">
                    <h2>ICT Project Management Quiz</h2>
                    <p style="text-align: center; margin-bottom: 2rem;">Test your knowledge of Modules 1-4</p>
                    
                    <div class="quiz-question">
                        <h3>1. What is a key difference between a project and an operation?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q1a" name="question1">
                                <label for="q1a">(A) Projects are ongoing and never end</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q1b" name="question1">
                                <label for="q1b">(B) Operations are temporary with a fixed goal</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q1c" name="question1">
                                <label for="q1c">(C) Projects are temporary and come to an end when goals are met</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q1d" name="question1">
                                <label for="q1d">(D) Operations require more team members</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>2. Which of the following best defines a project life cycle?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q2a" name="question2">
                                <label for="q2a">(A) A fixed schedule for business operations</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q2b" name="question2">
                                <label for="q2b">(B) A set of project phases from start to completion</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q2c" name="question2">
                                <label for="q2c">(C) A method for employee recruitment</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q2d" name="question2">
                                <label for="q2d">(D) A permanent work process</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>3. In project management, what are the three elements of the triple constraint?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q3a" name="question3">
                                <label for="q3a">(A) Quality, People, Time</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q3b" name="question3">
                                <label for="q3b">(B) Scope, Time, Cost</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q3c" name="question3">
                                <label for="q3c">(C) Resources, Tools, Approval</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q3d" name="question3">
                                <label for="q3d">(D) Vision, Mission, Output</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>4. What does a Work Breakdown Structure (WBS) primarily do?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q4a" name="question4">
                                <label for="q4a">(A) Assigns salaries to team members</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q4b" name="question4">
                                <label for="q4b">(B) Breaks down project work into smaller, manageable tasks</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q4c" name="question4">
                                <label for="q4c">(C) Calculates employee bonuses</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q4d" name="question4">
                                <label for="q4d">(D) Defines company mission statements</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>5. What type of Work Breakdown Structure is most commonly used?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q5a" name="question5">
                                <label for="q5a">(A) Phase-Based</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q5b" name="question5">
                                <label for="q5b">(B) Deliverable-Based</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q5c" name="question5">
                                <label for="q5c">(C) Milestone-Based</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q5d" name="question5">
                                <label for="q5d">(D) Budget-Based</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>6. In IT project teams, why do companies hire people from diverse academic backgrounds like liberal arts or business?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q6a" name="question6">
                                <label for="q6a">(A) To lower project costs</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q6b" name="question6">
                                <label for="q6b">(B) To bring different perspectives to IT initiatives</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q6c" name="question6">
                                <label for="q6c">(C) To replace technical staff</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q6d" name="question6">
                                <label for="q6d">(D) To reduce project timelines</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>7. Which of the following is NOT typically included in an ICT progress report?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q7a" name="question7">
                                <label for="q7a">(A) Project overview</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q7b" name="question7">
                                <label for="q7b">(B) Executive summary</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q7c" name="question7">
                                <label for="q7c">(C) Personal employee opinions</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q7d" name="question7">
                                <label for="q7d">(D) Progress updates</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>8. What does Agile project management emphasize?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q8a" name="question8">
                                <label for="q8a">(A) Long, fixed project schedules</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q8b" name="question8">
                                <label for="q8b">(B) Iterative development, customer satisfaction, and adaptability</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q8c" name="question8">
                                <label for="q8c">(C) Avoiding teamwork</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q8d" name="question8">
                                <label for="q8d">(D) Focusing only on final outcomes</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>9. In the Agile methodology, what is a “sprint”?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q9a" name="question9">
                                <label for="q9a">(A) A type of job title in IT projects</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q9b" name="question9">
                                <label for="q9b">(B) A long-term operational phase</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q9c" name="question9">
                                <label for="q9c">(C) A short, incremental project cycle</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q9d" name="question9">
                                <label for="q9d">(D) A communication software</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>10. What is the difference between Agile and Scrum?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q10a" name="question10">
                                <label for="q10a">(A) Scrum is more flexible and broader than Agile</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q10b" name="question10">
                                <label for="q10b">(B) Agile is a strict framework while Scrum allows more freedom</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q10c" name="question10">
                                <label for="q10c">(C) Scrum is a specific framework within Agile, often more rigid and result-driven</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q10d" name="question10">
                                <label for="q10d">(D) They are unrelated methodologies</label>
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
                    <p>1️⃣ C | 2️⃣ B | 3️⃣ B | 4️⃣ B | 5️⃣ B | 6️⃣ B | 7️⃣ C | 8️⃣ B | 9️⃣ C | 🔟 C</p>
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
            const correctAnswers = ['q1c', 'q2b', 'q3b', 'q4b', 'q5b', 'q6b', 'q7c', 'q8b', 'q9c', 'q10c'];
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
                const courseName = "ICT Project Management Course"; 
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