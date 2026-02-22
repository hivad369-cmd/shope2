<?php
// تابع پردازش فرم‌ها
function processAuthForms() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    // تنظیمات دیتابیس
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'ai_stylist_db');

    // اتصال به دیتابیس
    function getDBConnection() {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($conn->connect_error) {
            die("اتصال به دیتابیس ناموفق بود: " . $conn->connect_error);
        }
        $conn->set_charset("utf8");
        return $conn;
    }

    $errors = [];
    $login_error = '';

    // پردازش فرم ورود
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type']) && $_POST['form_type'] === 'login') {
        $identifier = $_POST['identifier'];
        $password = $_POST['password'];
        
        $conn = getDBConnection();
        $stmt = $conn->prepare("SELECT id, password, user_name, role_id FROM users WHERE email = ? OR phone_number = ?  OR user_name = ?");
        $stmt->bind_param("sss", $identifier , $identifier, $identifier);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // ورود موفق
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['user_name'];
                $_SESSION['role_id'] = $user['role_id'];
                
                // بازگشت آدرس پنل کاربری برای ریدایرکت
                return '/src/pages/dashboard/index.php';
            } else {
                $login_error = "رمز عبور اشتباه است";
            }
        } else {
            $login_error = "کاربری با این مشخصات یافت نشد";
        }
        $stmt->close();
        $conn->close();
    }

    // پردازش فرم ثبت‌نام
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_type']) && $_POST['form_type'] === 'register') {
        $userName = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];
        
        // اعتبارسنجی اولیه
        if (empty($userName)) $errors[] = "نام کاربری الزامی است";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "فرمت ایمیل نامعتبر است";
        if (strlen($password) < 8) $errors[] = "رمز عبور باید حداقل ۸ کاراکتر باشد";
        if ($password !== $confirmPassword) $errors[] = "رمز عبور و تکرار آن مطابقت ندارند";
        
        if (empty($errors)) {
            $conn = getDBConnection();
            
            // بررسی تکراری نبودن ایمیل و نام کاربری
            $checkStmt = $conn->prepare("SELECT id FROM users WHERE email = ? OR user_name = ?");
            $checkStmt->bind_param("ss", $email, $userName);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();
            
            if ($checkResult->num_rows > 0) {
                $errors[] = "ایمیل یا نام کاربری قبلاً ثبت شده است";
            } else {
                // هش کردن رمز عبور
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                
                // درج کاربر جدید
                $insertStmt = $conn->prepare("INSERT INTO users (email, password, user_name, phone_number, role_id) VALUES (?, ?, ?, ?, 1)");
                $insertStmt->bind_param("ssss", $email, $hashedPassword, $userName, $phone);
                
                if ($insertStmt->execute()) {
                    // ایجاد پروفایل کاربری
                    $user_id = $insertStmt->insert_id;
                    $profileStmt = $conn->prepare("INSERT INTO user_profiles (user_id, gender_id) VALUES (?, 4)");
                    $profileStmt->bind_param("i", $user_id);
                    $profileStmt->execute();
                    $profileStmt->close();
                    
                    // ورود خودکار بعد از ثبت‌نام
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['user_name'] = $userName;
                    $_SESSION['role_id'] = 1; // نقش مشتری
                    
                    // بازگشت آدرس پنل کاربری برای ریدایرکت
                    return '/src/pages/dashboard/index.php';
                } else {
                    $errors[] = "خطا در ثبت نام: " . $conn->error;
                }
                $insertStmt->close();
            }
            $checkStmt->close();
            $conn->close();
        }
    }
    
    // ذخیره خطاها در session برای نمایش در فرم
    if (!empty($errors)) {
        $_SESSION['form_errors'] = $errors;
    }
    if (!empty($login_error)) {
        $_SESSION['login_error'] = $login_error;
    }
    
    return false;
}

