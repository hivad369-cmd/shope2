import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
  // تنظیمات پایه
  base: '/public/',
  root: './src',
  publicDir: '../public',
  
  // پلاگین‌ها
  plugins: [react()],

  // تنظیمات سرور توسعه
  server: {
    host: '127.0.0.1',
    port: 3001,
    strictPort: true,
    cors: true,
    
    // تنظیمات HMR
    hmr: {
      protocol: 'ws',
      host: '127.0.0.1',
      port: 3001,
      overlay: false
    },
    
    // تنظیمات پروکسی
    proxy: {
      '^/api': {
        target: 'http://localhost:86',
        changeOrigin: true,
        secure: false,
        rewrite: (path) => path.replace(/^\/api/, '/public/api'),
        headers: {
          'X-Forwarded-Prefix': '/public'
        }
      },
      '^/assets': {
        target: 'http://localhost:86',
        changeOrigin: true,
        rewrite: (path) => path.replace(/^\/assets/, '/public/assets')
      },
      '^/images': {
        target: 'http://localhost:86',
        changeOrigin: true,
        rewrite: (path) => path.replace(/^\/images/, '/public/assets/images')
      }
    }
  },

  // تنظیمات ساخت
  build: {
    outDir: '../public/dist',
    emptyOutDir: true,
    manifest: true,
    sourcemap: true,
    minify: 'terser',
    
    // تنظیمات Rollup
    rollupOptions: {
      input: './src/App.jsx',
      output: {
        entryFileNames: 'js/[name].[hash].js',
        chunkFileNames: 'js/[name].[hash].js',
        assetFileNames: 'assets/[name].[hash].[ext]',
        manualChunks(id) {
          if (id.includes('node_modules')) {
            return 'vendor';
          }
        }
      }
    },
    
    // بهینه‌سازی‌های اضافه
    terserOptions: {
      compress: {
        drop_console: true,
        drop_debugger: true
      },
      format: {
        comments: false
      }
    }
  },

  // بهینه‌سازی وابستگی‌ها
  optimizeDeps: {
    include: [
      'react',
      'react-dom',
      'react-router-dom',
      'aos'
    ],
    exclude: ['js-big-decimal']
  }
});