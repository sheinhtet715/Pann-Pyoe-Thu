

  

function openPopup(courseName, fee, paymentName) {
    if (!window.isLoggedIn) {
        Swal.fire({
            icon: 'warning',
            title: 'Please sign in',
            text: 'You must be signed in to enroll in a course.'
        }).then(() => {
            openLogin();
        });
        return;
    }
    
    // For paid courses
    if (fee.toLowerCase() !== 'free') {
        // Set course name in form
        document.querySelector('#payment-popup input[name="course_name"]').value = courseName;
        // Show payment popup
        document.getElementById('payment-input').value = paymentName;
        document.getElementById('payment-popup').style.display = 'flex';
    } 
    // For free courses - submit directly
    else {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'Courses.php';
        
        const courseInput = document.createElement('input');
        courseInput.type = 'hidden';
        courseInput.name = 'course_name';
        courseInput.value = courseName;
        form.appendChild(courseInput);
        
        document.body.appendChild(form);
        form.submit();
    }
}

function closePopup() {
    document.getElementById('payment-popup').style.display = 'none';
}

// click-outside to close popup
document.addEventListener('click', function(e) {
const popup = document.getElementById('payment-popup');
if (popup && e.target === popup) closePopup();
});

// Function to handle payment method selection
  function selectMethod(method) {
  document.querySelectorAll('input[name="payment_method"]').forEach(input => {
    input.checked = (input.value === method);
  });
}

function toggleMobileMenu() {
    const nav = document.querySelector('.nav');
    nav.classList.toggle('active');
}

