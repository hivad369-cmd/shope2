document.addEventListener('DOMContentLoaded', function() {
    // مدیریت نمایش/پنهان کردن فرم‌ها
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    const loginTab = document.querySelector('[data-tab="login"]');
    const registerTab = document.querySelector('[data-tab="register"]');
    const loginLinks = document.querySelectorAll('.login-link');
    const registerLinks = document.querySelectorAll('.register-link');
    
    // تابع تغییر تب
    function switchTab(tabName) {
        if (tabName === 'login') {
            loginForm.classList.remove('hidden');
            registerForm.classList.add('hidden');
            loginTab.classList.add('active');
            registerTab.classList.remove('active');
        } else {
            loginForm.classList.add('hidden');
            registerForm.classList.remove('hidden');
            loginTab.classList.remove('active');
            registerTab.classList.add('active');
        }
    }
    
    // رویدادهای کلیک برای تب‌ها
    if (loginTab) {
        loginTab.addEventListener('click', () => switchTab('login'));
    }
    
    if (registerTab) {
        registerTab.addEventListener('click', () => switchTab('register'));
    }
    
    // رویدادهای کلیک برای لینک‌های تغییر فرم
    if (loginLinks.length > 0) {
        loginLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                switchTab('login');
            });
        });
    }
    
    if (registerLinks.length > 0) {
        registerLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                switchTab('register');
            });
        });
    }
    
    // مدیریت نمایش/پنهان کردن رمز عبور
    const passwordToggles = document.querySelectorAll('.password-toggle');
    
    if (passwordToggles.length > 0) {
        passwordToggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const inputId = this.getAttribute('data-input');
                const iconId = this.getAttribute('data-icon');
                const passwordInput = document.getElementById(inputId);
                const passwordIcon = document.getElementById(iconId);
                
                if (passwordInput && passwordIcon) {
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        passwordIcon.classList.remove('fa-eye-slash');
                        passwordIcon.classList.add('fa-eye');
                    } else {
                        passwordInput.type = 'password';
                        passwordIcon.classList.remove('fa-eye');
                        passwordIcon.classList.add('fa-eye-slash');
                    }
                }
            });
        });
    }
    
    // اعتبارسنجی فرم ثبت‌نام
    const registerFormElement = document.getElementById('registerForm');
    if (registerFormElement) {
        registerFormElement.addEventListener('submit', function(e) {
            const password = document.getElementById('register-password')?.value;
            const confirmPassword = document.getElementById('confirm-password')?.value;
            
            if (password && confirmPassword && password !== confirmPassword) {
                e.preventDefault();
                alert('رمز عبور و تکرار آن باید یکسان باشند');
            }
        });
    }
});