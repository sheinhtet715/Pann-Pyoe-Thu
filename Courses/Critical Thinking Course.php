<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Critical Thinking Course</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Course.css">
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
            <a href="../HTML/Homepage.html">Home Page</a>
            <a href="#">About us</a>
            <a href="#" class="active">Courses</a>
            <a href="../HTML/Counsellor Page.html">Education counselling</a>
            <a href="#">Scholarships</a>
            <a href="#">Local Universities</a>
            <a href="#">Job Applications</a>
        </nav>
        <div class="profile-icon" onclick="openLogin()">
            <img src="../HomePimg/Profile.png" alt="Profile" class="profile-img" />
        </div>
    </header>

    <!-- Main Content -->
    <div class="course-container">
        <!-- Course Header -->
        <div class="course-header">
            <h1>Critical Thinking</h1>
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
                <h3>Why is critical thinking important?</h3>
                
                <!-- Image 1 at start of Module 1 -->
                <img src="path/to/module1-image.jpg" alt="Psychological First Aid Overview" class="module-image">
                
                <p>Critical thinkers don't simply accept what they're told; they question why. They delve deeper, question assumptions, and refuse to be satisfied with simple solutions. If something doesn't add up, they don't dismiss it. They investigate. This does not imply that you are intentionally tough or contrarian. It indicates that you care about the truth. You want to know how things actually function, not simply how they are portrayed. Others may accept faulty beliefs simply because they are the norm, but you can't help but question them. What about the power to question everything? That is what sets you apart.</p>
                
               <h3>You seek proof, not merely speculations.</h3>

               <p>Most people trust information based on how convincingly it is delivered or how many people believe it. But confidence does not imply truth, and popularity does not ensure correctness. In fact, research have shown that people are more likely to believe misinformation if it has been repeated many times.</p>

            </section>

            <!-- Module 2 -->
            <section id="module2" class="module">
                <h2>MODULE 2</h2>
                <h3>Aspects of thinking critically</h3>
                <p>You probably think for yourself and don't take anything at face value if you've read this far.</p>
                <br>
                <p>And that is a rare but necessary ability. It is more crucial than ever to be able to question, evaluate, and seek the truth in a world full of false information, prejudice, and superficial thinking. According to the philosopher Bertrand Russell, "the whole problem with the world is that wiser people are so full of doubts, and fools and fanatics are always so certain of themselves." This is understood by true critical thinkers, who recognize that truth, not certainty, is the aim. Ultimately, critical thinking isn't about being skeptical for the purpose of being skeptical. It all comes down to never accepting simple solutions when a more thorough understanding is achievable.</p>

                <a href="https://geediting.com/dan-signs-youre-a-critical-thinker-who-sees-the-flaws-in-things-others-blindly-accept/">Learn More</a>
            </section>
            <!-- Module 3 -->
            <section id="module3" class="module">
                <h2>MODULE 3</h2>
                <h3>8 critical thinking abilities that are vital to cultivate</h3>
                
                <h3>1. Thinking Analytically</h3>
                
                <p>To arrive at the best conclusions, analytical thinking entails analyzing evidence from various sources. Rejecting cognitive biases and attempting to collect and evaluate complex information while resolving challenging issues are made possible by analytical thinking. Critical thinkers with analytical skills are able to:</p>

                <ol>
                    <li>Determine the data's trends and patterns.</li>
                    <li>Divide difficult problems into smaller, more manageable parts.</li>
                    <li>Understand the links between causes and effects</li>
                    <li>Assess the quality of the arguments and supporting data.</li>
                </ol>

                <p>For instance, a data analyst deconstructs intricate sales data to find patterns and trends that guide the business's marketing approach.</p>                
                
                <h3>2. Having an Open Mind</h3>

                <p>The ability to examine new concepts, viewpoints, and data objectively is known as open-mindedness. This ability to think critically enables you to evaluate and digest data in order to reach an objective conclusion. Letting rid of personal prejudices, accepting facts at face value, and drawing conclusions from a variety of viewpoints are all components of critical thinking.
                Critical thinkers with an open mind exhibit:</p>

                <ol>
                    <li>Willingness to take into account different perspectives</li>
                    <li>The capacity to hold off on making a decision until enough information has been obtained</li>
                    <li>Being open to helpful critiques and comments</li>
                    <li>Adaptability in revising opinions in light of fresh data</li>
                </ol>

                <p>Example: A team leader actively examines unconventional suggestions from junior members at a product development meeting, which results in an inventive solution.</p>

                <h3>3. Solving Problems</h3>

                <p>A key component of critical thinking is the ability to solve problems effectively. It calls for the capacity to see problems, come up with potential fixes, weigh options, and carry out the best plan of action. Particularly useful in domains like project management and entrepreneurship is this critical thinking ability.Important components of problem-solving consist of:</p>

                <ol>
                    <li>Clearly stating the issue</li>
                    <li>Compiling pertinent data</li>
                    <li>Generating ideas for possible fixes</li>
                    <li>Weighing the benefits and drawbacks of each choice</li>
                    <li>Applying and keeping an eye on the selected solution</li>
                    <li>Considering the result and making any required adjustments</li>
                </ol>
                
                <p>As an illustration, a high school principal employs problem-solving techniques to address dwindling student involvement through student surveys, expert consultations in higher education, and the introduction of a new curriculum that strikes a balance between academic difficulty and useful, real-world applications.</p>

                <h3>4. Resonal Assement</h3>

                <p>A crucial element of higher order thinking is reasoned judgment, which is making deliberate decisions after carefully weighing the pros and cons of various options and logically analyzing the available data. This ability to think critically is crucial in both professional and academic contexts. Important components of reasoned judgment consist of:</p>

                <ol>
                    <li>Collecting and evaluating data objectively</li>
                    <li>Assessing the reliability and applicability of the evidence</li>
                    <li>Taking into account various viewpoints before making judgments</li>
                    <li>Using sound reasoning and logical inference to make decisions</li>
                </ol>

                <p>As an illustration, a high school science instructor designs an experiment using reasoned judgment, closely monitoring and evaluating the findings before formulating conclusions regarding the hypothesis.</p>

            </section>

            <!-- Module 4 -->
            <section id="module4" class="module">
                <h2>MODULE 4</h2>
                <h3>5. Introspective Thought</h3>
                
                <p>Analyzing one's own ideas, deeds, and results in order to better comprehend them and perform better in the future is known as reflective thinking. In order to develop a cohesive understanding of an issue, good critical thinking necessitates the analysis and synthesis of information. It is a crucial critical thinking ability for lifelong learning and development.</p>

                <br>

                <p>Among the essential components of reflective thinking are:</p>

                <ol>
                    <li>Analyzing one's own presumptions and cognitive biases critically</li>
                    <li>Taking into account a range of opinions and perspectives</li>
                    <li>Combining data from multiple sources and experiences</li>
                    <li>Using insights to enhance choices and actions in the future</li>
                    <li>Constantly assessing and modifying one's thought processes</li>
                </ol>

                <p>As an illustration, a community organizer evaluates the results of a recent public gathering, taking into account what went well and what could be enhanced for similar events in the future.</p>

                <h3>6. Interaction</h3>

                <p>Critical thinkers who possess strong communication skills are better able to express their thoughts in a clear and convincing manner. efficient teamwork, leadership, and information sharing in the workplace all depend on efficient communication. Important facets of critical thinking communication include:</p>

                <ol>
                    <li>Clearly communicating difficult concepts</li>
                    <li>Active hearing and understanding</li>
                    <li>Modifying communication methods for various audiences</li>
                    <li>Developing and presenting strong arguments</li>
                </ol>

                <p>Example: A manager skillfully addresses her team's concerns and makes sure everyone is aware of the ramifications of a new corporate policy.</p>

                <h3>7. Investigation</h3>

                <p>Strong research abilities enable critical thinkers to collect, assess, and integrate data from a variety of sources. This is especially crucial in professional and academic contexts where lifelong learning is necessary. To conduct research effectively, one must:</p>

                <ol>
                    <li>Finding trustworthy and pertinent information sources</li>
                    <li>Assessing the reliability and partiality of sources</li>
                    <li>Integrating data from several sources</li>
                    <li>Identifying knowledge gaps in the field</li>
                </ol>

                <p>Example: Before writing a piece on a contentious subject, a journalist confirms facts from several reliable sources.</p>

                <h3>8. Making Choices</h3>

                <p>The ability to make logical inferences and generalizations through a variety of critical thinking abilities culminates in effective decision making. It entails assessing possibilities, thinking through the repercussions, and selecting the best course of action. Crucial elements of decision-making consist of:</p>

                <ol>
                    <li>Establishing precise grading criteria</li>
                    <li>Collecting and evaluating pertinent data</li>
                    <li>Taking into account both immediate and long-term effects</li>
                    <li>Controlling risk and uncertainty</li>
                    <li>Keeping intuition and reasoning in check</li>
                </ol>

                <p>Example: Before choosing to install solar panels on their property, a homeowner considers the costs, advantages, and long-term effects.</p>
                
                <a href="https://asana.com/resources/critical-thinking-skills">Learn More</a>
                
                <div class="video-container">
                    <a href="https://youtu.be/vNDYUlxNIAA?si=o7OAyiNTDJzTQ-AP" target="_blank">
                        <i class="fab fa-youtube"></i> Video
                    </a>
                </div>

            </section>

            <!-- Quiz Section -->
            <section id="quiz" class="module">
                <div class="quiz-section">
                    <h2>Critical Thinking Quiz</h2>
                    <p style="text-align: center; margin-bottom: 2rem;">Test your knowledge of Modules 1-4</p>
                    
                    <div class="quiz-question">
                        <h3>1. Why is critical thinking important according to the text?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q1a" name="question1">
                                <label for="q1a">(A) It helps people agree with the majority.</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q1b" name="question1">
                                <label for="q1b">(B) ) It encourages people to question assumptions and seek truth.</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q1c" name="question1">
                                <label for="q1c">(C) It makes people intentionally difficult.</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q1d" name="question1">
                                <label for="q1d">(D) It avoids investigating conflicting information.</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>2. What is a sign of a critical thinker based on Module 1?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q2a" name="question2">
                                <label for="q2a">(A) Accepting information if it's popular</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q2b" name="question2">
                                <label for="q2b">(B) Trusting confidently delivered claims without proof</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q2c" name="question2">
                                <label for="q2c">(C) Investigating when something doesn’t add up</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q2d" name="question2">
                                <label for="q2d">(D) Avoiding conflict to maintain peace</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>3. According to Bertrand Russell, what problem does the world face?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q3a" name="question3">
                                <label for="q3a">(A) Critical thinkers being too skeptical</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q3b" name="question3">
                                <label for="q3b">(B) Wise people doubting themselves while fools are overly certain</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q3c" name="question3">
                                <label for="q3c">(C) Too many people seeking evidence</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q3d" name="question3">
                                <label for="q3d">(D) Everyone believing the same thing</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>4. Which of the following best describes analytical thinking?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q4a" name="question4">
                                <label for="q4a">(A) Accepting personal biases as facts</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q4b" name="question4">
                                <label for="q4b">(B) Making quick decisions without evidence</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q4c" name="question4">
                                <label for="q4c">(C) Breaking down complex information to find patterns and relationships</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q4d" name="question4">
                                <label for="q4d">(D) Refusing to consider multiple sources of evidence</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>5. What does it mean to have an open mind as a critical thinker?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q5a" name="question5">
                                <label for="q5a">(A) Ignoring different perspectives</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q5b" name="question5">
                                <label for="q5b">(B) Relying solely on personal opinions</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q5c" name="question5">
                                <label for="q5c">(C) Objectively considering new ideas and facts before deciding</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q5d" name="question5">
                                <label for="q5d">(D) Quickly making conclusions without enough information</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>6. Which is the correct order of steps in problem-solving?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q6a" name="question6">
                                <label for="q6a">(A) Make a decision → Apply it → Identify the issue</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q6b" name="question6">
                                <label for="q6b">(B) Identify the issue → Gather information → Generate solutions → Evaluate options → Implement and monitor</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q6c" name="question6">
                                <label for="q6c">(C) Skip to the solution → Gather information → Evaluate results</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q6d" name="question6">
                                <label for="q6d">(D) Ignore the issue → Wait for it to resolve itself</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>7. Reasoned judgment involves:</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q7a" name="question7">
                                <label for="q7a">(A) Guessing based on instinct</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q7b" name="question7">
                                <label for="q7b">(B) Making decisions after logically analyzing data and viewpoints</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q7c" name="question7">
                                <label for="q7c">(C) Trusting popular opinions</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q7d" name="question7">
                                <label for="q7d">(D) Ignoring conflicting information</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>8. What is reflective thinking?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q8a" name="question8">
                                <label for="q8a">(A) Quickly reacting without analyzing outcomes</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q8b" name="question8">
                                <label for="q8b">(B) Analyzing one's own thoughts and actions to improve future decisions</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q8c" name="question8">
                                <label for="q8c">(C) Ignoring personal assumptions</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q8d" name="question8">
                                <label for="q8d">(D) Avoiding feedback and critique</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>9. Why are strong communication skills important for critical thinkers?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q9a" name="question9">
                                <label for="q9a">(A) So they can aggressively defend their opinions</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q9b" name="question9">
                                <label for="q9b">(B) To clearly express ideas, listen actively, and adjust their message for different audiences</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q9c" name="question9">
                                <label for="q9c">(C) To impress others with complex words</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q9d" name="question9">
                                <label for="q9d">(D) To avoid disagreements in conversations</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>10. What is the purpose of strong research skills in critical thinking?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q10a" name="question10">
                                <label for="q10a">(A) Trusting the first source you find</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q10b" name="question10">
                                <label for="q10b">(B) Only reading from social media</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q10c" name="question10">
                                <label for="q10c">(C) Gathering, evaluating, and integrating reliable information from multiple sources</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q10d" name="question10">
                                <label for="q10d">(D) Avoiding knowledge gaps in every subject</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-buttons">
                        <button class="quiz-btn" onclick="submitQuiz()">Submit Quiz</button>
                    </div>
                </div>
                
                <div class="highlight" style="margin-top: 2rem;">
                    <h3>Answer Key:</h3>
                    <p>1️⃣ B | 2️⃣ C | 3️⃣ B | 4️⃣ C | 5️⃣ C | 6️⃣ B | 7️⃣ B | 8️⃣ B | 9️⃣ B | 🔟 C</p>
                </div>
            </section>
        </div>
    </div>

    <!-- Footer -->
    <div class="bottom">
        <div class="bottom-left">
            <h4>Quick Links</h4>
            <a href="#">About Us</a>
            <a href="#">Courses</a>
            <a href="#">Education Counselling</a>
            <a href="#">Scholarships</a>
        </div>
        <div class="bottom-middle">
            <h4>Services</h4>
            <a href="#">Local Universities</a>
            <a href="#">Job Applications</a>
            <a href="#">Career Guidance</a>
            <a href="#">Student Support</a>
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
            const correctAnswers = ['q1b', 'q2c', 'q3c', 'q4b', 'q5b', 'q6b', 'q7c', 'q8a', 'q9a', 'q10a'];
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
                    <button class="quiz-btn" onclick="location.reload()">Take Quiz Again</button>
                </div>
            `;
        }

        // Login modal functionality (placeholder)
        function openLogin() {
            // Add login modal functionality here
            console.log('Login modal opened');
        }
    </script>
</body>
</html>