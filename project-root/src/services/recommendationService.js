import { getRecommendations } from './ai-service';
import { transformAIResponse } from '../utils/aiHelpers';

export const loadRecommendations = async (userId) => {
    try {
        // دریافت پیشنهادات از API
        const rawData = await getRecommendations(userId);
        
        // تبدیل به فرمت قابل استفاده
        return transformAIResponse(rawData);
    } catch (error) {
        // بازیابی پیشنهادات عمومی در صورت خطا
        return fetchFallbackRecommendations();
    }
};

const fetchFallbackRecommendations = async () => {
    const response = await fetch('/api/products/top-rated');
    return response.json();
};

export const refreshRecommendations = async (userId) => {
    // پاکسازی کش
    caches.delete('ai-recommendations');
    
    // دریافت پیشنهادات تازه
    return loadRecommendations(userId);
};