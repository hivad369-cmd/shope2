// AOS - Animate On Scroll
document.addEventListener('DOMContentLoaded', function() {
    function initAOS() {
      const elements = document.querySelectorAll('[data-aos]');
      
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('aos-animate');
            observer.unobserve(entry.target);
          }
        });
      }, { threshold: 0.1 });
  
      elements.forEach(el => {
        el.style.opacity = '0';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
      });
    }
  
    // Initialize on load and when new content added
    initAOS();
    document.addEventListener('newContentLoaded', initAOS);
  });