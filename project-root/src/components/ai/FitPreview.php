<?php
function renderFitPreview($userAvatar, $productImage) {
  return <<<HTML
  <div class="fit-preview relative">
    <img src="$userAvatar" alt="آواتار کاربر" class="w-48 h-48 object-contain" />
    <img src="$productImage" alt="پیش‌نمایش لباس" 
         class="absolute inset-0 w-full h-full opacity-80 mix-blend-multiply" />
  </div>
  HTML;
}
?>