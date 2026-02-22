// header.js (safe, consolidated)
document.addEventListener('DOMContentLoaded', () => {
    console.log('header.js loaded');
  
    // --- موبایل: منوی اصلی ---
    function initMobileMenu() {
      const mobileMenuButton = document.getElementById('mobileMenuButton');
      const mobileMenu = document.getElementById('mobileMenu');
  
      if (!mobileMenuButton || !mobileMenu) {
        if (!mobileMenuButton) console.info('mobileMenuButton not found — mobile menu skipped');
        if (!mobileMenu) console.info('mobileMenu not found — mobile menu skipped');
        return;
      }
  
      mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('max-h-0');
        mobileMenu.classList.toggle('max-h-screen');
  
        const expanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
        mobileMenuButton.setAttribute('aria-expanded', (!expanded).toString());
      });
    }
  
    // --- موبایل: زیرمنوها ---
    function initMobileSubmenus() {
      const mobileSubmenuButtons = document.querySelectorAll('#mobileMenu button');
      if (!mobileSubmenuButtons.length) {
        // هیچ زیرمنویی موجود نیست، رد می‌کنیم
        return;
      }
      mobileSubmenuButtons.forEach(button => {
        button.addEventListener('click', function () {
          const submenu = this.nextElementSibling;
          const icon = this.querySelector('svg');
  
          if (submenu && submenu.classList) {
            submenu.classList.toggle('hidden');
          }
          if (icon && icon.classList) {
            icon.classList.toggle('rotate-180');
          }
        });
      });
    }
  
    // --- دسکتاپ: دسته‌بندی‌ها ---
    function initDesktopCategories() {
      const toggle = document.getElementById('desktop-categories-toggle');
      const menu = document.getElementById('desktop-categories-menu');
      const arrow = document.getElementById('desktop-categories-arrow');
  
      if (!toggle || !menu || !arrow) {
        // اگر هیچ‌کدوم موجود نیستند، صرفاً رد می‌کنیم و لاگ میذاریم
        if (!toggle && !menu && !arrow) {
          console.info('desktop categories elements not found — skipping desktop menu logic');
        } else {
          if (!toggle) console.warn('desktop-categories-toggle not found');
          if (!menu) console.warn('desktop-categories-menu not found');
          if (!arrow) console.warn('desktop-categories-arrow not found');
        }
        return;
      }
  
      function openMenu() {
        menu.classList.remove('translate-y-2','opacity-0','pointer-events-none');
        menu.classList.add('translate-y-0','opacity-100');
        menu.setAttribute('aria-hidden','false');
        toggle.setAttribute('aria-expanded','true');
        arrow.classList.add('rotate-180');
      }
  
      function closeMenu() {
        menu.classList.add('translate-y-2','opacity-0','pointer-events-none');
        menu.classList.remove('translate-y-0','opacity-100');
        menu.setAttribute('aria-hidden','true');
        toggle.setAttribute('aria-expanded','false');
        arrow.classList.remove('rotate-180');
      }
  
      function toggleMenu(e) {
        e.preventDefault();
        e.stopPropagation();
        if (menu.classList.contains('opacity-100')) closeMenu();
        else openMenu();
      }
  
      toggle.addEventListener('click', toggleMenu);
  
      // بستن وقتی کلیک بیرون انجام شد
      document.addEventListener('click', (ev) => {
        // محافظت بیشتر: مطمئن می‌شیم menu و toggle هنوز وجود دارند
        if (!menu || !toggle) return;
        if (!menu.contains(ev.target) && !toggle.contains(ev.target)) {
          closeMenu();
        }
      });
  
      // اطمینان از شروع در حالت بسته
      closeMenu();
    }
  
    // اجراهای شرطی
    initMobileMenu();
    initMobileSubmenus();
    initDesktopCategories();
  });
  