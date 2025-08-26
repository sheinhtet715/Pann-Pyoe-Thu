-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2025 at 06:43 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE pannpyoethudb;
USE pannpyoethudb;

-- --------------------------------------------------------

--
-- Table structure for table `appointment_tbl`
--

CREATE TABLE `appointment_tbl` (
  `appointment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `counsellor_id` int(11) NOT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_time` time DEFAULT NULL,
  `description` text DEFAULT NULL,
  `appointment_status` enum('Pending','Confirmed','Cancelled','Completed') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_tbl`
--
-- --------------------------------------------------------

--
-- Table structure for table `counsellor_tbl`
--

CREATE TABLE `counsellor_tbl` (
  `counsellor_id` int(11) NOT NULL,
  `counsellor_name` varchar(50) NOT NULL,
  `specialization` varchar(255) DEFAULT NULL,
  `degree` varchar(20) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `experiences` varchar(500) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `counsellor_tbl`
--

INSERT INTO `counsellor_tbl` (`counsellor_id`, `counsellor_name`, `specialization`, `degree`, `email`, `phone`, `experiences`, `image_url`) VALUES
(1, 'Cathy Doll', 'Academic planning, course registration, scholarships', 'B.A. in Guidance & C', 'cathy.doll@pannpyoethu.edu.mm', '95 9 123 456 789', '200+ counselling sessions; Helped with registration, major selection, scholarships; Empathetic advising and tracking', 'Cathy.png'),
(2, 'Mercy Donan', 'Major selection, career fairs, academic mentorship', 'B.A. in Education', 'mercy.donan@pannpyoethu.edu.mm', '95 9 987 654 321', '4+ years supporting students; Organized events and fairs; Strategic advising', 'Mercy.jpg'),
(3, 'David Johnson', 'University apps, study skills, transitions', 'B.A. in Education', 'david.johnson@pannpyoethu.edu.', '95 9 555 123 456', '10 years of academic advising; Led workshops for study skills', 'David.jpg'),
(4, 'Linda Mae', 'First‑gen support, transitions, long‑term planning', 'B.A. in Psychology', 'linda.mae@pannpyoethu.edu.mm', '95 9 777 888 999', 'Support for first‑gen students; Community college experience', 'Linda.jpg'),
(5, 'Sophia Lwin', 'Retention, intervention, internships', 'B.A. in Human Servic', 'sophia.lwin@pannpyoethu.edu.mm', '95 9 444 222 111', '6+ years supporting student success; NGO and business internship collaborations', 'Sophia.jpg'),
(6, 'Michael Tun', 'Resume help, career pathway, adult learners', 'B.A. in Sociology', 'michael.tun@pannpyoethu.edu.mm', '95 9 222 333 444', '8+ years advising and coaching; Mock interviews and resume sessions', 'Michael.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `country_tbl`
--

CREATE TABLE `country_tbl` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_discounts`
--

CREATE TABLE `course_discounts` (
  `discount_id` int(11) NOT NULL,
  `discount_percent` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_discounts`
--

INSERT INTO `course_discounts` (`discount_id`, `discount_percent`, `start_date`, `end_date`) VALUES
(1, 25, '2025-08-01', '2025-08-02');

-- --------------------------------------------------------

--
-- Table structure for table `course_tbl`
--

CREATE TABLE `course_tbl` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `fee` varchar(50) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `language` varchar(20) DEFAULT NULL,
  `paid_status` tinyint(1) NOT NULL,
  `instructor_name` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `icon_url` varchar(255) DEFAULT NULL,
  `is_popular` tinyint(1) DEFAULT 0,
  `is_upcoming` tinyint(1) DEFAULT 0,
  `most_popular` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_tbl`
--

INSERT INTO `course_tbl` (`course_id`, `course_name`, `fee`, `type`, `language`, `paid_status`, `instructor_name`, `image_url`, `icon_url`, `is_popular`, `is_upcoming`, `most_popular`) VALUES
(1, 'Time Management Course', 'Free', 'Paper format', 'Burmese', 0, NULL, 'Time management course.jpg', 'clock-removebg-preview.png', 1, 0, 1),
(2, 'Communication Course', 'Free', 'Paper format', 'Burmese', 0, NULL, 'Communication course.jpg', 'loudspeaker-removebg-preview.png', 1, 0, 0),
(3, 'Problem-Solving Skill Course', 'Free', 'Paper format', 'Burmese', 0, NULL, 'Problem-solving course.jpg', 'puzzle-removebg-preview.png', 1, 0, 0),
(4, 'Gender Studies Course', 'Free', 'Paper format', 'Burmese', 0, NULL, 'gender.jpg', 'people-removebg-preview.png', 0, 0, 0),
(5, 'Critical Thinking Course', 'Free', 'Paper format', 'English', 0, NULL, 'critical thinking.jpg', 'brain_exercise-removebg-preview.png', 0, 0, 0),
(6, 'ICT Project Management Course', '30000 kyats', 'Video lectures', 'English', 0, NULL, 'project management.jpg', 'project-removebg-preview.png', 0, 0, 0),
(7, 'Psychological First Aid', 'Free', 'Paper format', 'English', 0, NULL, 'Psychological first aid.jpg', 'heart-removebg-preview.png', 0, 0, 0),
(8, 'Collaboration Course', '30000 kyats', 'Video lectures', 'English', 0, NULL, 'collaboration course.jpg', 'teamwork-removebg-preview.png', 0, 0, 0),
(9, 'Programming', NULL, NULL, NULL, 0, NULL, NULL, 'programming.png', 0, 1, 0),
(10, 'Languages', NULL, NULL, NULL, 0, NULL, NULL, 'languages.png', 0, 1, 0),
(11, 'Music Lessons', NULL, NULL, NULL, 0, NULL, NULL, 'musicpic.png', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_tbl`
--

CREATE TABLE `enrollment_tbl` (
  `enrollment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `enrollment_date` date NOT NULL,
  `payment_status` enum('pending','confirm','reject') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollment_tbl`
--

INSERT INTO `enrollment_tbl` (`enrollment_id`, `user_id`, `course_id`, `enrollment_date`, `payment_status`) VALUES
(6, 2, 4, '2025-08-16', 'confirm'),
(7, 2, 2, '2025-08-16', 'confirm'),
(8, 2, 7, '2025-08-16', 'confirm'),
(10, 2, 8, '2025-08-23', 'confirm'),
(11, 2, 5, '2025-08-23', 'confirm');

-- --------------------------------------------------------

--
-- Table structure for table `favouritescholarship_tbl`
--

CREATE TABLE `favouritescholarship_tbl` (
  `user_id` int(11) NOT NULL,
  `scholarship_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fieldofstudy_tbl`
--

CREATE TABLE `fieldofstudy_tbl` (
  `field_id` int(11) NOT NULL,
  `field_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_tbl`
--

CREATE TABLE `job_tbl` (
  `job_id` int(11) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `requirement` varchar(225) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `posted_date` date DEFAULT NULL,
  `job_type` enum('Full Time','Part Time') NOT NULL,
  `org_name` varchar(100) DEFAULT NULL,
  `job_attachment` varchar(255) DEFAULT NULL,
  `imglogo_url` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_tbl`
--

INSERT INTO `job_tbl` (`job_id`, `job_title`, `description`, `requirement`, `location`, `posted_date`, `job_type`, `org_name`, `job_attachment`, `imglogo_url`) VALUES
(1, 'Beauty Aesthetic Manager', ' Oversee spa operations and staff, manage client relationships, ensure high-quality  services.', 'Oversee spa operations and staff. Experience in beauty industry required.', 'Yangon', NULL, 'Full Time', 'Shwe Mingalar Spa', 'https://www.myjobs.com.mm/job/beauty-aesthetic-manager-78732', 'shwe mingalar spa.png'),
(2, 'Manager Research & Development', 'Manage, develop and collect data for related project with team.', 'Excellent research writing, analytical and presentation skills are required.', 'Yangon', NULL, 'Full Time', 'CHID Bank', 'https://www.jobnet.com.mm/job/manager-research-section-chid-bank/114527', 'chid bank.png'),
(3, 'Chinese-Myanmar Translator', 'Need to translate office related document.Work as a translator between clients and local.', 'Excel in Chinese-Myanmar four skills.Translation experience are required.', 'Myawaddy', NULL, 'Full Time', 'Icon Electric Shop', 'https://www.myjobs.com.mm/job/chinese-myanmar-translator-78837', 'icon electronic shop.png'),
(4, 'Mechanic Technician', 'Manage and test the quality of electronic products in the shop.', 'Experience with handling electronic products and gedgets is required.', 'Myawaddy', NULL, 'Full Time', 'Icon Electric Shop', 'https://www.myjobs.com.mm/job/mechanic-technician-78836', 'icon electronic shop.png'),
(5, 'Programme Management Associate', 'Responsible for coordinating logistics for field visits, meetings, and events, managing assets.', 'Communication, reporting, and providing translation support are required.', 'Mandalay', NULL, 'Full Time', 'UNOPS', 'https://www.myjobs.com.mm/job/programme-management-associate-78827 ', 'UNOPS.png'),
(6, 'Monitoring and Evaluation Senior Officer', 'Help design and implement M&E systems, provide technical support to partners, and contribute.', 'Social science research, data analysis skills are required.', 'Mandalay', NULL, 'Full Time', 'UNOPS', 'https://www.myjobs.com.mm/job/monitoring-and-evaluation-senior-officer-78828 ', 'UNOPS.png'),
(7, 'Finance Assistant', 'Maintain and assist in the process of financial related documents.', 'Proficiency in MS Excel and basic in accounting software are required.', 'Yangon', NULL, 'Full Time', 'Women Transforming Myanmar', 'https://www.myjobs.com.mm/job/finance-assistant-78815 ', 'women transforming myanmar.png'),
(8, 'Project Coordinator', 'Support, prepare and coordinate and explore new idea related to the project', 'Strong organizational and coordination skills are required.', 'Yangon', NULL, 'Full Time', 'Women Transforming Myanmar', 'https://www.myjobs.com.mm/job/project-coordinator-78814 ', 'women transforming myanmar.png'),
(9, 'Social Media Coordinator Office', 'Support, communicate and share and explore new idea related to the project.', 'Strong organizational and social marketing skills are required.', 'Yangon', NULL, 'Full Time', 'Women Transforming Myanmar', 'https://www.myjobs.com.mm/job/social-media-coordinator-78813', 'women transforming myanmar.png'),
(10, 'Office Admin Manager', 'Managing work related documents of the center. ', 'Computer skill and basic Japanese skills are required.', 'Yangon', NULL, 'Full Time', 'Moshi Moshi Japanese Language Center', 'https://www.myjobs.com.mm/job/office-admin-manager-78807 ', 'moshi moshi japanese lang center.png');

-- --------------------------------------------------------

--
-- Table structure for table `login_tbl`
--

CREATE TABLE `login_tbl` (
  `login_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(128) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `last_active` datetime DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `password_hash` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  `role` varchar(15) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_tbl`
--

INSERT INTO `login_tbl` (`login_id`, `user_id`, `session_id`, `ip_address`, `user_agent`, `last_active`, `user_name`, `password_hash`, `email`, `role`, `last_login`) VALUES
(1, 2, '376m30ac2rjeu31ltfqj4bf57s', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-17 20:21:33', 'Marina', '$2y$10$jrp1LpuQenQb2n9LIFIfEuAbxT5pqwVc3.2K8cLCvPsPM6XKs5kfe', 'marina@gmail.com', 'user', NULL),
(2, 2, 'tairkudo1fh7navehqjdda40hd', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-21 14:58:20', 'Marina', '$2y$10$jrp1LpuQenQb2n9LIFIfEuAbxT5pqwVc3.2K8cLCvPsPM6XKs5kfe', 'marina@gmail.com', 'user', NULL),
(3, 2, 'uemt2as4h99lou1vm1jvh7kr4a', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-23 21:14:10', 'Marina', '$2y$10$jrp1LpuQenQb2n9LIFIfEuAbxT5pqwVc3.2K8cLCvPsPM6XKs5kfe', 'marina@gmail.com', 'user', NULL),
(4, 2, 'ot5ltj7kq30lh5k64jh4fbccn4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36', '2025-08-24 22:24:47', 'Marina', '$2y$10$jrp1LpuQenQb2n9LIFIfEuAbxT5pqwVc3.2K8cLCvPsPM6XKs5kfe', 'marina@gmail.com', 'user', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_tbl`
--

CREATE TABLE `payment_tbl` (
  `payment_id` int(11) NOT NULL,
  `enrollment_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_status` enum('pending','confirm','reject') NOT NULL DEFAULT 'pending',
  `payment_receipt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_tbl`
--

INSERT INTO `payment_tbl` (`payment_id`, `enrollment_id`, `amount`, `payment_date`, `payment_method`, `payment_status`, `payment_receipt`) VALUES
(4, 10, 30000.00, '2025-08-23', '', 'confirm', 'uploads/payment_receipts/receipt_68a9d53a7cf167.53322969.png');

-- --------------------------------------------------------

--
-- Table structure for table `scholarshipfield_tbl`
--

CREATE TABLE `scholarshipfield_tbl` (
  `scholarship_id` int(11) NOT NULL,
  `field_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scholarship_tbl`
--

CREATE TABLE `scholarship_tbl` (
  `scholarship_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL,
  `coverage` text DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  `apply_link` varchar(255) DEFAULT NULL,
  `deadline` varchar(100) DEFAULT NULL,
  `intake_season` varchar(50) DEFAULT NULL,
  `degree_level` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `eligibility` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scholarship_tbl`
--

INSERT INTO `scholarship_tbl` (`scholarship_id`, `title`, `description`, `logo_url`, `coverage`, `country`, `apply_link`, `deadline`, `intake_season`, `degree_level`, `type`, `eligibility`) VALUES
(1, 'MEXT Japanese Studies Scholarship 2026', 'One‑year scholarship for undergraduates to study Japanese language and culture in Japan', 'MEXT.jpg', 'Tuition, monthly stipend, travel expenses', 'Japan', 'https://www.nashville.us.emb-japan.go.jp/itpr_en/00_000307.html', 'Application: January 2026; Deadline: TBD; Exam: TBD; Interview: TBD', 'October 2026', 'Undergraduate', 'Government scholarship', 'Must be an undergraduate student at a university outside Japan, majoring in Japanese language or culture. Must meet age limits and academic requirements. Applications typically open the winter before the scholarship year.'),
(2, 'Study in Italy Program for Myanmar Students', 'Support and scholarship opportunities for Myanmar students wishing to study at Italian universities. Includes guidance on enrollment, visa, tuition, and eligibility for fee reductions and scholarships.', 'ItalyScholar.png', 'Tuition reductions, university scholarships, housing benefits; free Declarations of Value when required.', 'Italy', 'https://ambyangon.esteri.it/en/servizi-consolari-e-visti/servizi-per-il-cittadino-straniero/studying-in-italy/', 'Varies by university and program', 'Academic Year 2025–2026', 'Undergraduate, Graduate', 'Government support & university scholarships', 'Myanmar students with a minimum 12 years of schooling (or alternative conditions) applying to Italian universities. Language proficiency in Italian or English required. Income‑based fee reduction available upon proof. Declaration of Value required.'),
(3, 'Octavius Catto Scholarship', 'A no‑debt, tuition‑free scholarship at Community College of Philadelphia with stipends, academic resources, and holistic student support to empower low‑income Philadelphians.', 'community_COPF.jpg', 'Tuition, all course materials, up to $1,600 stipend/semester, coaching, tutoring, career workshops, childcare, housing support.', 'United States', 'https://www.ccp.edu/admission-aid/paying-college/scholarships/octavius-catto-scholarship', 'No separate application; apply via CCP admissions + FAFSA', 'Fall & Spring Semesters (Year‑round)', 'Associate', 'Community college scholarship', 'New/first‑time CCP students, transfers with ≤30 credits, or returning students with 2.0+ GPA. Must be Philadelphia resident 12+ months, attend full‑time (12+ credits/term), have HS diploma/GED, FAFSA SAI ≤ $8,000 (undocumented accommodations), and place college‑ready or one level below in English & Math.'),
(4, 'Türkiye Scholarships – Bachelors Program', 'Scholarships for undergraduate students in various fields in Türkiye.', 'TürkiyeScholarships.png', 'Tuition, 4,500 TL/month stipend, accommodation, health insurance, 1‑year Turkish course, flights.', 'Turkey', 'https://www.turkiyeburslari.gov.tr/en', 'Typically opens Dec–Feb', 'Fall', 'Bachelor’’s', 'Government scholarship', 'Open to international students. Must verify field equivalence in home country.'),
(5, 'Chevening Scholarships', 'UK government scholarship for one‑year master’s programs.', 'cheveningscholarships.jpg', 'Tuition, living allowance, travel costs, additional grants.', 'United Kingdom', 'https://www.chevening.org/scholarships/who-can-apply/', 'Opens Aug 2025; Closes Nov 2025', 'Fall 2026', 'Master’s', 'Government scholarship', 'International emerging leaders with UK university offers and strong leadership potential.'),
(6, 'DAAD Helmut‑Schmidt Masters Scholarship', 'Postgraduate scholarship in public policy & governance in Germany.', 'DAAD.jpg', 'Tuition waiver, monthly stipend.', 'Germany', 'https://www.daad.de/go/en/stipa57692564', '31 July 2025 (annual)', 'Sept/Oct 2026', 'Master’s', 'Merit‑based', 'Open to Myanmar and other developing‑country students with relevant degrees and leadership potential.'),
(7, 'MOFA Taiwan Scholarship', 'Taiwan Ministry of Foreign Affairs scholarship for Bachelor’s & Master’s studies.', 'MOFA.jpg', 'Tuition waiver, NT$25,000–30,000 monthly stipend.', 'Taiwan', 'https://en.mofa.gov.tw/cp.aspx?n=1325', 'Varies (typically Spring)', 'Fall 2026', 'Bachelor’s, Master’s', 'Government scholarship', 'Open to non‑Taiwanese nationals with degree qualifications and language proficiency.'),
(8, 'Jardine Scholarship', 'Prestigious full scholarship to Oxford/Cambridge for Asia‑Pacific students.', 'jardineschoalrship.png', 'Full tuition, college fees, living expenses.', 'United Kingdom', 'jardineschoalrship.png', 'Oct 2025 (varies by region)', 'Fall 2026', 'Undergraduate', 'Foundation scholarship', 'From Asia‑Pacific; outstanding academic and leadership record.'),
(9, 'University of Windsor Global Conflict Relief Bursary', 'Bursary for international students affected by global conflicts.', 'UniversityofWindsorGlobalConflictReliefBursary.png', 'CAD 10,000.', 'Canada', 'https://www.uwindsor.ca/studentawards/international-students-scholarships', 'Oct 15, 2025 (may extend)', 'Fall 2025', 'Undergraduate', 'Bursary', 'International undergrads; must demonstrate conflict‑related hardship.'),
(10, 'UWindsor Open Entrance Scholarship', 'Automatic merit‑based scholarship for incoming international undergraduate students at University of Windsor.', 'UniversityofWindsorGlobalConflictReliefBursary.png', 'CAD 1,000.', 'Canada', 'https://www.uwindsor.ca/studentawards/international-students-scholarships', 'TBD (2025‑26 cycle)', 'Fall 2025', 'Undergraduate', 'Entrance scholarship', 'International undergrad; automatically considered based on admission average.');

-- --------------------------------------------------------

--
-- Table structure for table `university_tbl`
--

CREATE TABLE `university_tbl` (
  `university_id` int(11) NOT NULL,
  `university_name` varchar(100) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_course_tbl`
--

CREATE TABLE `user_course_tbl` (
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `email` varchar(30) NOT NULL,
  `password_hash` varchar(100) NOT NULL,
  `role` varchar(15) NOT NULL DEFAULT 'user',
  `phone` varchar(20) DEFAULT NULL,
  `profile_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `course_id`, `job_id`, `user_name`, `email`, `password_hash`, `role`, `phone`, `profile_path`) VALUES
(1, NULL, NULL, 'Admin', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500', 'admin', '', '/User_profile_images/1_1755197154_c2d0c894.ico'),
(2, NULL, NULL, 'Marina', 'marina@gmail.com', '$2y$10$jrp1LpuQenQb2n9LIFIfEuAbxT5pqwVc3.2K8cLCvPsPM6XKs5kfe', 'user', '0956834535', 'User_profile_images/prof_68a6d8bcad2d64.97176035.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_tbl`
--
ALTER TABLE `appointment_tbl`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `counsellor_id` (`counsellor_id`);

--
-- Indexes for table `counsellor_tbl`
--
ALTER TABLE `counsellor_tbl`
  ADD PRIMARY KEY (`counsellor_id`);

--
-- Indexes for table `country_tbl`
--
ALTER TABLE `country_tbl`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `course_discounts`
--
ALTER TABLE `course_discounts`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `course_tbl`
--
ALTER TABLE `course_tbl`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `enrollment_tbl`
--
ALTER TABLE `enrollment_tbl`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `favouritescholarship_tbl`
--
ALTER TABLE `favouritescholarship_tbl`
  ADD PRIMARY KEY (`user_id`,`scholarship_id`),
  ADD KEY `scholarship_id` (`scholarship_id`);

--
-- Indexes for table `fieldofstudy_tbl`
--
ALTER TABLE `fieldofstudy_tbl`
  ADD PRIMARY KEY (`field_id`);

--
-- Indexes for table `job_tbl`
--
ALTER TABLE `job_tbl`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `login_tbl`
--
ALTER TABLE `login_tbl`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `idx_login_email` (`email`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `session_id` (`session_id`);

--
-- Indexes for table `payment_tbl`
--
ALTER TABLE `payment_tbl`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `enrollment_id` (`enrollment_id`);

--
-- Indexes for table `scholarshipfield_tbl`
--
ALTER TABLE `scholarshipfield_tbl`
  ADD PRIMARY KEY (`scholarship_id`,`field_id`),
  ADD KEY `field_id` (`field_id`);

--
-- Indexes for table `scholarship_tbl`
--
ALTER TABLE `scholarship_tbl`
  ADD PRIMARY KEY (`scholarship_id`);

--
-- Indexes for table `university_tbl`
--
ALTER TABLE `university_tbl`
  ADD PRIMARY KEY (`university_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `user_course_tbl`
--
ALTER TABLE `user_course_tbl`
  ADD PRIMARY KEY (`user_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `job_id` (`job_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment_tbl`
--
ALTER TABLE `appointment_tbl`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `counsellor_tbl`
--
ALTER TABLE `counsellor_tbl`
  MODIFY `counsellor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `country_tbl`
--
ALTER TABLE `country_tbl`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `course_discounts`
--
ALTER TABLE `course_discounts`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course_tbl`
--
ALTER TABLE `course_tbl`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `enrollment_tbl`
--
ALTER TABLE `enrollment_tbl`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `fieldofstudy_tbl`
--
ALTER TABLE `fieldofstudy_tbl`
  MODIFY `field_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_tbl`
--
ALTER TABLE `job_tbl`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `login_tbl`
--
ALTER TABLE `login_tbl`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_tbl`
--
ALTER TABLE `payment_tbl`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `scholarship_tbl`
--
ALTER TABLE `scholarship_tbl`
  MODIFY `scholarship_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `university_tbl`
--
ALTER TABLE `university_tbl`
  MODIFY `university_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment_tbl`
--
ALTER TABLE `appointment_tbl`
  ADD CONSTRAINT `appointment_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_tbl_ibfk_2` FOREIGN KEY (`counsellor_id`) REFERENCES `counsellor_tbl` (`counsellor_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enrollment_tbl`
--
ALTER TABLE `enrollment_tbl`
  ADD CONSTRAINT `fk_enrollment_course` FOREIGN KEY (`course_id`) REFERENCES `course_tbl` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_enrollment_user` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `favouritescholarship_tbl`
--
ALTER TABLE `favouritescholarship_tbl`
  ADD CONSTRAINT `favouritescholarship_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`),
  ADD CONSTRAINT `favouritescholarship_tbl_ibfk_2` FOREIGN KEY (`scholarship_id`) REFERENCES `scholarship_tbl` (`scholarship_id`);

--
-- Constraints for table `login_tbl`
--
ALTER TABLE `login_tbl`
  ADD CONSTRAINT `login_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_tbl`
--
ALTER TABLE `payment_tbl`
  ADD CONSTRAINT `fk_payment_enrollment` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollment_tbl` (`enrollment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `scholarshipfield_tbl`
--
ALTER TABLE `scholarshipfield_tbl`
  ADD CONSTRAINT `scholarshipfield_tbl_ibfk_1` FOREIGN KEY (`scholarship_id`) REFERENCES `scholarship_tbl` (`scholarship_id`),
  ADD CONSTRAINT `scholarshipfield_tbl_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `fieldofstudy_tbl` (`field_id`);

--
-- Constraints for table `university_tbl`
--
ALTER TABLE `university_tbl`
  ADD CONSTRAINT `university_tbl_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country_tbl` (`country_id`);

--
-- Constraints for table `user_course_tbl`
--
ALTER TABLE `user_course_tbl`
  ADD CONSTRAINT `user_course_tbl_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tbl` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_course_tbl_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course_tbl` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD CONSTRAINT `user_tbl_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course_tbl` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_tbl_ibfk_2` FOREIGN KEY (`job_id`) REFERENCES `job_tbl` (`job_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
