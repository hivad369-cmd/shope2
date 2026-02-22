export const analyzeBodyProfile = async (profileData) => {
    try {
        const response = await fetch('/api/ai/analyze-profile', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({
                measurements: profileData.measurements,
                preferences: profileData.preferences
            })
        });
        
        if (!response.ok) throw new Error('AI analysis failed');
        return await response.json();
    } catch (error) {
        console.error('AI Service Error:', error);
        return { error: 'خطا در ارتباط با سرویس هوش مصنوعی' };
    }
};

export const getRecommendations = async (userId) => {
    try {
        const response = await fetch(`/api/ai/recommendations/${userId}`);
        if (!response.ok) throw new Error('Failed to get recommendations');
        return await response.json();
    } catch (error) {
        console.error('Recommendations Error:', error);
        return { error: 'خطا در دریافت پیشنهادات' };
    }
};

export const sendFeedback = async (feedbackData) => {
    try {
        const response = await fetch('/api/ai/feedback', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(feedbackData)
        });
        return response.ok;
    } catch (error) {
        console.error('Feedback Error:', error);
        return false;
    }
};