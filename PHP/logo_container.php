<?php




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
.logo-container {
    display: flex;
    align-items: center;
    gap: 0.7rem;
    flex-shrink: 0;
}

.logo-img {
    height: 40px;
    width: auto;
    border-radius: 8px;
    object-fit: contain;
}

.logo-text {
    margin-top: 5px;
    font-family: 'Great Vibes', cursive;
    font-size: 24px;
    color: black;
    text-shadow:
      -1px -1px 0 white,
        1px -1px 0 white,
      -1px  1px 0 white,
        1px  1px 0 white;
}

.nav {
    display: flex;
    gap: 1.5rem;
}

.nav a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    font-size: 1rem;
    transition: color 0.2s;
    transition: all 0.3s ease;
    border-radius: 5px;
}

.nav a:hover {
    background-color: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    color: #ffe6c7;
}

@media (max-width: 900px) {
    .login-container {
        flex-direction: column;
        width: 98vw;
        min-width: 0;
        max-width: 98vw;
        height: auto;
        border-radius: 22px;
        margin: 16px auto;
        box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        color: #ffffff;
    }
    .flower-img {
        width: 150px;
        height: 150px;
    }
}
@media (max-width: 600px) {
    .login-container {
        width: 100vw;
        min-width: 0;
        max-width: 100vw;
        padding: 0;
        border-radius: 0;
        height: 100vh;
        margin: 0;
        box-shadow: none;
    }
    .flower-img {
        width: 80px;
        height: 80px;
    }

}
@media (max-width: 480px) {
   
    .nav a {
        font-size: 12px;
        padding: 2px 3px;
    }
     .logo-text {
        font-size: 11px;
    }
    .login-container {
        height: 100vh;
        min-height: 0;
        max-height: 100vh;
        overflow-y: auto;
    }
    .flower-img {
        width: 80px;
        height: 80px;
    }

   
}

@media (max-width: 900px) {
    .nav {
        display: none;
        position: absolute;
        top: 70px;
        left: 0;
        width: 100vw;
        background: #529AA6;
        flex-direction: column;
        gap: 0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .nav.active {
        display: flex;
    }
    .nav a {
        padding: 1rem 2rem;
        border-bottom: 1px solid #417b87;
    }
    .mobile-menu-toggle {
        display: flex;
    }
}

    </style>
</head>
<body>
    <div class="logo-container">
        <img src="../HomePimg/Logo.ico" alt="Pann Pyoe Thu logo" class="logo-img" />
        <span class="logo-text">Pann Pyoe Thu</span>
      </div>
      <nav class="nav" id="nav-menu">
        <a href="../PHP/index.php">Home</a>
        <a href="../PHP/About Us.php">About us</a>
        <a href="../PHP/Courses.php">Courses</a>
        <a href="../PHP/Counsellor.php">Educational Counsellors</a>
        <a href="../PHP/Scholarship.php">Scholarships</a>
        <a href="../PHP/Local Uni.php">Local Universities</a>
        <a href="../PHP/Jobs.php">Job Opportunities</a>
      </nav>

      <button class="mobile-menu-toggle" onclick="toggleMobileMenu()" aria-label="Toggle mobile menu">
        <span></span>
        <span></span>
        <span></span>
      </button>
</body>
</html>