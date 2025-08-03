<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pann Pyoe Thu</title>
  <style>
    .modal {
    display: none;
    position: fixed;
    z-index: 3001;
    top: 0; 
    left: 0;
    width: 100%;
    height: 100%;

}
/* Modal Content */
.modal-content {
    background: linear-gradient(to bottom, #e4e9ea, #146e8a);
    border-radius: 50px;
    width: 500px;
    margin: 60px auto;
    position: relative;
    animation: fadeIn 0.3s ease-in-out;
    color: #ffffff;
}

.modal-content.login-container {
    display: flex;
    flex-direction: row;
    width: 800px;
    max-width: 100%;
    height: 500px;
    background-color: transparent;
    border-radius: 25px;
    overflow: hidden;
    margin: center;
    color: #ffffff;
}

.login-right, .login-left {
    flex: 1;
    height: 100%;
    width: 100%;
    padding: 50px 50px;
    box-sizing: border-box;
    color: #ffffff;
}

.login-left {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    font-family: 'TimesNewRoman', serif;
    text-align: center;
    background: linear-gradient(to bottom, #146e8a, #e4e9ea);
    border-radius: 20px;
    border: #052027;
    position: relative;
}

.login-left h1 {
    font-size: 28px;
    color: #ffffff;
}

.flower-img {
    width: 250px;
    height: 250px;
    margin-top: 10px;
}

.login-right {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: linear-gradient(to bottom, #e4e9ea, #146e8a);
    border-radius: 20px;
    border: #052027;
    position: relative;
}

.login-box {
    width: 100%;
    max-width: 400px;
    display: flex;
    flex-direction: column;
    align-items: center; 
    justify-content: center;
}

.login-logo {
    margin-bottom: 40px;
    /* max-width: 180px; */
    /* height: auto; */
    width: 60px;
    height: 60px;
}

.login-box input {
    width: 80%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 30px;
    border: none;
    font-size: 16px;
}

.login-buttons {
    display: flex;
    gap: 15px;
    margin-top: 15px;
}

.signin, .signup {
    background: linear-gradient(135deg, #c1a089 0%, #b08f7a 100%);
    border: none;
    padding: 12px 30px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    border-radius: 25px;
    color: white;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 4px 15px rgba(193, 160, 137, 0.3);
    position: relative;
    overflow: hidden;
}

.signin:hover, .signup:hover {
    background: linear-gradient(135deg, #b08f7a 0%, #9f7e6b 100%);
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(193, 160, 137, 0.4);
    color: rgb(240, 228, 195);
}

.signin:active, .signup:active {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(193, 160, 137, 0.3);
}


/* Close Button */
.close {
    color: white;
    font-size: 35px;
    position: absolute;
    top: 15px;
    right: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: rgba(0, 0, 0, 0.2);
    z-index: 1000;
    font-weight: bold;
}

.close:hover {
    background-color: rgba(255, 255, 255, 0.3);
    transform: scale(1.2);
    color: #333;
}

@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}

@media (max-width: 900px) {
    .modal-content.login-container {
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
    .login-left, .login-right {
        border-radius: 0;
        width: 100%;
        min-width: 0;
        padding: 24px 8px;
        height: auto;
        color: #ffffff;
    }
    .login-logo {
        width: 50px;
        height: 50px;
        margin-bottom: 18px;
    }
    .flower-img {
        width: 150px;
        height: 150px;
    }
}
@media (max-width: 600px) {
    .modal-content.login-container {
        width: 100vw;
        min-width: 0;
        max-width: 100vw;
        padding: 0;
        border-radius: 0;
        height: 100vh;
        margin: 0;
        box-shadow: none;
    }
    .login-left, .login-right {
        padding: 10px 2px;
        font-size: 14px;
        border-radius: 0;
    }
    .login-left h1 {
        font-size: 1.1rem;
    }
    .login-logo {
        width: 30px;
        height: 30px;
        margin-bottom: 8px;
    }
    .flower-img {
        width: 80px;
        height: 80px;
    }
    .login-box input {
        font-size: 0.98rem;
        padding: 10px 12px;
    }
    .signin, .signup {
        font-size: 0.98rem;
        padding: 10px 12px;
    }
    .login-box {
        max-width: 98vw;
    }
    .close {
    margin-top: 5px;
   }
}
@media (max-width: 480px) {
    .header {
        padding: 4px 1px;
    }
    .logo-text {
        font-size: 11px;
    }
    .nav a {
        font-size: 12px;
        padding: 2px 3px;
    }
    .bottom {
        padding: 4px 1px;
    }
    .modal-content, .modal-content.login-container {
        height: 100vh;
        min-height: 0;
        max-height: 100vh;
        overflow-y: auto;
    }
    .login-left h1 {
        font-size: 0.85rem;
    }
    .login-logo {
        width: 60px;
        height: 60px;
    }
    .flower-img {
        width: 80px;
        height: 80px;
    }

    .close {
    margin-top: 5px;
    cursor: pointer;
   }
}
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