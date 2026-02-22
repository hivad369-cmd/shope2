<?php
class RecommendationEngine {
    private $db;
    private $userId;
    private $cacheDir;

    public function __construct($userId) {
        $this->db = Database::getInstance();
        $this->userId = $userId;
        $this->cacheDir = __DIR__ . '/../../cache/';
        
        // اطمینان از وجود پوشه کش
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0777, true);
        }
    }

    public function getPersonalizedRecommendations($limit = 12) {
        $profile = $this->getUserProfile();
        $recommendations = $this->fetchAIRecommendations($profile);
        return $this->applyAdditionalFilters($recommendations, $limit);
    }

    private function getUserProfile() {
        $stmt = $this->db->prepare("
            SELECT 
                b.body_style_id, 
                b.skin_tone_id, 
                b.height_cm, 
                b.weight_kg,
                p.preferred_colors, 
                p.avoided_colors
            FROM user_body_profiles b
            LEFT JOIN user_preferences p ON b.user_id = p.user_id
            WHERE b.user_id = :user_id AND b.is_default = 1
        ");
        $stmt->execute([':user_id' => $this->userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?? [];
    }

    private function fetchAIRecommendations($profile) {
        $cacheFile = $this->cacheDir . "ai_rec_{$this->userId}.json";
        
        // بررسی کش معتبر
        if (file_exists($cacheFile)) {
            $fileAge = time() - filemtime($cacheFile);
            if ($fileAge < 3600) {
                $cachedData = file_get_contents($cacheFile);
                if ($cachedData) {
                    return json_decode($cachedData, true);
                }
            }
        }
        
        // دریافت پیشنهادات جدید از API
        $apiResponse = $this->callRecommendationAPI($profile);
        $recommendations = $this->parseAPIResponse($apiResponse);
        
        // ذخیره در فایل
        if (!empty($recommendations)) {
            file_put_contents($cacheFile, json_encode($recommendations));
        }
        
        return $recommendations;
    }

    private function callRecommendationAPI($profile) {
        // URL سرویس هوش مصنوعی
        $apiUrl = "https://your-ai-service.com/recommend";
        
        // ساختار داده‌های ارسالی
        $data = [
            'user_id' => $this->userId,
            'body_style' => $profile['body_style_id'] ?? null,
            'skin_tone' => $profile['skin_tone_id'] ?? null,
            'height' => $profile['height_cm'] ?? null,
            'weight' => $profile['weight_kg'] ?? null,
            'preferences' => !empty($profile['preferred_colors']) ? 
                json_decode($profile['preferred_colors'], true) : [],
            'avoided_colors' => !empty($profile['avoided_colors']) ? 
                json_decode($profile['avoided_colors'], true) : []
        ];

        // تنظیمات درخواست HTTP
        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
                'timeout' => 15 // 15 ثانیه تایم‌اوت
            ],
        ];

        try {
            $context = stream_context_create($options);
            $response = file_get_contents($apiUrl, false, $context);
            
            if ($response === false) {
                throw new Exception("Failed to connect to AI service");
            }
            
            return json_decode($response, true);
        } catch (Exception $e) {
            error_log("AI API Error: " . $e->getMessage());
            return []; // بازگرداندن آرایه خالی در صورت خطا
        }
    }

    private function parseAPIResponse($response) {
        // فرمت پاسخ پیش‌فرض
        $defaultFormat = [
            'recommendations' => [],
            'status' => 'success'
        ];
        
        // بررسی ساختار پاسخ
        if (!is_array($response) || empty($response)) {
            return [];
        }
        
        // اگر پاسخ شامل کلید recommendations باشد
        if (isset($response['recommendations']) && is_array($response['recommendations'])) {
            return $response['recommendations'];
        }
        
        // اگر پاسخ مستقیم آرایه محصولات باشد
        if (isset($response[0]['id'])) {
            return $response;
        }
        
        return [];
    }

    private function applyAdditionalFilters($recommendations, $limit) {
        if (empty($recommendations)) {
            return [];
        }
        
        // فیلتر بر اساس موجودی انبار
        $filtered = array_filter($recommendations, function($product) {
            return ($product['stock'] ?? 0) > 0;
        });
        
        // محدودیت تعداد
        return array_slice($filtered, 0, $limit);
    }
}
?>