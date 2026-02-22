// تبدیل پاسخ API به فرمت قابل استفاده در UI
export const transformAIResponse = (aiData) => {
    return {
        products: aiData.recommendations.map(item => ({
            id: item.product_id,
            name: item.product_name,
            description: item.product_description,
            image: item.product_image,
            price: item.product_price,
            score: calculateProductScore(item),
            attributes: {
                fit: item.fit_rating,
                style: item.style_match,
                color: item.color_compatibility
            }
        })),
        summary: {
            bodyType: aiData.body_type_analysis,
            styleProfile: aiData.style_profile,
            improvementTips: aiData.improvement_suggestions
        }
    };
};

// محاسبه امتیاز کلی محصول
const calculateProductScore = (product) => {
    const weights = {
        fit: 0.4,
        style: 0.3,
        color: 0.2,
        confidence: 0.1
    };
    
    return (
        (product.fit_rating * weights.fit) +
        (product.style_match * weights.style) +
        (product.color_compatibility * weights.color) +
        (product.ai_confidence * weights.confidence)
    ).toFixed(1);
};

// پردازش خطاهای API
export const handleAIError = (error) => {
    const errorMessages = {
        400: 'داده‌های ارسالی نامعتبر است',
        401: 'دسترسی غیرمجاز',
        404: 'سرویس یافت نشد',
        500: 'خطای سرور هوش مصنوعی',
        timeout: 'زمان ارتباط با سرور به پایان رسید'
    };
    
    return errorMessages[error.code] || 'خطای ناشناخته در سیستم هوش مصنوعی';
};

// ایجاد پرامپت برای هوش مصنوعی
export const createAIPrompt = (userProfile) => {
    return `
    کاربر با مشخصات زیر:
    - استایل بدنی: ${userProfile.bodyStyle}
    - رنگ پوست: ${userProfile.skinTone}
    - قد: ${userProfile.height} سانتی‌متر
    - وزن: ${userProfile.weight} کیلوگرم
    - ترجیحات استایلی: ${userProfile.preferences.join(', ')}
    
    لطفاً محصولات مناسب را از بین کالاهای ما پیشنهاد دهید با در نظر گرفتن:
    1. تناسب با استایل بدنی
    2. هماهنگی با رنگ پوست
    3. مطابقت با ترجیحات استایلی
    4. جدیدترین ترندهای فصلی
    
    خروجی را به فرمت JSON زیر ارائه دهید:
    {
      "recommendations": [
        {
          "product_id": 1,
          "fit_score": 0.95,
          "style_score": 0.88,
          "color_score": 0.92,
          "confidence": 0.91,
          "reason": "توضیح کوتاه"
        }
      ]
    }
    `;
};