function renderLoginRegister() {
    // بازیابی خطاها از session
    $errors = $_SESSION['form_errors'] ?? [];
    $login_error = $_SESSION['login_error'] ?? '';
    
    // پاک کردن خطاهای نمایش داده شده
    unset($_SESSION['form_errors']);
    unset($_SESSION['login_error']);
    
    $benefits = [
        ['icon' => 'user-check', 'text' => 'پروفایل شخصی‌سازی شده'],
        ['icon' => 'truck', 'text' => 'ارسال سریع و رایگان'],
        ['icon' => 'gift', 'text' => 'تخفیف‌های ویژه اعضا'],
        ['icon' => 'heart', 'text' => 'پیشنهادات هوشمند']
    ];
    ?>
    <link rel="stylesheet" href="/../../../public/assets/css/auth.css">
    
    <div class="auth-container">
        <div class="auth-card">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                <!-- بخش مزایا -->
                <div class="hidden lg:block auth-benefits">
                    <h2 class="text-3xl font-bold mb-6">به استایلیست من خوش آمدید!</h2>
                    <ul class="space-y-4">
                        <?php foreach ($benefits as $benefit): ?>
                        <li class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-emerald-500/30 flex items-center justify-center mr-3">
                                <i class="fas fa-<?= $benefit['icon'] ?> text-emerald-200"></i>
                            </div>
                            <span><?= $benefit['text'] ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <!-- بخش فرم‌ها -->
                <div class="auth-form-container">
                    <!-- نمایش خطاها -->
                    <?php if (!empty($errors) || !empty($login_error)): ?>
                        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
                            <ul class="list-disc list-inside">
                                <?php if (!empty($errors)): ?>
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= $error ?></li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                
                                <?php if (!empty($login_error)): ?>
                                    <li><?= $login_error ?></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                    <!-- نوار انتخاب -->
                    <div class="form-tabs">
                        <button class="form-tab active" data-tab="login">ورود به حساب</button>
                        <button class="form-tab" data-tab="register">ثبت‌نام جدید</button>
                    </div>
                    
                    <!-- فرم ورود -->
                    <div id="login-form">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">ورود به حساب کاربری</h3>
                        
                        <form id="loginForm" method="POST">
                            <input type="hidden" name="form_type" value="login">
                            
                            <div class="input-container">
                                <div class="input-icon"><i class="fas fa-user"></i></div>
                                <input type="text" id="login-identifier" name="identifier" class="input-field" placeholder=" " required>
                                <label class="floating-label">ایمیل یا شماره موبایل</label>
                            </div>
                            
                            <div class="input-container relative">
                                <div class="input-icon"><i class="fas fa-lock"></i></div>
                                <input type="password" id="login-password" name="password" class="input-field" placeholder="رمز عبور" required>
                                <span class="password-toggle absolute ml-6" data-input="login-password" data-icon="login-password-toggle">
                                    <i id="login-password-toggle" class="fas fa-eye-slash"></i>
                                </span>
                            </div>
                            
                            <div class="flex justify-between items-center mb-6">
                                <div class="flex items-center">
                                    <input type="checkbox" id="remember-me" name="remember" class="h-4 w-4 text-emerald-600">
                                    <label for="remember-me" class="mr-2 text-sm">مرا به خاطر بسپار</label>
                                </div>
                                <a href="#" class="text-sm auth-link">رمز عبور را فراموش کرده‌اید؟</a>
                            </div>
                            
                            <button type="submit" class="auth-submit-btn mb-4">
                                ورود به حساب <i class="fas fa-sign-in-alt mr-2"></i>
                            </button>
                            
                            <p class="text-center text-gray-600">
                                حساب کاربری ندارید؟ 
                                <a href="#" class="auth-link register-link">ثبت‌نام کنید</a>
                            </p>
                        </form>
                    </div>
                    
                    <!-- فرم ثبت‌نام -->
                    <div id="register-form" class="hidden">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">ثبت‌نام در استایلیست من</h3>
                        
                        <form id="registerForm" method="POST">
                            <input type="hidden" name="form_type" value="register">
                            <div class="input-container">
                                <div class="input-icon"><i class="fas fa-at"></i></div>
                                <input type="text" id="username" name="username" class="input-field" placeholder=" " required>
                                <label class="floating-label">نام کاربری</label>
                            </div>
                            
                            <div class="input-container">
                                <div class="input-icon"><i class="fas fa-envelope"></i></div>
                                <input type="email" id="email" name="email" class="input-field" placeholder=" " required>
                                <label class="floating-label">آدرس ایمیل</label>
                            </div>
                            
                            <div class="input-container">
                                <div class="input-icon"><i class="fas fa-mobile-alt"></i></div>
                                <input type="tel" id="phone" name="phone" class="input-field" placeholder=" " required>
                                <label class="floating-label">شماره موبایل</label>
                            </div>
                            
                            <div class="input-container">
                                <div class="input-icon"><i class="fas fa-lock"></i></div>
                                <input type="password" id="register-password" name="password" class="input-field" placeholder="رمز عبور (حداقل ۸ کاراکتر)" required>
                                <span class="password-toggle ml-6" data-input="register-password" data-icon="register-password-toggle">
                                    <i id="register-password-toggle" class="fas fa-eye-slash"></i>
                                </span>
                            </div>
                            
                            <div class="input-container">
                                <div class="input-icon"><i class="fas fa-lock"></i></div>
                                <input type="password" id="confirm-password" name="confirm_password" class="input-field" placeholder="تکرار رمز عبور" required>
                                <span class="password-toggle ml-6" data-input="confirm-password" data-icon="confirm-password-toggle">
                                    <i id="confirm-password-toggle" class="fas fa-eye-slash"></i>
                                </span>
                            </div>
                            
                            <div class="flex items-start mb-6">
                                <input type="checkbox" id="terms" name="terms" class="h-4 w-4 text-emerald-600 mt-1" required>
                                <label for="terms" class="mr-3 text-sm">
                                    با <a href="#" class="auth-link">قوانین</a> و <a href="#" class="auth-link">حریم خصوصی</a> موافقم
                                </label>
                            </div>
                            
                            <button type="submit" class="auth-submit-btn mb-4">
                                ایجاد حساب <i class="fas fa-user-plus mr-2"></i>
                            </button>
                            
                            <p class="text-center text-gray-600">
                                قبلاً ثبت‌نام کرده‌اید؟ 
                                <a href="#" class="auth-link login-link">وارد شوید</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="/../../../assets/js/auth.js"></script>
    <?php
}