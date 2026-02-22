<?php
// اتصال به دیتابیس
$pdo = new PDO('mysql:host=localhost;dbname=styleist_db', 'root', '');

// وارد کردن کاربران
$users = json_decode(file_get_contents(__DIR__.'/../sampledata/fake_users.json'), true);
$userStmt = $pdo->prepare("INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)");

foreach ($users as $user) {
    $userStmt->execute([$user['name'], $user['email'], $user['password_hash']]);
}

// وارد کردن محصولات
$products = json_decode(file_get_contents(__DIR__.'/../sampledata/converted_products.json'), true);
$productStmt = $pdo->prepare("INSERT INTO products (name, description, base_price, subcategory_id) VALUES (?, ?, ?, ?)");

foreach ($products as $product) {
    $productStmt->execute([
        $product['name'],
        $product['description'],
        $product['base_price'],
        $product['subcategory_id']
    ]);
}

// وارد کردن پروفایل‌های بدنی
$profiles = json_decode(file_get_contents(__DIR__.'/../sampledata/body_profiles.json'), true);
$profileStmt = $pdo->prepare("INSERT INTO user_body_profiles (user_id, body_style_id, height_cm, weight_kg, is_default) VALUES (?, ?, ?, ?, ?)");

foreach ($profiles as $profile) {
    $profileStmt->execute([
        $profile['user_id'],
        $profile['body_style_id'],
        $profile['height_cm'],
        $profile['weight_kg'],
        $profile['is_default']
    ]);
}

echo "✅ داده‌ها با موفقیت وارد دیتابیس شدند!";
?>