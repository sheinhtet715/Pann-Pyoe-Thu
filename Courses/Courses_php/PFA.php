<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Psychological First Aid Course</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
     <link rel="stylesheet" href="../Courses/Courses_css/PFA.css">
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
            <h1>Psychological First Aid (PFA)</h1>
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
                        <li>1. LOOK</li>
                        <li>2. LISTEN</li>
                        <li>3. LINK</li>
                    </ul>
                </li>
                <li data-module="module4">Module 4</li>
                <li data-module="quiz" class="quiz-nav" style="display: none;">Quiz</li>
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="main-content">
            <!-- Module 1 -->
            <section id="module1" class="module active">
                <h2>MODULE 1</h2>
                <h3>Psychological First Aid: What Is It?</h3>
                
                <!-- Image 1 at start of Module 1 -->
                <img src="../Courses page Images/Psychological first aid.jpg" alt="Psychological First Aid Overview" class="module-image">
                
                <p>Psychological First Aid (PFA) is a data-driven method based on the concept of human resilience. PFA seeks to alleviate stress symptoms and promote a healthy recovery following a traumatic incident, natural disaster, public health emergency, or personal crisis.</p>
                
                <div class="example">
                    <h4>Key Insight:</h4>
                    <p>Emotional suffering is not usually as evident as physical injury, yet it is equally terrible and debilitating.</p>
                </div>
            </section>

            <!-- Module 2 -->
            <section id="module2" class="module">
                <h2>MODULE 2</h2>
                <h3>Common Reactions to Traumatic Events</h3>
                
                <p>It is normal to feel upset after going through a life-changing incident. Every person who experiences a calamity is affected by it. Reactions vary depending on when they occur during and after the experience.</p>
                
                <h3>Some frequent stress reactions are:</h3>
                
                <ul>
                    <li>Confusion, fear, and feelings of helplessness</li>
                    <li>Sleep troubles</li>
                    <li>Physical pain and anxiety</li>
                    <li>Feelings of anger, grief, and shock</li>
                    <li>Aggressiveness</li>
                    <li>Withdrawal & Guilt</li>
                    <li>Shaken religious faith</li>
                    <li>Loss of confidence in self or others</li>
                </ul>
                
                <div class="example">
                    <h4>Important Note:</h4>
                    <p>These reactions are normal responses to abnormal events. Recognizing them is the first step in providing appropriate support.</p>
                </div>
                
                <p>Reference: <a href="https://www.health.state.mn.us/communities/ep/behavioral/pfa.html" target="_blank">Minnesota Department of Health - PFA</a></p>
            </section>

            <!-- Module 3 -->
            <section id="module3" class="module">
                <h2>MODULE 3</h2>
                <h3>How to Proceed and What to Do?</h3>
                
                <p>Comforting someone in distress and assisting them in feeling secure and at ease is the goal of PFA. In addition to helping people discover information, resources, and social support, it offers emotional support and assists in meeting urgent basic requirements.</p>
                
                <div class="think-outside-box">
                    <h4>Action Principles</h4>
                    <p>According to the three action principles of Look, Listen, and Link, PFA is a method of approaching someone who is in distress, determining what kind of assistance they require, and assisting them in getting that assistance.</p>
                </div>
                
                <!-- Image 2 in Module 3 -->
                <img src="../Courses page Images/Psychological first aid.jpg" alt="LOOK Action Principle" class="module-image">
                
                <h3>1. LOOK (observe a circumstance)</h3>
                <ul>
                    <li>Analyze what has occurred or is occurring</li>
                    <li>Pick who requires assistance</li>
                    <li>Analyse the hazards to safety and security</li>
                    <li>Evaluate any physical harm</li>
                    <li>Consider your immediate practical and basic demands</li>
                    <li>Monitor for emotional responses</li>
                </ul>
                
                <h3>2. LISTEN (focus on the individual)</h3>
                <ul>
                    <li>Give a brief introduction</li>
                    <li>Listen intently and actively</li>
                    <li>Respect other people's emotions</li>
                    <li>Calm the distressed individual</li>
                    <li>Inquire about needs and worries</li>
                    <li>Assist the person or people experiencing distress in resolving their issues and requirements</li>
                </ul>
                
                <!-- Image 3 in Module 3 -->
                <img src="../Courses page Images/Psychological first aid.jpg" alt="LISTEN Action Principle" class="module-image">
                
                <h3>3. LINK (act now to assist)</h3>
                <ul>
                    <li>Look for information</li>
                    <li>Make contact with the person's family and friends</li>
                    <li>Address real-world issues</li>
                    <li>Get assistance and other services</li>
                </ul>
            </section>

            <!-- Module 4 -->
            <section id="module4" class="module">
                <h2>MODULE 4</h2>
                <h3>Active Listening in PFA</h3>
                
                <!-- Image 4 at start of Module 4 -->
                <img src="../Courses page Images/Psychological first aid.jpg" alt="Active Listening in PFA" class="module-image">
                
                <p>A crucial element of PFA is active listening. This skill is fundamental to establishing trust and providing effective support.</p>
                
                <h3>Active Listening Guidelines:</h3>
                <ol>
                    <li>Focus intently on what the person who is impacted has to say</li>
                    <li>Don't try to reassure them that everything will be okay or interrupt them</li>
                    <li>If appropriate for your culture, make frequent eye contact and make sure your body language conveys that you are paying attention</li>
                    <li>If appropriate, gently touch the afflicted person's hand or shoulder</li>
                    <li>Spend some time listening to others explain what transpired</li>
                </ol>
                
                <div class="example">
                    <h4>Key Principle:</h4>
                    <p>People will gradually comprehend and come to terms with the incident if they share their story.</p>
                </div>
                
                <!-- Two side-by-side images in Module 4 interaction part -->
                <div class="image-container">
                    <img src="../Courses page Images/Psychological first aid.jpg" alt="Active Listening Techniques">
                    <img src="../Courses page Images/Psychological first aid.jpg" alt="Supportive Communication">
                </div>
                
                <div class="video-container">
                    <h4>Supporting Specific Populations</h4>
                    <p>Watch this video to learn about applying PFA principles with different groups:</p>
                    <a href="https://youtu.be/AfdKqpGaa_k" target="_blank">
                        <i class="fab fa-youtube"></i> Watch Video
                    </a>
                    <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/AfdKqpGaa_k?si=HFvFgW4MLmC76j8C" 
                        title="YouTube video player" frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen>
                    </iframe> -->
                </div>
                
                <p>Reference: <a href="https://epidemics.ifrc.org/volunteer/action/45-psychological-first-aid-pfa" target="_blank">IFRC - PFA Action Principles</a></p>
            </section>

            <!-- Quiz Section -->
            <section id="quiz" class="module">
                <div class="quiz-section">
                    <h2>Psychological First Aid (PFA) Quiz</h2>
                    <p style="text-align: center; margin-bottom: 2rem;">Test your knowledge of Modules 1-4</p>
                    
                    <div class="quiz-question">
                        <h3>1. What is the main goal of Psychological First Aid (PFA)?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q1a" name="question1">
                                <label for="q1a">(A) To provide long-term therapy</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q1b" name="question1">
                                <label for="q1b">(B) To promote resilience and healthy recovery after a crisis</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q1c" name="question1">
                                <label for="q1c">(C) To administer medication</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q1d" name="question1">
                                <label for="q1d">(D) To avoid discussing traumatic events</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>2. Which of the following is NOT a common reaction to a life-changing incident?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q2a" name="question2">
                                <label for="q2a">(A) Sleep problems</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q2b" name="question2">
                                <label for="q2b">(B) Feelings of anger and grief</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q2c" name="question2">
                                <label for="q2c">(C) Immediate recovery within minutes</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q2d" name="question2">
                                <label for="q2d">(D) Loss of confidence in self or others</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>3. What does the 'LOOK' action principle of PFA involve?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q3a" name="question3">
                                <label for="q3a">(A) Ignoring the environment</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q3b" name="question3">
                                <label for="q3b">(B) Judging people's feelings</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q3c" name="question3">
                                <label for="q3c">(C) Observing the situation and identifying who needs help</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q3d" name="question3">
                                <label for="q3d">(D) Sharing personal experiences</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>4. What is the key objective of the 'LISTEN' step in PFA?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q4a" name="question4">
                                <label for="q4a">(A) To immediately offer advice</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q4b" name="question4">
                                <label for="q4b">(B) To actively listen and calm the person in distress</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q4c" name="question4">
                                <label for="q4c">(C) To list possible reasons for the incident</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q4d" name="question4">
                                <label for="q4d">(D) To avoid the person until they recover</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>5. What does the 'LINK' step focus on?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q5a" name="question5">
                                <label for="q5a">(A) Ignoring practical problems</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q5b" name="question5">
                                <label for="q5b">(B) Connecting the person to resources, support, and information</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q5c" name="question5">
                                <label for="q5c">(C) Encouraging isolation</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q5d" name="question5">
                                <label for="q5d">(D) Dismissing their concerns</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>6. Which of the following best describes active listening in PFA?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q6a" name="question6">
                                <label for="q6a">(A) Interrupting to share your own story</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q6b" name="question6">
                                <label for="q6b">(B) Listening attentively without judging or rushing to reassure</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q6c" name="question6">
                                <label for="q6c">(C) Advising people to quickly move on</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q6d" name="question6">
                                <label for="q6d">(D) Focusing on distractions</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>7. According to PFA guidelines, what physical gestures may help show you're listening if culturally appropriate?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q7a" name="question7">
                                <label for="q7a">(A) Crossing your arms</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q7b" name="question7">
                                <label for="q7b">(B) Turning away from the person</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q7c" name="question7">
                                <label for="q7c">(C) Gentle touch on the hand or shoulder</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q7d" name="question7">
                                <label for="q7d">(D) Constantly checking your phone</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>8. Which of the following is a common emotional reaction after a disaster?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q8a" name="question8">
                                <label for="q8a">(A) Confusion and fear</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q8b" name="question8">
                                <label for="q8b">(B) Feeling nothing at all in every case</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q8c" name="question8">
                                <label for="q8c">(C) Immediate happiness</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q8d" name="question8">
                                <label for="q8d">(D) Total memory loss</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>9. What should a person practicing PFA avoid saying to someone in distress?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q9a" name="question9">
                                <label for="q9a">(A) "Everything will be fine soon."</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q9b" name="question9">
                                <label for="q9b">(B) "I am here to listen if you'd like to talk."</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q9c" name="question9">
                                <label for="q9c">(C) "Can you tell me how you're feeling right now?"</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q9d" name="question9">
                                <label for="q9d">(D) "Would you like me to help contact your family or friends?"</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>10. Why is it important for people to share their experiences after a traumatic event?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q10a" name="question10">
                                <label for="q10a">(A) It helps them gradually comprehend and come to terms with the event</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q10b" name="question10">
                                <label for="q10b">(B) It delays their recovery</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q10c" name="question10">
                                <label for="q10c">(C) It encourages them to forget the event</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q10d" name="question10">
                                <label for="q10d">(D) It makes them dependent on others</label>
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
                    <p>1️⃣ B | 2️⃣ C | 3️⃣ C | 4️⃣ B | 5️⃣ B | 6️⃣ B | 7️⃣ C | 8️⃣ A | 9️⃣ A | 🔟 A</p>
                </div> -->
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