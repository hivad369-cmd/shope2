<?php
try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=ai_stylist_db",
        "root",
        "" // اگر رمز داری اینجا وارد کن
    );
    echo "✅ اتصال به دیتابیس موفقیت‌آمیز بود!";
} catch (PDOException $e) {
    echo "❌ خطا در اتصال به دیتابیس: " . $e->getMessage();
}