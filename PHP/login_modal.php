<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
    
  </style>
</head>
<body>
  


<!-- login_modal.php -->
<div id="loginModal" class="modal" style="display:none">
  <div class="modal-content login-container">
    <div class="login-left">
      <h1>Welcome to Pann Pyoe Thu</h1>
      <img src="../HomePimg/tulips-removebg-preview.png" alt="Flowers" class="flower-img"/>
    </div>
    <div class="login-right">
      <span class="close" onclick="closeLogin()">&times;</span>
      <img src="../HomePimg/Logo.ico" class="login-logo" alt="logo"/>
      <div class="login-box">
        <!-- Any server‑side error messages? -->
        <?php if (!empty($error)): ?>
          <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php" class="login-box">
          <input type="hidden" name="return"
       value="<?= htmlspecialchars($_SERVER['REQUEST_URI']) ?>">

          <input type="text" name="user_name" placeholder="Username" required />
          <input type="email" name="email" placeholder="Email" required />
          <input type="password" name="password" placeholder="Password" required />
          <div class="login-buttons">
            <button class="signin" type="submit" name="signin">Sign in</button>
            <button class="signup" type="submit" name="signup">Sign up</button>
          </div>
        </form>
        <!-- <a href="#" class="forgot">Forgot your password?</a> -->
      </div>
    </div>
  </div>
</div>
</body>
</html>