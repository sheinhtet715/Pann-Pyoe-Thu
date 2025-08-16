

  

async function openPopup(courseName, fee, paymentName) {
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
     // 🔍 Check enrollment before continuing
     try {
        // Adjust the path as needed relative to the current page:
        const resp = await fetch('check_enrollment.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ course_name: courseName })
        });

        // Read text first to debug if JSON parse fails
        const raw = await resp.text();
        let data;
        try { data = JSON.parse(raw); }
        catch (e) {
            console.error('Non-JSON response:', raw);
            throw e;
        }

        if (data.status === 'unauthenticated') {
            Swal.fire({ icon: 'warning', title: 'Please sign in' }).then(() => openLogin());
            return;
        }
        if (data.status === 'exists') {
            Swal.fire({
                icon: 'info',
                title: 'Already Enrolled',
                text: 'You are already enrolled in this course.'
            });
            return; // stop here
        }
        if (data.status !== 'not_enrolled') {
            Swal.fire({ icon: 'error', title: 'Error', text: data.message || 'Unexpected response.' });
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
    catch(err) {
        console.error(err);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Something went wrong. Please try again later.'
        });
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

