<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Konsumen - E-commerce Pertanian</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-green: #4CAF50;
            --dark-green: #388E3C;
            --earth-brown: #795548;
            --light-brown: #A1887F;
            --sunny-yellow: #FFC107;
            --light-green: #C8E6C9;
            --cream: #F5F5DC;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            background-image: url('https://images.unsplash.com/photo-1464226184884-fa280b87c399?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
        }

        .dashboard-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            margin-top: 50px;
            margin-bottom: 50px;
            position: relative;
            overflow: hidden;
        }

        .dashboard-container::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background-color: var(--light-green);
            border-radius: 50%;
            opacity: 0.5;
            z-index: 0;
        }

        .dashboard-container::after {
            content: '';
            position: absolute;
            bottom: -70px;
            left: -70px;
            width: 250px;
            height: 250px;
            background-color: var(--cream);
            border-radius: 50%;
            opacity: 0.4;
            z-index: 0;
        }

        .welcome-icon {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .welcome-icon i {
            font-size: 60px;
            color: var(--primary-green);
            background-color: var(--light-green);
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(76, 175, 80, 0.4);
            }

            70% {
                box-shadow: 0 0 0 15px rgba(76, 175, 80, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(76, 175, 80, 0);
            }
        }

        h1 {
            text-align: center;
            font-size: 2rem;
            color: var(--dark-green);
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 30px;
            position: relative;
            z-index: 1;
        }

        .menu-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 25px 15px;
            background-color: white;
            border-radius: 15px;
            text-decoration: none;
            color: #333;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .menu-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background-color: var(--primary-green);
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            background-color: var(--light-green);
        }

        .menu-item:hover::before {
            width: 100%;
            opacity: 0.1;
        }

        .menu-item i {
            font-size: 2rem;
            margin-bottom: 10px;
            color: var(--primary-green);
            transition: all 0.3s ease;
        }

        .menu-item:hover i {
            color: var(--earth-brown);
            transform: scale(1.1);
        }

        .menu-item span {
            font-weight: 500;
            text-align: center;
        }

        .cart-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: var(--sunny-yellow);
            color: var(--earth-brown);
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 15px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .logout-btn:hover {
            background-color: #d32f2f;
            transform: translateY(-2px);
        }

        .logout-btn i {
            margin-right: 10px;
        }

        .notification {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            animation: slideIn 0.5s ease;
            position: relative;
            z-index: 1;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .notification i {
            margin-right: 10px;
        }

        .notification.success {
            background-color: #d4edda;
            color: #155724;
        }

        .notification.error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .floating-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 15px 20px;
            background-color: white;
            border-left: 4px solid var(--primary-green);
            border-radius: 5px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            display: none;
            animation: slideInRight 0.5s ease;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .product-preview {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            max-width: 500px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            display: none;
            overflow: hidden;
        }

        .product-preview-header {
            background-color: var(--primary-green);
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product-preview-body {
            padding: 20px;
        }

        .close-preview {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .featured-products {
            margin-top: 30px;
            position: relative;
            z-index: 1;
        }

        .section-title {
            font-size: 1.5rem;
            color: var(--dark-green);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 10px;
            color: var(--primary-green);
        }

        .product-scroll {
            display: flex;
            overflow-x: auto;
            gap: 15px;
            padding-bottom: 10px;
            scrollbar-width: thin;
            scrollbar-color: var(--light-green) white;
        }

        .product-scroll::-webkit-scrollbar {
            height: 8px;
        }

        .product-scroll::-webkit-scrollbar-track {
            background: white;
            border-radius: 10px;
        }

        .product-scroll::-webkit-scrollbar-thumb {
            background-color: var(--light-green);
            border-radius: 10px;
        }

        .product-card {
            min-width: 150px;
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }

        .product-image {
            height: 100px;
            background-color: var(--light-green);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image i {
            font-size: 2.5rem;
            color: var(--primary-green);
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            padding: 10px;
        }

        .product-name {
            font-weight: 500;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .product-price {
            color: var(--earth-brown);
            font-weight: 600;
        }

        .farmer-info {
            display: flex;
            align-items: center;
            margin-top: 10px;
            font-size: 0.8rem;
            color: #666;
        }

        .farmer-info i {
            margin-right: 5px;
            color: var(--primary-green);
        }

        @media (max-width: 600px) {
            .menu-grid {
                grid-template-columns: 1fr;
            }

            .dashboard-container {
                padding: 30px 15px;
                margin-top: 20px;
                margin-bottom: 20px;
            }

            h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <div class="welcome-icon">
            <i class="fas fa-seedling"></i>
        </div>

        <h1>Selamat Datang, Konsumen!</h1>
        <p class="subtitle">Ayo belanja produk pertanian segar langsung dari petani lokal</p>

        @if (session('success'))
            <div class="notification success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="notification error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <div class="menu-grid">
            <a href="{{ route('konsumen.browse') }}" class="menu-item" id="browse-products">
                <i class="fas fa-search"></i>
                <span>Cari Produk</span>
            </a>

            <a href="#" class="menu-item" id="view-cart">
                <i class="fas fa-shopping-cart"></i>
                <span>Keranjang</span>
                <span class="cart-badge" id="cart-count">3</span>
            </a>

            <a href="{{ route('konsumen.purchase.history') }}" class="menu-item">
                <i class="fas fa-list"></i>
                <span>Pesanan Saya</span>
            </a>

            <a href="{{ route('konsumen.wishlist') }}" class="menu-item">
                <i class="fas fa-heart"></i>
                <span>Wishlist</span>
            </a>

            <a href="{{ route('konsumen.addresses') }}" class="menu-item">
                <i class="fas fa-map-marker-alt"></i>
                <span>Alamat</span>
            </a>

            <a href="{{ route('profile.edit') }}" class="menu-item">
                <i class="fas fa-user-edit"></i>
                <span>Edit Profile</span>
            </a>
        </div>

        <div class="featured-products">
            <h2 class="section-title">
                <i class="fas fa-star"></i>
                Produk Unggulan
            </h2>
            <div class="product-scroll" id="featured-products-container">
                @foreach($latestProducts as $product)
                    <div class="product-card" data-id="{{ $product->id }}">
                        @if($product->gambar)
                            <div class="product-image">
                                <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama_produk }}">
                            </div>
                        @else
                            <div class="product-image">
                                <i class="fas fa-seedling"></i>
                            </div>
                        @endif
                        <div class="product-info">
                            <div class="product-name">{{ $product->nama_produk }}</div>
                            <div class="product-price">Rp {{ number_format($product->harga, 0, ',', '.') }}</div>
                            <div class="farmer-info">
                                <i class="fas fa-user"></i> {{ $product->farmer->name ?? 'Petani Lokal' }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>

    <!-- Preview Produk -->
    <div class="overlay" id="overlay"></div>
    <div class="product-preview" id="product-preview">
        <div class="product-preview-header">
            <h3>Detail Produk</h3>
            <button class="close-preview" id="close-preview">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="product-preview-body" id="product-preview-content">
            <!-- Konten preview produk akan dimuat melalui AJAX -->
        </div>
    </div>

    <!-- Notifikasi Melayang -->
    <div class="floating-notification" id="floating-notification">
        <div id="notification-content"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Setup event listeners
            setupEventListeners();
        });

        function setupEventListeners() {
            // Preview produk
            document.getElementById('close-preview').addEventListener('click', hideProductPreview);
            document.getElementById('overlay').addEventListener('click', hideProductPreview);

            // Keranjang belanja
            document.getElementById('view-cart').addEventListener('click', function(e) {
                e.preventDefault();
                showNotification('Keranjang belanja Anda sedang dimuat...');
                // Di sini bisa ditambahkan AJAX untuk memuat konten keranjang
            });

            // Cari produk
            document.getElementById('browse-products').addEventListener('click', function(e) {
                e.preventDefault();
                showNotification('Mengarahkan ke halaman pencarian produk...');
                window.location.href = "{{ route('konsumen.browse') }}";
            });

            // Tambahkan event listener untuk setiap kartu produk
            const productCards = document.querySelectorAll('.product-card');
            productCards.forEach(card => {
                card.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    loadProductPreview(productId);
                });
            });
        }

        function loadProductPreview(productId) {
            // Menggunakan AJAX untuk mendapatkan detail produk
            fetch(`/api/products/${productId}`)
                .then(response => response.json())
                .then(data => {
                    showProductPreview(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Gagal memuat detail produk');
                });
        }

        function showProductPreview(product) {
            const overlay = document.getElementById('overlay');
            const preview = document.getElementById('product-preview');
            const content = document.getElementById('product-preview-content');

            // Format harga
            const formattedPrice = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(product.harga);

            // Buat konten preview
            content.innerHTML = `
                <div class="flex flex-col items-center">
                    ${product.gambar ? 
                        `<img src="${asset('storage/' + product.gambar)}" alt="${product.nama_produk}" class="w-32 h-32 object-cover rounded-full mb-4">` :
                        `<div class="w-32 h-32 bg-green-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-seedling text-5xl text-green-600"></i>
                        </div>`
                    }
                    <h3 class="text-xl font-bold mb-2">${product.nama_produk}</h3>
                    <p class="text-lg font-semibold text-amber-700 mb-4">${formattedPrice}</p>
                    <p class="text-gray-600 mb-4">${product.deskripsi || 'Tidak ada deskripsi'}</p>
                    <div class="flex gap-2 w-full">
                        <button class="flex-1 bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition add-to-cart" data-id="${product.id}">
                            <i class="fas fa-cart-plus mr-2"></i> Tambah ke Keranjang
                        </button>
                        <button class="flex-1 bg-amber-500 text-white py-2 rounded-lg hover:bg-amber-600 transition add-to-wishlist" data-id="${product.id}">
                            <i class="fas fa-heart mr-2"></i> Wishlist
                        </button>
                    </div>
                </div>
            `;

            // Tambahkan event listener untuk tombol tambah ke keranjang
            content.querySelector('.add-to-cart').addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                addToCart(productId);
            });

            // Tambahkan event listener untuk tombol wishlist
            content.querySelector('.add-to-wishlist').addEventListener('click', function() {
                const productId = this.getAttribute('data-id');
                addToWishlist(productId);
            });

            overlay.style.display = 'block';
            preview.style.display = 'block';
        }

        function hideProductPreview() {
            document.getElementById('overlay').style.display = 'none';
            document.getElementById('product-preview').style.display = 'none';
        }

        function showNotification(message) {
            const notification = document.getElementById('floating-notification');
            const content = document.getElementById('notification-content');

            content.textContent = message;
            notification.style.display = 'block';

            // Sembunyikan notifikasi setelah 3 detik
            setTimeout(() => {
                notification.style.display = 'none';
            }, 3000);
        }

        function addToCart(productId) {
            // Implementasi AJAX untuk menambah ke keranjang
            fetch(`/cart/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        quantity: 1
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification(data.message);
                        // Update cart count
                        document.getElementById('cart-count').textContent = data.cart_count;
                    } else {
                        showNotification(data.message || 'Gagal menambahkan ke keranjang');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Gagal menambahkan ke keranjang');
                });
        }

        function addToWishlist(productId) {
            // Implementasi AJAX untuk menambah ke wishlist
            fetch(`/wishlist/add/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification(data.message);
                    } else {
                        showNotification(data.message || 'Gagal menambahkan ke wishlist');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Gagal menambahkan ke wishlist');
                });
        }
    </script>
</body>

</html>