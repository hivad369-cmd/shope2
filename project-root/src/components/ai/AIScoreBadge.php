<?php
function AIScoreBadge($score, $label, $type) {
    $colorMap = [
        'fit' => 'bg-blue-100 text-blue-800',
        'style' => 'bg-emerald-100 text-emerald-800',
        'color' => 'bg-purple-100 text-purple-800',
        'confidence' => 'bg-amber-100 text-amber-800'
    ];
    
    $colorClass = $colorMap[$type] ?? 'bg-gray-100 text-gray-800';
    
    return <<<HTML
    <div class="flex items-center">
        <span class="text-xs font-medium px-2 py-1 rounded-full $colorClass">
            $label: $score%
        </span>
    </div>
HTML;
}
?>
