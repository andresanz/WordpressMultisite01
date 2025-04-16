// Accordion functionality
//
document.querySelectorAll('.accordion-toggle').forEach(button => {
    button.addEventListener('click', function () {
      const content = this.nextElementSibling;
      const isActive = this.classList.contains('active');
  
      // Close all accordions
      document.querySelectorAll('.accordion-toggle').forEach(btn => btn.classList.remove('active'));
      document.querySelectorAll('.accordion-content').forEach(acc => acc.style.display = 'none');
  
      // Open current accordion if not active
      if (!isActive) {
        this.classList.add('active');
        content.style.display = 'block';
      }
    });
  });