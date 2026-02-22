<?php
require 'vendor/autoload.php';
$faker = Faker\Factory::create('fa_IR');

// تابع تبدیل اعداد انگلیسی به فارسی
function convertEnglishToPersianDigits($string) {
    $persianDigits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    return preg_replace_callback('/[0-9]/', function($matches) use ($persianDigits) {
        return $persianDigits[$matches[0]];
    }, $string);
}

// تابع ترجمه عنوان محصول
function translateProductTitle($title) {
    $translations = [
        'fjallraven' => 'فجالراون',
        'foldsack' => 'چمدانی',
        'backpack' => 'کوله پشتی',
        'laptop' => 'لپ تاپ',
        't-shirt' => 'تیشرت',
        'shirt' => 'پیراهن',
        'jacket' => 'ژاکت',
        'dress' => 'لباس زنانه',
        'jewelery' => 'زیورآلات',
        'electronics' => 'الکترونیکی',
        'men' => 'مردانه',
        'women' => 'زنانه',
        'cotton' => 'نخی',
        'slim' => 'فیت',
        'fit' => 'فیت',
        'portable' => 'قابل حمل',
        'external' => 'اکسترنال',
        'solid' => 'ساده',
        'plated' => 'پوشش داده شده',
        'double' => 'دوبل',
        'performance' => 'پرتابل',
        'gaming' => 'گیمینگ',
        'ultra-thin' => 'فوق باریک',
        'curved' => 'منحنی',
        'snowboard' => 'اسنوبرد',
        'faux leather' => 'چرم مصنوعی',
        'moisture' => 'نفوذناپذیر',
        'casual' => 'کژوال',
        'premium' => 'پریمیوم',
        'legend' => 'افسانه‌ای',
        'naga' => 'ناگا',
        'dragon' => 'اژدها',
        'station' => 'ایستگاه',
        'chain' => 'زنجیره',
        'bracelet' => 'دستبند',
        'petite' => 'ظریف',
        'micropave' => 'میکروپاو',
        'princess' => 'پرنسسی',
        'pierced' => 'پیرس شده',
        'owl' => 'جغد',
        'rose' => 'رز',
        'stainless steel' => 'استیل ضدزنگ',
        'hard drive' => 'هارد دیسک',
        'ssd' => 'اس‌اس‌دی',
        'internal' => 'داخلی',
        'cache' => 'کش',
        'boost' => 'افزایش عملکرد',
        'ultrawide' => 'اولترا واید',
        'screen' => 'صفحه نمایش',
        'winter' => 'زمستانی',
        'coat' => 'کت',
        'removable' => 'قابل جدا شدن',
        'hooded' => 'هودی دار',
        'moto' => 'موتوری',
        'biker' => 'بایکر',
        'rain' => 'بارانی',
        'windbreaker' => 'بادگیر',
        'striped' => 'راه راه',
        'climbing' => 'کوهنوردی',
        'raincoats' => 'بارانی',
        'short' => 'کوتاه',
        'sleeve' => 'آستین',
        'boat' => 'قایقی',
        'neck' => 'یقه',
        'v' => 'وی شکل',
        '3-in-1' => 'سه کاره',
        'bi' => 'بی‌آی',
        'elements' => 'المنتس',
        'plus' => 'پلاس',
        'work' => 'کار',
        'playstation' => 'پلی‌استیشن',
        'full' => 'کامل',
        'lock' => 'قفل',
        'love' => 'عشق',
        'opna' => 'اپنا',
        'danvouy' => 'دانووی',
        'biylaclesen' => 'بیلاکلسن',
        'samsung' => 'سامسونگ',
        'iphone' => 'آیفون',
        'watch' => 'ساعت',
        'ring' => 'حلقه',
        'necklace' => 'گردنبند',
        'denim' => 'جین',
        'linen' => 'کتان',
        'silk' => 'ابریشم',
        'wool' => 'پشم',
        'chiffon' => 'شیفون',
        'sneakers' => 'کفش اسپرت',
        'heels' => 'پاشنه بلند',
        'loafers' => 'کفش راحتی',
        'earrings' => 'گوشواره',
        'top' => 'بلوز',
        'pants' => 'شلوار',
        'skirt' => 'دامن',
        'blouse' => 'بلوز زنانه',
        'sweater' => 'پلیور',
        'hoodie' => 'هودی',
        'jeans' => 'شلوار جین',
        'shorts' => 'شلوارک',
        'suit' => 'کت و شلوار',
        'trousers' => 'شلوار رسمی',
        'boots' => 'بوت',
        'sandals' => 'صندل',
        'socks' => 'جوراب',
        'scarf' => 'شال',
        'gloves' => 'دستکش',
        'belt' => 'کمربند',
        'wallet' => 'کیف پول',
        'bag' => 'کیف',
        'perfume' => 'عطر'
    ];
    
    // تبدیل اعداد انگلیسی به فارسی
    $title = convertEnglishToPersianDigits($title);
    
    // جایگزینی کلمات
    foreach ($translations as $en => $fa) {
        $title = preg_replace("/\b$en\b/i", $fa, $title);
    }
    
    // اصلاح حروف خاص
    $title = str_replace(['-', ',', '"', "'", '&', '  '], [' ', ' ', ' ', ' ', ' و ', ' '], $title);
    
    // حذف "Woمردانه" و "مردانهs"
    $title = preg_replace('/\bWo?مردانه\b/i', 'زنانه', $title);
    $title = preg_replace('/\bمردانهs?\b/i', 'مردانه', $title);
    
    // حذف کلمات اضافی انگلیسی
    $title = str_replace(
        ['Womens', 'Mens', 's', 't'], 
        ['زنانه', 'مردانه', '', ''],
        $title
    );
    
    // حذف فاصله‌های اضافی
    $title = preg_replace('/\s+/', ' ', $title);
    return trim($title);
}

