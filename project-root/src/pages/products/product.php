<?php
// تنظیمات اولیه
date_default_timezone_set('Asia/Tehran');
session_start();

// 1. تنظیمات امنیتی
error_reporting(E_ALL);
ini_set('display_errors', 0); // در محیط تولید باید 0 باشد

// 2. اتصال به دیتابیس
require_once __DIR__ . '/../config/db_connection.php';

// 3. تابع دریافت اطلاعات محصول
function getProductDetails($productId, $connection) {
    $stmt = $connection->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        return null;
    }
    
    return $result->fetch_assoc();
}

// 4. تابع ذخیره نظر
function saveComment($productId, $comment, $userId = null) {
    // در اینجا کد ذخیره نظر در دیتابیس قرار می‌گیرد
    // به عنوان مثال:
    /*
    $stmt = $connection->prepare("INSERT INTO comments (product_id, user_id, comment) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $productId, $userId, $comment);
    $stmt->execute();
    */
    
    // فعلاً برای نمونه در سشن ذخیره می‌کنیم
    $_SESSION['comments'][$productId][] = [
        'text' => $comment,
        'timestamp' => time()
    ];
}

// 5. تابع دریافت نظرات
function getComments($productId) {
    return $_SESSION['comments'][$productId] ?? [];
}

// 6. پردازش درخواست‌ها
$product = null;
$comments = [];
$error = '';
$success = '';

if (isset($_GET['product_id']) && is_numeric($_GET['product_id'])) {
    $productId = (int)$_GET['product_id'];
    $product = getProductDetails($productId, $connection);
    
    if (!$product) {
        $error = 'محصول مورد نظر یافت نشد.';
    } else {
        $comments = getComments($productId);
    }
} else {
    $error = 'شناسه محصول نامعتبر است.';
}

// پردازش فرم ثبت نظر
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $commentText = trim($_POST['comment']);
    
    if (empty($commentText)) {
        $error = 'لطفا نظر خود را وارد کنید.';
    } elseif (strlen($commentText) < 10) {
        $error = 'نظر شما باید حداقل 10 کاراکتر داشته باشد.';
    } else {
        saveComment($productId, $commentText, $_SESSION['user_id'] ?? null);
        $success = 'نظر شما با موفقیت ثبت شد.';
        $comments = getComments($productId); // بارگذاری مجدد نظرات
    }
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['title'] ?? 'جزئیات محصول') ?> - استایلیست من</title>
    <link href="../css/output.css" rel="stylesheet">
    <link href="https://cdn.fontcdn.ir/Font/Persian/Vazir/Vazir.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            AOS.init();
            
            // تابع افزودن به سبد خرید
            window.addToCart = function(productId) {
                fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('محصول به سبد خرید اضافه شد!');
                        // به‌روزرسانی آیکون سبد خرید
                        const cartCount = document.getElementById('cart-count');
                        if (cartCount) {
                            cartCount.textContent = parseInt(cartCount.textContent) + 1;
                        }
                    } else {
                        alert('خطا در افزودن به سبد خرید: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('خطای شبکه!');
                });
            };
        });
    </script>
</head>
<body class="bg-gray-50 text-gray-800 font-vazir">
    <?php require __DIR__ . '/../includes/header.php'; ?>

    <main class="container mx-auto px-4 py-8 max-w-6xl">
        <?php if ($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                <strong class="font-bold">خطا! </strong>
                <span class="block sm:inline"><?= $error ?></span>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline"><?= $success ?></span>
            </div>
        <?php endif; ?>

        <?php if ($product): ?>
            <!-- بخش محصول -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <img 
                        src="<?= htmlspecialchars($product['image']) ?>" 
                        alt="<?= htmlspecialchars($product['title']) ?>" 
                        class="w-full h-auto object-cover"
                        loading="lazy"
                    >
                </div>
                
                <div class="py-4">
                    <h1 class="text-3xl font-bold text-emerald-700 mb-4"><?= htmlspecialchars($product['title']) ?></h1>
                    
                    <div class="flex items-center mb-4">
                        <div class="flex text-yellow-400 mr-2">
                            ★★★★☆
                        </div>
                        <span class="text-gray-600">(۴.۵ از ۵ - ۱۲ نظر)</span>
                    </div>
                    
                    <p class="text-2xl font-bold text-emerald-600 mb-6"><?= number_format($product['price']) ?> تومان</p>
                    
                    <div class="mt-3 flex items-center justify-center">
    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">
        تطابق ۹۲٪
    </span>
    <span class="ml-2 text-xs text-gray-500">
        <i class="fas fa-robot mr-1"></i>پیشنهاد هوشمند
    </span>
</div>

                    <p class="text-gray-700 mb-8 leading-relaxed">
                        <?= nl2br(htmlspecialchars($product['description_d'])) ?>
                    </p>
                    
                    <div class="flex flex-wrap gap-4">
                        <button 
                            onclick="addToCart(<?= $product['id'] ?>)"
                            class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-full transition-colors"
                        >
                            افزودن به سبد خرید
                        </button>
                        
                        <button class="border border-emerald-600 text-emerald-600 hover:bg-emerald-50 px-8 py-3 rounded-full transition-colors">
                            افزودن به علاقه‌مندی‌ها
                        </button>
                    </div>
                    
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <h3 class="font-bold text-lg mb-3">ویژگی‌های محصول:</h3>
                        <ul class="grid grid-cols-2 gap-2">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>جنس: <?= htmlspecialchars($product['material'] ?? 'پنبه') ?></span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>رنگ: <?= htmlspecialchars($product['color'] ?? 'مشکی') ?></span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>گارانتی: ۱۸ ماه</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>موجود در انبار</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- بخش نظرات -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-12">
                <h2 class="text-2xl font-bold text-emerald-600 mb-6 pb-2 border-b border-gray-200">نظرات کاربران</h2>
                
                <form method="post" class="mb-8">
                    <div class="mb-4">
                        <label for="comment" class="block text-gray-700 font-medium mb-2">نظر شما:</label>
                        <textarea 
                            id="comment" 
                            name="comment" 
                            rows="4" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all"
                            placeholder="نظر خود را درباره این محصول بنویسید..."
                            required
                        ><?= $_POST['comment'] ?? '' ?></textarea>
                    </div>
                    <button 
                        type="submit" 
                        name="submit" 
                        class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-2 rounded-lg transition-colors"
                    >
                        ثبت نظر
                    </button>
                </form>
                
                <div class="space-y-6">
                    <?php if (empty($comments)): ?>
                        <p class="text-gray-500 text-center py-4">هنوز نظری ثبت نشده است. اولین نفری باشید که نظر می‌دهد!</p>
                    <?php else: ?>
                        <?php foreach ($comments as $index => $comment): ?>
                            <div class="border-b border-gray-100 pb-6 last:border-0">
                                <div class="flex items-start mb-3">
                                    <div class="bg-gray-200 border-2 border-dashed rounded-xl w-16 h-16 flex items-center justify-center text-gray-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div class="mr-4">
                                        <h4 class="font-bold">کاربر <?= $index + 1 ?></h4>
                                        <p class="text-gray-500 text-sm">
                                            <?= date('Y/m/d H:i', $comment['timestamp']) ?>
                                        </p>
                                    </div>
                                </div>
                                <p class="text-gray-700"><?= nl2br(htmlspecialchars($comment['text'])) ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </main>

    <?php require __DIR__ . '/../includes/footer.php'; ?>
</body>
</html>