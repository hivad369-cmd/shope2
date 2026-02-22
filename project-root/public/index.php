<?php
session_start();
require_once '../config/db_connection.php'; // مسیر رو درست بزن

$isLoggedIn = isset($_SESSION['user_id']);

$first_name = '';
$userAvatar = '/assets/avatars/default-avatar.png';

if ($isLoggedIn) {
    $userId = $_SESSION['user_id'];

    $conn = Database::getInstance();
    $stmt = $conn->prepare("SELECT first_name, avatar_url FROM user_profiles WHERE user_id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    $first_name = $user['first_name'] ?? '';
    $userAvatar = $user['avatar_url'] ?? '/assets/avatars/default-avatar.png';
}
?>


<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>فروشگاه مد و پوشاک</title>
  
  <!-- لینک Tailwind CSS -->
  <link href="/public/assets/css/output.css" rel="stylesheet">
  
  <?php if (isset($_SERVER['VITE_DEV'])): ?>
    <!-- حالت توسعه Vite -->
    <script type="module" src="http://localhost:3001/@vite/client"></script>
    <script type="module" src="http://localhost:3001/src/App.jsx"></script>
  <?php else: ?>
    <!-- حالت Production -->
    <link rel="stylesheet" href="assets/css/output.css">
    <script type="module" src="assets/js/script.js"></script>
  <?php endif; ?>
  
  <!-- فونت‌ها و استایل‌های اضافه -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://cdn.fontcdn.ir/Font/Persian/Vazir/Vazir.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Vazir', sans-serif;
    }
    @keyframes text {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
    }
    .animate-text {
    animation: text 5s ease infinite;
    background-size: 200% auto;
    }
    .testimonial-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            z-index: 1;
        }
        
        .testimonial-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .avatar-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #22c55e, #3b82f6);
            color: white;
            font-weight: bold;
            position: relative;
            z-index: 20;
        }
        
        .quote-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            opacity: 0.1;
            font-size: 5rem;
            z-index: 0; /* پایین‌تر از محتوا */
        }
        
        .card-content {
            position: relative;
            z-index: 10; /* بالاتر از آیکون ویرگول */
        }
        
        .star-rating .star {
            color: #e2e8f0;
        }
        
        .star-rating .star.filled {
            color: #fbbf24;
        }
        
        .avatar-container {
            position: relative;
            z-index: 20;
        }
  </style>
</head>
<body class="bg-gray-50">
  <!-- اسکریپت AOS -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 800,
      easing: 'ease-in-out',
      once: true,
      disable: window.innerWidth < 768
    });
    tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Vazirmatn', 'sans-serif']
                    },
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in forwards',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: 0, transform: 'translateY(20px)' },
                            '100%': { opacity: 1, transform: 'translateY(0)' },
                        }
                    }
                }
            }
        };
  </script>

  <?php 
  // بارگذاری هدر و هد مشترک برای همه صفحات
  require_once __DIR__ . '/../src/components/layout/head.php';
  require_once __DIR__ . '/../src/components/layout/header.php'; 
  
  // مدیریت محتوای صفحه بر اساس پارامتر GET
  $page = $_GET['page'] ?? 'home';
  switch($page) {
      case 'body-profile':
          require __DIR__ . '/../src/pages/body-profile/index.php';
          break;
      case 'ai-suggestions':
          require __DIR__ . '/../src/pages/ai-suggestions/index.php';
          break;
      default:
          // صفحه پیش‌فرض
          require __DIR__ . '/../src/components/layout/hero.php';
          require __DIR__ . '/../src/components/layout/banner.php';
          require __DIR__ . '/../src/components/layout/categories.php';
          require __DIR__ . '/../src/components/layout/products.php';
          require __DIR__ . '/../src/components/layout/Comments.php';
  }
  
  require_once __DIR__ . '/../src/components/layout/Zemanat.php'; 
  require_once __DIR__ . '/../src/components/layout/footer.php';
  ?>
</body>
</html>