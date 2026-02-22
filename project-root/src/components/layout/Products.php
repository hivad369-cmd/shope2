<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>استایلیست من - محصولات پرفروش</title>
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
    <!-- بخش محصولات پرفروش -->
    <section class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    محصولات <span class="text-primary-600">پرفروش</span>
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-primary-500 to-emerald-400 mx-auto rounded-full mb-6"></div>
                <p class="text-gray-600 max-w-2xl mx-auto text-lg">
                    پرفروش‌ترین محصولات ما با بهترین کیفیت و مناسب‌ترین قیمت
                </p>
            </div>
            
            <div class="flex overflow-x-auto pb-6 scroll-container gap-6 px-4">
                <!-- Product 1 -->
                <div class="flex-shrink-0 w-72 bg-white/5 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/10 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                    <div class="relative overflow-hidden rounded-xl mb-5">
                        <div class="absolute top-4 left-4 z-10">
                            <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full animate-pulse-slow">
                                پرفروش
                            </span>
                        </div>
                        <div class="absolute top-4 right-4 z-10">
                            <button class="w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center text-gray-500 hover:text-red-500 transition-colors">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <img 
                            src="assets\images\cot.jpg" 
                            alt="کت زنانه"
                            class="w-full h-60 object-cover rounded-xl transition-transform duration-500 hover:scale-105"
                            onerror="this.src='https://via.placeholder.com/500'"
                        >
                    </div>
                    
                    <div class="mb-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-1">کت زنانه مدل پاریس</h3>
                        <div class="flex items-center text-amber-400 mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <span class="text-sm text-gray-500 mr-2">(۴.۵)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-xl font-bold text-primary-600">۲۵۰,۰۰۰ تومان</span>
                            <span class="text-sm text-gray-400 line-through mr-2">۳۲۰,۰۰۰ تومان</span>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <div class="flex space-x-1">
                            <span class="w-5 h-5 rounded-full bg-blue-500 border border-gray-300"></span>
                            <span class="w-5 h-5 rounded-full bg-red-500 border border-gray-300"></span>
                            <span class="w-5 h-5 rounded-full bg-green-500 border border-gray-300"></span>
                        </div>
                        
                        <button class="bg-gradient-to-r from-primary-500 to-emerald-500 text-white font-medium py-2 px-4 rounded-full hover:from-primary-600 hover:to-emerald-600 transition-all duration-300 hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                            <i class="fas fa-shopping-cart ml-2"></i>
                            افزودن به سبد
                        </button>
                    </div>
                </div>
                
                <!-- Product 2 -->
                <div class="flex-shrink-0 w-72 bg-white/5 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/10 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                    <div class="relative overflow-hidden rounded-xl mb-5">
                        <div class="absolute top-4 left-4 z-10">
                            <span class="bg-blue-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                                جدید
                            </span>
                        </div>
                        <div class="absolute top-4 right-4 z-10">
                            <button class="w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center text-gray-500 hover:text-red-500 transition-colors">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <img 
                            src="assets\images\shirt.webp" 
                            alt="پیراهن مردانه"
                            class="w-full h-60 object-cover rounded-xl transition-transform duration-500 hover:scale-105"
                            onerror="this.src='https://via.placeholder.com/500'"
                        >
                    </div>
                    
                    <div class="mb-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-1">پیراهن مردانه طرح کلاسیک</h3>
                        <div class="flex items-center text-amber-400 mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star text-gray-300"></i>
                            <span class="text-sm text-gray-500 mr-2">(۴.۰)</span>
                        </div>
                        <span class="text-xl font-bold text-primary-600">۳۲۰,۰۰۰ تومان</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <div class="flex space-x-1">
                            <span class="w-5 h-5 rounded-full bg-gray-900 border border-gray-300"></span>
                            <span class="w-5 h-5 rounded-full bg-gray-500 border border-gray-300"></span>
                            <span class="w-5 h-5 rounded-full bg-gray-200 border border-gray-300"></span>
                        </div>
                        
                        <button class="bg-gradient-to-r from-primary-500 to-emerald-500 text-white font-medium py-2 px-4 rounded-full hover:from-primary-600 hover:to-emerald-600 transition-all duration-300 hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                            <i class="fas fa-shopping-cart ml-2"></i>
                            افزودن به سبد
                        </button>
                    </div>
                </div>
                
                <!-- Product 3 -->
                <div class="flex-shrink-0 w-72 bg-white/5 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/10 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                    <div class="relative overflow-hidden rounded-xl mb-5">
                        <div class="absolute top-4 left-4 z-10">
                            <span class="bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                                %۲۲ تخفیف
                            </span>
                        </div>
                        <div class="absolute top-4 right-4 z-10">
                            <button class="w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center text-gray-500 hover:text-red-500 transition-colors">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <img 
                            src="assets\images\wpants.jpg" 
                            alt="شلوار جین زنانه"
                            class="w-full h-60 object-cover rounded-xl transition-transform duration-500 hover:scale-105"
                            onerror="this.src='https://via.placeholder.com/500'"
                        >
                    </div>
                    
                    <div class="mb-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-1">شلوار جین زنانه اسلیم فیت</h3>
                        <div class="flex items-center text-amber-400 mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <span class="text-sm text-gray-500 mr-2">(۵.۰)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-xl font-bold text-primary-600">۱۸۰,۰۰۰ تومان</span>
                            <span class="text-sm text-gray-400 line-through mr-2">۲۳۰,۰۰۰ تومان</span>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <div class="flex space-x-1">
                            <span class="w-5 h-5 rounded-full bg-gray-900 border border-gray-300"></span>
                            <span class="w-5 h-5 rounded-full bg-gray-400 border border-gray-300"></span>
                            <span class="w-5 h-5 rounded-full bg-red-300 border border-gray-300"></span>
                        </div>
                        
                        <button class="bg-gradient-to-r from-primary-500 to-emerald-500 text-white font-medium py-2 px-4 rounded-full hover:from-primary-600 hover:to-emerald-600 transition-all duration-300 hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                            <i class="fas fa-shopping-cart ml-2"></i>
                            افزودن به سبد
                        </button>
                    </div>
                </div>
                
                <!-- Product 4 -->
                <div class="flex-shrink-0 w-72 bg-white/5 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-white/10 transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                    <div class="relative overflow-hidden rounded-xl mb-5">
                        <div class="absolute top-4 left-4 z-10">
                            <span class="bg-green-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                                ویژه
                            </span>
                        </div>
                        <div class="absolute top-4 right-4 z-10">
                            <button class="w-10 h-10 rounded-full bg-white shadow-md flex items-center justify-center text-red-500">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                        <img 
                            src="assets\images\sportShoes.jpg" 
                            alt="کفش اسپورت مردانه"
                            class="w-full h-60 object-cover rounded-xl transition-transform duration-500 hover:scale-105"
                            onerror="this.src='https://via.placeholder.com/500'"
                        >
                    </div>
                    
                    <div class="mb-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-1">کفش اسپورت مردانه</h3>
                        <div class="flex items-center text-amber-400 mb-2">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                            <i class="far fa-star text-gray-300"></i>
                            <span class="text-sm text-gray-500 mr-2">(۳.۵)</span>
                        </div>
                        <span class="text-xl font-bold text-primary-600">۲۹۰,۰۰۰ تومان</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <div class="flex space-x-1">
                            <span class="w-5 h-5 rounded-full bg-gray-900 border border-gray-300"></span>
                            <span class="w-5 h-5 rounded-full bg-red-600 border border-gray-300"></span>
                            <span class="w-5 h-5 rounded-full bg-orange-500 border border-gray-300"></span>
                        </div>
                        
                        <button class="bg-gradient-to-r from-primary-500 to-emerald-500 text-white font-medium py-2 px-4 rounded-full hover:from-primary-600 hover:to-emerald-600 transition-all duration-300 hover:-translate-y-0.5 shadow-md hover:shadow-lg">
                            <i class="fas fa-shopping-cart ml-2"></i>
                            افزودن به سبد
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- دکمه مشاهده همه محصولات -->
            <div class="text-center mt-12">
                <button class="px-8 py-3 bg-gradient-to-r from-primary-500 to-emerald-500 text-white font-bold rounded-full hover:from-primary-600 hover:to-emerald-600 transition-all shadow-lg hover:shadow-xl">
                    مشاهده همه محصولات
                    <i class="fas fa-arrow-left mr-2"></i>
                </button>
            </div>
        </div>
    </section>
</body>
</html>