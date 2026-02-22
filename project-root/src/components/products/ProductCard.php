<?php
function ProductCard($product) {
  return <<<HTML
  <div class="product-card relative">
    <!-- ... -->
    <div class="ai-scores flex gap-2 mt-3">
      <?= AIScoreBadge($product['fit_score'], 'تناسب', 'fit') ?>
      <?= AIScoreBadge($product['style_score'], 'استایل', 'style') ?>
    </div>
    <button class="fit-preview-btn" 
            data-product="{$product['id']}">
      مشاهده پیش‌نمایش
    </button>
  </div>
  HTML;
}
?>