// تابع تولید تصاویر مرتبط
function generateFashionImage($category, $title) {
    $terms = [
        "men's clothing" => 'men,fashion,clothing,style',
        "women's clothing" => 'women,dress,fashion,style',
        "jewelery" => 'jewelry,accessories,luxury',
        "electronics" => 'tech,gadget,modern'
    ];
    
    $term = $terms[$category] ?? 'fashion';
    
    // استخراج کلمات کلیدی فارسی
    $keywords = [
        'پیراهن' => 'shirt',
        'تیشرت' => 't-shirt',
        'شلوار' => 'pants',
        'کت' => 'coat',
        'دامن' => 'skirt',
        'کفش' => 'shoes',
        'زیورآلات' => 'jewelry',
        'ساعت' => 'watch',
        'گردنبند' => 'necklace',
        'دستبند' => 'bracelet',
        'گوشواره' => 'earrings',
        'عینک' => 'glasses',
        'کوله' => 'backpack',
        'ژاکت' => 'jacket',
        'پلیور' => 'sweater',
        'هودی' => 'hoodie',
        'جین' => 'jeans'
    ];
    
    // تبدیل کلمات کلیدی فارسی به انگلیسی
    $translatedKeywords = [];
    foreach ($keywords as $fa => $en) {
        if (strpos($title, $fa) !== false) {
            $translatedKeywords[] = $en;
        }
    }
    
    $query = implode(',', array_merge([$term], $translatedKeywords));
    return "https://source.unsplash.com/random/600x800/?{$query}";
}

// تابع تولید توضیحات محصول
function generateProductDescription($name, $category, $faker) {
    $descriptions = [
        "men's clothing" => [
            "{$name} با طراحی مدرن و پارچه با کیفیت. {$faker->sentence(6)}",
            "{$name} مناسب برای استفاده روزمره و مهمانی‌ها. {$faker->sentence(5)}",
            "{$name} با دوخت دقیق و الگوی فیت بدن. {$faker->sentence(7)}",
            "این {$name} از جدیدترین ترندهای فصل پیروی می‌کند. {$faker->sentence(4)}"
        ],
        "women's clothing" => [
            "{$name} با طراحی زنانه و شیک. {$faker->sentence(6)}",
            "{$name} مناسب برای مجالس و میهمانی‌ها. {$faker->sentence(5)}",
            "{$name} با پارچه لطیف و رنگ ثابت. {$faker->sentence(7)}",
            "طراحی خاص و منحصر به فرد {$name} شما را متمایز می‌کند. {$faker->sentence(5)}"
        ],
        "jewelery" => [
            "{$name} ساخته شده با بهترین مواد اولیه. {$faker->sentence(6)}",
            "{$name} طراحی منحصر به فرد و لوکس. {$faker->sentence(5)}",
            "{$name} مناسب برای هدیه و مناسبت‌های خاص. {$faker->sentence(7)}",
            "زیورآلات {$name} با طراحی منحصر به فرد. {$faker->sentence(5)}",
            "{$name} دست‌ساز با دقت بالا. {$faker->sentence(4)}"
        ],
        "electronics" => [
            "{$name} با آخرین فناوری روز. {$faker->sentence(6)}",
            "{$name} مناسب برای استفاده حرفه‌ای. {$faker->sentence(5)}",
            "{$name} با گارانتی اصالت و سلامت فیزیکی. {$faker->sentence(7)}",
            "دستگاه {$name} با قابلیت‌های پیشرفته. {$faker->sentence(6)}"
        ]
    ];
    
    return $descriptions[$category][array_rand($descriptions[$category])];
}

