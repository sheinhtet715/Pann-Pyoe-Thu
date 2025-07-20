// Counsellor.js
// Counsellor.js
function openPopup(advisorName, skipLoginCheck = false) {
  if (!skipLoginCheck && !window.isLoggedIn) {
    Swal.fire({
      icon: 'warning',
      title: 'Please sign in',
      text: 'You must be signed in to book an appointment.'
    }).then(() => {
      window.location.href = 'index.php?showLogin=1';
    });
    return;
  }

  document.getElementById('advisor-input').value     = advisorName;
  document.getElementById('advisor-name').textContent = advisorName;
  document.getElementById('appointment-popup').style.display = 'flex';
}

function closePopup() {
  document.getElementById('appointment-popup').style.display = 'none';
}

// click‐outside auto‑close
window.onclick = function(e) {
  const popup = document.getElementById('appointment-popup');
  if (popup && e.target === popup) closePopup();
};


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

// Close popups when clicking the overlay
// window.onclick = (event) => {
//   const popup = document.getElementById("appointment-popup");
//   if (popup && event.target === popup) popup.style.display = "none";
//   const modal = document.getElementById("loginModal");
//   if (modal && event.target === modal) modal.style.display = "none";
// };

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