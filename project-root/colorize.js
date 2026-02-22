// colorize.js
import chalk from 'chalk';

// تبدیل ورودی به حروف کوچک برای انعطاف‌پذیری بیشتر
const prefix = (process.argv[2] || 'log').toLowerCase();

const colors = {
  'vite': chalk.blue.bold,
  'tailwind': chalk.green.bold,
  'php': chalk.magenta.bold,
  'default': chalk.white
};

process.stdin.on('data', data => {
  const lines = data.toString().split('\n');
  lines.forEach(line => {
    if(line.trim()) {
      const colorFn = colors[prefix] || colors['default'];
      console.log(`${colorFn(`[${prefix.toUpperCase()}]`)} ${line}`);
    }
  });
});