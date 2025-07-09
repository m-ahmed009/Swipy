document.addEventListener('DOMContentLoaded', function() {
    // Product image gallery thumbnail click handler
    const thumbnails = document.querySelectorAll('.product-thumbnail');
    const mainImage = document.getElementById('mainImage');

    if (thumbnails.length && mainImage) {
      thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
          const newSrc = this.src.replace('-thumb', '-large');
          mainImage.src = newSrc;

          // Remove active class from all thumbnails
          thumbnails.forEach(t => t.classList.remove('active'));
          // Add active class to clicked thumbnail
          this.classList.add('active');
        });
      });
    }

    // Quantity input handlers
    const quantityInputs = document.querySelectorAll('.quantity-input');

    quantityInputs.forEach(input => {
      const minusBtn = input.previousElementSibling;
      const plusBtn = input.nextElementSibling;

      minusBtn.addEventListener('click', function() {
        let value = parseInt(input.value);
        if (value > 1) {
          input.value = value - 1;
        }
      });

      plusBtn.addEventListener('click', function() {
        let value = parseInt(input.value);
        input.value = value + 1;
      });
    });

    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  });
