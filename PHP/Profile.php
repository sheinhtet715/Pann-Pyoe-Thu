<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
    <link rel="icon" href="../HomePimg/Logo.ico" type="image/x-icon">
  <title>Profile Page</title>
  <link rel="stylesheet" href="../CSS/Profile.css">
</head>
<body>
  <div class="container">
    <header>
      <div class="logo-section">
        <img src="../HomePimg/Logo.ico" alt="Logo" class="logo-img">
        <span class="brand-name">Pawn Pyoe Thu</span>
      </div>
      <button class="logout-btn">Log out</button>
    </header>
    <main>
      <section class="profile-section">
        <div class="profile-pic-container">
          <div class="profile-pic-placeholder" id="profile-pic-placeholder">
            <img src="profile-placeholder.png" alt="Profile" class="profile-img" id="profile-img">
            <div class="spinner" id="profile-spinner" style="display:none;"></div>
            <button type="button" class="remove-img-btn" id="remove-img-btn" style="display:none;">✕</button>
          </div>
          <label class="upload-label" for="profile-upload">
            <input type="file" id="profile-upload" accept="image/*" style="display:none;">
            Upload your profile
          </label>
        </div>
        <div class="enrolled-courses">
          <span>Enrolled courses</span>
          <div class="courses-slider">
            <button class="slider-arrow left-arrow" id="left-arrow" aria-label="Previous courses">&#60;</button>
            <ul class="courses-list" id="enrolled-courses-list">
              <li class="course-circle" data-course-id="1"></li>
              <li class="course-circle" data-course-id="2"></li>
              <li class="course-circle" data-course-id="3"></li>
              <li class="course-circle" data-course-id="4"></li>
              <li class="course-circle" data-course-id="5"></li>
              <li class="course-circle" data-course-id="6"></li>
              <li class="course-circle" data-course-id="7"></li>
            </ul>
            <button class="slider-arrow right-arrow" id="right-arrow" aria-label="Next courses">&#62;</button>
          </div>
        </div>
        <div class="flowers">
          <img src="../HomePimg/tulips-removebg-preview.png" alt="Flower 1" class="flower-img">
          <img src="../Counsellor_page_images/Pink Tulip.png" alt="Flower 2" class="flower-img">
        </div>
      </section>
      <section class="edit-profile-section">
        <h2>Edit your profile</h2>
        <form>
          <label>Name</label>
          <input type="text" placeholder="">
          <label>Email</label>
          <input type="email" placeholder="">
          <label>Phone Number</label>
          <input type="text" placeholder="">
        </form>
        <input class="Save-btn" type ="submit" value ="Save">
      </section>
    </main>
  </div>
  <script src="../JavaScript/Profile.js"></script>
</body>
</html> 