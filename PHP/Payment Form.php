<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['payment_method'])) {
    $method = $_POST['payment_method'];
    echo "<h2>You selected: $method</h2>";
  } else {
    echo "<p>No payment method selected.</p>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 <style>
        
/* Payment Form Popup Styles */
.payment-popup .popup {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  /* background: rgba(0,0,0,0.5); */
  justify-content: center;
  align-items: center;
  z-index:3000 ;
  border-radius: 30px;
  margin: center;
  /* margin-top: center;
  margin-left: center; */
  
}

.card {
  display: flex;
  width: 900px;
  height: 450px;
  background: linear-gradient(to bottom, #b6d3d6, #2e5356);
  border-radius: 30px;
  overflow: hidden;
  box-shadow: 0 5px 20px rgba(250, 250, 250, 0.1);
  position: relative;
  flex-direction:row;
}

.logo-image {
  width: 50px;
  height: 50px;
}
.flower-image1 {
  position: absolute;
  top: 20%;
  right: 10%;
  transform: translate(-50%, -50%) rotate(25deg);
  opacity: 0.9;
  z-index: 1;
  pointer-events: none;
  width: 30px;
  height: 30px;
}
.flower-image {
  position: absolute;
  top: 56%;
  right: 20%;
  transform: translate(-50%, -50%) rotate(-25deg);
  opacity: 0.9;
  z-index: 1;
  pointer-events: none;
  width: 30px;
  height: 30px;
}
.flower-image2 {
  position: absolute;
  top: 33%;
  right: 1%;
  transform: translate(-50%, -50%) rotate(-25deg);
  opacity: 0.9;
  z-index: 1;
  pointer-events: none;
  width: 70px;
  height: 70px;
}
.Logo-title {
  display: flex;
  align-items: center;
  position: relative;
  margin-top: -20px;
  gap: 10px;
}
.left {
  width: 50%;
  padding: 30px;
  background: linear-gradient(to bottom, #2e5356, #b6d3d6);
  color: rgb(253, 253, 253);
  position: relative;
  border-radius: 30px;
}

.right {
  width: 50%;
  padding: 30px;
  background: linear-gradient(to bottom, #b6d3d6, #2e5356);
  color:#f1efef;
  position: relative;
  font-size: 20px;
  margin-top: -20px;
}

.left h2 {
  margin-bottom: 20px;
  font-size: 20px;
  align-items: center;
}

label {
  font-size: 14px;
  margin-top: 10px;
  display: block;
}

input, textarea {
  width: 80%;
  padding: 12px 20px;
  margin: 8px 0;
  background: linear-gradient(90deg, #BF9E8D 40%, #D6C6AF 60%);
  border: none;
  border-radius: 30px;
  font-size: 14px;
}



.disclaimer {
  font-size: 12px;
  margin-top: 8px;
  color: #3b7880ff;
  max-width: 80%;
}
.left label {
  /* margin-top: -20px; */
  color: #f1efef;
}

.right .payment{
    font-size: 20px;
    color: #f1efef;
    margin-top: 20px;
    font-weight: bold;
}
  .payment-options {
    display: flex;
    gap: 10px;
    margin-left: 50px;
    margin-top: -10px;
  }

  .payment-option img {
    width: 70px;
    border: 3px solid transparent;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .payment-option input:checked + img {
    border-color: #145153ff;
    box-shadow: 0 0 10px #82cec4ff;
  }
.thank{
    color: #2d5f6bff;
    margin-top: 20px;
    font-size: 20px;
    align-items: center;
    text-align: center;
    background: linear-gradient(to bottom, #ebe3cfff, #BF9E8D);
    padding: 20px;
    border-radius: 20px;
    
}
.Transcription {
    display: flex;
  flex-direction: row;
  margin-top: 15px;
  font-size: 16px;
  color: #f1efef;
  gap: 50px;
}

.file:hover {
  background-color: #cca47e;
  transform: scale(1.05);
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.25);
}

.button-group {
  margin-top: 25px;
  display: flex;
  gap: 10px;
  justify-content: flex-end;
}
.confirm-btn {
  padding: 12px 30px;
  border: none;
  border-radius: 20px;
  background-color: #1D2733;
  color: white;
  font-weight: bold;
  cursor: pointer;
}

.cancel-btn {
  padding: 12px 30px;
  border: none;
  border-radius: 20px;
  background-color: #BF9E8D;
  color: white;
  font-weight: bold;
  cursor: pointer;
  margin-right: 10px;
  transition: background 0.18s, transform 0.18s, box-shadow 0.18s;
}

.cancel-btn:hover {
  background-color: #cca47e;
  transform: scale(1.08);
  box-shadow: 0 4px 16px rgba(231, 76, 60, 0.25);
}
.confirm-btn:hover {
  background-color: #98d1e4ff;
  transform: scale(1.08);
  box-shadow: 0 4px 16px rgba(231, 76, 60, 0.25);
}



/* Popup Responsive Design */
@media (max-width: 1100px) {
  .popup .card {
    border-radius: 30px;
    flex-direction: row;
    width: 90%;
    background: linear-gradient(to bottom, #b6d3d6, #2e5356);
    margin-top:center;
    margin-left: center;
  }
  .card{
      background: linear-gradient(to bottom, #b6d3d6, #2e5356);
  }
  .logo-image {
    width: 50px;
    height: 50px;
    z-index: 1000;
    opacity: 0.5;
    margin-top: 40px;
  }
  .left label {
    margin-top: 1px;
  color: #f1efef;
  
}
.textarea {
  height: 50%;
  width: 30%;
  font-size: 14px;
  padding: 10px;
  border-radius: 8px;
  background: linear-gradient(90deg, #BF9E8D 40%, #D6C6AF 60%);
}
.input,.textarea{
  margin:10px 0;
  width: 50%;
}
.popup .h2{
  margin: -10px;
}
.button-group {
    margin-top: 30px;
    display: flex;
    gap: 10px;
    justify-content: center;
  }
  .confirm-btn, .cancel-btn {
    padding: 10px 20px;
    font-size: 14px;
  }
}

@media (max-width: 1024px) {
  .popup .card {
    border-radius: 30px;
    flex-direction: row;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, #b6d3d6, #2e5356);
    margin-top: 20px;
    margin-left: center;
    margin-top:center;

  }
  .card{
      background: linear-gradient(to bottom, #b6d3d6, #2e5356);
  }
    .logo-image {
    width: 50px;
    height: 50px;
    opacity: 0.9;
    margin-top: 0px; 
    }
  .flower-image {
    width: 40px;
    height: 40px;
    z-index: 1000;
    opacity: 0.9;
    margin-top: 1px;
    margin-right: -9px;
  }
  .right .flower-image2 {
    width: 70px;
    height: 70px;
    margin-right: -20px;
    margin-top: -10px;
  }
  .left label {
    margin: 5px;
  color: #f1efef;
  
}
.left input {
  margin:10px 0;
  width:90%;
  height:30px;
}
.thank{
    height: 60px;
    padding:10px;
}
.payment-options {
    display: flex;
    gap: 10px;
    margin-left: 5px;
  }

  .payment-option img {
    width: 80px;
    border: 3px solid transparent;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .payment-option input:checked + img {
    border-color: #145153ff;
    box-shadow: 0 0 10px #82cec4ff;
  }
.button-group {
    margin-top: 30px;
    display: flex;
    gap: 10px;
    justify-content: center;
  }
  .confirm-btn, .cancel-btn {
    padding: 10px 20px;
    font-size: 14px;
  }
}

@media (max-width: 768px) {
 
  .popup .card {
    border-radius: 30px;
    flex-direction: row;
    width: 100%;
    background: linear-gradient(to bottom, #b6d3d6, #2e5356);
    margin-top: 20px;
    margin-left: center;

  }
  .card{
      background: linear-gradient(to bottom, #b6d3d6, #2e5356);
  }
  .logo-image {
  width: 50px;
  height: 50px;
  opacity: 0.9;
  margin-top: 0px; 
  }
  .flower-image {
    width: 40px;
    height: 40px;
    z-index: 1000;
    opacity: 0.9;
    margin-top: -5px;
    margin-right: -9px;
  }
  .right .flower-image2 {
    width: 70px;
    height: 70px;
    margin-right: -20px;
    margin-top: -10px;
  }
  .left label {
    margin: 5px;
  color: #f1efef;
  
}
.thank{
    height: 60px;
    padding:10px;
}
.payment-options {
    display: flex;
    gap: 10px;
    margin-left: 5px;
  }

  .payment-option img {
    width: 60px;
    border: 3px solid transparent;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .payment-option input:checked + img {
    border-color: #145153ff;
    box-shadow: 0 0 10px #82cec4ff;
  }
.button-group {
    margin-top: 30px;
    display: flex;
    gap: 10px;
    justify-content: center;
  }
  .confirm-btn, .cancel-btn {
    padding: 10px 20px;
    font-size: 14px;
  }
}


 @media (max-width: 425px) {
 
  .popup .card {
    border-radius: 30px;
    flex-direction: column;
    margin-top:0px;
    margin-left: 20px;
    width: 90%;
    height: 100%;
    
  }
  .card{
    flex-direction: column;
  }
   .logo-image {
  width: 50px;
  height: 50px;
  opacity: 0.9;
  margin-top: 0px; 
}
  .left{
    width: 100%;
    height: 70%;
    border-radius: 0%;
  }
  .right{
    width: 100%;
    height: 100%;
    margin-top: -30px;
  }
  .flower-image {
    width: 50px;
    height: 50px;
    z-index: 1000;
    opacity: 0.9;
    margin-top: 100px;
    margin-left: 80px;
  }
  .flower-image1 {
    width: 50px;
    height: 50px;
    margin-left:20px;
    margin-top: 20px;
  }
  .flower-image2 {
    width: 60px;
    height: 60px;
    margin-right:48px;
    margin-top: 10px;
  }
  .left label {
    margin: 5px;
  color: #f1efef;
  
}
.right label {
    margin: 1px;
  color: #f1efef;
  margin-top: 1px;
  
}
.left input {
  margin:10px 0;
  width:70%;
  height:20px;
}
.right input{
  margin:5px 0;
  width: 70%;
  height: 20px;
 
}
.thank{
    width: 70%;
    margin-left: 10px;
}
.payment-options {
    display: flex;
    gap: 10px;
    margin-left: 10px;
  }

  .payment-option img {
    width: 70px;
    border: 3px solid transparent;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s ease;
  }

  .payment-option input:checked + img {
    border-color: #145153ff;
    box-shadow: 0 0 10px #82cec4ff;
  }
.button-group {
    margin-top: 10px;
    display: flex;
    gap: 10px;
    justify-content: center;
    width: 100%;
    height: 30px;
    
  }
  .confirm-btn, .cancel-btn {
    padding: 10px 20px;
    font-size: 10px;
    
  }
}

 
 
@media (max-width: 375px) {
    .popup, .card {
    border-radius: 30px;
    flex-direction: column;
    margin-top:0px;
    width: 100%;
    height: 100%;
    
  }
  .card{
    flex-direction: column;
  }
  .logo-image {
  width: 50px;
  height: 50px;
  opacity: 0.9;
  margin-top: 0px; 
}
.left .flower-image {
    width: 50px;
    height: 50px;
    margin-left:20px;
    margin-top: 120px;
  }
  .left .flower-image1 {
    width: 50px;
    height: 50px;
    margin-left:20px;
    margin-top: 10px;
  }
    .right .flower-image2 {
    width: 50px;
    height: 50px;
    margin-right:55px;
    margin-top: 10px;
  }
  .left{
    width: 100%;
    height: 70%;
    border-radius: 0%;
  }
  .right{
    width: 100%;
    height: 100%;
    margin-top: -30px;
  }
  .flower-image {
    width: 50px;
    height: 50px;
    opacity: 0.9;
    margin-top: 100px;
    margin-left: 80px;
  }
  .left label {
    margin: 5px;
  color: #f1efef;
  
}

.left input {
  margin:10px 0;
  width:70%;
  height:20px;
}
.right input{
  margin:5px 0;
  width: 70%;
  height: 20px;
 
}
.thank{
    width: 65%;
  
}

.Transcription {
    display: flex;
  flex-direction: row;
  margin-top: 15px;
  font-size: 16px;
  color: #f1efef;
  gap: 5px;
}
.payment-options {
    display: flex;
    gap: 1px;
    margin-left: 1px;
    margin-top: -10px;
  }

  .payment-option img {
    width: 70px;
    border: 3px solid transparent;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s ease;
  }
 .payment-option input:checked + img {
    border-color: #145153ff;
    box-shadow: 0 0 10px #82cec4ff;

.button-group {
    margin-top: 10px;
    display: flex;
    gap: 10px;
    justify-content: center;
    width: 100%;
    height: 30px;
    
  }
  .confirm-btn, .cancel-btn {
    padding: 10px 20px;
    font-size: 10px;
    
  }
}
}
@media (max-width: 320px) {
    .popup, .card {
    border-radius: 30px;
    flex-direction: column;
    margin-top:0px;
    width: 100%;
    height: 100%;
    
  }
  .card{
    flex-direction: column;
  }
  .logo-image {
  width: 50px;
  height: 50px;
  opacity: 0.9;
  margin-top: 0px;
  
}
.left .flower-image {
    width: 50px;
    height: 50px;
    margin-left:20px;
    margin-top: 120px;
  }
  .left .flower-image1 {
    width: 50px;
    height: 50px;
    margin-left:20px;
    margin-top: 10px;
  }
    .right .flower-image2 {
    width: 50px;
    height: 50px;
    margin-right:40px;
    margin-top: 10px;
  }
  .left{
    width: 100%;
    height: 70%;
    border-radius: 0%;
  }
  .right{
    width: 100%;
    height: 100%;
    margin-top: -30px;
  }
  .flower-image {
    width: 50px;
    height: 50px;
    opacity: 0.9;
    margin-top: 100px;
    margin-left: 80px;
  }
  .left label {
    margin: 5px;
  color: #f1efef;
  
}

.left input {
  margin:10px 0;
  width:70%;
  height:20px;
}
.right input{
  margin:5px 0;
  width: 70%;
  height: 20px;
 
}
.thank{
    width: 65%;
  
}

.Transcription {
    display: flex;
  flex-direction: row;
  margin-top: 15px;
  font-size: 16px;
  color: #f1efef;
  gap: 5px;
}
.payment-options {
    display: flex;
    gap: 1px;
    margin-left: -5px;
    margin-top: -10px;
  }

  .payment-option img {
    width: 70px;
    border: 3px solid transparent;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s ease;
  }
 .payment-option input:checked + img {
    border-color: #145153ff;
    box-shadow: 0 0 10px #82cec4ff;

.button-group {
    margin-top: 10px;
    display: flex;
    gap: 10px;
    justify-content: center;
    width: 100%;
    height: 30px;
    
  }
  .confirm-btn, .cancel-btn {
    padding: 10px 20px;
    font-size: 10px;
    
  }
}
}
</style>
</head>

<body>
 
    <div id="payment-popup" class="popup">
    <form method="POST" action="Payement Form.php">
      <input type="hidden" name="payment_name" id="payment-input" />
      <input type="hidden" name="course_name" value="<?= htmlspecialchars($_SESSION['course_name'] ?? '') ?>">
      <input type="hidden" name="course_id" value="<?= htmlspecialchars($course_id ?? '') ?>">

      <div class="card">
        <div class="left">
        <div class="Logo-title"><img src="../HomePimg/Logo.ico" class="logo-image" alt="logo">
          <h2>PAYMENT FORM</h2></div>
          <img src="../Counsellor_page_images/White Tulip.png" class="flower-image1" alt="logo">
          <img src="../Counsellor_page_images/Pink Tulip.png" class="flower-image" alt="logo">
          <div class="textbox">
            <label>Name</label>
            <input type="text" name="user_name" value="<?= htmlspecialchars($user_name ?? '') ?>" placeholder="Your name" required />

            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($email ?? '') ?>" placeholder="your@email.com" required />
            
            <label>Phone Number</label>
            <input type="phone" name="phone" placeholder="+95: 09..." required />

            <p class="disclaimer">
              We requestyou to remit the paymet to:<br><br>
                <strong>Kpay Number: 09-12345678 </strong><br>
                <strong>Wave Number: 09-12345678 </strong><br><br>
                We will notify you once the payment has been successfully completed.
            </p>
          </div>
        </div>

        <div class="right">
        <p>Payment Method</p>
        <img src="../HomePimg/tulips-removebg-preview.png" class="flower-image2" alt="logo">
         
            <div class="payment-options">
              <label class="payment-option">
                <input type="radio" name="payment_method" value="Wave" hidden required>
                <img src="../Courses page Images/Certificate.png" alt="Wave" onclick="selectMethod('Wave')">
              </label>

              <label class="payment-option">
                <input type="radio" name="payment_method" value="paypal" hidden>
                <img src="../Courses page Images/Certificate.png" alt="PayPal" onclick="selectMethod('paypal')">
              </label>

              <label class="payment-option">
                <input type="radio" name="payment_method" value="kbzpay" hidden>
                <img src="../Courses page Images/Certificate.png" alt="KBZPay" onclick="selectMethod('kbzpay')">
              </label>
            </div>
    
          <div class="thank"> "Thanks for choosing us! Let’s make learning powerful and enjoyable together."
          </div>
          <div class="Transcription">
            <p >Payment Transcription</p>
            <P><strong>REQUIRED</strong></P>
            </div>
            <input class="file" type="file" name="file" accept=".jpg, .jpeg, .png, .pdf" required />
          <div class="button-group">
            <button type="button" class="cancel-btn" onclick="closePopup()">Cancel</button>
            <button type="submit" class="confirm-btn">Save</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</body>
<script>

  // Function to handle payment method selection
  function selectMethod(method) {
  document.querySelectorAll('input[name="payment_method"]').forEach(input => {
    input.checked = (input.value === method);
  });
}

function openPopup(paymentName, skipLoginCheck = false) {
  if (!skipLoginCheck && !window.isLoggedIn) {
    Swal.fire({
      icon: 'warning',
      title: 'Please sign in',
      text: 'You must be signed in to book an appointment.'
    }).then(() => {
      window.location.href = 'login.php?return=' + encodeURIComponent(window.location.href);
    });
    return;
  }
  document.getElementById('payment-input').value     = paymentName;
  document.getElementById('advisor-name').textContent = advisorName;
  document.getElementById('payment-popup').style.display = 'flex';
}

function closePopup() {
  document.getElementById('payment-popup').style.display = 'none';
}

// click-outside to close *appointment* popup
document.addEventListener('click', function(e) {
  const popup = document.getElementById('payment-popup');
  if (popup && e.target === popup) closePopup();
});
// click‐outside auto‑close
// window.onclick = function(e) {
//   const popup = document.getElementById('appointment-popup');
//   if (popup && e.target === popup) closePopup();
// };


// Profile‑menu toggle
function toggleProfileMenu() {
  const menu = document.getElementById("profile-menu");
  if (menu) menu.classList.toggle("show");
}
document.addEventListener('click', (e) => {
  const section = document.querySelector('.profile-section');
  const menu    = document.getElementById("profile-menu");
  if (section && menu && !section.contains(e.target)) {
    menu.classList.remove("show");
  }
});
</script>
</html>