<?php
function renderFeedbackWidget($suggestionId, $productId) {
    ?>
    <div class="feedback-widget mt-4 p-4 border-t">
        <p class="font-medium text-gray-700">آیا این پیشنهاد مفید بود؟</p>
        <div class="flex space-x-3 mt-2">
            <button data-feedback="positive" 
                    class="px-4 py-2 bg-green-100 text-green-800 rounded-lg hover:bg-green-200 transition">
                بله
            </button>
            <button data-feedback="negative" 
                    class="px-4 py-2 bg-red-100 text-red-800 rounded-lg hover:bg-red-200 transition">
                خیر
            </button>
        </div>
        <div class="mt-3 hidden feedback-comment">
            <textarea placeholder="لطفاً دلیل خود را شرح دهید (اختیاری)"
                      class="w-full p-3 border rounded-lg"></textarea>
            <button class="mt-2 px-4 py-2 bg-blue-600 text-white rounded-lg">
                ارسال نظر
            </button>
        </div>
    </div>
    
    <script>
        document.querySelectorAll('[data-feedback]').forEach(btn => {
            btn.addEventListener('click', () => {
                const feedbackType = btn.dataset.feedback;
                // ارسال فیدبک به سرور
                fetch('/api/feedback', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({
                        suggestionId: <?= $suggestionId ?>,
                        productId: <?= $productId ?>,
                        feedback: feedbackType
                    })
                });
                
                // نمایش بخش نظرات اختیاری
                document.querySelector('.feedback-comment').classList.remove('hidden');
            });
        });
    </script>
    <?php
}
?>