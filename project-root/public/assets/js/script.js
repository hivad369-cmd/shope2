document.addEventListener('DOMContentLoaded', function () {
    // راه‌اندازی AOS
    AOS.init({
      duration: 800,
      easing: 'ease-in-out',
      once: true
    });
  
    // راه‌اندازی Swiper
    new Swiper('.swiper-container', {
      loop: true,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      slidesPerView: 2,
      spaceBetween: 20,
      breakpoints: {
        768: {
          slidesPerView: 4,
          spaceBetween: 30,
        },
      },
    });
  });
  