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
echo '<!-- StylePreferences loaded -->';
function renderStylePreferences() {
    echo '<!-- renderStylePreferences called -->';
    // گزینه‌ها استاتیک برای نمایش
    $preferences = [
        ['id' => 1, 'name' => 'کژوال', 'icon' => '👕'],
        ['id' => 2, 'name' => 'رسمی', 'icon' => '👔'],
        ['id' => 3, 'name' => 'اسپرت', 'icon' => '👟'],
        ['id' => 4, 'name' => 'مینیمال', 'icon' => '🎯'],
        ['id' => 5, 'name' => 'بوتیک/خاص', 'icon' => '💎'],
        ['id' => 6, 'name' => 'کلاسیک', 'icon' => '🎩'],
        ['id' => 7, 'name' => 'ویندج', 'icon' => '🌺'],
        ['id' => 8, 'name' => 'خیابانی', 'icon' => '🛹']
    ];

    // رنگ‌های تک با دکمه مستقل
    $colors = [
        ['id' => 1,  'hex_code' => '#FF3B30', 'color_name' => 'قرمز',     'text_color' => 'white'],
        ['id' => 2,  'hex_code' => '#1E90FF', 'color_name' => 'آبی',      'text_color' => 'white'],
        ['id' => 3,  'hex_code' => '#FFCF2F', 'color_name' => 'زرد',      'text_color' => 'black'],
        ['id' => 4,  'hex_code' => '#00C853', 'color_name' => 'سبز',      'text_color' => 'white'],
        ['id' => 5,  'hex_code' => '#7C4DFF', 'color_name' => 'بنفش',     'text_color' => 'white'],
        ['id' => 6,  'hex_code' => '#ECEFF1', 'color_name' => 'خاکستری',  'text_color' => 'black'],
        ['id' => 7,  'hex_code' => '#FF7A18', 'color_name' => 'نارنجی',   'text_color' => 'black'],
        ['id' => 8,  'hex_code' => '#FF2D95', 'color_name' => 'صورتی',    'text_color' => 'white'],
        ['id' => 9,  'hex_code' => '#222D5A', 'color_name' => 'سرمه ایی',     'text_color' => 'white'],
        ['id' => 10, 'hex_code' => '#0B0F14', 'color_name' => 'مشکی',     'text_color' => 'white'],
        ['id' => 11, 'hex_code' => '#FFFFFF', 'color_name' => 'سفید',     'text_color' => 'black', 'border' => '#E5E7EB'],
        ['id' => 12, 'hex_code' => '#E6B422', 'color_name' => 'طلایی',    'text_color' => 'black'],
        ['id' => 13, 'hex_code' => '#D0D6DB', 'color_name' => 'نقره‌ای',  'text_color' => 'black'],
        ['id' => 14, 'hex_code' => '#8B4513', 'color_name' => 'قهوه‌ای',  'text_color' => 'white']
    ];
    
    
    ?>
    <div class="max-w-4xl mx-auto p-5 bg-gradient-to-br from-amber-50/50 to-emerald-50/40 rounded-xl shadow-lg backdrop-blur-sm">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold mb-2 text-emerald-800 bg-gradient-to-r from-emerald-700 to-amber-600 bg-clip-text text-transparent">ترجیحات استایلی شما</h2>
            <div class="w-20 h-1 bg-gradient-to-r from-emerald-500 to-amber-300 mx-auto rounded-full mb-3"></div>
            <p class="text-emerald-700/90 max-w-2xl mx-auto text-sm">لطفاً سلیقه و ترجیحات استایل خود را انتخاب کنید تا پیشنهادات شخصی‌سازی شده دریافت نمایید</p>
        </div>

        <form id="stylePreferencesForm" method="POST" action="#" class="space-y-6">
            <!-- بخش سبک لباس -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl p-5 border border-emerald-200 shadow-sm">
                <div class="flex items-center gap-2 mb-4">
                    <div class="bg-gradient-to-br from-emerald-200 to-emerald-100 w-8 h-8 rounded-full flex items-center justify-center shadow-inner">
                        <i class="fas fa-tshirt text-emerald-700 text-sm"></i>
                    </div>
                    <h3 class="text-lg font-bold text-emerald-800">سبک لباس مورد علاقه</h3>
                </div>
                <p class="text-emerald-700/80 mb-4 pl-1 text-sm">می‌توانید چند گزینه را انتخاب کنید</p>
                
                <div class="grid grid-cols-4 md:grid-cols-8 gap-3">
                    <?php foreach ($preferences as $pref): ?>
                        <label class="flex flex-col items-center p-3 border-2 border-emerald-100 rounded-xl cursor-pointer transition-all duration-300 bg-gradient-to-b from-white to-emerald-50 hover:border-emerald-300 group hover:shadow-md peer-checked:border-emerald-400">
                            <input type="checkbox" name="clothing_prefs[]" value="<?= htmlspecialchars($pref['id']) ?>" class="hidden peer" />
                            <div class="text-2xl mb-1 text-gray-500 group-hover:text-emerald-500 peer-checked:text-emerald-600 transition-colors">
                                <?= htmlspecialchars($pref['icon']) ?>
                            </div>
                            <span class="text-xs text-gray-700 peer-checked:text-emerald-700 peer-checked:font-semibold transition-all">
                                <?= htmlspecialchars($pref['name']) ?>
                            </span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- بخش رنگ‌های مورد علاقه -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl p-5 border border-amber-200 shadow-sm">
                <div class="flex items-center gap-2 mb-4">
                    <div class="bg-gradient-to-br from-amber-200 to-amber-100 w-8 h-8 rounded-full flex items-center justify-center shadow-inner">
                        <i class="fas fa-palette text-amber-700 text-sm"></i>
                    </div>
                    <h3 class="text-lg font-bold text-amber-800">رنگ‌های مورد علاقه</h3>
                </div>
                <p class="text-amber-700/80 mb-4 pl-1 text-sm">رنگ‌هایی که بیشتر دوست دارید بپوشید</p>
                
                <div class="grid grid-cols-5 sm:grid-cols-7 md:grid-cols-8 gap-3">
                    <?php foreach ($colors as $color): ?>
                        <label class="relative flex flex-col items-center group">
                            <input type="checkbox" name="fav_colors[]" value="<?= htmlspecialchars($color['id']) ?>" class="hidden peer" />
                            
                            <!-- دایره رنگی -->
                            <div class="w-7 h-7 rounded-full mb-1 shadow flex items-center justify-center transition-all duration-300 group-hover:scale-110 group-hover:shadow-md"
                                style="background-color: <?= htmlspecialchars($color['hex_code']) ?>;
                                    <?= isset($color['border']) ? "border: 2px solid {$color['border']}" : '' ?>">
                                
                                <!-- نشان انتخاب -->
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 peer-checked:opacity-100 transition-opacity">
                                    <div class="bg-black/20 w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fas fa-check text-white text-2xs"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <span class="text-2xs text-gray-700 peer-checked:font-semibold peer-checked:text-amber-700">
                                <?= htmlspecialchars($color['color_name']) ?>
                            </span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- بخش رنگ‌های ناخواسته -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl p-5 border border-rose-200 shadow-sm">
                <div class="flex items-center gap-2 mb-4">
                    <div class="bg-gradient-to-br from-rose-200 to-rose-100 w-8 h-8 rounded-full flex items-center justify-center shadow-inner">
                        <i class="fas fa-ban text-rose-700 text-sm"></i>
                    </div>
                    <h3 class="text-lg font-bold text-rose-800">رنگ‌هایی که نمی‌پسندید</h3>
                </div>
                <p class="text-rose-700/80 mb-4 pl-1 text-sm">رنگ‌هایی که مایل به پوشیدن آنها نیستید</p>
                
                <div class="grid grid-cols-5 sm:grid-cols-7 md:grid-cols-8 gap-3">
                    <?php foreach ($colors as $color): ?>
                        <label class="relative flex flex-col items-center group">
                            <input type="checkbox" name="avoid_colors[]" value="<?= htmlspecialchars($color['id']) ?>" class="hidden peer" />
                            
                            <!-- دایره رنگی -->
                            <div class="w-7 h-7 rounded-full mb-1 shadow flex items-center justify-center transition-all duration-300 group-hover:scale-110 group-hover:shadow-md"
                                style="background-color: <?= htmlspecialchars($color['hex_code']) ?>;
                                    <?= isset($color['border']) ? "border: 2px solid {$color['border']}" : '' ?>">
                                
                                <!-- نشان عدم انتخاب -->
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 peer-checked:opacity-100 transition-opacity">
                                    <div class="bg-black/20 w-5 h-5 rounded-full flex items-center justify-center">
                                        <i class="fas fa-times text-white text-2xs"></i>
                                    </div>
                                </div>
                            </div>
                            
                            <span class="text-2xs text-gray-700 peer-checked:font-semibold peer-checked:text-rose-700">
                                <?= htmlspecialchars($color['color_name']) ?>
                            </span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- بخش جنس پارچه -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl p-5 border border-blue-200 shadow-sm">
                <div class="flex items-center gap-2 mb-4">
                    <div class="bg-gradient-to-br from-blue-200 to-blue-100 w-8 h-8 rounded-full flex items-center justify-center shadow-inner">
                        <i class="fas fa-tshirt text-blue-700 text-sm"></i>
                    </div>
                    <h3 class="text-lg font-bold text-blue-800">جنس مورد علاقه</h3>
                </div>
                <p class="text-blue-700/80 mb-4 pl-1 text-sm">جنس پارچه‌هایی که راحت‌تر هستید</p>
                
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <label class="flex flex-col items-center p-3 border-2 border-emerald-100 rounded-lg cursor-pointer hover:border-emerald-300 transition-all bg-gradient-to-b from-white to-emerald-50 peer-checked:border-emerald-400">
                        <input type="checkbox" name="fabric_prefs[]" value="cotton" class="hidden peer" />
                        <i class="fas fa-leaf text-xl text-emerald-500 mb-1"></i>
                        <span class="text-xs text-center text-gray-700 peer-checked:text-emerald-700">پنبه / کتان</span>
                    </label>
                    
                    <label class="flex flex-col items-center p-3 border-2 border-amber-100 rounded-lg cursor-pointer hover:border-amber-300 transition-all bg-gradient-to-b from-white to-amber-50 peer-checked:border-amber-400">
                        <input type="checkbox" name="fabric_prefs[]" value="wool" class="hidden peer" />
                        <i class="fas fa-cloud text-xl text-amber-500 mb-1"></i>
                        <span class="text-xs text-center text-gray-700 peer-checked:text-amber-700">پشم / کشمیر</span>
                    </label>
                    
                    <label class="flex flex-col items-center p-3 border-2 border-blue-100 rounded-lg cursor-pointer hover:border-blue-300 transition-all bg-gradient-to-b from-white to-blue-50 peer-checked:border-blue-400">
                        <input type="checkbox" name="fabric_prefs[]" value="silk" class="hidden peer" />
                        <i class="fas fa-feather-alt text-xl text-blue-500 mb-1"></i>
                        <span class="text-xs text-center text-gray-700 peer-checked:text-blue-700">ابریشم / ساتن</span>
                    </label>
                    
                    <label class="flex flex-col items-center p-3 border-2 border-purple-100 rounded-lg cursor-pointer hover:border-purple-300 transition-all bg-gradient-to-b from-white to-purple-50 peer-checked:border-purple-400">
                        <input type="checkbox" name="fabric_prefs[]" value="synthetic" class="hidden peer" />
                        <i class="fas fa-atom text-xl text-purple-500 mb-1"></i>
                        <span class="text-xs text-center text-gray-700 peer-checked:text-purple-700">صنعتی / مصنوعی</span>
                    </label>
                </div>
            </div>
            <!-- دکمه ارسال -->
            <div class="text-center pt-6">
                <a href="http://localhost:86/src/pages/ai-suggestions/" class="relative inline-flex items-center px-8 py-4 bg-gradient-to-r from-emerald-600 to-emerald-800 text-white rounded-full font-bold transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 group overflow-hidden">
                    <span class="absolute inset-0 bg-gradient-to-r from-amber-500 to-amber-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    <span class="relative z-10">
                        <i class="fas fa-robot mr-2"></i> دریافت پیشنهادات هوشمند
                    </span>
                </a>
                <p class="text-emerald-700/80 text-sm mt-4 max-w-md mx-auto font-medium">پس از ذخیره ترجیحات، سیستم هوش مصنوعی لباس‌های مناسب شما را پیشنهاد خواهد داد</p>
            </div>
        </form>
    </div>

    <script>
        (function () {
            const form = document.getElementById('stylePreferencesForm');
            if (!form) return;

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                
                // جمع‌آوری داده‌ها برای نمایش در کنسول
                const formData = new FormData(form);
                const data = {
                    clothing_prefs: formData.getAll('clothing_prefs[]'),
                    fav_colors: formData.getAll('fav_colors[]'),
                    avoid_colors: formData.getAll('avoid_colors[]'),
                    fabric_prefs: formData.getAll('fabric_prefs[]')
                };
                
                console.log('داده‌های ترجیحات:', data);
                
                // شبیه‌سازی بارگیری
                const button = form.querySelector('button[type="submit"]');
                const originalContent = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> در حال پردازش...';
                button.disabled = true;
                
                // شبیه‌سازی تاخیر برای ارسال داده‌ها
                setTimeout(() => {
                    button.innerHTML = originalContent;
                    button.disabled = false;
                    
                    // هدایت به صفحه گزارش
                    window.location.href = '?page=body-profile&subpage=report';
                }, 10000);
            });
        })();
    </script>
    <?php
}
?>