<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Management Skills Course</title>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu+Condensed&family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Time Management.css">
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
            <h1>Time Management Skills</h1>
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
                <li class="active" data-module="module1">Time Management</li>
                <li data-module="module2">4Ds</li>
                <li data-module="module3">Why 4Ds?</li>
                <li data-module="quiz" class="quiz-nav" style="display: none;">Quiz</li>
            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="main-content">
            <!-- Module 1 -->
            <section id="module1" class="module active">
                <h2>Time Management Skills</h2>
                <h3>အချိန် စီမံခန့် ခွဲမှု (Time Management)</h3>
                
                <!-- Image 1 at start of Module 1 -->
                <img src="Courses_images/Time Management Skill Images/Time 0.png" alt="Time 0" class="module-image">
                
                <p>“အချိန် စီမံခန့်ခွဲမှု” ဆိုတာဟာ သင့်ရဲ့ အချိန်ကို တနေ့တာ ဆောင်ရွက်ရန်ရှိတဲ့ သင်ယူခြင်းလုပ်ငန်းများ၊ အလုပ်တာဝန်များ၊ လူမှုရေးလုပ်ငန်းများနှင့် မိသာစုတာဝန်များကို အံဝင်ခွင်ကျဖြစ်အောင် ပြီးမြောက်အောင် စနစ်တကျ စီစဉ်တဲ့ လုပ်ငန်းစဉ်ဖြစ်ပါတယ်။ ကောင်းမွန်တဲ့ အချိန်စီမံခန့်ခွဲမှုတွေကို လုပ်ဆောင်တဲ့အခါ အဓိကအားဖြင့် လုပ်ဆောင်မှု (action) အဆင့်မှ ရလဒ် (Result) အဆင့်သို့ ရောက်ဖို့လိုပါတယ်။ အလုပ်များ ခြင်းဟာ အချိန်ကို စနစ်တကျ စီမံခန့်ခွဲမှု မဟုတ်ပါ။ တိုးတက်လိုသူတစ်ဦးအနေနဲ့ ရှိသင့်တဲ့ အရေးကြီးတဲ့ အရည်အချင်းတစ်ခုကတော့ အချိန်စီမံခန်ခွဲမှုပဲဖြစ်ပါတယ်။ အချိန်စီမံခန်ခွဲမှုဆိုတာ တစ်ရက်တာအချိန် ၂၄ နာရီကို အကျိုးရှိစွာ အသုံးပြုခြင်းကို ရည်ညွှန်းခြင်းဖြစ်ပါတယ်။</p>
                
                <br>

                <p>ပထမဦးစွာအောက်ပါမေးခွန်းများဖြင့်မိမိရဲ့ အချိန်စီမံခန့်ခွဲမှု အလေ့အထကို ပြန်လည်စဉ်းစား သုံးသပ်ကြည့်ပါ။</p>

                <img src="Courses_images/Time Management Skill Images/Time 1.png" alt="Time 1" class="module-image">

                <ul>
                    <li>သင်လုပ်ဆောင်ရမယ့် တာဝန်တွေ ကို အချိန်မီပြီးဆုံးအောင် ဆောင်ရွက်ပါသလား။</li>
                    <li>သင်လုပ်ဆောင်ရမယ့် အရာတွေကို ရေးသားခြင်း၊ စာရွက်ပေါ်တွင် သိမ်းဆည်းထားခြင်း၊ မှတ်တမ်းတွင် ရေးမှတ်ထားခြင်းတွေ ပြုလုပ်ခြင်းထက် ဦးနှောက်ထဲတွင်သာမှတ်သားထားပါသလား။</li>
                    <li>သင် လုပ်ဆောင်ရမယ့် အလုပ်တွေကို ပြက္ခဒိန်ရေးဆွဲလုပ်ဆောင်တတ်ပါသလား။</li>
                    <li>စာမေးပွဲဖြေဆိုဖို့အတွက် အချိန်ဇယားရေးဆွဲပြီး စာလေ့လာပါသလား။</li>
                    <li>သင်စာလေ့လာရန် (သို့) အလုပ်လုပ်ရန် ပြင်ဆင်တဲ့ အချိန်မှာ ဘယ်အရာကို လုပ်ဆောင်မယ် ဆိုတာကို အတိအကျသိရှိနေပါသလား။</li>
                    <li>လုပ်ဆောင်ရမယ့် အရာတွေကို အချိန်နီးကပ်မှ လုပ်ဆောင်ပါသလား။</li>
                    <li>သင်ဟာ များသောအားဖြင့် အချိန်မှန်သူ တစ်ဦး ဖြစ်ပါသလား။</li>
                    <li>တစ်ချိန်တည်းမှာ လုပ်ဆောင်ရမည့်တာဝန်တွေကို တစ်ခုထက်မက လုပ်ဆောင်တတ်ပါသလား။</li>
                </ul>

                <h3>ကောင်းမွန်သော အချိန်စီမံခန့်ခွဲမှုတွင် အဓိကပါဝင်သောအချက်များ</h3>

                <p>အချိန်စီမံခန်ခွဲမှု၏ အခြေခံယူဆချက်မှာ မိမိတွင်ရှိသော အချိန်အတိုင်းအတာအတွင်း အတတ်နိုင်ဆုံး အလုပ်များများပြီးအောင် လုပ်ဆောင်နိုင်ဖို့ ဖြစ်ပါတယ်။ ကောင်းမွန်တဲ့ အချိန်စီမံခန်ခွဲမှုတွင် အဓိကပါဝင်သော အချက်တွေကတော့ –</p>

                <img src="Courses_images/Time Management Skill Images/Time 2.jpg" alt="Time 2" class="module-image">

                <ul>
                    <li>ရှင်းလင်းသော မျှော်မှန်းချက်ရှိခြင်း။</li>
                    <li>ဦးစားပေးအလုပ်များကို သိရှိခြင်း။</li>
                    <li>အချိန်၏တန်ဖိုးကို နားလည်ခြင်း။</li>
                    <li>အလုပ်ပြီးမြောက်ရမည့်အချိန်ကို ကန့်သတ်ထားရှိခြင်း။</li>
                    <li>လုံလောက်သော အနားယူချိန်ရှိခြင်း။</li>
                    <li>အာရုံစူးစိုက်မှု အကောင်းဆုံးအချိန်တွင်ခက်ခဲသော လုပ်ငန်းတာဝန်များကို ဆောင်ရွက်ခြင်း။</li>
                    <li>အချိန်ဆွဲခြင်းကို တွန်းလှန်ခြင်း</li>
                </ul>
            </section>

            <!-- Module 2 -->
            <section id="module2" class="module">
                <h2>4Ds</h2>
                
                <h3>အချိန်စီမံခန့်ခွဲမှု ၏ 4Ds က ဘာတွေလဲ။</h3>

                <p>အချိန်စီမံခန့်ခွဲမှု၏ 4Ds ဆိုတာ လုပ်ငန်းတစ်ခုကို သတ်မှတ်ထားသော အချိန်အတွင်း ပြီးစီးနိုင်မှု ရှိမရှိ သုံးသပ်နိုင်ရန် အသုံးချသော နည်းဗျူဟာတစ်ခုဖြစ်ပါတယ်။ လုပ်ငန်းတစ်ခု (သို့) စီမံကိန်းတစ်ခုရဲ့ အလုပ်တာဝန်များကို သတ်မှတ်ထားသော အချိန်အတွင်း ပိုမိုထိရောက်စွာ စီမံနိုင်ရန် နှင့် သင့်အတွက် အရေး အကြီးဆုံး လုပ်ငန်းစဉ်များကို အဓိက အာရုံစိုက်ဆောင်ရွက်နိုင်ရန် 4Ds နည်းဗျူဟာကို အသုံးချနိုင်ပါတယ်။</p>

                <img src="Courses_images/Time Management Skill Images/Time 3.jpg" alt="Time 3" class="module-image">

                <p>အချိန်စီမံခန့်ခွဲမှု ၏ 4Ds တွေကတော့</p>
                <ol>
                    <li>Do – ချက်ချင်ပြီးမြောက်နိုင်မည့်အလုပ်များဦးစားပေးလုပ်ဆောင်ခြင်း</li>
                    <li>Defer (Delay) – ချက်ချင်းဆောင်ရွက်ရန်မလိုအပ်သောအလုပ်များကိုဆက်လက်ဆောင်ရွက်နိုင်ရန်စီမံထားခြင်း</li>
                    <li>Delegate – တာဝန်များကိုခွဲဝေဆောင်ရွက်ခြင်း</li>
                    <li>Delete (Drop) – မလိုအပ်သောအလုပ်မလုပ်ခြင်း</li>
                </ol>

                <h3>Do – ပြုလုပ်ခြင်း။</h3>

                <p>Do ဆိုလိုသည်မှာ – အခုလတ်တလောအချိန်အတွင်း အရေးတကြီးဆောင်ရွက်ရန် လိုအပ်သော အလုပ်များကို ချက်ချင်းဆောင်ရွက်ခြင်းဖြစ်သည်။ ထို့ပြင် အရေးကြီးပြီး ချက်ချင်း ဆောင်ရွက်နိုင်သော၊ အချိန်အနည်းငယ်အတွင်း ပြီးစီးအောင် လုပ်နိုင်သော အလုပ်ငယ် (small tasks) များကိုလည်း အချိန်မဆွဲဘဲ ပြီးမြောက်အောင် ဆောင်ရွက်ခြင်းဖြစ်ပါတယ်။ ဒီလို သေးငယ်တဲ့ အလုပ်များကို အချိန်မဆွဲမထားပါနဲ့။ ချက်ချင်းပြီးအောင်လုပ်ပါ။ ဥပမာအားဖြင့် အရေးကြီးတဲ့အီးမေလ်းများကို အကြောင်းပြန်ကြားခြင်း၊ ဖုန်းဖြင့်အကြောင်းပြန်ကြားခြင်း၊ လာမယ့် ၁နာရီအတွင်း ပေးပို့ရန်ရှိသည့် အစီရင်ခံစာများပရင့်ထုတ်ခြင်း စတဲ့ အချိန်တိုအတွင်း ဆောင်ရွက်ရန်လိုသော အလုပ်များပြီးအောင် ဆောင်ရွက်ခြင်း ကိုဆိုလိုပါတယ်။</p>

                <h3>Defer (Delay) – နှောင့်နှေးစေခြင်း။</h3>

                <p>အခုချက်ချင်း လုပ်ဖို့မလိုအပ်သော်လည်း မဖြစ်မနေ လုပ်ရန်လိုအပ်သော (not urgent but important) အလုပ်များကို ဆိုလိုပါတယ်။ ချက်ချင်း အလောတကြီး (urgent & important) ပြုလုပ်ရမယ့် အလုပ်တွေပြီးစီးတဲ့အခါ ယခုအလုပ်များကို လုပ်ဆောင်နိုင်စေရန် အချိန်စာရင်းများနဲ့ စီစဉ်ထားခြင်းကို ဆိုလိုပါတယ်။ ဥပမာအားဖြင့် နောင်တွင်အကောင်အထည်ဖော်မယ့် ပရောဂျက်ဆိုင်ရာ idea များပြုစုခြင်း၊ ချက်ချင်း အကြောင်း ပြန်ရန်မလိုသော အီးမေလ်းများ အကြောင်းပြန်ကြားနေခြင်းများကို မလုပ်ဆောင်ဘဲ ရှောင်းရှားခြင်းကိုဆိုလိုပါတယ်။</p>

                <h3>Delegate – တာဝန်များကိုခွဲဝေဆောင်ရွက်ခြင်း။</h3>

                <p>Delegate ၏ ဆိုလိုရင်းမှာ အရေးကြီးသော လုပ်ငန်းများ အချိန်မီ(Deadlineအမီ) ပြီးစီးရန် လူမှန်၊ အလုပ်မှန် တာဝန်ခွဲဝေသတ်မှတ်ပေးခြင်း၊ တာဝန်ခွဲဝေရာတွင် အလုပ်တာဝန်အနည်းအများပေါ်မူတည်ပြီး တာဝန်သတ်မှတ်ပေးခြင်းများကို ဆိုလိုပါတယ်။ ဥပမာအားဖြင့် အစီရင်ခံစာတစ်ခုကို ၃ နာရီအတွင်း အပြီးရေးသာရးမယ်ဆိုပါစို့။ ယခင်အစီရင်ခံစာရေးသားဖူးသူ၊ အစီရင်ခံစာတွင်ပါဝင်ရမယ့် ကြောင်းအရာတွေ ကိုလည်း နှံ့နှံ့စပ်စပ်သိသူ၊ ကွန်ပျူတာစာစီစာရိုက်တွင်ပါ ကျွမ်းကျင်သူ စတဲ့သူမျိုးကို တာဝန်ပေးအပ်ခြင်းဖြစ်ပါတယ်။</p>

                <h3>Delete (Drop) – ဖျက်သိမ်းခြင်း။</h3>

                <p>မလိုအပ်သော အလုပ်များ ၊ အကျိုးမဖြစ်ထွန်းသော အစည်းအဝေးများ စသော အချိန်ဖြုန်းတီးမှုကိုသာဖြစ်စေတဲ့ အရာများကို သင့်အချိန်ဇယားမှ ဖယ်ထုတ်ပစ်ခြင်းဖြစ်ပါတယ်။</p>
            </section>

            <!-- Module 3 -->
            <section id="module3" class="module">

                <h2>Why 4Ds?</h2>

                <h3>4Ds သည် အဘယ်ကြောင့်အရေးကြီး သနည်း။</h3>
                
                <p>အလုပ်နှင့်အချိန် စီမံခန့်ခွဲမှုတွင် 4Ds ကိုအသုံးချခြင်းဖြင့် စီမံကိန်းများနှင့် အလုပ်များတွင် လူမှန်နေရာမှန် စီမံနိုင်ပြီး၊ အမှန်တကယ်အရေးကြီးသော အလုပ်များ ကို အာရုံစိုက် အချိန်မီ ပြီးမြောက်အောင် ဆောင်ရွက်နိုင်မှာဖြစ်ပါတယ်။ 4Ds ဗျူဟာက အမှန်တကယ်အရေးကြီးတဲ့ အလုပ်တွေကို အာရုံစိုက်ဖို့ ကူညီပေးမှာ ဖြစ်ပါတယ်။ ဒါ့အပြင် မိမိအမြဲ စိတ်ပူပန်ရနိုင်တဲ့ လုပ်ငန်း အရေအတွက်ကို လျှော့ချပေးပြီး အချိန်စာရင်းကိုလည်း မရှုပ်ထွေးစေနိုင်တော့ပါ။ ဒါ့အပြင် မိမိ ရဲ့တစ်နေ့တာကို ပိုမိုအာရုံစိုက်နိုင်ရန် စိတ်ပိုင်းဆိုင်ရာ စွမ်းအင်ကိုပေးတဲ့အပြင် ဆုံးဖြတ်ချက်ချခြင်းကိုလည်း အထောက်အကူပြုတာကြောင့် လက်တွေ့ အသုံးပြုရန် အရေးကြီးပါတယ်။</p>

                <p>၂၁ ရာစုက ဒီဂျစ်နည်းပညာခေတ်ဖြစ်တဲ့ အားလျော်စွာ ဒီဂျစ်တယ်ကိရိယာတွေနဲ့ ချိတ်ဆက်ပြီး သင့်အချိန်ကို အလွယ်တကူ စီမံခန့်ခွဲနိုင်ပါတယ်။ ဥပမာ google calendar, notion, github စတဲ့ digital tools တွေကိုအသုံးပြုပြီး မိမိရဲ့ အချိန် နဲ့ အလုပ်တွေကို ကောင်းစွာ စီမံခန့်ခွဲ နိုင်မှာ ဖြစ်ပါတယ်။</p>

                <p>Reference : MYEO</p>
                <p>Video</p>

                <div class="video-container">
                    
                    <a href="https://www.youtube.com/watch?v=iONDebHX9qk" target="_blank">How I Manage My Time – 10 Time Management Tips
                    </a>

                    <br>

                    <a href="https://www.youtube.com/watch?v=fbAYK4KQrso">Timeboxing: Elon Musk’s Time Management Method</a>

                    <br>

                    <a href="https://youtu.be/GBM2k2zp-MQ?t=100" target="_blank">
                        <i class="fab fa-youtube"></i> Watch Video
                    </a>

                    <br>

                    <a href="https://youtu.be/iDbdXTMnOmE" target="_blank">
                        <i class="fab fa-youtube"></i> Watch Video
                    </a>
                </div>
            </section>

            <!-- Quiz Section -->
            <section id="quiz" class="module">
                <div class="quiz-section">
                    <h2>Time Management Skill Course</h2>
                    <p style="text-align: center; margin-bottom: 2rem;">Test your knowledge of 3 Topics</p>
                    
                    <div class="quiz-question">
                        <h3>1. "အချိန်စီမံခန့်ခွဲမှု" ဆိုတာဘာကိုဆိုလိုတာလဲ?**</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q1a" name="question1">
                                <label for="q1a">(A) ပိုက်ဆံစီမံခြင်း</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q1b" name="question1">
                                <label for="q1b">(B) တာဝန်တွေကို စနစ်တကျ စီမံခြင်း</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q1c" name="question1">
                                <label for="q1c">(C) ကိုယ့်ပျော်မှုအတွက်အချိန်ယူခြင်း</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q1d" name="question1">
                                <label for="q1d">(D) ခရီးသွားစီစဉ်ခြင်း</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>2. "4Ds" ဆိုတာဘာတွေလဲ?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q2a" name="question2">
                                <label for="q2a">(A) Do, Defer, Delegate, Delete</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q2b" name="question2">
                                <label for="q2b">(B) Decide, Drop, Drive, Deliver</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q2c" name="question2">
                                <label for="q2c">(C) Dream, Design, Do, Drop</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q2d" name="question2">
                                <label for="q2d">(D) Do, Drive, Deal, Defer</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>3. “Do” ဆိုတာ ဘာအတွက်သုံးသလဲ?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q3a" name="question3">
                                <label for="q3a">(A) ချက်ချင်းဆောင်ရွက်ရန်လိုသော အလုပ်များ</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q3b" name="question3">
                                <label for="q3b">(B) တစ်နေ့နောက်မှလုပ်ရန်</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q3c" name="question3">
                                <label for="q3c">(C) တခြားသူကိုတာဝန်ပေးရန်</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q3d" name="question3">
                                <label for="q3d">(D) မလုပ်တော့ဘဲ ဖယ်ရှားရန်</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>4. တစ်နေ့ ၂၄နာရီထဲမှာ ကိုယ်လုပ်ရန်တာဝန်များကို ဘယ်လိုလုပ်သင့်သလဲ?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q4a" name="question4">
                                <label for="q4a">(A) စိတ်ကသဘောကျတာပဲလုပ်</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q4b" name="question4">
                                <label for="q4b">(B) အရေးကြီးမှုနဲ့အလျင်အမြန်လိုအပ်မှုအပေါ်အခြေခံပြီးစီစဉ်</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q4c" name="question4">
                                <label for="q4c">(C) တစ်စိတ်တစ်ပိုင်းပဲလုပ်</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q4d" name="question4">
                                <label for="q4d">(D) မစဉ်းစားဘဲအကုန်တစ်ခါတည်းလုပ်</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>5. Delegate ဆိုတာဘာလဲ?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q5a" name="question5">
                                <label for="q5a">(A) ကိုယ်တိုင်လုပ်ခြင်း</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q5b" name="question5">
                                <label for="q5b">(B) တစ်နေ့နောက်ထပ်လုပ်မယ်လို့ဖြုတ်ခြင်း</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q5c" name="question5">
                                <label for="q5c">(C) တခြားသူတစ်ဦးကိုတာဝန်ပေးခြင်း</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q5d" name="question5">
                                <label for="q5d">(D) အလုပ်ကိုဖျက်ပစ်ခြင်း</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>6. Defer (Delay) ဆိုတာ?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q6a" name="question6">
                                <label for="q6a">(A) လက်နက်ချရန်</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q6b" name="question6">
                                <label for="q6b">(B) ချက်ချင်းလုပ်ရန်</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q6c" name="question6">
                                <label for="q6c">(C) နောက်ပိုင်းလုပ်ရန် ရွှေ့ခြင်း</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q6d" name="question6">
                                <label for="q6d">(D) ဖျက်ပစ်ရန်</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>7. Delete ဆိုတာ?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q7a" name="question7">
                                <label for="q7a">(A) အရေးမကြီးတာမျိုး မလုပ်တော့ပဲ ဖျက်ပစ်ခြင်း</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q7b" name="question7">
                                <label for="q7b">(B) အရေးကြီးလို့ ချက်ချင်းလုပ်ခြင်း</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q7c" name="question7">
                                <label for="q7c">(C) တစ်ယောက်တည်းလုပ်ခြင်း</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q7d" name="question7">
                                <label for="q7d">(D) တစ်နေ့နောက်လုပ်မယ်လို့ထားခြင်း</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>8. Time Management က မဖြစ်မနေနဲ့သိထားသင့်တာက?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q8a" name="question8">
                                <label for="q8a">(A) ပျော်ရွှင်မှုရရှိမှု</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q8b" name="question8">
                                <label for="q8b">(B) တာဝန်ပေါ်မူတည်ပြီး အချိန်တွဲသတ်မှတ်ခြင်း</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q8c" name="question8">
                                <label for="q8c">(C) မလုပ်တော့ဘဲ ပျင်းပျင်းနေခြင်း</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q8d" name="question8">
                                <label for="q8d">(D) အလုပ်တိုင်းကိုတစ်ခါတည်းလုပ်ခြင်း</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>9. အလုပ်အမြန်ပြီးဖို့အတွက် နည်းလမ်းကဘာလဲ?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q9a" name="question9">
                                <label for="q9a">(A) အလုပ်တွေထဲက အရေးကြီးတာကိုပထမဆုံးလုပ်</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q9b" name="question9">
                                <label for="q9b">(B) စိတ်ကြိုက်လုပ်</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q9c" name="question9">
                                <label for="q9c">(C) မလုပ်တော့ဘဲ ချန်ထား</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q9d" name="question9">
                                <label for="q9d">(D) အလုပ်တိုင်းကို တစ်ပြိုင်နက်တည်းလုပ်</label>
                            </div>
                        </div>
                        <p style="margin-top: 1rem; color: #BF9E8D;">Choose a correct one.</p>
                    </div>

                    <div class="quiz-question">
                        <h3>10. တစ်နေ့တာအချိန်စီမံရာမှာ ဘာနည်းကျယ်ပြန့်သုံးတယ်?</h3>
                        <div class="options">
                            <div class="option">
                                <input type="radio" id="q10a" name="question10">
                                <label for="q10a">(A) 3Cs</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q10b" name="question10">
                                <label for="q10b">(B) 5Es</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q10c" name="question10">
                                <label for="q10c">(C) 4Ds</label>
                            </div>
                            <div class="option">
                                <input type="radio" id="q10d" name="question10">
                                <label for="q10d">(D) 6Bs</label>
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
                    <p>1️⃣ B | 2️⃣ A | 3️⃣ A | 4️⃣ B | 5️⃣ C | 6️⃣ C | 7️⃣ A | 8️⃣ B | 9️⃣ A | 🔟 C</p>
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