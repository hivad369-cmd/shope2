<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>استایلیست من - دسته‌بندی محصولات</title>
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
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite'
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: 0, transform: 'translateY(20px)' },
                            '100%': { opacity: 1, transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 font-sans">
    <!-- بخش دسته‌بندی‌ها -->
    <section class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    <span class="text-primary-600">دسته‌بندی</span> محصولات
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-primary-500 to-emerald-400 mx-auto rounded-full mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    دسته‌بندی‌های متنوع ما را برای یافتن محصول مورد علاقه‌تان کشف کنید
                </p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- دسته‌بندی 1 -->
                <a href="#" class="group relative overflow-hidden rounded-2xl shadow-xl transition-all duration-500 hover:shadow-2xl hover:-translate-y-3">
                    <div class="relative h-80 overflow-hidden">
                        <img 
                            src="/public/assets/images/woman.jpeg" 
                            alt="لباس زنانه"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-center">
                        <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-emerald-300 transition-colors">
                            لباس زنانه
                        </h3>
                        <p class="text-emerald-300 font-medium">۲۴۵ محصول</p>
                    </div>
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full text-primary-600 font-bold text-sm">
                        <i class="fas fa-arrow-left ml-2"></i>
                        مشاهده محصولات
                    </div>
                </a>
                
                <!-- دسته‌بندی 2 -->
                <a href="#" class="group relative overflow-hidden rounded-2xl shadow-xl transition-all duration-500 hover:shadow-2xl hover:-translate-y-3">
                    <div class="relative h-80 overflow-hidden">
                        <img 
                            src="/public/assets/images/man1.jpeg" 
                            alt="لباس مردانه"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-center">
                        <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-emerald-300 transition-colors">
                            لباس مردانه
                        </h3>
                        <p class="text-emerald-300 font-medium">۱۸۹ محصول</p>
                    </div>
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full text-primary-600 font-bold text-sm">
                        <i class="fas fa-arrow-left ml-2"></i>
                        مشاهده محصولات
                    </div>
                </a>
                
                <!-- دسته‌بندی 3 -->
                <a href="#" class="group relative overflow-hidden rounded-2xl shadow-xl transition-all duration-500 hover:shadow-2xl hover:-translate-y-3">
                    <div class="relative h-80 overflow-hidden">
                        <img 
                            src="/public/assets/images/shoes.jpg" 
                            alt="کفش"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-center">
                        <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-emerald-300 transition-colors">
                            کفش
                        </h3>
                        <p class="text-emerald-300 font-medium">۱۲۰ محصول</p>
                    </div>
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full text-primary-600 font-bold text-sm">
                        <i class="fas fa-arrow-left ml-2"></i>
                        مشاهده محصولات
                    </div>
                </a>
                
                <!-- دسته‌بندی 4 -->
                <a href="#" class="group relative overflow-hidden rounded-2xl shadow-xl transition-all duration-500 hover:shadow-2xl hover:-translate-y-3">
                    <div class="relative h-80 overflow-hidden">
                        <img 
                            src="/public/assets/images/acsesory.jpg" 
                            alt="لوازم جانبی"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                        >
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 p-6 text-center">
                        <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-emerald-300 transition-colors">
                            لوازم جانبی
                        </h3>
                        <p class="text-emerald-300 font-medium">۹۸ محصول</p>
                    </div>
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full text-primary-600 font-bold text-sm">
                        <i class="fas fa-arrow-left ml-2"></i>
                        مشاهده محصولات
                    </div>
                </a>
            </div>
            
            <!-- دکمه مشاهده همه دسته‌بندی‌ها -->
            <div class="text-center mt-16">
                <button class="px-8 py-3 bg-gradient-to-r from-primary-500 to-emerald-500 text-white font-bold rounded-full hover:from-primary-600 hover:to-emerald-600 transition-all shadow-lg hover:shadow-xl">
                    مشاهده همه دسته‌بندی‌ها
                    <i class="fas fa-arrow-left mr-2"></i>
                </button>
            </div>
        </div>
    </section>
</body>
</html>