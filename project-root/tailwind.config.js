module.exports = {
  content: [
    "./src/**/*.{php,js,jsx,ts,tsx}",
    "./public/**/*.php", // اصلاح شده
    "../src/**/*.{php,js,jsx}" // اضافه شده
  ],
  theme: {
    extend: {
      // اضافه کردن تنظیمات سفارشی
      borderRadius: {
        'xl-custom': '1rem',
      },
      boxShadow: {
        '2xl': '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
      },
      transitionProperty: {
        'transform-shadow': 'transform, box-shadow',
      },
      scale: {
        '105': '1.05',
      },
      colors: {
        'beige': '#F5F5DC', // نام دلخواه
      }
    },
  },
  plugins: [],
}