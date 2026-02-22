// گروه‌بندی رویدادها بر اساس نوع
export const groupEventsByType = (events) => {
    return events.reduce((acc, event) => {
        if (!acc[event.type]) {
            acc[event.type] = [];
        }
        acc[event.type].push(event);
        return acc;
    }, {});
};

// تحلیل الگوهای تعامل کاربر
export const analyzeUserBehavior = (events) => {
    const suggestionClicks = events.filter(e => e.type === 'suggestion_click');
    const feedbackEvents = events.filter(e => e.type === 'feedback_submitted');
    
    // محاسبه نرخ کلیک (CTR)
    const ctr = suggestionClicks.length / events.length;
    
    // محاسبه نرخ بازخورد مثبت
    const positiveFeedback = feedbackEvents.filter(f => f.data.feedback === 'positive').length;
    const feedbackRate = feedbackEvents.length > 0 ? 
        (positiveFeedback / feedbackEvents.length) : 0;
    
    return {
        suggestionCTR: ctr.toFixed(2),
        positiveFeedbackRate: feedbackRate.toFixed(2),
        favoriteCategories: getTopCategories(suggestionClicks)
    };
};

// شناسایی دسته‌بندی‌های محبوب
const getTopCategories = (events) => {
    const categoryCounts = events.reduce((acc, event) => {
        const category = event.data.category || 'unknown';
        acc[category] = (acc[category] || 0) + 1;
        return acc;
    }, {});
    
    return Object.entries(categoryCounts)
        .sort((a, b) => b[1] - a[1])
        .slice(0, 3)
        .map(([category]) => category);
};