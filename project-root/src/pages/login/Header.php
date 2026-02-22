<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>استایلیست من - فروشگاه مد و پوشاک</title>

  <!-- لینک به فایل‌های خارجی -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  
  <!-- تنظیمات Tailwind -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Vazirmatn', 'sans-serif']
          },
          colors: {
            primary: {
              50: '#f0fdf4',
              100: '#dcfce7',
              200: '#bbf7d0',
              300: '#86efac',
              400: '#4ade80',
              500: '#22c55e',
              600: '#16a34a',
              700: '#15803d',
              800: '#166534',
              900: '#14532d',
            }
          }
        }
      }
    }
  </script>
  
  <!-- لینک به فایل CSS اختصاصی هدر -->
  <link rel="stylesheet" href="/../../../public/assets/css/header.css">
</head>
<body>
  <!-- محتوای هدر -->
  <header class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100 p-x-5">
    <nav class="container mx-auto flex flex-row-reverse justify-between items-center px-4 py-3">
      <div class="flex items-center">
        <a href="#" class="text-2xl font-bold text-emerald-600 flex items-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-2 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          استایلیست من
        </a>
      </div>

      <div class="hidden md:flex items-center gap-6">
        <a href="http://localhost:86/public/" class="nav-link text-gray-800 hover:text-emerald-600">خانه</a>
      </div>

      <!-- دکمه منوی موبایل -->
      <button id="mobileMenuButton"
              class="md:hidden text-gray-700 bg-emerald-100 hover:bg-emerald-200 w-12 h-12 rounded-full flex items-center justify-center transition-colors"
              aria-controls="mobileMenu"
              aria-expanded="false"
              aria-label="باز کردن منوی موبایل">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
      </button>
    </nav>

    <!-- منوی موبایل -->
    <div id="mobileMenu" class="mobile-menu max-h-0 md:hidden bg-white border-t border-gray-100">
      <div class="container mx-auto px-4 py-3">
        <a href="http://localhost:86/public/" class="block py-3 px-4 hover:bg-emerald-50 rounded-lg text-gray-800 font-medium">
          <i class="fas fa-home mr-3 text-emerald-500"></i> خانه
        </a>
      </div>
    </div>
  </header>
  <script src="../../../public/assets/js/header.js"></script>
</body>
</html>
