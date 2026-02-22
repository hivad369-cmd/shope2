<?php
require 'vendor/autoload.php';
$faker = Faker\Factory::create('fa_IR');

// دریافت محصولات از دیتابیس
$pdo = new PDO('mysql:host=localhost;dbname=styleist_db', 'root', '');
$products = $pdo->query("SELECT id, name, subcategory_id FROM products")->fetchAll(PDO::FETCH_ASSOC);

// تولید داده‌های آموزشی برای هوش مصنوعی
$training_data = [];

foreach ($products as $product) {
    for ($i = 0; $i < 5; $i++) { // 5 ورودی به ازای هر محصول
        $training_data[] = [
            'product_id' => $product['id'],
            'body_style_id' => rand(1, 10),
            'skin_tone_id' => rand(1, 6),
            'clothing_pref_id' => rand(1, 8),
            'height' => rand(150, 190),
            'weight' => rand(50, 90),
            'recommendation_score' => rand(70, 100) / 100 // امتیاز پیشنهاد
        ];
    }
}

file_put_contents(__DIR__.'/../sampledata/ai_training_data.json', json_encode($training_data));

// درج در جدول آموزشی هوش مصنوعی
$stmt = $pdo->prepare("INSERT INTO ai_recommendation_data (
    product_id, body_style_id, skin_tone_id, clothing_pref_id, 
    height, weight, recommendation_score
) VALUES (?, ?, ?, ?, ?, ?, ?)");

foreach ($training_data as $data) {
    $stmt->execute([
        $data['product_id'],
        $data['body_style_id'],
        $data['skin_tone_id'],
        $data['clothing_pref_id'],
        $data['height'],
        $data['weight'],
        $data['recommendation_score']
    ]);
}

echo "✅ داده‌های آموزشی هوش مصنوعی با موفقیت ایجاد شدند!";
?>