<?php
function BodyMeasureInput($name, $label, $unit = 'cm') {
    return <<<HTML
    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-medium mb-2">
            $label ($unit)
        </label>
        <input 
            type="number" 
            name="$name"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-300"
            placeholder="0"
            min="0"
            step="0.5"
            required
        >
    </div>
HTML;
}
?>
