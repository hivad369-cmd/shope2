<!doctype html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>پیشنهادهای شخصی‌سازی‌شده — استایلیست من</title>

  <!-- Tailwind (CDN برای توسعه محلی) -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  <style>
    body { font-family: "Vazirmatn", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; }
    /* زیبا کردن scrollbar برای بخش اسکرول افقی محصولات (اختیاری) */
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .match-badge { background: linear-gradient(90deg,#10b981,#059669); }
    /* برای مودال: */
    .modal-backdrop { background: rgba(15, 23, 42, 0.6); }
  </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 text-gray-800">

  <!-- Container -->
  <div class="min-h-screen container mx-auto px-4 py-10 max-w-7xl">

    <!-- Header / Hero -->
    <header class="mb-8">
      <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div>
          <h1 class="text-2xl md:text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-emerald-600 to-amber-400">
            پیشنهادهای هوشمند برای شما
          </h1>
          <p class="text-gray-600 mt-1">پیشنهادهایی که بر اساس پروفایل بدنی و ترجیحات سبک شما توسط موتور هوش‌مصنوعی تولید شده‌اند.</p>
        </div>

        <div class="flex items-center gap-3">
          <div class="text-right">
            <p class="text-sm text-gray-600">کاربر:</p>
            <p class="font-medium">علی</p>
          </div>
          <button id="editProfileBtn" class="px-4 py-2 rounded-full border border-emerald-200 text-emerald-700 hover:bg-emerald-50 transition">
            ویرایش پروفایل
          </button>
        </div>
      </div>
    </header>

    <!-- Main layout: filters + suggestions -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

      <!-- Filters (left in desktop) -->
      <aside class="lg:col-span-1 order-2 lg:order-1">
        <div class="bg-white rounded-xl p-5 shadow-sm border border-gray-100">
          <h3 class="font-semibold mb-3">فیلترها</h3>

          <label class="block text-sm text-gray-600 mb-2">حداقل درصد تطابق</label>
          <input id="minMatch" type="range" min="0" max="100" value="40" class="w-full mb-3">

          <label class="block text-sm text-gray-600 mb-2">حداکثر قیمت (تومان)</label>
          <input id="maxPrice" type="number" min="0" placeholder="مثلاً 500000" class="w-full px-3 py-2 rounded-md border border-gray-200 mb-3">

          <label class="block text-sm text-gray-600 mb-2">دسته‌بندی</label>
          <select id="categoryFilter" class="w-full rounded-md border border-gray-200 px-3 py-2 mb-4">
            <option value="">همه</option>
            <option value="women">لباس زنانه</option>
            <option value="men">لباس مردانه</option>
            <option value="shoes">کفش</option>
            <option value="accessory">لوازم جانبی</option>
          </select>

          <button id="applyFilters" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white py-2 rounded-md transition">اعمال فیلتر</button>
        </div>

        <!-- Summary card: why these suggestions -->
        <div class="mt-4 bg-gradient-to-r from-emerald-50 to-white rounded-xl p-4 border border-emerald-100 shadow-sm">
          <h4 class="text-sm font-semibold mb-2">چرا این پیشنهادها؟</h4>
          <ul class="text-sm text-gray-600 space-y-2">
            <li>• تطابق با پروفایل بدنی شما</li>
            <li>• اولویت‌های سبک انتخابی شما</li>
            <li>• امتیاز تطابق محاسبه‌شده توسط مدل AI</li>
          </ul>
        </div>
      </aside>

      <!-- Suggestions list -->
      <main class="lg:col-span-3 order-1 lg:order-2">
        <!-- Top controls -->
        <div class="flex items-center justify-between mb-4">
          <div class="text-sm text-gray-600">نمایش <span id="resultCount" class="font-medium">0</span> پیشنهاد</div>

          <div class="flex items-center gap-3">
            <input id="searchInput" type="search" placeholder="جستجو در پیشنهادها..." class="px-3 py-2 rounded-md border border-gray-200" />
            <select id="sortSelect" class="rounded-md border border-gray-200 px-3 py-2">
              <option value="match_desc">مرتب‌سازی بر اساس تطابق</option>
              <option value="price_asc">قیمت (کم → زیاد)</option>
              <option value="price_desc">قیمت (زیاد → کم)</option>
            </select>
          </div>
        </div>

        <!-- loading / empty states -->
        <div id="loading" class="w-full py-24 flex items-center justify-center">
          <div class="text-center">
            <div class="inline-block animate-spin mb-3">
              <i class="fas fa-spinner fa-2x text-emerald-500"></i>
            </div>
            <p class="text-gray-600">در حال آماده‌سازی پیشنهادها ...</p>
          </div>
        </div>

        <div id="emptyState" class="hidden w-full py-20 text-center text-gray-600">
          <p class="mb-4">فعلاً پیشنهادی برای نمایش وجود ندارد.</p>
          <button id="retryBtn" class="px-4 py-2 bg-emerald-600 text-white rounded-md">تلاش مجدد</button>
        </div>

        <!-- Grid of suggestions -->
        <section id="suggestionsGrid" class="hidden grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
          <!-- cards injected by JS -->
        </section>

        <!-- pagination (simple) -->
        <div id="pagination" class="hidden mt-6 flex justify-center items-center gap-3">
          <button id="prevPage" class="px-3 py-1 rounded-md border">قبلی</button>
          <span id="pageInfo" class="text-sm text-gray-600">صفحه 1 از 1</span>
          <button id="nextPage" class="px-3 py-1 rounded-md border">بعدی</button>
        </div>
      </main>
    </div>
  </div>

  <!-- Modal: product details & AI reasons -->
  <div id="productModal" class="fixed inset-0 z-50 hidden items-center justify-center">
    <div class="absolute inset-0 modal-backdrop" aria-hidden="true"></div>

    <div class="bg-white rounded-xl shadow-xl max-w-4xl w-full mx-4 lg:mx-0 overflow-hidden relative z-10">
      <div class="flex flex-col lg:flex-row">
        <div class="lg:w-1/2">
          <img id="modalImage" src="/public/assets/images/manset.webp" alt="تصویر محصول" class="w-full h-80 object-cover">
        </div>
        <div class="lg:w-1/2 p-6">
          <div class="flex items-start justify-between">
            <div>
              <h3 id="modalTitle" class="text-xl font-bold mb-2">عنوان محصول</h3>
              <p id="modalPrice" class="text-emerald-600 font-bold mb-2">۲۵۰,۰۰۰ تومان</p>
            </div>
            <button id="closeModal" class="text-gray-400 hover:text-gray-700">
              <i class="fas fa-times"></i>
            </button>
          </div>

          <div class="mb-4">
            <h4 class="font-semibold text-gray-700 mb-2">دلیل‌های پیشنهاد AI</h4>
            <ul id="modalReasons" class="list-disc list-inside text-sm text-gray-600 space-y-2"></ul>
          </div>
          <div class="mt-4" id="modalFeedbackSection">
                <h5 class="font-semibold mb-2">این پیشنهاد کمک کرد؟</h5>
                <div class="flex items-center gap-2">
                    <button id="modalHelpfulBtn" class="px-3 py-1 rounded-md border">بله</button>
                    <button id="modalNotHelpfulBtn" class="px-3 py-1 rounded-md border">خیر</button>
                </div>

                <div id="modalFeedbackForm" class="hidden mt-3 bg-gray-50 p-3 rounded-md border">
                    <label class="block text-sm mb-2">چرا این پیشنهاد مفید نبود؟</label>
                    <div class="flex gap-2 mb-2 flex-wrap">
                    <button class="reasonBtn px-2 py-1 rounded-md border" data-reason="color">رنگ</button>
                    <button class="reasonBtn px-2 py-1 rounded-md border" data-reason="size">سایز</button>
                    <button class="reasonBtn px-2 py-1 rounded-md border" data-reason="style">استایل</button>
                    <button class="reasonBtn px-2 py-1 rounded-md border" data-reason="wrong_reason">دلیل AI نادرست بود</button>
                    </div>
                    <textarea id="modalFeedbackText" rows="3" class="w-full rounded-md border p-2" placeholder="اگر دوست داری دلیل بیشتری بنویس..."></textarea>
                    <div class="mt-2 flex justify-end">
                    <button id="submitModalFeedback" class="px-3 py-1 bg-emerald-600 text-white rounded-md">ارسال فیدبک</button>
                    </div>
                </div>
         </div>
          <div class="flex items-center gap-3 mt-4">
            <button id="addToCartModal" class="bg-emerald-600 text-white px-4 py-2 rounded-md shadow">افزودن به سبد</button>
            <button id="viewDetailsModal" class="px-4 py-2 rounded-md border">مشاهده صفحه محصول</button>
            <div id="modalMatch" class="ml-auto text-sm inline-flex items-center gap-2">
              <span class="px-2 py-1 rounded-full match-badge text-white text-xs font-semibold">۸۷٪</span>
              <span class="text-gray-500">تطابق</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Sample data + rendering JS -->
  <script>
    // --- پروفایل کاربر (نمایش در هدر) ---
const userProfile = {
  id: 123,
  name: "آقای نمونه",
  gender: "male",
  bodyShape: "سیب",
  skinTone: "تیره",
  stylePreferences: ["کلاسیک"],
  favoriteColors: ["سورمه‌ای"],
  dislikedColors: ["نارنجی"],
  size: "3XL"
};

// --- پیشنهادهای نمونهِ مرتبط با پروفایل بالا ---
const sampleSuggestions = [
  {
    id: 101,
    title: "کت کلاسیک سورمه‌ای",
    price: 850000,
    oldPrice: 1100000,
    image: "/public/assets/images/cot1.jpg",
    match: 95,
    reasons: [
      "سورمه‌ای مطلوب کاربر است و با تون پوست تیره همخوانی بالایی دارد.",
      "برش کلاسیک و ساختاریِ کت کمک می‌کند تا ناحیهٔ میانی در شکل بدنی «سیب» کمتر جلب توجه کند.",
      "این مدل در سایز 3XL موجود است (تضمین فیت مناسب)."
    ],
    category: "men",
    sizes: ["L", "XL", "2XL", "3XL"]
  },
  {
    id: 102,
    title: "پیراهن مردانه سورمه‌ای ساده",
    price: 420000,
    image: "/public/assets/images/shirt dark.webp",
    match: 90,
    reasons: [
      "رنگ سورمه‌ای مطابق با اولویت رنگ کاربر است.",
      "یقه کلاسیک و کوتاهی آستین مناسب استایل رسمی/کلاسیک است.",
      "آستین و برش مناسب کمک می‌کند توجه از تنهٔ میانی کاسته شود."
    ],
    category: "men",
    sizes: ["M", "L", "XL", "2XL", "3XL"]
  },
  {
    id: 103,
    title: "شلوار پارچه‌ای کلاسیک خاکستری تیره",
    price: 380000,
    oldPrice: 450000,
    image: "/public/assets/images/shalvar.jpg",
    match: 86,
    reasons: [
      "ترکیب خاکستری تیره با سورمه‌ای بالانس می‌کند و استایل کلاسیک حفظ می‌شود.",
      "کات مناسب در ناحیه کمر و فاق برای شکل بدن سیب طراحی شده است.",
      "قابلیت انتخاب سایز 3XL برای فیت مناسب وجود دارد."
    ],
    category: "men",
    sizes: ["L", "XL", "2XL", "3XL"]
  },
  {
    id: 104,
    title: "کفش رسمی مشکی",
    price: 690000,
    image: "/public/assets/images/shoe.jpg",
    match: 78,
    reasons: [
      "کفش رسمی مشکی با استایل کلاسیک بسیار همخوان است.",
      "رنگ مشکی با تون پوست تیره تضاد مطبوعی ایجاد می‌کند.",
      "جزء ضروری برای کامل‌کردن ست کلاسیک (پوشش بالاتنه سورمه‌ای + شلوار خاکستری)."
    ],
    category: "shoes",
    sizes: ["40", "41", "42", "43", "44"]
  },
  {
    id: 105,
    title: "پیراهن نارنجی چاپی — (نامناسب)",
    price: 210000,
    image: "/public/assets/images/orange-shirt.jpg",
    match: 22,
    reasons: [
      "رنگ نارنجی در لیست رنگ‌های نامطلوب کاربر قرار دارد.",
      "طراحی چاپی و رنگ روشن با اولویت کلاسیک همسو نیست.",
      "بنابراین اولویت نمایش پایین آمده و پیشنهاد نمی‌شود."
    ],
    category: "men",
    sizes: ["L", "XL", "2XL", "3XL"]
  }
];

document.addEventListener('DOMContentLoaded', () => {
  const nameEl = document.querySelector('#headerUserName');
  const summaryEl = document.querySelector('#headerUserSummary');

  if (nameEl) nameEl.innerText = userProfile.name;
  if (summaryEl) summaryEl.innerText = `${userProfile.bodyShape} • ${userProfile.stylePreferences.join(', ')} • سایز ${userProfile.size}`;

  filtered = sampleSuggestions.slice();
  currentPage = 1;
  applyFilters();
});
    // حالت صفحه‌بندی ساده
    let currentPage = 1, perPage = 6, filtered = [];

    // helper: format price
    function formatPrice(n) {
      return n ? n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " تومان" : "";
    }

    // render a single card
    function createCard(item) {
      const div = document.createElement('article');
      div.className = "bg-white rounded-2xl p-4 shadow-md border border-gray-100 flex gap-4";
      div.setAttribute('data-id', item.id);

      div.innerHTML = `
        <div class="w-32 h-32 flex-shrink-0 rounded-lg overflow-hidden">
          <img src="${item.image}" alt="${item.title}" class="w-full h-full object-cover">
        </div>
        <div class="flex-1">
          <div class="flex items-start justify-between gap-3">
            <div>
              <h3 class="text-lg font-bold">${item.title}</h3>
              <p class="text-sm text-gray-500 mt-1">${item.reasons[0] || ''}</p>
            </div>
            <div class="text-right">
              <div class="inline-flex items-center gap-2">
                <span class="px-2 py-1 rounded-full bg-emerald-50 text-emerald-700 font-semibold">${item.match}%</span>
                <span class="text-xs text-gray-500">تطابق</span>
              </div>
            </div>
          </div>

          <div class="flex items-center gap-4 mt-3">
            <div>
              <div class="text-emerald-600 font-bold">${formatPrice(item.price)}</div>
              ${item.oldPrice ? `<div class="text-sm text-gray-400 line-through">${formatPrice(item.oldPrice)}</div>` : ''}
            </div>

            <div class="ml-auto flex items-center gap-2">
              <button class="openModalBtn px-3 py-1 rounded-md border border-gray-200 text-sm">جزئیات</button>
              <button class="addToCartBtn bg-emerald-600 text-white px-3 py-1 rounded-md text-sm">افزودن</button>
              <!-- INSERT after line 311 -->
                <div class="mt-3 flex items-center gap-3">
                <button class="feedbackBtn inline-flex items-center gap-2 text-sm px-2 py-1 rounded-md border" data-action="helpful" title="مفید">
                    <i class="fa-regular fa-thumbs-up"></i> مفید
                </button>
                <button class="feedbackBtn inline-flex items-center gap-2 text-sm px-2 py-1 rounded-md border" data-action="not_helpful" title="مفید نبود">
                    <i class="fa-regular fa-thumbs-down"></i> مفید نبود
                </button>
                </div>
                <!-- END INSERT -->

            </div>
          </div>
        </div>
      `;

      // wire buttons
      div.querySelector('.openModalBtn').addEventListener('click', () => openModal(item));
      div.querySelector('.addToCartBtn').addEventListener('click', () => addToCart(item));
            // feedback button listeners (put before return div;)
        div.querySelectorAll('.feedbackBtn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const action = btn.getAttribute('data-action');
            btn.disabled = true;
            sendFeedback(item.id, { helpful: action === 'helpful', context: { from: 'card' } })
            .then(()=> btn.classList.add('opacity-70'))
            .catch(()=> { btn.disabled = false; alert('ارسال فیدبک با خطا مواجه شد.'); });
        });
        });
      return div;
    }

    function renderSuggestions(list) {
      const grid = document.getElementById('suggestionsGrid');
      grid.innerHTML = '';

      if (!list.length) {
        document.getElementById('emptyState').classList.remove('hidden');
        document.getElementById('suggestionsGrid').classList.add('hidden');
        document.getElementById('pagination').classList.add('hidden');
        document.getElementById('resultCount').innerText = 0;
        return;
      }

      document.getElementById('emptyState').classList.add('hidden');
      document.getElementById('loading').classList.add('hidden');
      document.getElementById('suggestionsGrid').classList.remove('hidden');
      document.getElementById('pagination').classList.remove('hidden');

      // simple pagination slice
      const start = (currentPage - 1) * perPage;
      const pageItems = list.slice(start, start + perPage);

      pageItems.forEach(item => {
        grid.appendChild(createCard(item));
      });

      const totalPages = Math.ceil(list.length / perPage);
      document.getElementById('pageInfo').innerText = `صفحه ${currentPage} از ${Math.max(1, totalPages)}`;
      document.getElementById('resultCount').innerText = list.length;
    }

    // open modal
    function openModal(item) {
      document.getElementById('modalImage').src = item.image;
      document.getElementById('modalTitle').innerText = item.title;
      document.getElementById('modalPrice').innerText = formatPrice(item.price);
      document.getElementById('modalReasons').innerHTML = '';
      item.reasons.forEach(r => {
        const li = document.createElement('li');
        li.innerText = r;
        document.getElementById('modalReasons').appendChild(li);
      });
      document.getElementById('modalMatch').querySelector('.match-badge').innerText = item.match + '%';
      document.getElementById('productModal').classList.remove('hidden');
      document.getElementById('productModal').classList.add('flex');
    }

    function closeModal() {
      document.getElementById('productModal').classList.add('hidden');
      document.getElementById('productModal').classList.remove('flex');
    }

    function addToCart(item) {
      // در پیاده‌سازی واقعی به API سبد ارسال کن
      alert(`محصول "${item.title}" به سبد اضافه شد (شبیه‌سازی).`);
    }

    // apply filters
    function applyFilters() {
      const minMatch = parseInt(document.getElementById('minMatch').value, 10);
      const maxPrice = parseInt(document.getElementById('maxPrice').value || "0", 10);
      const category = document.getElementById('categoryFilter').value;
      const search = (document.getElementById('searchInput').value || '').trim().toLowerCase();
      const sort = document.getElementById('sortSelect').value;

      filtered = sampleSuggestions.filter(it => {
        if (it.match < minMatch) return false;
        if (maxPrice > 0 && it.price > maxPrice) return false;
        if (category && it.category !== category) return false;
        if (search && ! (it.title + ' ' + (it.reasons.join(' '))).toLowerCase().includes(search)) return false;
        return true;
      });

      // sort
      if (sort === 'match_desc') filtered.sort((a,b)=>b.match-a.match);
      if (sort === 'price_asc') filtered.sort((a,b)=>a.price-b.price);
      if (sort === 'price_desc') filtered.sort((a,b)=>b.price-a.price);

      currentPage = 1;
      renderSuggestions(filtered);
    }

    // pagination handlers
    document.getElementById('prevPage').addEventListener('click', () => {
      if (currentPage > 1) { currentPage--; renderSuggestions(filtered); }
    });
    document.getElementById('nextPage').addEventListener('click', () => {
      const totalPages = Math.ceil(filtered.length / perPage);
      if (currentPage < totalPages) { currentPage++; renderSuggestions(filtered); }
    });

    // hook controls
    document.getElementById('applyFilters').addEventListener('click', applyFilters);
    document.getElementById('searchInput').addEventListener('input', () => applyFilters());
    document.getElementById('sortSelect').addEventListener('change', applyFilters);
    document.getElementById('retryBtn').addEventListener('click', () => init());
    document.getElementById('closeModal').addEventListener('click', closeModal);
    document.getElementById('productModal').addEventListener('click', function(e){
      if (e.target === this) closeModal();
    });
    document.getElementById('editProfileBtn').addEventListener('click', function(){
      // هدایت به بخش ویرایش پروفایل بدنی یا ترجیحات
      window.location.href = '?page=body-profile';
    });

    /* INSERT at line 427 (before function init) */
