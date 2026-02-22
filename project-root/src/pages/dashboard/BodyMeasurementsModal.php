<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پروفایل بدنی - ویرایش حرفه‌ای</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'emerald': {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                        },
                        'amber': {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;200;300;400;500;600;700;800;900&display=swap');
        
        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: #f0fdf4;
        }
        
        .input-container {
            position: relative;
        }
        
        .input-field {
            width: 100%;
            border: 2px solid #d1fae5;
            border-radius: 10px;
            padding: 10px 14px;
            background-color: white;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }
        
        .input-field:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.3);
        }
        
        .unit-label {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            color: #047857;
            font-weight: 500;
            pointer-events: none;
            font-size: 0.85rem;
        }
        
        .select-container {
            position: relative;
        }
        
        .select-field {
            width: 100%;
            border: 2px solid #d1fae5;
            border-radius: 10px;
            padding: 10px 36px 10px 14px;
            background-color: white;
            appearance: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }
        
        .select-field:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.3);
        }
        
        .select-icon {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            pointer-events: none;
            color: #059669;
            font-size: 0.9rem;
        }
        
        .radio-card {
            transition: all 0.3s ease;
        }
        
        .radio-card:hover {
            border-color: #34d399;
        }
        
        .radio-card.selected {
            border-color: #10b981;
            background-color: #ecfdf5;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }
        
        .skin-tone-option {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .skin-tone-option:hover {
            transform: scale(1.1);
        }
        
        .submit-btn {
            transition: all 0.3s ease;
        }
        
        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(5, 150, 105, 0.4);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-amber-50 to-emerald-50 min-h-screen py-6">
<?php
function renderBodyMeasurements() {
?>
    <div class="max-w-2xl mx-auto px-4">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold mb-3 bg-gradient-to-r from-emerald-700 to-amber-600 bg-clip-text text-transparent">پروفایل بدنی شما</h1>
            <div class="w-24 h-1 bg-gradient-to-r from-emerald-500 to-amber-300 mx-auto rounded-full mb-4"></div>
            <p class="text-emerald-700/80 font-medium">اندازه‌های دقیق بدنی خود را وارد کنید تا پیشنهادات شخصی‌سازی شده دریافت نمایید</p>
        </div>

        <div class="bg-white rounded-xl p-6 border border-emerald-200 shadow-md">
            <form id="bodyMeasurementsForm" class="space-y-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <!-- بخش جنسیت -->
                    <div>
                        <label class="block mb-2 font-medium text-emerald-800 flex items-center gap-2">
                            <i class="fas fa-venus-mars text-emerald-600"></i> جنسیت
                        </label>
                        <div class="select-container">
                            <select name="gender_id" class="select-field" required>
                                <option value="">انتخاب کنید</option>
                                <option value="female">زن</option>
                                <option value="male" selected>مرد</option>
                                <option value="other">سایر</option>
                            </select>
                            <i class="fas fa-chevron-down select-icon"></i>
                        </div>
                    </div>

                    <!-- بخش سن -->
                    <div>
                        <label class="block mb-2 font-medium text-emerald-800 flex items-center gap-2">
                            <i class="fas fa-birthday-cake text-amber-600"></i> سن
                        </label>
                        <div class="input-container">
                            <input type="number" name="age" class="input-field" min="10" max="100" value="20" required>
                            <span class="unit-label">سال</span>
                        </div>
                    </div>

                    <!-- بخش قد -->
                    <div>
                        <label class="block mb-2 font-medium text-emerald-800 flex items-center gap-2">
                            <i class="fas fa-ruler-vertical text-emerald-600"></i> قد
                        </label>
                        <div class="input-container">
                            <input type="number" name="height" class="input-field" step="0.1" value="175" required>
                            <span class="unit-label">سانتی‌متر</span>
                        </div>
                    </div>

                    <!-- بخش وزن -->
                    <div>
                        <label class="block mb-2 font-medium text-emerald-800 flex items-center gap-2">
                            <i class="fas fa-weight-scale text-amber-600"></i> وزن
                        </label>
                        <div class="input-container">
                            <input type="number" name="weight" class="input-field" step="0.1" value="68" required>
                            <span class="unit-label">کیلوگرم</span>
                        </div>
                    </div>

                    <!-- بخش اندازه‌های بدن -->
                    <div>
                        <label class="block mb-2 font-medium text-emerald-800 flex items-center gap-2">
                            <i class="fas fa-ruler-combined text-blue-500"></i> عرض شانه
                        </label>
                        <div class="input-container">
                            <input type="number" name="shoulder_width" class="input-field" step="0.1" value="42">
                            <span class="unit-label">سانتی‌متر</span>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block mb-2 font-medium text-emerald-800 flex items-center gap-2">
                            <i class="fas fa-ruler-combined text-pink-500"></i> دور سینه
                        </label>
                        <div class="input-container">
                            <input type="number" name="chest_circumference" class="input-field" step="0.1" value="95">
                            <span class="unit-label">سانتی‌متر</span>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block mb-2 font-medium text-emerald-800 flex items-center gap-2">
                            <i class="fas fa-ruler-combined text-emerald-500"></i> دور کمر
                        </label>
                        <div class="input-container">
                            <input type="number" name="waist_circumference" class="input-field" step="0.1" value="80">
                            <span class="unit-label">سانتی‌متر</span>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block mb-2 font-medium text-emerald-800 flex items-center gap-2">
                            <i class="fas fa-ruler-combined text-purple-500"></i> دور باسن
                        </label>
                        <div class="input-container">
                            <input type="number" name="hip_circumference" class="input-field" step="0.1" value="98">
                            <span class="unit-label">سانتی‌متر</span>
                        </div>
                    </div>
                </div>

                <!-- بخش سایز بدن -->
                <div>
                    <label class="block mb-2 font-medium text-emerald-800 flex items-center gap-2">
                        <i class="fas fa-tshirt text-emerald-600"></i> سایز بدن
                    </label>
                    <div class="flex flex-wrap gap-3">
                        <label class="flex-1 min-w-[60px]">
                            <input type="radio" name="body_size" value="XS" class="hidden" onchange="updateCardSelection(this)">
                            <div class="radio-card text-center p-3 border-2 border-emerald-100 rounded-xl cursor-pointer transition-colors">
                                XS
                            </div>
                        </label>
                        <label class="flex-1 min-w-[60px]">
                            <input type="radio" name="body_size" value="S" class="hidden" onchange="updateCardSelection(this)">
                            <div class="radio-card text-center p-3 border-2 border-emerald-100 rounded-xl cursor-pointer transition-colors">
                                S
                            </div>
                        </label>
                        <label class="flex-1 min-w-[60px]">
                            <input type="radio" name="body_size" value="M" class="hidden" checked onchange="updateCardSelection(this)">
                            <div class="radio-card text-center p-3 border-2 border-emerald-100 rounded-xl cursor-pointer transition-colors selected">
                                M
                            </div>
                        </label>
                        <label class="flex-1 min-w-[60px]">
                            <input type="radio" name="body_size" value="L" class="hidden" onchange="updateCardSelection(this)">
                            <div class="radio-card text-center p-3 border-2 border-emerald-100 rounded-xl cursor-pointer transition-colors">
                                L
                            </div>
                        </label>
                        <label class="flex-1 min-w-[60px]">
                            <input type="radio" name="body_size" value="XL" class="hidden" onchange="updateCardSelection(this)">
                            <div class="radio-card text-center p-3 border-2 border-emerald-100 rounded-xl cursor-pointer transition-colors">
                                XL
                            </div>
                        </label>
                    </div>
                </div>

                <!-- بخش شکل بدن -->
                <div>
    <label class="block mb-2 font-medium text-emerald-800 flex items-center gap-2">
        <i class="fas fa-person text-amber-600"></i> شکل بدن
    </label>
    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-3">
        <!-- ساعت شنی -->
        <label class="radio-card flex flex-col items-center p-3 border-2 border-emerald-100 rounded-xl cursor-pointer transition-colors">
            <input type="radio" name="body_shape" value="hourglass" class="hidden" onchange="updateCardSelection(this)">
            <i class="fas fa-hourglass-half text-2xl mb-2 text-pink-500"></i>
            <span class="text-gray-700">ساعت شنی</span>
        </label>

        <!-- مستطیلی -->
        <label class="radio-card flex flex-col items-center p-3 border-2 border-emerald-100 rounded-xl cursor-pointer transition-colors">
            <input type="radio" name="body_shape" value="rectangle" class="hidden" onchange="updateCardSelection(this)">
            <i class="fas fa-square text-2xl mb-2 text-blue-500"></i>
            <span class="text-gray-700">مستطیلی</span>
        </label>

        <!-- گلابی -->
        <label class="radio-card flex flex-col items-center p-3 border-2 border-emerald-100 rounded-xl cursor-pointer transition-colors">
            <input type="radio" name="body_shape" value="pear" class="hidden" onchange="updateCardSelection(this)">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/81/Emojione_1F350.svg/512px-Emojione_1F350.svg.png" alt="گلابی" class="w-8 h-8 mb-2">
            <span class="text-gray-700">گلابی</span>
        </label>

        <!-- سیب -->
        <label class="radio-card flex flex-col items-center p-3 border-2 border-emerald-100 rounded-xl cursor-pointer transition-colors">
            <input type="radio" name="body_shape" value="apple" class="hidden" onchange="updateCardSelection(this)">
            <i class="fas fa-apple-whole text-2xl mb-2 text-amber-500"></i>
            <span class="text-gray-700">سیب</span>
        </label>

        <!-- ورزشی -->
        <label class="radio-card flex flex-col items-center p-3 border-2 border-emerald-100 rounded-xl cursor-pointer transition-colors">
            <input type="radio" name="body_shape" value="athletic" class="hidden" onchange="updateCardSelection(this)">
            <i class="fas fa-dumbbell text-2xl mb-2 text-purple-500"></i>
            <span class="text-gray-700">ورزشی</span>
        </label>

        <!-- مثلث وارونه -->
        <label class="radio-card flex flex-col items-center p-3 border-2 border-emerald-100 rounded-xl cursor-pointer transition-colors">
            <input type="radio" name="body_shape" value="inverted_triangle" class="hidden" onchange="updateCardSelection(this)">
            <div class="rotate-180">
                <i class="fas fa-play rotate-90 text-2xl mb-2 text-red-500"></i>
            </div>
            <span class="text-gray-700">مثلث وارونه</span>
        </label>

        <!-- ریزنقش / کوچک -->
        <label class="radio-card flex flex-col items-center p-3 border-2 border-emerald-100 rounded-xl cursor-pointer transition-colors">
            <input type="radio" name="body_shape" value="petite" class="hidden" onchange="updateCardSelection(this)">
            <i class="fas fa-child text-2xl mb-2 text-pink-400"></i>
            <span class="text-gray-700">ریز/کوچک</span>
        </label>

        <!-- شکل V -->
        <label class="radio-card flex flex-col items-center p-3 border-2 border-emerald-100 rounded-xl cursor-pointer transition-colors">
            <input type="radio" name="body_shape" value="v_shape" class="hidden" onchange="updateCardSelection(this)">
            <i class="fas fa-v text-2xl mb-2 text-blue-700"></i>
            <span class="text-gray-700">شکل V</span>
        </label>
    </div>
</div>

                <!-- بخش سایز کفش -->
                <div>
                    <label class="block mb-2 font-medium text-emerald-800 flex items-center gap-2">
                        <i class="fas fa-shoe-prints text-purple-500"></i> سایز کفش
                    </label>
                    <input type="text" name="shoe_size" class="input-field" value="40">
                </div>

                <!-- بخش رنگ پوست -->
                <div>
                    <label class="block mb-2 font-medium text-emerald-800 flex items-center gap-2">
                        <i class="fas fa-palette text-amber-600"></i> رنگ پوست
                    </label>
                    <div class="flex flex-wrap gap-4 items-center">
                        <label class="flex flex-col items-center">
                            <input type="radio" name="skin_tone" value="fair" class="hidden" onchange="updateSkinTone(this)">
                            <div class="skin-tone-option w-10 h-10 rounded-full mb-1 shadow-md"
                                style="background-color: #f5d0c4; border: 2px solid #e5e7eb">
                            </div>
                            <span class="text-xs text-gray-700">روشن</span>
                        </label>
                        <label class="flex flex-col items-center">
                            <input type="radio" name="skin_tone" value="light" class="hidden" onchange="updateSkinTone(this)">
                            <div class="skin-tone-option w-10 h-10 rounded-full mb-1 shadow-md"
                                style="background-color: #e3bc9a; border: 2px solid #e5e7eb">
                            </div>
                            <span class="text-xs text-gray-700">کمرنگ</span>
                        </label>
                        <label class="flex flex-col items-center">
                            <input type="radio" name="skin_tone" value="medium" class="hidden" checked onchange="updateSkinTone(this)">
                            <div class="skin-tone-option w-10 h-10 rounded-full mb-1 shadow-md"
                                style="background-color: #d2a679; border: 2px solid #10b981">
                            </div>
                            <span class="text-xs font-semibold text-emerald-700">متوسط</span>
                        </label>
                        <label class="flex flex-col items-center">
                            <input type="radio" name="skin_tone" value="dark" class="hidden" onchange="updateSkinTone(this)">
                            <div class="skin-tone-option w-10 h-10 rounded-full mb-1 shadow-md"
                                style="background-color: #b78b61; border: 2px solid #e5e7eb">
                            </div>
                            <span class="text-xs text-gray-700">تیره</span>
                        </label>
                    </div>
                </div>

                <!-- دکمه ارسال -->
                <div class="text-center pt-4">
                <button type="submit" class="relative inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-600 to-emerald-800 text-white rounded-full font-bold transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 group overflow-hidden text-sm">
                    <span class="absolute inset-0 bg-gradient-to-r from-amber-500 to-amber-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    <span class="relative z-10">
                        <i class="fas fa-save ml-1"></i> ذخیره تغییرات
                    </span>
                </button>
                <p class="text-emerald-700/80 text-xs mt-3 max-w-md mx-auto">پس از ذخیره اطلاعات، می‌توانید از پیشنهادات شخصی‌سازی شده استفاده کنید</p>
            </div>
            </form>
        </div>
    </div>

    <script>
         document.getElementById('stylePreferencesForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('تغییرات با موفقیت ذخیره شد!');
        });
    function updateCardSelection(radio) {
        // حذف کلاس selected از تمامی کارت‌ها
        const allCards = document.querySelectorAll('.radio-card');
        allCards.forEach(card => card.classList.remove('selected'));
        
        // افزودن کلاس selected به کارت انتخاب شده
        const parent = radio.closest('.radio-card') || radio.closest('label');
        if (parent) {
            parent.classList.add('selected');
        }
    }
    
    function updateSkinTone(radio) {
        // حذف هایلایت از تمامی گزینه‌ها
        const allOptions = document.querySelectorAll('.skin-tone-option');
        allOptions.forEach(option => {
            option.style.border = '2px solid #e5e7eb';
        });
        
        // هایلایت کردن گزینه انتخاب شده
        const selectedOption = radio.nextElementSibling;
        if (selectedOption) {
            selectedOption.style.border = '2px solid #10b981';
        }
        
        // بروزرسانی متن
        const allSpans = document.querySelectorAll('.skin-tone-option + span');
        allSpans.forEach(span => {
            span.classList.remove('font-semibold', 'text-emerald-700');
            span.classList.add('text-gray-700');
        });
        
        const selectedSpan = selectedOption.nextElementSibling;
        if (selectedSpan) {
            selectedSpan.classList.add('font-semibold', 'text-emerald-700');
            selectedSpan.classList.remove('text-gray-700');
        }
    }
    
    </script>
<?php
}
?>
<?php
renderBodyMeasurements()
?>
</body>
</html>