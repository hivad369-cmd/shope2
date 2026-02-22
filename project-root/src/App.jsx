import Navbar from './Navbar'; // یا مسیر دقیق‌تر اگر توی فولدر دیگه‌ایه، مثل: './components/Navbar'

function App() {
  return (
    <div>
      <Navbar />
      {/* بقیه محتوای صفحه‌ت */}
      <h2 className="text-center mt-10 text-2xl">سلام دنیا!</h2>
    </div>
  );
}

export default App;