// تابع دریافت ID زیردسته
function getSubcategoryId($name) {
    $subcategories = [
        'پیراهن مردانه' => 1, 
        'تیشرت مردانه' => 2,
        'شلوار مردانه' => 3,
        'کت مردانه' => 4,
        'هودی مردانه' => 5,
        'پیراهن زنانه' => 6,
        'بلوز زنانه' => 7,
        'شلوار زنانه' => 8,
        'دامن' => 9,
        'لباس مجلسی' => 10,
        'کفش مردانه' => 11,
        'کفش زنانه' => 12,
        'کفش اسپرت' => 13,
        'ساعت' => 14,
        'گردنبند' => 15,
        'دستبند' => 16,
        'گوشواره' => 17,
        'عینک' => 18
    ];
    
    return $subcategories[$name] ?? 1;
}

// دریافت داده‌های محصولات از API
$api_url = "https://fakestoreapi.com/products";
$products_data = json_decode(file_get_contents($api_url), true);

// اگر دریافت داده با مشکل مواجه شد
if (!$products_data || !is_array($products_data)) {
    die("❌ خطا در دریافت داده‌ها از API");
}

$converted = [];
$category_mapping = [
    "men's clothing" => [
        'subcategories' => [
            'پیراهن' => 1,
            'تیشرت' => 2,
            'شلوار' => 3,
            'کت' => 4,
            'هودی' => 5
        ],
        'materials' => ['کتان', 'پنبه', 'پلی‌استر', 'ویسکوز', 'جین'],
        'styles' => ['مجلسی', 'کژوال', 'اسپرت', 'کلاسیک']
    ],
    "women's clothing" => [
        'subcategories' => [
            'پیراهن' => 6,
            'بلوز' => 7,
            'شلوار' => 8,
            'دامن' => 9,
            'لباس مجلسی' => 10
        ],
        'materials' => ['ابریشم', 'نخی', 'پلی‌استر', 'ویسکوز', 'شیفون'],
        'styles' => ['زنانه', 'شیک', 'رسمی', 'مجلسی']
    ],
    "jewelery" => [
        'subcategories' => [
            'ساعت' => 14,
            'گردنبند' => 15,
            'دستبند' => 16,
            'گوشواره' => 17,
            'عینک' => 18
        ],
        'materials' => ['طلای 18 عیار', 'نقره استرلینگ', 'استیل ضدزنگ', 'پلاتین'],
        'styles' => ['لوکس', 'زیورآلات', 'تزئینی']
    ],
    "electronics" => [
        'subcategories' => ['اکسسوری کاربردی'],
        'materials' => ['پلاستیک ABS', 'آلومینیوم', 'شیشه گوریلا', 'سیلیکون'],
        'styles' => ['مدرن', 'کاربردی', 'تکنولوژی']
    ]
];

foreach ($products_data as $product) {
    $category = $product['category'];
    $mapping = $category_mapping[$category] ?? [
        'subcategories' => ['اکسسوری کاربردی'],
        'materials' => ['پلاستیک ABS', 'آلومینیوم'],
        'styles' => ['عمومی']
    ];
    
    $translated_name = translateProductTitle($product['title']);
    
    // انتخاب زیردسته بر اساس عنوان محصول
    $subcategory_id = 1; // پیش‌فرض
    foreach ($mapping['subcategories'] as $keyword => $id) {
        if (strpos($translated_name, $keyword) !== false) {
            $subcategory_id = $id;
            break;
        }
    }
    
    // محاسبه قیمت پایه
    $base_price = (int)(round($product['price'] * 50000));
    
    // تعدیل قیمت بر اساس دسته‌بندی
    $price_adjustments = [
        "men's clothing" => 1.0,
        "women's clothing" => 1.1,
        "jewelery" => 1.5,
        "electronics" => 0.8
    ];
    
    $adjustment = $price_adjustments[$category] ?? 1.0;
    $base_price = (int)($base_price * $adjustment);
    
    // محدودیت قیمت
    $base_price = min($base_price, 5000000);
    $base_price = max($base_price, 100000);
    
    $converted[] = [
        'name' => $translated_name,
        'description' => generateProductDescription($translated_name, $category, $faker),
        'base_price' => $base_price,
        'subcategory_id' => $subcategory_id,
        'image_url' => generateFashionImage($category, $translated_name),
        'color_id' => rand(1, 40),
        'material' => $mapping['materials'][array_rand($mapping['materials'])],
        'style_tags' => json_encode($mapping['styles'])
    ];
}

// ایجاد پوشه اگر وجود ندارد
$dir = __DIR__.'/../sampledata';
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

file_put_contents($dir.'/converted_products.json', json_encode($converted, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

echo "✅ داده‌های محصولات با موفقیت دریافت و تبدیل شدند!";
?>