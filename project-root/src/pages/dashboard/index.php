<?php
session_start();
require_once '../../../config/db_connection.php'; // فایل کلاس Database

// بررسی وضعیت لاگین بودن
$isLoggedIn = isset($_SESSION['user_id']); 

// مقدار پیش‌فرض برای کاربران لاگین نکرده
$first_name = 'تکمیل پروفایل';
$userAvatar = 'http://localhost:86/public/assets/avatars/avatar.png';

if ($isLoggedIn) {
    $userId = $_SESSION['user_id'];

    // گرفتن اطلاعات کاربر از جدول user_profiles
    $conn = Database::getInstance();
    $stmt = $conn->prepare("SELECT first_name, avatar_url FROM user_profiles WHERE user_id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    // ذخیره در سشن
    $_SESSION['first_name'] = $user['first_name'] ?? $first_name;
    $_SESSION['user_avatar'] = $user['avatar_url'] ?? $userAvatar;

    // مقداردهی متغیرها برای هدر
    $first_name = $_SESSION['first_name'];
    $userAvatar = $_SESSION['user_avatar'];
}


// اگر کاربر لاگین نکرده باشد، به صفحه لاگین هدایت شود
if (!$isLoggedIn) {
    header('Location: /login.php');
    exit();
}

$userId = $_SESSION['user_id'];
$conn = Database::getInstance();

// گرفتن اطلاعات کاربر
$stmt = $conn->prepare("
    SELECT u.*, up.first_name, up.last_name, up.avatar_url, up.gender_id, up.birth_date,
           g.gender as gender_name
    FROM users u
    LEFT JOIN user_profiles up ON u.id = up.user_id
    LEFT JOIN gender_types g ON up.gender_id = g.id
    WHERE u.id = ?
");
$stmt->execute([$userId]);
$user = $stmt->fetch();

// ذخیره اطلاعات در سشن
$_SESSION['first_name'] = $user['first_name'] ?? 'تکمیل پروفایل';
$_SESSION['user_avatar'] = $user['avatar_url'] ?? 'http://localhost:86/public/assets/avatars/avatar.png';

// ذخیره اطلاعات در سشن
$_SESSION['first_name'] = $user['first_name'] ?? 'تکمیل پروفایل';
$_SESSION['user_avatar'] = $user['avatar_url'] ?? 'http://localhost:86/public/assets/avatars/avatar.png';

// گرفتن تمام پروفایل‌های بدنی کاربر
$bodyProfiles = [];
$stmt = $conn->prepare("SELECT * FROM body_profiles WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$userId]);
$bodyProfiles = $stmt->fetchAll();

// گرفتن تمام سلیقه‌های کاربر
$userPreferencesList = [];
$stmt = $conn->prepare("SELECT * FROM user_preferences WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$userId]);
$userPreferencesList = $stmt->fetchAll();

// آمارها
$stmt = $conn->prepare("SELECT COUNT(*) FROM body_profiles WHERE user_id = ?");
$stmt->execute([$userId]);
$bodyProfilesCount = intval($stmt->fetchColumn() ?: 0);

$stmt = $conn->prepare("SELECT COUNT(*) FROM user_preferences WHERE user_id = ?");
$stmt->execute([$userId]);
$preferencesCount = intval($stmt->fetchColumn() ?: 0);

$stmt = $conn->prepare("SELECT COUNT(*) FROM shipping_addresses WHERE user_id = ?");
$stmt->execute([$userId]);
$addressesCount = intval($stmt->fetchColumn() ?: 0);

$stmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE user_id = ?");
$stmt->execute([$userId]);
$ordersCount = intval($stmt->fetchColumn() ?: 0);

// سبد خرید
$stmt = $conn->prepare("SELECT id FROM carts WHERE user_id = ?");
$stmt->execute([$userId]);
$cartId = $stmt->fetchColumn();
if ($cartId) {
    $stmt = $conn->prepare("SELECT COALESCE(SUM(quantity),0) FROM cart_items WHERE cart_id = ?");
    $stmt->execute([$cartId]);
    $cartItemsCount = intval($stmt->fetchColumn() ?: 0);
} else {
    $cartItemsCount = 0;
}

// تعیین برچسب نقش کاربر
$roleLabel = 'کاربر عادی';
if ($user['role_id'] == 2) {
    $roleLabel = 'ادمین';
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل کاربری - سبک‌پرداز هوشمند</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#047857',
                        primaryLight: '#064E3B',
                        primaryDark: '#10B981',
                        accent: '#FBBF24',
                        lightBg: '#F9FAFB',
                        darkText: '#263238',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-lightBg text-darkText font-sans min-h-screen flex flex-col">
    <!-- هدر -->
    <?php require_once __DIR__ . '/../../components/layout/Header.php'; ?>

    <div class="flex flex-1 flex-col md:flex-row w-full mx-0">
        <!-- نوار کناری -->
        <div class="bg-gradient-to-b from-primaryDark to-primary text-white w-full md:w-64 p-4 flex flex-col h-full">
            <div class="text-center mb-6">
                <img 
                src="<?=!empty($userAvatar) ? htmlspecialchars($userAvatar) : 'http://localhost:86/public/assets/avatars/avatar.png'?>" 
                class="rounded-full border-4 border-white shadow-md w-24 h-24 mx-auto mb-3" 
                alt="پروفایل"
                onerror="this.onerror=null;this.src='/assets/images/avatars/avatar.png';"
                >
                <h5 class="mb-1"><?= htmlspecialchars($_SESSION['first_name']) ?></h5>
                <p class="text-white/80"><?= $roleLabel ?></p>
            </div>
            
            <nav class="space-y-2 flex-grow">
                <a href="#dashboard" class="flex items-center p-3 rounded hover:bg-white/10 active:bg-white/15">
                    <i class="fas fa-home ml-2"></i>
                    صفحه کاربری
                </a>
                <a href="#profile" class="flex items-center p-3 rounded hover:bg-white/10">
                    <i class="fas fa-user ml-2"></i>
                    پروفایل کاربری
                </a>
                <a href="#body_profiles" class="flex items-center p-3 rounded hover:bg-white/10">
                    <i class="fas fa-ruler-combined ml-2"></i>
                    نمایه های بدنی
                </a>
                <a href="#preferences_list" class="flex items-center p-3 rounded hover:bg-white/10">
                    <i class="fas fa-heart ml-2"></i>
                    ترجیحات سبک
                </a>
                <a href="/orders.php" class="flex items-center p-3 rounded hover:bg-white/10">
                    <i class="fas fa-shopping-bag ml-2"></i>
                    سفارشات
                </a>
                <a href="/addresses.php" class="flex items-center p-3 rounded hover:bg-white/10">
                    <i class="fas fa-map-marker-alt ml-2"></i>
                    آدرس‌ها
                </a>
            </nav>
            
            <!-- بخش دکمه‌های خروج و سبد خرید در نوار کناری -->
            <div class="mt-auto pt-4 border-t border-white/20">
                <a href="/cart.php" class="flex items-center p-3 rounded hover:bg-white/10 text-white mb-2">
                    <i class="fas fa-shopping-cart ml-2"></i>
                    سبد خرید
                    <?php if ($cartItemsCount > 0): ?>
                        <span class="bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs mr-2">
                            <?= $cartItemsCount ?>
                        </span>
                    <?php endif; ?>
                </a>
                
                <form action="http://localhost:86/src/pages/login/" method="POST" class="w-full">
                    <button type="submit" class="flex items-center w-full p-3 rounded hover:bg-white/10 text-white text-right">
                        <i class="fas fa-sign-out-alt ml-2"></i>
                        خروج از حساب کاربری
                    </button>
                </form>
            </div>
        </div>
        
        <!-- محتوای اصلی -->
        <main class="flex-1 p-4 md:p-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                <h2 class="text-xl md:text-2xl font-bold mb-4 md:mb-0">داشبورد کاربری</h2>
                <div class="flex flex-wrap gap-2">
                    <button onclick="location.reload()" class="btn-outline-primary">
                        <i class="fas fa-sync-alt ml-1"></i>بروزرسانی
                    </button>
                </div>
            </div>
            
            <!-- آمار -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-lg p-4 text-center shadow">
                    <i class="fas fa-user text-primary text-3xl mb-3"></i>
                    <div class="text-2xl font-bold"><?= $bodyProfilesCount ?></div>
                    <div class="text-sm">نمایه های بدنی</div>
                </div>
                <div class="bg-white rounded-lg p-4 text-center shadow">
                    <i class="fas fa-heart text-primary text-3xl mb-3"></i>
                    <div class="text-2xl font-bold"><?= $preferencesCount ?></div>
                    <div class="text-sm">ترجیحات ثبت شده</div>
                </div>
                <div class="bg-white rounded-lg p-4 text-center shadow">
                    <i class="fas fa-map-marker-alt text-primary text-3xl mb-3"></i>
                    <div class="text-2xl font-bold"><?= $addressesCount ?></div>
                    <div class="text-sm">آدرس‌های ثبت شده</div>
                </div>
                <div class="bg-white rounded-lg p-4 text-center shadow">
                    <i class="fas fa-shopping-bag text-primary text-3xl mb-3"></i>
                    <div class="text-2xl font-bold"><?= $ordersCount ?></div>
                    <div class="text-sm">سفارشات انجام شده</div>
                </div>
            </div>
            
            <div class="grid md:grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- پروفایل کاربر -->
                <div id="profile" class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="bg-primary text-white p-4 flex justify-between items-center">
                        <span>نمایه کاربری</span>
                        <a href="/src/profile/edit.php" class="btn-outline-light text-sm">
                            <i class="fas fa-edit ml-1"></i>ویرایش
                        </a>
                    </div>
                    <div class="p-4">
                        <div class="text-center mb-4">
                        <img 
                            src="<?=!empty($userAvatar) ? htmlspecialchars($userAvatar) : 'http://localhost:86/public/assets/avatars/avatar.png'?>" 
                            class="rounded-full border-4 border-white shadow-md w-24 h-24 mx-auto mb-3" 
                            alt="پروفایل"
                            onerror="this.onerror=null;this.src='/assets/images/avatars/avatar.png';"
                        >
                            <h5 class="mt-3 mb-0"><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></h5>
                            <p class="text-gray-500"><?= $roleLabel ?></p>
                        </div>
                        
                        <div class="space-y-3">
                        <div class="flex justify-between flex-wrap border-b pb-2">
                        <span class="text-gray-500">پست الکترونیک:</span>
                        <span class="truncate max-w-[calc(100%-1px)] text-sm"><?= htmlspecialchars($user['email'] ?? '—') ?></span>
                        </div>

                            <div class="flex justify-between border-b pb-2">
                                <span class="text-gray-500">شماره موبایل:</span>
                                <span><?= htmlspecialchars($user['phone_number'] ?? '—') ?></span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span class="text-gray-500">جنسیت:</span>
                                <span><?= htmlspecialchars($user['gender_name'] ?? '—') ?></span>
                            </div>
                            <div class="flex justify-between border-b pb-2">
                                <span class="text-gray-500">تاریخ تولد:</span>
                                <span><?= isset($user['birth_date']) ? htmlspecialchars($user['birth_date']) : '—' ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- لیست پروفایل‌های بدنی -->
                <div class="bg-white rounded-lg shadow overflow-hidden lg:col-span-2" id="body_profiles">
                    <div class="bg-primary text-white p-4 flex justify-between items-center">
                        <span>نمایه های بدنی</span>
                        <a href="http://localhost:86/public/?page=body-profile" class="btn-outline-light text-sm">
                            <i class="fas fa-plus ml-1"></i>افزودن نمایه
                        </a>
                    </div>
                    <div class="p-4">
                        <?php if (count($bodyProfiles) === 0): ?>
                            <div class="text-center py-8 text-gray-500">
                                <i class="fas fa-ruler-combined text-4xl mb-3"></i>
                                <p>هنوز نمایه بدنی ثبت نکرده‌اید.</p>
                                <a href="http://localhost:86/public/?page=body-profile" class="btn-primary mt-4 inline-block">
                                    <i class="fas fa-plus ml-1"></i>افزودن نمایه بدنی
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <?php foreach ($bodyProfiles as $profile): ?>
                                    <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                                        <div class="flex justify-between items-start mb-3">
                                            <h4 class="font-semibold text-primaryDark"><?= htmlspecialchars($profile['title']) ?></h4>
                                            <div class="flex space-x-2 space-x-reverse">
                                                <a href="http://localhost:86/src/pages/dashboard/BodyMeasurementsModal.php?id=<?= $profile['id'] ?>" class="text-blue-500 hover:text-blue-700 open-modal">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="post" action="/body-profiles/delete.php" class="inline" onsubmit="return confirm('آیا مطمئن هستید؟');">
                                                    <input type="hidden" name="id" value="<?= $profile['id'] ?>">
                                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        
                                        <div class="space-y-2 text-sm">
                                            <?php if ($profile['height']): ?>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-500">قد:</span>
                                                    <span><?= htmlspecialchars($profile['height']) ?> سانتی‌متر</span>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <?php if ($profile['weight']): ?>
                                                <div class="flex justify-between">
                                                    <span class="text-gray-500">وزن:</span>
                                                    <span><?= htmlspecialchars($profile['weight']) ?> کیلوگرم</span>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <div class="flex justify-between">
                                                <span class="text-gray-500">سایز بدن:</span>
                                                <span><?= htmlspecialchars($profile['body_size'] ?? '—') ?></span>
                                            </div>
                                            
                                            <div class="flex justify-between">
                                                <span class="text-gray-500">سن:</span>
                                                <span><?= htmlspecialchars($profile['age'] ?? '—') ?></span>
                                            </div>
                                            
                                            <div class="flex justify-between">
                                                <span class="text-gray-500">عرض شانه:</span>
                                                <span><?= htmlspecialchars($profile['shoulder_width'] ?? '—') ?> سانتی‌متر</span>
                                            </div>

                                            <div class="flex justify-between">
                                                <span class="text-gray-500">دور سینه:</span>
                                                <span><?= htmlspecialchars($profile['chest_circumference'] ?? '—') ?> سانتی‌متر</span>
                                            </div>

                                            <div class="flex justify-between">
                                                <span class="text-gray-500">دور کمر:</span>
                                                <span><?= htmlspecialchars($profile['waist_circumference'] ?? '—') ?> سانتی‌متر</span>
                                            </div>

                                            <div class="flex justify-between">
                                                <span class="text-gray-500">دور باسن:</span>
                                                <span><?= htmlspecialchars($profile['hip_circumference'] ?? '—') ?> سانتی‌متر</span>
                                            </div>

                                            <div class="flex justify-between">
                                                <span class="text-gray-500">سایز بدن:</span>
                                                <span><?= htmlspecialchars($profile['body_size'] ?? '—') ?></span>
                                            </div>

                                            <?php
                                            $bodyShapes = [
                                                'Hourglass' => 'ساعت شنی',
                                                'Rectangle' => 'مستطیلی',
                                                'Pear' => 'گلابی',
                                                'Apple' => 'سیب',
                                                'Athletic' => 'ورزشی',
                                                'Inverted_triangle' => 'مثلث وارونه',
                                                'Petite' => 'ریز/کوچک',
                                                'V_shape' => 'شکل V'
                                            ];
                                            ?>
                                            <div class="flex justify-between">
                                                <span class="text-gray-500">شکل بدن:</span>
                                                <span><?= $bodyShapes[$profile['body_shape']] ?? '—' ?></span>
                                            </div>

                                            <div class="flex justify-between">
                                                <span class="text-gray-500">سایز کفش:</span>
                                                <span><?= htmlspecialchars($profile['shoe_size'] ?? '—') ?></span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-500">رنگ پوست:</span>
                                                <span>
                                                    <?php 
                                                    $skinTones = [
                                                        'light' => 'روشن',
                                                        'medium' => 'متوسط',
                                                        'dark' => 'تیره',
                                                        'neutral' => 'خنثی'
                                                    ];
                                                    echo $skinTones[$profile['skin_tone']] ?? '—';
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-3 pt-3 border-t text-xs text-gray-400">
                                            ایجاد شده در: <?= date('Y/m/d', strtotime($profile['created_at'])) ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- لیست ترجیحات سبک -->
            <div class="bg-white rounded-lg shadow overflow-hidden mt-6" id="preferences_list">
                <div class="bg-primary text-white p-4 flex justify-between items-center">
                    <span>ترجیحات سبک</span>
                    <a href="http://localhost:86/public/?page=body-profile" class="btn-outline-light text-sm">
                        <i class="fas fa-plus ml-1"></i>افزودن ترجیحات
                    </a>

                </div>
                <div class="p-4">
                    <?php if (count($userPreferencesList) === 0): ?>
                        <div class="text-center py-8 text-gray-500">
                            <i class="fas fa-heart text-4xl mb-3"></i>
                            <p>هنوز ترجیحات سبک ثبت نکرده‌اید.</p>
                            <a href="http://localhost:86/public/?page=body-profile" class="btn-primary mt-4 inline-block">
                                <i class="fas fa-plus ml-1"></i>افزودن ترجیحات سبک
                            </a>

                        </div>
                    <?php else: ?>
                     <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <?php foreach ($userPreferencesList as $preference): ?>
                                <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <div class="flex justify-between items-start mb-3">
                                        <h4 class="font-semibold text-primaryDark">پروفایل ترجیحات</h4>
                                        <div class="flex space-x-2 space-x-reverse">
                                        <a href="http://localhost:86/src/pages/dashboard/StylePreferencesModal.php" class="text-blue-500 hover:text-blue-700 open-modal">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                            <form method="post" action="/preferences/delete.php" class="inline" onsubmit="return confirm('آیا مطمئن هستید؟');">
                                                <input type="hidden" name="id" value="<?= $preference['id'] ?>">
                                                <button type="submit" class="text-red-500 hover:text-red-700">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    
                                    <?php
                                    // نمونه مپینگ سبک‌ها
                                    $styles = [
                                        'Casual' => 'کژوال',
                                        'Formal' => 'رسمی',
                                        'Sporty' => 'ورزشی',
                                        'Classic' => 'کلاسیک',
                                        'Streetwear' => 'خیابانی',
                                        'Minimal' => 'مینیمال',
                                        'Special' => 'خاص',
                                        'Vintage' => 'ویندج'
                                    ];

                                    // نمونه مپینگ پارچه‌ها
                                    $fabrics = [
                                        'Cotton' => 'پنبه',
                                        'Linen' => 'کتان',
                                        'Silk' => 'ابریشم',
                                        'Wool' => 'پشم',
                                        'Polyester' => 'پلی استر',
                                    ];
                                    ?>
                                    <div class="space-y-3 text-sm">
                                        <?php if ($preference['style_preference']): ?>
                                            <div>
                                                <h5 class="font-medium text-gray-700">سبک‌های مورد علاقه:</h5>
                                                <?php 
                                                $styleKeys = explode(',', $preference['style_preference']); // فرض بر اینه که چند سبک با کاما جدا شدن
                                                $styleNames = array_map(fn($key) => $styles[$key] ?? $key, $styleKeys);
                                                ?>
                                                <p class="text-gray-600"><?= implode(', ', $styleNames) ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php
                                        // آرایه رنگ‌ها
                                        $colors = [
                                            'Red'        => 'قرمز',
                                            'Blue'       => 'آبی',
                                            'Yellow'     => 'زرد',
                                            'Green'      => 'سبز',
                                            'Purple'     => 'بنفش',
                                            'Grey'       => 'خاکستری',
                                            'Orange'     => 'نارنجی',
                                            'Pink'       => 'صورتی',
                                            'Navy'       => 'سرمه‌ای',
                                            'Black'      => 'مشکی',
                                            'White'      => 'سفید',
                                            'Gold'       => 'طلایی',
                                            'Silver'     => 'نقره‌ای',
                                            'Brown'      => 'قهوه‌ای'
                                        ];
                                        ?>
                                       <?php if ($preference['preferred_colors']): ?>
                                            <div>
                                                <h5 class="font-medium text-gray-700">رنگ‌های مورد علاقه:</h5>
                                                <?php 
                                                $colorIds = explode(',', $preference['preferred_colors']); // رنگ‌ها با کاما ذخیره شده
                                                $colorNames = array_map(fn($key) => $colors[$key] ?? $key, $colorIds);
                                                ?>
                                                <p class="text-gray-600"><?= implode(', ', $colorNames) ?></p>
                                            </div>
                                        <?php endif; ?>

                                        <?php if ($preference['avoided_colors']): ?>
                                            <div>
                                                <h5 class="font-medium text-gray-700">رنگ‌های عدم علاقه:</h5>
                                                <?php 
                                                $avoidedIds = explode(',', $preference['avoided_colors']); 
                                                $avoidedNames = array_map(fn($key) => $colors[$key] ?? $key, $avoidedIds);
                                                ?>
                                                <p class="text-gray-600"><?= implode(', ', $avoidedNames) ?></p>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($preference['fabric_preferences']): ?>
                                            <div>
                                                <h5 class="font-medium text-gray-700">پارچه‌های مورد علاقه:</h5>
                                                <?php 
                                                $fabricKeys = explode(',', $preference['fabric_preferences']); 
                                                $fabricNames = array_map(fn($key) => $fabrics[$key] ?? $key, $fabricKeys);
                                                ?>
                                                <p class="text-gray-600"><?= implode(', ', $fabricNames) ?></p>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    
                                    <div class="mt-3 pt-3 border-t text-xs text-gray-400">
                                        ایجاد شده در: <?= date('Y/m/d', strtotime($preference['created_at'])) ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
        <!-- مدال -->
        <div id="modal-overlay" class="hidden fixed inset-0 bg-black/50 z-40"></div>
        <div id="modal" class="hidden fixed inset-0 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg w-3/4 md:w-1/2 h-5/6 relative overflow-hidden">
                <button id="modal-close" class="absolute top-2 right-2 text-gray-700 text-xl">×</button>
                <iframe id="modal-iframe" class="w-full h-full border-0"></iframe>
            </div>
        </div>   

    <!-- فوتر -->
    <?php require_once __DIR__ . '/../../components/layout/Footer.php'; ?>
    <script>
document.addEventListener('DOMContentLoaded', function() {
  const overlay = document.getElementById('modal-overlay');
  const modal = document.getElementById('modal');
  const iframe = document.getElementById('modal-iframe');
  const closeBtn = document.getElementById('modal-close');

  // باز کردن modal برای هر لینک با کلاس open-modal
  document.body.addEventListener('click', function(e) {
    const a = e.target.closest('a.open-modal');
    if (!a) return;
    e.preventDefault();

    // اگر لینک حاوی target="_blank" هست، اجازه بد بدیم مثل قبل باز بشه
    if (a.target && a.target === '_blank') {
      window.open(a.href, '_blank');
      return;
    }

    // تنظیم src و نمایش مدال
    iframe.src = a.href;
    overlay.classList.remove('hidden');
    modal.classList.remove('hidden');
    // جلوگیری از scroll صفحه پشت مدال
    document.documentElement.classList.add('overflow-hidden');
    document.body.classList.add('overflow-hidden');
  });

  function closeModal() {
    overlay.classList.add('hidden');
    modal.classList.add('hidden');
    // پاک کردن iframe برای جلوگیری از play شدن و آزادسازی منابع
    iframe.src = 'about:blank';
    document.documentElement.classList.remove('overflow-hidden');
    document.body.classList.remove('overflow-hidden');
  }

  // بستن با کلیک روی بک‌گراند یا دکمه
  overlay.addEventListener('click', closeModal);
  closeBtn.addEventListener('click', closeModal);

  // بستن با کلید Escape
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
  });
});
</script>
    <style>
        .btn-primary {
            @apply bg-primary hover:bg-primaryDark text-white px-4 py-2 rounded transition;
        }
        .btn-outline-primary {
            @apply border border-primary text-primary hover:bg-primary hover:text-white px-4 py-2 rounded transition;
        }
        .btn-outline-light {
            @apply border border-white/30 hover:bg-white/10 text-white px-3 py-1 rounded text-sm transition;
        }
    </style>
</body>
</html>
