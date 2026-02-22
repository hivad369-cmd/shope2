<?php
function renderPointsDisplay($userId) {
    $db = Database::getInstance();
    $points = $db->prepare("SELECT points FROM user_points WHERE user_id = :user_id");
    $points->execute([':user_id' => $userId]);
    $points = $points->fetchColumn() ?? 0;
    ?>
    <div class="points-display bg-yellow-50 border border-yellow-200 rounded-lg p-3 inline-flex items-center">
        <div class="bg-yellow-400 w-8 h-8 rounded-full flex items-center justify-center mr-2">
            <span class="text-white font-bold">★</span>
        </div>
        <div>
            <p class="text-xs text-gray-500">امتیاز شما</p>
            <p class="font-bold text-lg"><?= number_format($points) ?></p>
        </div>
    </div>
    <?php
}
?>