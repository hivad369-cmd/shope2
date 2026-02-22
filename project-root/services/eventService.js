export const trackEvent = (eventType, data) => {
    const events = JSON.parse(localStorage.getItem('userEvents') || []);
    const event = {
        type: eventType,
        data,
        timestamp: new Date().toISOString()
    };
    
    events.push(event);
    localStorage.setItem('userEvents', JSON.stringify(events));
    
    // ارسال به سرور در صورت آنلاین بودن
    if (navigator.onLine) {
        sendEventsToServer(events);
    }
};

const sendEventsToServer = async (events) => {
    try {
        await fetch('/api/events', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({ events })
        });
        localStorage.removeItem('userEvents');
    } catch (error) {
        console.error('Failed to send events:', error);
    }
};

export const initEventTracking = () => {
    // ردیابی رویدادهای مهم
    window.addEventListener('click', (e) => {
        if (e.target.closest('[data-ai-suggestion]')) {
            trackEvent('suggestion_click', {
                suggestionId: e.target.dataset.suggestionId
            });
        }
    });
    
    // همگام‌سازی رویدادها هنگام بازگشت به آنلاین
    window.addEventListener('online', () => {
        const events = JSON.parse(localStorage.getItem('userEvents') || []);
        if (events.length > 0) {
            sendEventsToServer(events);
        }
    });
};