
// JavaScript/Scholarship.js
// Close modal when clicking outside


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