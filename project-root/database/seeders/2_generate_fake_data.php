<?php
require 'vendor/autoload.php';
$faker = Faker\Factory::create('fa_IR');

// تولید کاربران فیک
$users = [];
for ($i = 0; $i < 100; $i++) {
    $users[] = [
        'name' => $faker->name,
        'email' => $faker->unique()->email,
        'password_hash' => password_hash('123456', PASSWORD_DEFAULT)
    ];
}
file_put_contents(__DIR__.'/../sampledata/fake_users.json', json_encode($users));

// تولید پروفایل‌های بدنی
$body_profiles = [];
$body_styles = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]; // IDهای استایل‌های موجود

foreach ($users as $index => $user) {
    $body_profiles[] = [
        'user_id' => $index + 1,
        'body_style_id' => $body_styles[array_rand($body_styles)],
        'height_cm' => rand(150, 190),
        'weight_kg' => rand(50, 90),
        'is_default' => 1
    ];
}
file_put_contents(__DIR__.'/../sampledata/body_profiles.json', json_encode($body_profiles));
?>