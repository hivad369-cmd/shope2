<?php require_once __DIR__ . '/../../../src/components/layout/head.php'; ?>
<?php require_once __DIR__ . '/../../../src/components/layout/header.php'; ?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پروفایل بدنی - ویرایش حرفه‌ای</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'emerald': {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                        },
                        'amber': {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;200;300;400;500;600;700;800;900&display=swap');
        
        body {
            font-family: 'Vazirmatn', sans-serif;
            background-color: #f0fdf4;
        }
        
        .input-container {
            position: relative;
        }
        
        .input-field {
            width: 100%;
            border: 2px solid #d1fae5;
            border-radius: 12px;
            padding: 12px 16px;
            background-color: white;
            transition: all 0.3s ease;
        }
        
        .input-field:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.3);
        }
        
        .unit-label {
            position: absolute;
            top: 50%;
            left: 16px;
            transform: translateY(-50%);
            color: #047857;
            font-weight: 500;
            pointer-events: none;
        }
        
        .select-container {
            position: relative;
        }
        
        .select-field {
            width: 100%;
            border: 2px solid #d1fae5;
            border-radius: 12px;
            padding: 12px 40px 12px 16px;
            background-color: white;
            appearance: none;
            transition: all 0.3s ease;
        }
        
        .select-field:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.3);
        }
        
        .select-icon {
            position: absolute;
            top: 50%;
            left: 16px;
            transform: translateY(-50%);
            pointer-events: none;
            color: #059669;
        }
        
        .radio-card {
            transition: all 0.3s ease;
        }
        
        .radio-card:hover {
            border-color: #34d399;
        }
        
        .radio-card.selected {
            border-color: #10b981;
            background-color: #ecfdf5;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }
        
        .skin-tone-option {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .skin-tone-option:hover {
            transform: scale(1.1);
        }
        
        .submit-btn {
            transition: all 0.3s ease;
        }
        
        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px -5px rgba(5, 150, 105, 0.4);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-amber-50 to-emerald-50 min-h-screen py-8">
<?php
$page = $_GET['page'] ?? '';
$subpage = $_GET['subpage'] ?? 'measurements';

if ($page === 'body-profile') {
    switch ($subpage) {
        case 'measurements':
            require_once __DIR__ . '/BodyMeasurements.php';
            renderBodyMeasurements();
            break;
        case 'preferences':
            require_once __DIR__ . '/StylePreferences.php';
            renderStylePreferences();
            break;
        default:
            echo "صفحه مورد نظر یافت نشد.";
    }
}
?>
<?php require_once __DIR__ . '/../../../src/components/layout/zemanat.php'; ?>
<?php require_once __DIR__ . '/../../../src/components/layout/footer.php'; ?>
</body>
</html>