

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('loginModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
};

  function openLogin() {
    const modal = document.getElementById('loginModal');
    if (modal && modal.style.display !== 'block') {
      modal.style.display = 'block';
    }
  }
  function closeLogin() {
    const modal = document.getElementById('loginModal');
    if (modal) modal.style.display = 'none';
  }

  window.addEventListener('DOMContentLoaded', () => {
    // 1) Make sure it's hidden first
    closeLogin();

    // 2) If we arrived with ?showLogin=1 → open it
    const params = new URLSearchParams(window.location.search);
    if (params.get('showLogin') === '1') {
      openLogin();
      // scrub the param so it won't fire again on refresh
      params.delete('showLogin');
      history.replaceState(null, '', window.location.pathname);
    }
  });

 // filter functionality (as before)
    document.addEventListener('DOMContentLoaded', function() {
      const select = document.querySelector('.filter-select');
      const cards  = document.querySelectorAll('.scholarship-card');
      select.addEventListener('change', () => {
        const v = select.value;
        cards.forEach(card => {
          const c = card.querySelector('.country').textContent.trim();
          card.style.display = (v === 'All' || c === v) ? '' : 'none';
        });
      });

      // login modal auto‑open
      const params = new URLSearchParams(window.location.search);
      if (params.get('showLogin') === '1') {
        openLogin(); // assume defined elsewhere
        params.delete('showLogin');
        history.replaceState(null, '', window.location.pathname);
      }
    });