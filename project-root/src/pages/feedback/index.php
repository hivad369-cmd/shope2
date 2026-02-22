<?php
function renderFeedbackPage() {
    $db = Database::getInstance();
    $userId = $_SESSION['user_id'] ?? 0;
    
    $feedbacks = $db->prepare("
        SELECT f.*, p.name AS product_name
        FROM ai_suggestion_feedbacks f
        JOIN products p ON f.product_id = p.id
        WHERE f.user_id = :user_id
        ORDER BY f.created_at DESC
    ");
    $feedbacks->execute([':user_id' => $userId]);
    ?>
    
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">تاریخچه نظرات شما</h1>
        
        <div class="grid grid-cols-1 gap-4">
            <?php while ($fb = $feedbacks->fetch()): ?>
                <div class="bg-white p-4 rounded-lg shadow">
                    <div class="flex justify-between">
                        <h3 class="font-medium"><?= $fb['product_name'] ?></h3>
                        <span class="<?= $fb['feedback_type'] === 'positive' ? 'text-green-600' : 'text-red-600' ?>">
                            <?= $fb['feedback_type'] === 'positive' ? 'مثبت' : 'منفی' ?>
                        </span>
                    </div>
                    
                    <?php if (!empty($fb['feedback_note'])): ?>
                        <p class="mt-2 text-gray-600"><?= $fb['feedback_note'] ?></p>
                    <?php endif; ?>
                    
                    <p class="text-sm text-gray-500 mt-3">
                        <?= date('Y-m-d H:i', strtotime($fb['created_at'])) ?>
                    </p>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php
}
?>