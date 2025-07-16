
function openPopup(advisorName) {
  if (!isLoggedIn) {
  alert('Please sign in to book an appointment.');
  // encode the space as %20
  window.location.href = '../front page/Homepage.php';
  return;
}
  const advisorInput = document.getElementById("advisor-input");
  const nameSpan     = document.getElementById("advisor-name");
  const popup        = document.getElementById("appointment-popup");

  if (advisorInput) {
    advisorInput.value = advisorName;
    console.log("DEBUG: advisor-input set to:", advisorInput.value);
  }
  if (nameSpan) nameSpan.textContent = advisorName;
  if (popup)    popup.style.display = "flex";
}
  

function closePopup() {
  var popup = document.getElementById("appointment-popup");
  if (popup) {
    popup.style.display = "none";
  }
}
function toggleProfileMenu() {
  var menu = document.getElementById("profile-menu");
  if (menu) {
    menu.classList.toggle("show");
  }
}


// Close profile menu when clicking outside
document.addEventListener('click', function(event) {
  var profileSection = document.querySelector('.profile-section');
  var menu = document.getElementById("profile-menu");
  
  if (profileSection && menu && !profileSection.contains(event.target)) {
    menu.classList.remove("show");
  }
});

// Unified click-outside handler for both popups
window.onclick = function(event) {
  var popup = document.getElementById("appointment-popup");
  if (popup && event.target === popup) {
    popup.style.display = "none";
  }
  var modal = document.getElementById('loginModal');
  if (modal && event.target === modal) {
    modal.style.display = 'none';
  }
};

// function openLogin() {
//   console.log('openLogin called');
//   var modal = document.getElementById('loginModal');
//   if (modal) {
//     modal.style.display = 'block';
//   }
// }

// function closeLogin() {
//   var modal = document.getElementById('loginModal');
//   if (modal) {
//     modal.style.display = 'none';
//   }
// }

// Hide login modal on page load as a fallback
// window.addEventListener('DOMContentLoaded', function() {
//   var modal = document.getElementById('loginModal');
//   if (modal) {
//     modal.style.display = 'none';
//   }
//   // Add robust event handler to profile icon
//   var profileIcon = document.querySelector('.profile-icon');
//   if (profileIcon) {
//     profileIcon.addEventListener('click', function() {
//       console.log('Profile icon clicked, opening login modal');
//       openLogin();
//     });
//   }
// });
  // window.addEventListener('DOMContentLoaded', function() {
  //   // 1) Hide login modal initially
  //   const loginModal = document.getElementById('loginModal');
  //   if (loginModal) loginModal.style.display = 'none';

  //   // 2) Profile‑icon → openLogin()
  //   const profileIcon = document.querySelector('.profile-icon');
  //   if (profileIcon) profileIcon.addEventListener('click', openLogin);  });