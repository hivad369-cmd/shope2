<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>استایلیست من - فروشگاه مد و پوشاک</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in forwards',
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 3s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: 0, transform: 'translateY(20px)' },
                            '100%': { opacity: 1, transform: 'translateY(0)' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-10px)' },
                        }
                    }
                }
            }
        }
    </script>
     <link rel="stylesheet" href="/../../../public/assets/css/header.css">
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen font-sans">
    <!-- هدر بهبود یافته با رفع مشکل رنگ لینک‌ها -->
    <header class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <nav class="container mx-auto flex flex-row-reverse justify-between items-center px-4 py-3">
            <!-- لوگو -->
            <div class="flex items-center">
                <a href="#" class="text-2xl font-bold text-emerald-600 flex items-center">
                    سبک ساز من
                </a>
            </div>

            <!-- نویگیشن دسکتاپ -->
            <div class="hidden md:flex items-center gap-6">
                <a href="http://localhost:86/public/" class="nav-link text-gray-800 hover:text-emerald-600">
                    خانه
                </a>
                
                <div class="relative flex items-center">
                    <button id="desktop-categories-toggle" class="nav-link !inline-flex !items-center !gap-1 !whitespace-nowrap !text-gray-800 hover:!text-emerald-600" aria-expanded="false" type="button">
                        <span>دسته‌بندی‌ها</span>
                        <svg id="desktop-categories-arrow" class="h-4 w-4 transform transition-transform" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="desktop-categories-menu"
                        class="absolute right-0 top-full w-48 bg-white rounded-xl shadow-2xl py-3 opacity-0 pointer-events-none transition-all duration-300 border border-emerald-100/20 z-50"
                        aria-hidden="true" style="transform-origin: top right;">
                        <a href="#" class="block px-5 py-3 hover:bg-emerald-50 text-gray-700 transition-colors flex items-center">
                        <i class="fas fa-female text-emerald-500 ml-2"></i>
                        لباس زنانه
                        </a>
                        <a href="#" class="block px-5 py-3 hover:bg-emerald-50 text-gray-700 transition-colors flex items-center">
                        <i class="fas fa-male text-emerald-500 ml-2"></i>
                        لباس مردانه
                        </a>
                        <a href="#" class="block px-5 py-3 hover:bg-emerald-50 text-gray-700 transition-colors flex items-center">
                        <i class="fas fa-shoe-prints text-emerald-500 ml-2"></i>
                        کفش
                        </a>
                        <a href="#" class="block px-5 py-3 hover:bg-emerald-50 text-gray-700 transition-colors flex items-center">
                        <i class="fas fa-gem text-emerald-500 ml-2"></i>
                        لوازم جانبی
                        </a>
                    </div>
                </div>
    
                <a href="#special" class="nav-link text-gray-800 hover:text-emerald-600">
                    پیشنهادات ویژه
                </a>
    
                <!-- وضعیت کاربر -->
                <?php if ($isLoggedIn): ?>
                    <a href="http://localhost:86/src/pages/dashboard/index.php" class="flex items-center gap-2 px-4 py-2 bg-gray-100 rounded-full cursor-pointer hover:bg-gray-200">
                         <img 
                            src="<?= !empty($userAvatar) ? htmlspecialchars($userAvatar) : 'http://localhost:86/public/assets/avatars/avatar.png' ?>" 
                            class="w-8 h-8 rounded-full" 
                            alt="Avatar"
                            onerror="this.onerror=null;this.src='/assets/images/avatars/avatar.png';"
                            >
                        <span>
                        <?= $first_name !== '' ? htmlspecialchars($first_name) : 'تکمیل پروفایل' ?>
                        </span>
</a>


                <?php else: ?>
                <a href="http://localhost:86/src/pages/login/index.php" class="bg-gradient-to-r from-amber-400 to-amber-500 text-emerald-900 font-bold px-5 py-2.5 rounded-full flex items-center">
                    <i class="fas fa-user-circle ml-2"></i> ثبت نام/ورود
                </a>
                <?php endif; ?>
            </div>


            <!-- دکمه منوی موبایل -->
            <button id="mobileMenuButton" class="md:hidden text-gray-700 bg-emerald-100 hover:bg-emerald-200 w-12 h-12 rounded-full flex items-center justify-center transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </nav>
        
        <!-- منوی موبایل -->
        <div id="mobileMenu" class="mobile-menu max-h-0 md:hidden bg-white border-t border-gray-100">
            <div class="container mx-auto px-4 py-3">
                <a href="http://localhost:86/public/" class="block py-3 px-4 hover:bg-emerald-50 rounded-lg text-gray-800 font-medium">
                    <i class="fas fa-home mr-3 text-emerald-500"></i>
                    خانه
                </a>
                
                <div class="py-3 px-4">
  <button id="category-toggle" class="w-full flex items-center justify-between text-gray-800 font-medium cursor-pointer" type="button" aria-expanded="false" aria-controls="category-menu">
    <span>
      <i class="fas fa-list mr-3 text-emerald-500"></i>
      دسته‌بندی‌ها
    </span>
    <svg id="category-arrow" class="h-4 w-4 transform transition-transform duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
    </svg>
  </button>

  <!-- مهم: از hidden کلاس استفاده نمی‌کنیم؛ از استایل inline استفاده می‌کنیم -->
  <div id="category-menu" class="mt-2 pl-8 space-y-2  hidden">
    <a href="#" class="block py-2 hover:bg-emerald-50 rounded-lg text-gray-600">لباس زنانه</a>
    <a href="#" class="block py-2 hover:bg-emerald-50 rounded-lg text-gray-600">لباس مردانه</a>
    <a href="#" class="block py-2 hover:bg-emerald-50 rounded-lg text-gray-600">کفش</a>
    <a href="#" class="block py-2 hover:bg-emerald-50 rounded-lg text-gray-600">لوازم جانبی</a>
  </div>
</div>
                <a href="#special" class="block py-3 px-4 hover:bg-emerald-50 rounded-lg text-gray-800 font-medium">
                    <i class="fas fa-percent mr-3 text-amber-500"></i>
                    پیشنهادات ویژه
                </a>
                <?php if ($isLoggedIn): ?>
                    <a href="http://localhost:86/src/pages/dashboard/index.php" class="flex items-center gap-2 px-4 py-2 bg-gray-100 rounded-full cursor-pointer hover:bg-gray-200">
                         <img 
                            src="<?= !empty($userAvatar) ? htmlspecialchars($userAvatar) : 'http://localhost:86/public/assets/avatars/avatar.png' ?>" 
                            class="w-8 h-8 rounded-full" 
                            alt="Avatar"
                            onerror="this.onerror=null;this.src='/assets/images/avatars/avatar.png';"
                            >
                        <span>
                        <?= $first_name !== '' ? htmlspecialchars($first_name) : 'تکمیل نمایه' ?>
                        </span>
                    </a>


                <?php else: ?>
                <a href="../../pages/login" class="bg-gradient-to-r from-amber-400 to-amber-500 text-emerald-900 font-bold px-5 py-2.5 rounded-full flex items-center">
                    <i class="fas fa-user-circle ml-2"></i> ثبت نام/ورود
                </a>
                <?php endif; ?>
            </div>
            </div>
        </div>
    </header>
    <body>
  <script src="../../../public/assets/js/header.js"></script>
</body>
</html>