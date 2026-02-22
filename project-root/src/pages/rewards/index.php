<?php
function renderRewardsPage() {
    $db = Database::getInstance();
    $userId = $_SESSION['user_id'] ?? 0;
    
    $points = $db->prepare("SELECT points FROM user_points WHERE user_id = :user_id");
    $points->execute([':user_id' => $userId]);
    $points = $points->fetchColumn() ?? 0;
    
    $coupons = $db->query("SELECT * FROM coupons WHERE points_cost > 0")->fetchAll();
    ?>
    
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">سیستم پاداش</h1>
        
        <div class="bg-blue-50 rounded-xl p-6 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600">مجموع امتیازات شما</p>
                    <p class="text-4xl font-bold text-blue-700"><?= number_format($points) ?></p>
                </div>
                <div class="text-sm">
                    <p>هر 100 امتیاز = 10,000 تومان تخفیف</p>
                </div>
            </div>
        </div>
        
        <h2 class="text-xl font-bold mb-4">کوپن‌های قابل خرید</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php foreach ($coupons as $coupon): ?>
                <div class="border rounded-lg p-4 bg-white shadow-sm">
                    <div class="flex justify-between items-start">
                        <h3 class="font-bold text-lg"><?= $coupon['code'] ?></h3>
                        <span class="bg-amber-500 text-white px-2 py-1 rounded text-sm">
                            <?= number_format($coupon['points_cost']) ?> امتیاز
                        </span>
                    </div>
                    
                    <p class="text-gray-600 mt-2"><?= $coupon['description'] ?></p>
                    
                    <button class="mt-4 w-full bg-blue-600 text-white py-2 rounded-lg disabled:bg-gray-300"
                            <?= $points < $coupon['points_cost'] ? 'disabled' : '' ?>>
                        دریافت کوپن
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}
?>