// helper: ارسال فیدبک به سرور
function sendFeedback(suggestionId, payload) {
  const body = {
    userId: userProfile.id || null,
    suggestionId,
    timestamp: new Date().toISOString(),
    ...payload
  };
  return fetch('/api/feedback', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(body)
  }).then(resp => {
    if (!resp.ok) throw new Error('network');
    return resp.json();
  });
}

    // modal feedback logic
    let modalCurrentItemId = null;
    let chosenReason = null;

    const modalHelpfulBtn = document.getElementById('modalHelpfulBtn');
    const modalNotHelpfulBtn = document.getElementById('modalNotHelpfulBtn');
    const modalFeedbackForm = document.getElementById('modalFeedbackForm');
    const submitModalFeedback = document.getElementById('submitModalFeedback');

    if (modalHelpfulBtn) {
    modalHelpfulBtn.addEventListener('click', () => {
        if (!modalCurrentItemId) return;
        sendFeedback(modalCurrentItemId, { helpful: true, context: { from: 'modal' } })
        .then(()=> modalHelpfulBtn.classList.add('opacity-70'))
        .catch(()=> alert('ارسال با خطا مواجه شد'));
    });
    }

    if (modalNotHelpfulBtn) {
    modalNotHelpfulBtn.addEventListener('click', () => {
        if (!modalCurrentItemId) return;
        modalFeedbackForm.classList.remove('hidden');
    });
    }

    if (modalFeedbackForm) {
    modalFeedbackForm.querySelectorAll('.reasonBtn').forEach(b => {
        b.addEventListener('click', ()=> {
        modalFeedbackForm.querySelectorAll('.reasonBtn').forEach(x=>x.classList.remove('bg-emerald-100'));
        b.classList.add('bg-emerald-100');
        chosenReason = b.getAttribute('data-reason');
        });
    });
    }

    if (submitModalFeedback) {
    submitModalFeedback.addEventListener('click', ()=> {
        if (!modalCurrentItemId) return;
        const text = document.getElementById('modalFeedbackText').value.trim();
        sendFeedback(modalCurrentItemId, {
        helpful: false,
        reason: chosenReason,
        comment: text,
        context: { from: 'modal' }
        }).then(()=> {
        modalFeedbackForm.classList.add('hidden');
        modalNotHelpfulBtn.classList.add('opacity-70');
        alert('ممنون! فیدبک شما ثبت شد.');
        }).catch(()=> alert('ارسال با خطا مواجه شد'));
    });
    }

    /* END INSERT */

    // initial render: simulate loading then show sample suggestions
    function init() {
      document.getElementById('loading').classList.remove('hidden');
      document.getElementById('suggestionsGrid').classList.add('hidden');
      document.getElementById('emptyState').classList.add('hidden');
      document.getElementById('pagination').classList.add('hidden');

      setTimeout(()=> {
        // در پیاده‌سازی واقعی اینجا fetch('YOUR_AI_API_ENDPOINT', {method:'POST', body:...})
        // سپس mappedResponse => sampleSuggestions
        filtered = sampleSuggestions.slice(); // copy
        currentPage = 1;
        applyFilters();
      }, 900);
    }

    // run
    init();
  </script>
</body>
</html>
