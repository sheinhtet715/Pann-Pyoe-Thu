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
    <title>Problem Solving Skill Course</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="Problem-Solving.css">
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
            <h1>Problem Solving Skills</h1>
            <div class="course-info">
                <div>Type - Paper Format</div>
                <div>Language - Brumese</div>
                <div>Topic - 3 Topics</div>
            </div>
        </div>

        <!-- Sidebar - Module Navigation -->
        <div class="module-nav">
            <h3>Topics</h3>
            <ul>
                <li class="active" data-module="module1">Problem Solving Skills</li>
                <li data-module="module2">Enhancing Problem Solving Skills</li>
                <li data-module="module3">Questions</li>
                <li data-module="quiz" class="quiz-nav" style="display: none;">Quiz</li>
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="main-content">
            <!-- Module 1 -->
            <section id="module1" class="module active">
                <h2>Problem Solving Skills</h2>
                <h3>ပြဿနာဖြေရှင်းနိုင်ခြင်း စွမ်းရည် (Problem Solving Skills)</h3>
                
                <!-- Image 1 at start of Module 1 -->
                <img src="Courses_images/Problem Solving Skills Images/Problem 0.png" alt="Problem 0" class="module-image">
                
                <p>လူတိုင်ဟာ နေ့စဉ် အခက်အခဲအမျိုးမျိုး၊ပြသနာအမျိုးမျိုးကြုံရလေ့ရှိတာမို့ ပြဿနာဖြေရှင်းနိုင်ခြင်း စွမ်းရည်(Problem Solving Skills) သည် လူတိုင်းကျွမ်းကျင်ထားရမယ့် မရှိမဖြစ်လိုအပ်တဲ့ ကျွမ်းကျင်မှုစွမ်းရည် တစ်ခုဖြစ်ပါတယ်။ သင်ကိုယ်တိုင် သင်ကြုံတွေ့နေရတဲ့ ပြဿနာတွေကို ဖြေရှင်းခြင်းဖြင့် သင့်ရဲ့ Problem Solving Skills ကို တိုးတက်အောင်ပြုလုပ်လို့ရပါတယ်။ အသစ်သစ်သော ပြဿနာများ ကြုံတွေ့ရလေ သင်ရဲ့ Problem Solving Skills စွမ်းရည်က ပိုပြီးတိုးတက်လာလေပဲဖြစ်ပါတယ်။ လူတွေက သင့်ကို အဆိုးဆုံးသော အရာတွေ ပြဿနာတွေကို ကိုင်တွယ်ဖြေရှင်းဖို့ သင့်ကို မျှော်လင့်နေမှာဖြစ်ပါတယ်။</p>
                
                <br>

                <p>လူအများနဲ့ ပြောဆို ဆက်သွယ် အလုပ်လုပ်ရလေ သင့်အတွက် အသစ်သစ်သော ပြဿနာများ တိုးပွားလာလေပဲဖြစ်ပါသတယ်။ ဒီလို ပြဿနာများကို များများထိတွေ့ရလေလေ ပြဿနာဖြေရှင်းနိုင်သူ (Problem Solver)တစ်ယောက် ဖြစ်လာပြီး သင့်ရဲ့ တွေးခေါ်မှုစွမ်းရည်၊ တည်တည်ငြိမ်ငြိမ်သတိရှိရှိလုပ်ဆောင်နိုင်သောစွမ်းရည်များကို လက်တွေ့ ချိတ်ဆက် အသုံးပြု နိုင်မှာ ဖြစ်ပါတယ်။</p>

                <h3>Types of Problems (ပြဿနာအမျိုးအစားများ)</h3>

                <h3>1. သာမန်ပြဿနာများ (Tame Problems)</h3>

                <p>ရှင်းလင်းသော သာမန်ဖြစ်လေ့ဖြစ်ထရှိသော ပြဿနာများ၊ ဖြေရှင်းဖူးသောအတွေ့အကြုံများ ရှိပြီး ဖြစ်သော ပြဿနာများဖြစ်ပြီး ဖြေရှင်းရန်လွယ်ကူသည့် ပြဿနာမျိုးဖြစ်သည်။ ဥပမာ-၁ ကျောင်းသားတစ်ယောက်က အိမ်ယာထနောက်ကျလို့ အတန်းအမြဲနောက်ကျတဲ့ ပြဿနာ။ ဖြေရှင်းနည်းက နှိုးစက်ဝယ်လိုက်တာမျိုး။ ဥပမာ-၂ ယာဉ်ကြောပိတ်ဆို့သည် ပြဿနာဆိုပါဆို...နိုင်ငံအတော်များများများ ဖြေရှင်းဖူးကြတယ် အောင်မြင်ကြတယ်၊ အဖြေက တစ်သမှတ်တည်းရှိတာမျိုး။ ဖြေရှင်းနည်းအနေနဲ့က မိုးပျံလမ်းတွေဆောက်တာ၊ မြေအောက်ရ ထား လိုင်းတွေ စီမံပေးတာမျိုး။</p>

                <h3>2. ရှုပ်ထွေးသော ပြဿနာများ (Complex Problems)</h3>

                <img src="Courses_images/Problem Solving Skills Images/Problem 1.jpg" alt="Problem 1" class="module-image">

                <p>တသမတ်ဖြေရှင်းနည်းဖြင့် ဖြေရှင်း၍ ရလေ့မရှိဘဲ နားလည်ရခက်ပြီး ဖြေရှင်းနည်း မကျပါက မမျှော်လင့်ထားသော နောက်ဆက်တွဲပြဿနာများ ဖြစ်ပေါ်နိုင်သည်။ ဥပမာ-၁ ကျောင်းတစ်ကျောင်းမှာ အောင်ချက်ရာခိုင်းနှုန်းကျဆင်းတာ။ ဖြေရှင်းရမှာနည်းလမ်းတွေက အများကြီးဖြစ်နိုင်တယ်</p>

                <br>

                <p>ကျောင်းသားတစ်ဦးချင်း ကျောင်းတက်မှန်ဖို့၊ ကျောင်းချိန်မှန်ဖို့၊ ဆရာ/ဆရာမတွေ ကျွမ်းကျင်မှုမြှင့်တင်ဖို့၊ ကျောင်းနေပျော်စေဖို့ စသဖြင့် ဖြေရှင်းနည်း အများကြီးထဲကမှ တစ်ခု သို့မဟုတ် အားလုံးကို စဉ်းစားတာမျိုးဖြစ်ပါတယ်။ ဥပမာ-၂ မူးယစ်ဆေးစွဲတဲ့ ပြဿနာ ဆိုပါဆို့။ ဆေးဖြတ်ပေးရုံနဲ့ ပြဿနာ မပြီးပါဘူး၊ ရေရှည် ဖွံ့ဖြိုးရေး ဆောင်ရွက်ပေးရတာ၊ မူယစ်ဆေးရနိုင်တဲ့နေရာတွေ နှိမ့်နှင်းရတာ၊ ဥပဒေတွေပြဌာန်းရတာ စတဲ့ ဖြေရှင်းနည်းတစ်ခုနဲ့ မရဘဲ သွယ်ဝိုက်ပတ်သက်မှုတွေကိုပါ ဖြေရှင်းမှာ ပြေလည်နိုင်တဲ့ ပြသနာမျိုးဖြစ်ပါတယ်။</p>

                <h3>3. ထောင့်စုံမြင်ရသော ပြဿနာများ (Wicked Problems)</h3>

                <p>ဖြေရှင်းရန်အခက်ခဲဆုံး ပြဿနာများဖြစ်ပြီး ရှုပ်ထွေးသော ပြဿနာများ စုစည်းနေတတ်သည့် ပြဿနာစုအနေဖြင့် တည်ရှိတတ်ကြပါတယ်။ ပြဿနာရဲ့အရင်းအမြစ်ကို သတ်မှတ်ဖို့ခက် ပါတယ်။ ဥပမာ- ကမ္ဘာ့ရာသီဥတု ဖောက်ပြန်မှုပြဿနာ ဆိုပါဆို့၊ ပြဿနာ ဖြစ်ရတဲ့အကြောင်းရင်းက သစ်တောပြုန်းတီးမှုကြောင့်လား၊ ကာဗွန်ထုတ်လုပ်မှုမြင့်တက်လာတာကြောင့်လား၊ ရုပ်ကြွင်းလောင်စာတွေကြောင့် မြို့ပြတွေချဲ့ထွင်လာတာကြောင့်လား စတဲ့ အရင်းခံတွေ အမျိုးမျိုးရှိနိုင်သလို့ ဖြေရှင်းနည်းတိုင်း မှာ နောက်ဆက်တွဲ အကျိုးဆက်တွေက ပိုရှုပ်ထွေးစေမဲ့ နောက်ထပ် ပြဿနာတွေ ထပ်ဖြစ်လာစေမဲ့ ပြဿနာမျိုးဖြစ်ပါတယ်။ ဖြေရှင်းနည်းကလည်း တသတ်မှတ်တည်းမရှိသလို အမှား အမှန်လည်း မရှိတတ်ပါဘူး။</p>

            </section>

            <!-- Module 2 -->
            <section id="module2" class="module">
                <h2>Enhancing Problem Solving Skills</h2>
                
                <h3>Problem Solving Skills နကာင်ျိုးနအာင် ဘယ်လှိုမြှင့်တင်မလဲ။</h3>

                <p>သင်ဟာ ပြဿနာတွေကို ကောင်းကောင်းမွန်မွန် ဖြေရှင်းနိုင်သူတစ်ယောက် ဖြစ်ဖို့ဆိုရင် အလွန်ထက်မြက်နေဖို့ မလိုသလို အများအထင်ကြီးခံရအောင် ကြိုးစားဖို့လည်းမလိုပါဘူး။ ကြုံလာရတဲ့ ပြဿနာတွေကို ဖြေရှင်းရင်း သင်ခန်းစာယူဖို့နဲ့ လေ့ကျင့်နေဖို့ပဲလိုတာပါ။ မတူညီတဲ့ ပြဿနာများကို အောက်ဖော်ပြပါအတိုင်း အဆင့်လိုက် ဖြေရှင်းခြင်းဖြင့် သင်သည် ကြီးမားသော ပြဿနာများကိုလည်း ကောင်းစွာ ဖြေရှင်းနိုင်လာမှာ ဖြစ်ပါတယ်။</p>

                <h3>၁။ ပြဿနာပေါ်မဟုတ်ပဲ ဖြေရှင်းချက်ပေါ်ပဲ အာရုံစိုက်ပါ။ (Focus on the Solution, Not the Problem)</h3>

                <p>“သင်က ပြဿနာပေါ်မှာပဲ အာရုံစိုက်နေမယ်ဆိုရင် သင့်ရဲ့ ဦးနှောက်မှာ ဖြေရှင်းချက်ကို ရှာဖွေလို့ရမှာ မဟုတ်ပါဘူး" လို့ အာရုံကြောသိပ္ပံပညာရှင်များက ဆိုထားပါတယ်။ ဒါက ဘာကြောင့်လဲ ဆိုတော့ သင်က ပြဿနာပေါ်မှာပဲ အာရုံစိုက်ပြီး အကောင်းမမြင်တဲ့ စိတ်ခံစားချက်များကို သင့်ရဲ့ ဦးနှောက်မှာ လွှမ်းမိုးနေလို့ပဲ ဖြစ်ပါတယ်။ အဲဒီ မကောင်းမြင်စိတ်တွေက သင့်ရဲ့ ဖြေရှင်းမှု စွမ်းရည်ကိုပိတ်ဆို့လိုက်တာကြောင့် ဖြစ်ပါတယ်။ ဒီအချက်မှာ ပြဿနာကို မတွေးနဲ့ဆိုတာက ပြဿနာကို လျစ်လျူရှုပြီး ရှောင်ပြေးဖို့ မဆိုလိုပါဘူး။ စိတ်ကို တည်ငြိမ်အောင်ထားခြင်းကသာ ပြဿနာရဲ့ ဇစ်မြစ်ကို သိရန် ကူညီပေးမှာဖြစ်ပါတယ်။ "ဘယ်သူ့အမှားလဲ၊ ဘာကြောင့်မှားတာလဲ" ဆိုတာကို တွေးတောနေမယ့်အစား အဖြေကိုသာ အာရုံကို စိုက်ပါ။</p>

                <h3>၂။ ပြဿနာကိုရှင်းရှင်းလင်းလင်းသတ်မှတ်ရန်5 WHYS ကိုသိအောင်လုပ်ပါ။</h3>

                <p>"5 WHYs" သည် ပြဿနာတစ်ခု၏ အရင်းခံကို သိရှိအောင်ကူညီပေးသည့် နည်းစဉ် တစ်ခုဖြစ်ပါတယ်။ ပြဿနာတစ်ခုအတွက် “ဘာကြောင့်လဲ" ဆိုတဲ့မေးခွန်းကို ထပ်ခါတလဲလဲမေးရင်း၊ အကြောင်းရင်းကို ရှာဖွေနိုင်ပါတယ်။ ဒီပြဿနာက ဘာကြောင့်လဲဆိုတဲ့ ‘Why’မေးခွန်းကို ထပ်ခါထပ်ခါ မေးခြင်းအားဖြင့် အကြောင်းအရင်းကို သင်ရှာဖွေနိုင်ပါတယ်။ ဒီနည်းလမ်းက ပြဿနာတစ်ခုကို အကောင်းဆုံးဖြေရှင်းနည်းပဲ ဖြစ်ပါတယ်။ ဒါကြောင့် 'Why' ဆိုတဲ့မေးခွန်းနဲ့ပတ်သတ်တဲ့ အကြောင်းအရာတွေကို ငါးကြိမ်လောက် မေးမြန်းခြင်းအားဖြင့် ပြဿနာအရင်းခံကို နက်နက်နဲနဲ ရှာဖွေနိုင်ပါတယ်။</p>

                <p>ဥပမာ- ပြဿနာက "အိပ်ယာထနောက်ကျပြီး အမြဲတမ်းအလုပ်နောက်ကျတယ်" ဆိုရင်</p>

                <img src="Courses_images/Problem Solving Skills Images/Problem 2.png" alt="Problem 2" class="module-image">

                <ol>
                    <li>ငါဘာလို့အလုပ်အမြဲနောက်ကျတာလဲ။
                    <p>အိပ်ယာထနောက်ကျလို့ ဖြစ်တယ်။</p></li>
                    <li>ငါဘာလို့အိပ်ချင်နေရတာလဲ။
                    <p>မနက်ခင်းမှာ ငါအရမ်းပင်ပန်းသလို ခံစားရလို့ ဖြစ်တယ်။</p></li>
                    <li>မနက်ခင်းမှာငါဘာလို့ပင်ပန်းနေရတာလဲ။
                    <p>ငါမနေ့ညက ညဉ့်နက် မှ အိပ်ခဲ့တာကြောင့်ဖြစ်တယ်။</p></li>
                    <li>ငါဘာလို့ညဉ့်နက်အိပ်ခဲ့တာလဲ။
                    <p>ကော်ဖီသောက်ပြီး အိပ်မပျော်လို့ facebook ကို ဖွင့်ပြီး New feedမှာ ဟိုကြည့်ဒီကြည့်လုပ်ရင်း အချိန်ကုန်မှန်း မသိအောင် သုံးမိခဲ့တာကြောင့်ဖြစ်တယ်။</p></li>
                    <li>ငါဘာလို့ကော်ဖီသောက်ခဲ့တာလဲ။
                    <p>နေ့လည်ပိုင်းတုန်းက အလုပ်မှာ အိပ်ငိုက်နေလို့ ကော်ဖီ သောက်ခဲ့မိတာကြောင့် ဖြစ်တယ်။</p></li>
                </ol>

                <p>ဒီ အချက်တွေ သင်တွေးလိုက်ခြင်းက"သင်ဘာကြောင့်အလုပ်နောက်ကျလဲ" ဆိုတာရဲ့အဖြေကိုရှာနိုင်ပါတယ်။ ရုံးမှာဘာကြောင့် နေ့လည်ဘက်ကော်ဖီသောက်မိတာလဲ ဆိုတဲ့ အရင်းမြစ်ခံကတော့ မနေ့ညက Facebook သုံးပြီး ညဉ့်နက်မှအိပ်ခဲ့တာကြောင့်ဖြစ်တယ်။ Social Mediaတွေကို အလွန်အကျွံသုံးမိတဲ့အခါ သင့်ရဲ့စိတ်ကျန်းမာရေး ကိုယ်ကျန်းမာရေးကို ထိခိုက်စေပြီး အဓိကပြဿနာအရင်းမြစ်တစ်ခု ဖြစ်လာပါတယ်။ဒါကြောင့် ပြသနာတစ်စုံတစ်ခုဖြစ်လာရင် 5 WHYs ကို လေ့ကျင့်သင့်ပါတယ်။</p>

                <h3>၃။ပြဿနာတွေကိုရိုးရှင်းအောင်ပြုလုပ်ပါ။(Simplify Things)</h3>

                <p>ကျွန်တော်တို့ တစ်တွေဟာ တစ်ခါတစ်ရံမှာ ရိုးရှင်းတဲ့ပြဿနာတွေကို လိုအပ်သည်ထက် ပိုမို ရှုပ်ထွေးအောင် ပြုလုပ်တတ်ကြသည်မှာ ဓမ္မတာပါပဲ။ ဒါကြောင့် ကိုယ့်ရဲ့ ပြဿနာတွေကို ယေဘုယျဆန်ဆန် ရှုမြင်ပြီး ရိုးရိုးရှင်းရှင်း မြင်ယောင်ကြည့်ပါ။ အသေးစိတ်တွေးတောမှုကို ဖယ်ထုတ်ပြီး ပြဿနာအရင်းခံက ဘယ်ကစလဲဆိုတာကို ပြန်လည်ရှာဖွေပါ။ အလွယ်ကူဆုံးနဲ့ သိသာထင်ရှားတဲ့ ပြဿနာဖြေရှင်းနည်းကို ရှာဖွေစဉ်းစားခြင်းအားဖြင့် သင်ရရှိလာမယ့် ရလဒ်က သင့်ကို အံ့အားသင့်စေပါလိမ့်မယ်။ အရိုးရှင်းဆုံး လုပ်ဆောင်ချက်တွေကပဲ အကောင်းဆုံး ရလဒ်တွေ ပေးတယ်ဆိုတာကို သိထားသင့်ပါတယ်။</p>

                <h3>၄။ ဖြစ်နိုင်တဲ့ ဖြေရှင်းချက်တွေကို စာရင်းပြုစုပါ။ (List out as Many Solutions as possible)</h3>

                <p>ပြဿနာတစ်ခုက ဘယ်လောက်ပဲ ရှုပ်ထွေးနေသည်ဖြစ်စေ ဖြစ်နိုင်ခြေရှိတဲ့ ဖြေရှင်းချက်တွေ ပေါ်ပေါက်လာအောင် လုပ်ဆောင်ပါ၊ စာရင်းပြုစုပါ။ ဒီအချက်က သင့်ရဲ့ အတွေးတွေကို ပွင့်လင်းစေပြီး ဝေဖန်ပိုင်းခြားတွေးခေါ်ခြင်းစွမ်းရည် (Critical Thinking Skills) ကို မြှင့်တင်ပေးတာကြောင့် အရေးပါတဲ့အပြင် အလားအလာရှိတဲ့ ဖြေရှင်းချက်တွေကိုလည်း အစပျိုးပေးပါတယ်။ သင်ဘာလုပ်လုပ် ‘ပေါကြောင်ကြောင်ဖြေရှင်းနည်း(stupid solutions) တွေက ပေါ်ပေါက်လာနိုင်တာမို့ ကိုယ့်ကိုကိုယ် အသုံးမကျတဲ့ လူတစ်ယောက်အဖြစ် လှောင်ပြောင်တာမျိုး မလုပ်ဘဲ ရူးရူးသွပ်သွပ် တွေးခေါ်စဉ်းစားပြီး အလားအလာရှိတဲ့ ဖြေရှင်းချက်တွေကို ရှာဖွေသင့်ပါတယ်။</p>

                <h3>၅။သွယ်ဝိုက်တွေးခေါပြီးဖြေရှင်းပါ။(ThinkLaterally)</h3>

                <p>Literal Thinking ကို Divergent Thinking လို့လည်းခေါ်ပါတယ်။ ဆိုလိုတာက ပြဿနာတစ်ခုအတွက် အဖြေတစ်ခုတည်း စဉ်းစားတာမဟုတ်ဘဲ ဖြစ်နိုင်ခြေအားလုံးကို စဉ်းစားတာပါ။ "You cannot dig a hole in a different place by digging it deeper." အဓိပ္ပါယ်က "တွင်းကို တစ်နေရာတည်းမှာပဲ နက်နက်တူးမိနေရင် အခြားနေရာတွေမှာ စမ်းတူးကြည့်ဖို့ အခွင့်အရေးမရနိုင်တော့ဘူး"။ ဆိုလိုချင်တာက အခက်အခဲ ပြဿနာနဲ့ ကြုံလာရင် ဖြေရှင်းစရာ နည်းတွေအမျိုးမျိုးရှိနိုင်တယ်။ နည်းလမ်းတစ်မျိုးတည်းကိုပဲ တစ်ချိန်လုံး တွေးနေရင်တော့ အဆင်ပြေမှာ မဟုတ်ပါဘူး။ ဒါကြောင့်မိမိတွေးတောမှု ပုံစံ၊ ဖြေရှင်းနည်းပုံစံတွေကို ပြောင်းလဲပါ။ ဘက်ပေါင်းစုံ၊ ရှုထောင့်ပေါင်းစုံ ကနေ အဖြေရှာကြည့်ဖို့ လိုအပ်ပါတယ်။ ဥပမာ- Lateral Thinker တစ်ယောက်ဟာ မီးပူထိုးချင်ပေမဲ့ လျှပ်စစ်မီးမရရင် အပူခံသံပြားသုံးပြီး မီးပူပေးတဲ့နည်းကို ပြောင်းလဲစဉ်းစားတာမျိုးကို ဆိုလိုပါတယ်။</p>

                <h3>၆။ဖြစ်နိုင်ခြေရှိတဲ့စကားလုံးများကိုသုံးပြီးဖြေရှင်းပါ။</h3>

                <p>ပြဿနာကိုဖြေရှင်းနိုင်ဖို့ဆိုရင် " တကယ်လို့သာ (What if...) " နှင့် " ဒီလိုဖြစ်ခဲ့မယ်ဆိုရင် ('Imagine if...) ဟူသော စကားစုများဖြင့် စဉ်းစားတွေးခေါ်တာကို စတင်လုပ်ဆောင်ပါ။ ဒီလို လုပ်ဆောင်ခြင်းက တီထွင်ဖန်တီးမှုရှိသော အဖြေများရရှိရန် ဦးနှောက်ကို လှုံ့ဆော်ပေးပါတယ်။ သို့ပေမယ့် ရေငုံနှုတ်ပိတ်နေခြင်း၊ အဆိုးမြင် စကားလုံးများဖြစ်တဲ့ “ဖြစ်နိုင်မယ်မထင်ဘူး (I don't think) " သို့မဟုတ် "ဒီနည်းလမ်းက မမှန်နိုင်ဘူး (But this is not right)" ဆိုတဲ့ အတွေးတွေကို မတွေးသင့်ပါဘူး။</p>

                <h3>၇။ဆက်သွယ်ပြောဆိုလုပ်ဆောင်ပါ။</h3>

                <p>သင့်ဖြေရှင်းချက်နည်းလမ်းတွေက ဘယ်လို အလုပ်ဖြစ်နိုင်တယ်ဆိုတာကို အခြားသူများနှင့် မျှဝေပါ။ အကယ်၍ လူအများကြိုက်နှစ်သက်မှု မရှိသည့် ဖြေရှင်းနည်းတစ်ခုကို ရွေးချယ်လိုက်ပါက ဘာကြောင့် ရှင်းပြပါ။ သင့်အစီအစဉ် ဤနည်းလမ်းကို ရွေးချယ်ရသည်ကို နားလည်အောင် ဖြစ်မြောက်အောင်မြင်အောင် ပူးပေါင်း ကူညီပေးခဲ့သူများကိုလည်း ကျေးဇူးတင်ပါ။</p>

                <h3>ပြဿနာဖြေရှင်းသူများတွင် မွေးမြူရမည့် အရည်အသွေးများနှင့် စိတ်နေ သဘော ထားများ</h3>

                <ul>
                    <li>မှန်ကန်ခိုင်မာနေပြီးဖြစ်သောအချက်အလက်များနှင့် လက်တွေ့အခြေအနေများကြားကွဲပြားခြားနားချက်ကို သိရှိထားခြင်း။</li>
                    <li>မှားယွင်းသွားခြင်း (သို့မဟုတ်) အမှားလုပ်မိခြင်းတို့အပေါ်ကြောက်ရွံ့မှု မရှိခြင်း။</li>
                    <li>ရရှိသော အချိန်အကန့်အသတ် အပိုင်းအခြားအတွင်း ပြီးစီးအောင် လုပ်ဆောင်ခြင်း။</li>
                    <li>အခြေအနေအလိုက်လိုက်လျောညီထွေမှုရှိခြင်းနှင့်ပြဿနာအတွက်အဖြေတစ်ခုထက်မကရှာဖွေတတ်ခြင်း။</li>
                    <li>လုပ်နိုင်သည် (I Can Do It)" ဟူသည့် စိတ်နေသဘောထားရှိခြင်း။</li>
                    <li>ပြဿနာတိုင်းအတွက် ပြောင်းလဲ၍မရနိုင်သော၊ နောက်ဆုံးတစ်ခုတည်းဖြစ်သော၊ လုံးဝမှန်ကန်သော အဖြေတစ်ခုတည်းသာ ရှိနေသည်ဟု မှတ်ယူမထားခြင်း။</li>
                    <li>ပြဿနာဖြေရှင်းသူများသည် ၎င်းတို့၏ အတွေးအခေါ်များကို စဉ်းစားသုံးသပ်ပြီး ပြဿနာ ဖြေရှင်းသည့် နည်းလမ်းများကို ပြန်လည် သုံးသပ်တတ်ခြင်း။</li>
                </ul>
            </section>

            <!-- Module 3 -->
            <section id="module3" class="module">
                <h3>လေ့ကျင့်ရန်မေးခွန်းများ</h3>
                
                <ol>
                    <li>သင်ပြဿနာကြုံတွေ့ရသည့် အချိန်ကို ပြန်လည်စဉ်းစားကြည့်ပြီး ပြဿနာများကို သင်မည်သို့ ဖြေရှင်းလေ့ရှိသနည်း။ ပြန်လည်တွေးကြည့်ပါ။ တစ်ဦးချင်းစီ စဉ်းစားပြီး အတန်းဖော်များနှင့် ပြန်လည်ဝေငှပြောဆိုပါ။</li>
                    <li>သင့်ဘဝတွင် (သို့မဟုတ်) အလုပ်တွင် မျှော်လင့်မထားသော အခက်အခဲများနှင့် ရင်ဆိုင်ရချိန်တွင် သင်မည်ကဲ့သို့ အောင်မြင်အောင် ဖြေရှင်းဆောင်ရွက်ခဲ့ဖူးပါသနည်း။ လက်ရှိကာလတွင် အလားတူ အခက်အခဲများ ထပ်မံကြုံတွေ့လာလျှင် သင် မည်သို့ ဖြေရှင်းမည်နည်း။</li>
                    <li>သင့်ဘဝတွင် သင့်မိသားစုအတွင်းတွင်သော်လည်းကောင်း၊ သူငယ်ချင်းများနှင့် ပက်သက်၍ သော်လည်းကောင်း၊ ရပ်ရွာတိုးတက်ရေး လုပ်ငန်းများဆောင်ရွက်ရာတွင်လည်းကောင်း ပြဿနာ အခက်များကြုံခဲ့ရဖူးပါသလား။ ၎င်းတို့ကို သင်မည်ကဲ့သို့ ဖြေရှင်းကူညီဆောင်ရွက်ခဲ့ပါသနည်း။</li>
                    <li>ပြဿနာဖြေရှင်းရန်ဆုံးဖြတ်ချက်မချမီသင်မည်သည့်အဆင့်များကို အရင်ဆုံးဆောင်ရွက်ရပါသနည်း။ ဘာကြောင့်ထိုအဆင့်များကို့်အဆင့်များကို အရင်ဆုံးဆောင်ရွက်ရပါသနည်း။(သင့်ဘဝအတွေ့အကြုံနှင့် ဆွေးနွေးနိုင်ပါသည်)။</li>
                    <li>သင့် သူငယ်ချင်းသော်လည်းကောင်း၊ သင့်အလုပ်မှလုပ်ဖော်ကိုင်ဖက်လည်းကောင်း မလုပ်သင့်သောအမှားတစ်ခုခုကို လုပ်ဆောင်နေကြောင်း သင်သိခဲ့လျှင် ထိုအခြေအနေကိုသင်မည်ကဲ့သို့ ဖြေရှင်းမည်နည်း။ သင်ရွေးချယ်သည့် နည်းလမ်းတွင် မထင်မှတ်ဘဲ အခက်အခဲကြုံရလျှင် မည်သို့ဆောင်ရွက်မည်နည်း။</li>
                </ol>

                <p>Resource</p>
                <p>MYEO</p>

                <div class="video-container">
                    <p>Now let's watch a video about Problem Solving Strategy</p>
                    <a href="https://www.youtube.com/watch?v=QTzDL_RjQ9U" target="_blank">
                        <i class="fab fa-youtube"></i> Watch Video
                    </a>

                    <br>

                    <a href="https://www.youtube.com/watch?v=QOjTJAFyNrU">How to Solve a Problem in Four Steps</a>

                    <br>

                    <a href="https://www.youtube.com/watch?v=LaYVqj1El1A">Find Problem, Solve Problem | Ariana Glantz | TEDxMemphis</a>
                </div>
            </section>

            <!-- Quiz Section -->
            <section id="quiz" class="module">
                <div class="quiz-section">
                    <h2>Problem Solving Skill Course</h2>
                    <p style="text-align: center; margin-bottom: 2rem;">Test your knowledge of 3 Topics</p>
                    
                    <div class="quiz-question">
                        <h3>1. Problem Solving Skills ဆိုတာ ဘာလဲ?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q1a" name="question1">
                                <label for="q1a">(A) သင်ပျော်စရာကောင်းတဲ့အရာတွေလုပ်နိုင်တဲ့စွမ်းရည်</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q1b" name="question1">
                                <label for="q1b">(B) ပြဿနာတွေကို မမျှော်လင့်ပဲ ပျင်းပျင်းနဲ့နေရတဲ့စွမ်းရည်</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q1c" name="question1">
                                <label for="q1c">(C) ပြဿနာနဲ့ရင်ဆိုင်တဲ့အခါ ဖြေရှင်းနိုင်တဲ့စွမ်းရည်</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q1d" name="question1">
                                <label for="q1d">(D) မျှော်လင့်ချက်များကိုဖျက်သိမ်းတဲ့စွမ်းရည်</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>2. Tame Problems ဆိုတာ ဘာလဲ?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q2a" name="question2">
                                <label for="q2a">(A) ဖြေရှင်းရခက်တဲ့ ပြဿနာ</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q2b" name="question2">
                                <label for="q2b">(B) လွယ်ကူလွယ်ကူဖြေရှင်းလို့ရတဲ့ ပြဿနာ</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q2c" name="question2">
                                <label for="q2c">(C) မဖြေရှင်းနိုင်တဲ့ပြဿနာ</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q2d" name="question2">
                                <label for="q2d">(D) အချို့က ဖြေရှင်းနိုင်ပြီး အချို့ကမဖြေရှင်းနိုင်တဲ့ပြဿနာ</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>3. Complex Problems ဆိုတာ...</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q3a" name="question3">
                                <label for="q3a">(A) လွယ်လွယ်လေးဖြေရှင်းလို့ရတဲ့ ပြဿနာ</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q3b" name="question3">
                                <label for="q3b">(B) ပြဿနာနည်းနည်းပဲဖြစ်တဲ့အခါ</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q3c" name="question3">
                                <label for="q3c">(C) တစ်ခုနဲ့တစ်ခုဆက်နွယ်ပြီး ဖြေရှင်းရခက်တဲ့ ပြဿနာ</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q3d" name="question3">
                                <label for="q3d">(D) မဖြေရှင်းနိုင်တဲ့အရာ</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>4. Wicked Problems ဆိုတာ...</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q4a" name="question4">
                                <label for="q4a">(A) သက်သက်ပျော်ဖို့ဖြစ်တဲ့ ပြဿနာ</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q4b" name="question4">
                                <label for="q4b">(B) ဖြေရှင်းဖို့အရမ်းလွယ်တဲ့ ပြဿနာ</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q4c" name="question4">
                                <label for="q4c">(C) မပြည့်စုံတဲ့ဖြေရှင်းနည်းတွေနဲ့ ဖြေရှင်းရမယ့် ပြဿနာ</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q4d" name="question4">
                                <label for="q4d">(D) လက်ထပ်ပွဲနဲ့ပတ်သက်တဲ့ ပြဿနာ</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>5. Problem Solver တစ်ယောက်ဟာ ဘယ်လိုလူမျိုးဖြစ်သင့်လဲ?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q5a" name="question5">
                                <label for="q5a">(A) ပြဿနာမြင်လျှင် ထွက်ပြေးသူ</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q5b" name="question5">
                                <label for="q5b">(B) ပြဿနာနဲ့ကြုံတိုင်း တော်တော်များများနဲ့တိုင်ပင်သူ</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q5c" name="question5">
                                <label for="q5c">(C) ပြဿနာနဲ့ရင်ဆိုင်ပြီး ဖြေရှင်းနည်းရှာသူ</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q5d" name="question5">
                                <label for="q5d">(D) မလုပ်တော့ဘူးဆိုသူ</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>6. နောက်ဆုံးထွက်နိုင်တဲ့ ဖြေရှင်းနည်းတစ်ခုက မမှန်ပဲဖြစ်နိုင်တဲ့ပြဿနာအမျိုးအစားက ဘယ်ဟာလဲ?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q6a" name="question6">
                                <label for="q6a">(A) Tame Problem</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q6b" name="question6">
                                <label for="q6b">(B) Complex Problem</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q6c" name="question6">
                                <label for="q6c">(C) Wicked Problem</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q6d" name="question6">
                                <label for="q6d">(D) Simple Problem</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>7. အကြံဉာဏ်တစ်ခုအဖြစ် "Problem Focus" လုပ်မလား "Solution Focus" လုပ်မလား?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q7a" name="question7">
                                <label for="q7a">(A) Problem Focus</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q7b" name="question7">
                                <label for="q7b">(B) Solution Focus</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q7c" name="question7">
                                <label for="q7c">(C) ဒါနဲ့ဘာမှမလုပ်ဘူး</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q7d" name="question7">
                                <label for="q7d">(D) ကြည့်ပြီးဆုံးဖြတ်</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>8. Complex Problems တွေဖြေရှင်းတဲ့အခါ ဘာလိုအပ်သလဲ?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q8a" name="question8">
                                <label for="q8a">(A) တစ်ယောက်ထဲလုပ်ရန်</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q8b" name="question8">
                                <label for="q8b">(B) အမြန်ဆုံးဖြေရှင်းရန်</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q8c" name="question8">
                                <label for="q8c">(C) အသင်းအဖွဲ့နဲ့ တိုင်ပင်ပြီး အဆင့်ဆင့်သွားရန်</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q8d" name="question8">
                                <label for="q8d">(D) မဖြေတော့ဘူးဆိုပြီး စွန့်ရန်</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>9. ပြဿနာတစ်ခုကို ဖြေရှင်းဖို့ နည်းလမ်းကောင်းတစ်ခုကဘာလဲ?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q9a" name="question9">
                                <label for="q9a">(A) ထပ်ဆင့်ထပ်ဆင့်အကြံထုတ်ပြီး စမ်းသပ်ကြည့်</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q9b" name="question9">
                                <label for="q9b">(B) ချက်ချင်းဆုံးဖြတ်</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q9c" name="question9">
                                <label for="q9c">(C) အကြံထုတ်မလုပ်ဘဲလုပ်သွား</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q9d" name="question9">
                                <label for="q9d">(D) နေရအောင်နေရ</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>10. Problem Solving Skills တိုးဖို့ ဘာလုပ်သင့်လဲ?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q10a" name="question10">
                                <label for="q10a">(A) ပြဿနာနဲ့ကြုံတိုင်းထွက်ပြေး</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q10b" name="question10">
                                <label for="q10b">(B) ကိုယ့်နည်းနဲ့ပဲလုပ်</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q10c" name="question10">
                                <label for="q10c">(C) အခြားသူတွေဘယ်လိုလုပ်လဲ ကြည့်ပြီး သင်ယူ</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q10d" name="question10">
                                <label for="q10d">(D) ဘာမှလုပ်စရာမလို</label>
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
                    <p>1️⃣ C | 2️⃣ B | 3️⃣ C | 4️⃣ C | 5️⃣ C | 6️⃣ C | 7️⃣ B | 8️⃣ C | 9️⃣ A | 🔟 C</p>
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
                const module4 = document.getElementById('module3');
                if (module4 && module4.style.display === 'block') {
                    quizNav.style.display = 'block';
                }
            }
            
            // Check completion when navigating to Module 4
            moduleNavItems.forEach((item, index) => {
                if (item.getAttribute('data-module') === 'module3') {
                    item.addEventListener('click', function() {
                        setTimeout(checkModuleCompletion, 100);
                    });
                }
            });
        });

        // Quiz submission function
        function submitQuiz() {
            const correctAnswers = ['q1c', 'q2b', 'q3c', 'q4c', 'q5c', 'q6c', 'q7b', 'q8c', 'q9a', 'q10c'];
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
                    <h3 style="color: #2e5356; font-size: 2rem; margin-bottom: 20px;">
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
                const courseName = "Problem-Solving Skill Course"; 
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