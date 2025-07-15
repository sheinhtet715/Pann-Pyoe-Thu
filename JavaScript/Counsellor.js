function openPopup(advisorName) {
  console.log('openPopup called for advisor:', advisorName);
  var popup = document.getElementById("appointment-popup");
  var nameSpan = document.getElementById("advisor-name");

  if (popup && nameSpan) {
    nameSpan.textContent = advisorName;
    popup.style.display = "flex";
  }
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

function openLogin() {
  console.log('openLogin called');
  var modal = document.getElementById('loginModal');
  if (modal) {
    modal.style.display = 'block';
  }
}

function closeLogin() {
  var modal = document.getElementById('loginModal');
  if (modal) {
    modal.style.display = 'none';
  }
}

// Hide login modal on page load as a fallback
window.addEventListener('DOMContentLoaded', function() {
  var modal = document.getElementById('loginModal');
  if (modal) {
    modal.style.display = 'none';
  }
  // Add robust event handler to profile icon
  var profileIcon = document.querySelector('.profile-icon');
  if (profileIcon) {
    profileIcon.addEventListener('click', function() {
      console.log('Profile icon clicked, opening login modal');
      openLogin();
    });
  }
});
