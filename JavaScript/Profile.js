document.addEventListener('DOMContentLoaded', function() {
  const uploadInput = document.getElementById('profile-upload');
  const profileImg = document.getElementById('profile-img');
  const spinner = document.getElementById('profile-spinner');
  const removeBtn = document.getElementById('remove-img-btn');
  const placeholderSrc = 'profile-placeholder.png';

  uploadInput.addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file && file.type.startsWith('image/')) {
      spinner.style.display = 'block';
      const reader = new FileReader();
      reader.onload = function(e) {
        profileImg.src = e.target.result;
        spinner.style.display = 'none';
        removeBtn.style.display = 'block';
      };
      reader.readAsDataURL(file);
    }
  });

  removeBtn.addEventListener('click', function() {
    profileImg.src = placeholderSrc;
    uploadInput.value = '';
    removeBtn.style.display = 'none';
  });

  // Slider functionality for enrolled courses
  const leftArrow = document.getElementById('left-arrow');
  const rightArrow = document.getElementById('right-arrow');
  const coursesList = document.getElementById('enrolled-courses-list');

  function scrollCourses(direction) {
    const circle = coursesList.querySelector('.course-circle');
    if (!circle) return;
    const scrollAmount = circle.offsetWidth + 22; // width + margin
    coursesList.scrollBy({
      left: direction * scrollAmount,
      behavior: 'smooth'
    });
  }

  leftArrow.addEventListener('click', function() {
    scrollCourses(-1);
  });
  rightArrow.addEventListener('click', function() {
    scrollCourses(1);
  });
}); 