<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

ob_start();

$page = $_GET['page'] ?? 'auth';

// پردازش فرم‌های احراز هویت
if ($page === 'auth') {
    require_once __DIR__ . '/login-register.php';
    
    $redirectUrl = processAuthForms();
    
    if ($redirectUrl) {
        ob_end_clean();
        header('Location: ' . $redirectUrl);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>استایلیست من - ورود/ثبت‌نام</title>
    <link rel="stylesheet" href="/../../../public/assets/css/auth.css">
</head>
<body class="bg-gradient-to-br from-amber-50 to-emerald-50 min-h-screen flex flex-col text-right">
    <?php require_once __DIR__ . '/Header.php'; ?>
    
    <main class="flex-1 container mx-auto py-8">
        <?php
        if ($page === 'auth') {
            renderLoginRegister();
        }
        ?>
    </main>
    
    <?php require_once __DIR__ . '/../../components/layout/Footer.php'; ?>
    
    <script src="/../../../public/assets/js/auth.js"></script>
</body>
</html>
<?php ob_end_flush(); ?>