<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Produk - Sistem Pertanian</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --primary: #4a7c59;
            --primary-dark: #3a6249;
            --secondary: #e74c3c;
            --background: #f8f9fa;
            --surface: #ffffff;
            --text-primary: #333333;
            --text-secondary: #666666;
            --border: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--background);
            color: var(--text-primary);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.95);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        .scale-in {
            animation: scaleIn 0.3s ease-out forwards;
        }

        /* Product Card Styles */
        .product-card {
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .product-image-container {
            position: relative;
            overflow: hidden;
        }

        .product-image {
            transition: transform 0.5s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }

        .wishlist-badge {
            transition: all 0.3s ease;
        }

        .wishlist-badge:hover {
            transform: scale(1.1);
        }

        .btn-primary {
            background-color: var(--primary);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 124, 89, 0.3);
        }

        .btn-wishlist {
            transition: all 0.3s ease;
        }

        .btn-wishlist:hover {
            transform: scale(1.2);
        }

        .btn-wishlist.active {
            color: var(--secondary);
        }

        /* Search Section Styles */
        .search-section {
            background: linear-gradient(135deg, #f5f7fa 0%, #e4efe9 100%);
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        .search-input {
            transition: all 0.3s ease;
        }

        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(74, 124, 89, 0.2);
        }

        .filter-select {
            transition: all 0.3s ease;
        }

        .filter-select:focus {
            box-shadow: 0 0 0 3px rgba(74, 124, 89, 0.2);
        }

        /* Header Styles */
        .header {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), #6fa071);
        }

        /* Category Badge Styles */
        .product-category {
            background: rgba(74, 124, 89, 0.1);
            color: var(--primary);
            transition: all 0.3s ease;
        }

        .product-category:hover {
            background: rgba(74, 124, 89, 0.2);
        }

        /* Pagination Styles */
        .page-link {
            transition: all 0.3s ease;
        }

        .page-link:hover:not(.active) {
            background-color: rgba(74, 124, 89, 0.1);
            color: var(--primary);
        }

        .page-link.active {
            background: var(--primary);
        }

        /* No Products Styles */
        .no-products {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        /* Wishlist Section Styles */
        .wishlist-section {
            background: linear-gradient(135deg, #fff5f5 0%, #ffe0e0 100%);
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(231, 76, 60, 0.1);
            margin-bottom: 40px;
            padding: 20px;
        }

        .wishlist-title {
            color: var(--secondary);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .wishlist-card {
            border: 2px solid rgba(231, 76, 60, 0.2);
            transition: all 0.3s ease;
        }

        .wishlist-card:hover {
            border-color: rgba(231, 76, 60, 0.4);
            transform: translateY(-8px);
            box-shadow: 0 15px 30px rgba(231, 76, 60, 0.15);
        }

        .wishlist-badge-highlight {
            position: absolute;
            top: -10px;
            left: -10px;
            background: var(--secondary);
            color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        /* Loading Animation */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
            }

            .filter-section {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Header -->
        <div class="header p-6 mb-8 fade-in">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-store text-green-700 mr-3"></i>
                    <span>Toko Pertanian</span>
                </h1>
                <div class="flex items-center space-x-4 mt-4 md:mt-0">
                    <!-- Cart Icon -->
                    <a href="{{ route('konsumen.cart.index') }}"
                        class="relative btn-primary text-white px-6 py-3 rounded-full flex items-center">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        <span>Keranjang</span>
                        @php
                            $cartCount = Auth::user()->carts()->count();
                        @endphp
                        @if ($cartCount > 0)
                            <span
                                class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                    <a href="{{ route('konsumen.dashboard') }}"
                        class="back-btn text-gray-700 px-6 py-3 rounded-full flex items-center border border-gray-300">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Search Section -->
        <div class="search-section p-8 mb-8 fade-in" style="animation-delay: 0.1s">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-search text-green-700 mr-3"></i>
                <span>Cari Produk Pertanian</span>
            </h2>

            <form method="GET" action="{{ route('konsumen.search') }}">
                <div class="search-bar flex flex-col md:flex-row gap-4 mb-6">
                    <div class="relative flex-1">
                        <input type="text" name="q"
                            class="search-input w-full py-4 px-6 pr-12 rounded-full border border-gray-300 focus:outline-none focus:border-green-600"
                            placeholder="Cari produk pertanian..." value="{{ request('q') }}">
                        <i class="fas fa-search absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <button type="submit"
                        class="btn-primary text-white px-8 py-4 rounded-full font-medium flex items-center justify-center">
                        <i class="fas fa-search mr-2"></i>
                        <span>Cari</span>
                    </button>
                </div>

                <div class="filter-section flex flex-col md:flex-row gap-6">
                    <div class="filter-group flex-1">
                        <label class="filter-label block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="category"
                            class="filter-select w-full py-3 px-4 rounded-lg border border-gray-300 focus:outline-none focus:border-green-600 bg-white">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category }}"
                                    {{ request('category') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group flex-1">
                        <label class="filter-label block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                        <select name="location"
                            class="filter-select w-full py-3 px-4 rounded-lg border border-gray-300 focus:outline-none focus:border-green-600 bg-white">
                            <option value="">Semua Lokasi</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location }}"
                                    {{ request('location') == $location ? 'selected' : '' }}>
                                    {{ $location }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="filter-group flex-1">
                        <label class="filter-label block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                        <select name="sort"
                            class="filter-select w-full py-3 px-4 rounded-lg border border-gray-300 focus:outline-none focus:border-green-600 bg-white">
                            <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru
                            </option>
                            <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama
                            </option>
                            <option value="harga-terendah" {{ request('sort') == 'harga-terendah' ? 'selected' : '' }}>
                                Harga Terendah</option>
                            <option value="harga-tertinggi"
                                {{ request('sort') == 'harga-tertinggi' ? 'selected' : '' }}>Harga Tertinggi</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <!-- Products Grid -->
        @if ($products->count() > 0)
            <!-- Wishlist Products Section -->
            <div class="wishlist-section fade-in" style="animation-delay: 0.2s">
                <h3 class="wishlist-title text-xl font-bold mb-4">
                    <i class="fas fa-heart text-red-500 mr-2"></i>
                    <span>Produk Wishlist Anda</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($products as $product)
                        @if (isset($wishlistProductIds) && in_array($product->id, $wishlistProductIds))
                            <div class="product-card wishlist-card bg-white rounded-2xl overflow-hidden shadow-lg scale-in relative"
                                style="animation-delay: 0.{{ $loop->index + 2 }}s">
                                <div class="wishlist-badge-highlight">
                                    <i class="fas fa-heart text-sm"></i>
                                </div>

                                <div class="product-image-container h-56 relative">
                                    @if ($product->gambar)
                                        <img src="{{ asset('storage/' . $product->gambar) }}"
                                            alt="{{ $product->nama_produk }}"
                                            class="product-image w-full h-full object-cover">
                                    @else
                                        <img src="{{ asset('images/default-product.jpg') }}"
                                            alt="Default Product Image"
                                            class="product-image w-full h-full object-cover">
                                    @endif

                                    <!-- Wishlist Badge - Tanda jika produk sudah di wishlist -->
                                    <div
                                        class="wishlist-badge absolute top-4 right-4 bg-white bg-opacity-90 text-red-500 rounded-full w-12 h-12 flex items-center justify-center z-10 shadow-lg">
                                        <i class="fas fa-heart text-xl"></i>
                                    </div>
                                </div>

                                <div class="product-content p-6">
                                    <h3 class="product-title text-xl font-bold text-gray-800 mb-3">
                                        {{ $product->nama_produk }}
                                    </h3>

                                    <div class="product-meta flex justify-between items-center mb-4">
                                        <span
                                            class="product-category py-1 px-3 rounded-full text-xs font-medium">{{ $product->kategori }}</span>
                                        <span class="product-location text-sm text-gray-600 flex items-center">
                                            <i class="fas fa-map-marker-alt mr-1 text-green-600"></i>
                                            <span>{{ $product->lokasi }}</span>
                                        </span>
                                    </div>

                                    <div class="product-price text-2xl font-bold text-red-500 mb-5">
                                        Rp {{ number_format($product->harga, 0, ',', '.') }}/{{ $product->satuan }}
                                    </div>

                                    <div class="product-actions flex justify-between items-center">
                                        <a href="{{ route('konsumen.show', $product->id) }}"
                                            class="btn-primary text-white px-5 py-2.5 rounded-lg font-medium flex items-center">
                                            <i class="fas fa-eye mr-2"></i>
                                            <span>Detail</span>
                                        </a>

                                        <!-- Jika sudah di wishlist, tombol untuk menghapus -->
                                        <form action="{{ route('konsumen.wishlist.remove', $product->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-wishlist active text-2xl"
                                                title="Hapus dari Wishlist">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Other Products Section -->
            <div class="fade-in" style="animation-delay: 0.3s">
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-shopping-basket text-green-700 mr-2"></i>
                    <span>Semua Produk</span>
                </h3>

                <div class="products-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-12">
                    @foreach ($products as $product)
                        @if (!isset($wishlistProductIds) || !in_array($product->id, $wishlistProductIds))
                            <div class="product-card bg-white rounded-2xl overflow-hidden shadow-lg scale-in"
                                style="animation-delay: 0.{{ $loop->index + 2 }}s">
                                <div class="product-image-container h-56 relative">
                                    @if ($product->gambar)
                                        <img src="{{ asset('storage/' . $product->gambar) }}"
                                            alt="{{ $product->nama_produk }}"
                                            class="product-image w-full h-full object-cover">
                                    @else
                                        <img src="{{ asset('images/default-product.jpg') }}"
                                            alt="Default Product Image"
                                            class="product-image w-full h-full object-cover">
                                    @endif

                                    <!-- Wishlist Badge - Tanda jika produk sudah di wishlist -->
                                    @if (Auth::user()->wishlist()->where('dummy_product_id', $product->id)->exists())
                                        <div
                                            class="wishlist-badge absolute top-4 right-4 bg-white bg-opacity-90 text-red-500 rounded-full w-12 h-12 flex items-center justify-center z-10 shadow-lg">
                                            <i class="fas fa-heart text-xl"></i>
                                        </div>
                                    @endif
                                </div>

                                <div class="product-content p-6">
                                    <h3 class="product-title text-xl font-bold text-gray-800 mb-3">
                                        {{ $product->nama_produk }}
                                    </h3>

                                    <div class="product-meta flex justify-between items-center mb-4">
                                        <span
                                            class="product-category py-1 px-3 rounded-full text-xs font-medium">{{ $product->kategori }}</span>
                                        <span class="product-location text-sm text-gray-600 flex items-center">
                                            <i class="fas fa-map-marker-alt mr-1 text-green-600"></i>
                                            <span>{{ $product->lokasi }}</span>
                                        </span>
                                    </div>

                                    <div class="product-price text-2xl font-bold text-red-500 mb-5">
                                        Rp {{ number_format($product->harga, 0, ',', '.') }}/{{ $product->satuan }}
                                    </div>

                                    <div class="product-actions flex flex-col gap-2">
                                        <div class="flex justify-between items-center">
                                            <a href="{{ route('konsumen.show', $product->id) }}"
                                                class="btn-primary text-white px-5 py-2.5 rounded-lg font-medium flex items-center">
                                                <i class="fas fa-eye mr-2"></i>
                                                <span>Detail</span>
                                            </a>

                                            @if (Auth::user()->wishlist()->where('dummy_product_id', $product->id)->exists())
                                                <!-- Jika sudah di wishlist, tombol untuk menghapus -->
                                                <form action="{{ route('konsumen.wishlist.remove', $product->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-wishlist active text-2xl"
                                                        title="Hapus dari Wishlist">
                                                        <i class="fas fa-heart"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <!-- Jika belum di wishlist, tombol untuk menambahkan -->
                                                <form action="{{ route('konsumen.wishlist.add', $product->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn-wishlist text-2xl text-gray-400"
                                                        title="Tambah ke Wishlist">
                                                        <i class="far fa-heart"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>

                                        <!-- Tombol tambah ke keranjang -->
                                        <form action="{{ route('konsumen.cart.add', $product->id) }}" method="POST"
                                            class="add-to-cart-form">
                                            @csrf
                                            <button type="submit"
                                                class="w-full bg-green-600 hover:bg-green-700 text-white py-2.5 rounded-lg font-medium flex items-center justify-center">
                                                <i class="fas fa-shopping-cart mr-2"></i>
                                                <span>Tambah ke Keranjang</span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @else
            <div class="no-products p-12 text-center fade-in">
                <i class="fas fa-box-open text-6xl text-gray-300 mb-5"></i>
                <h3 class="text-2xl font-bold text-gray-700 mb-3">Tidak ada produk ditemukan</h3>
                <p class="text-gray-600 max-w-md mx-auto">Coba gunakan kata kunci pencarian lainnya atau atur ulang
                    filter</p>
            </div>
        @endif

        <!-- Pagination -->
        @if ($products->count() > 0)
            <div class="pagination flex justify-center mt-12 fade-in">
                {{ $products->links() }}
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle add to cart form submission with AJAX
            document.querySelectorAll('.add-to-cart-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const action = this.getAttribute('action');
                    const button = this.querySelector('button');
                    const originalText = button.innerHTML;

                    // Show loading state
                    button.innerHTML =
                        '<i class="fas fa-spinner fa-spin mr-2"></i><span>Memproses...</span>';
                    button.disabled = true;

                    fetch(action, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({})
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Show success notification
                                showNotification(data.message);

                                // Update cart count if available
                                if (data.cart_count !== undefined) {
                                    const cartCountElements = document.querySelectorAll(
                                        '.cart-count');
                                    cartCountElements.forEach(element => {
                                        element.textContent = data.cart_count;
                                    });

                                    // Update cart badge in header
                                    const cartBadges = document.querySelectorAll(
                                        '.fa-shopping-cart').forEach(icon => {
                                        const parent = icon.closest('a');
                                        if (parent && parent.querySelector(
                                                '.bg-red-500')) {
                                            const badge = parent.querySelector(
                                                '.bg-red-500');
                                            if (data.cart_count > 0) {
                                                badge.textContent = data.cart_count;
                                                badge.style.display = 'flex';
                                            } else {
                                                badge.style.display = 'none';
                                            }
                                        }
                                    });
                                }
                            } else {
                                // Show error notification
                                showNotification(data.message ||
                                    'Gagal menambahkan ke keranjang', 'error');
                            }

                            // Reset button
                            button.innerHTML = originalText;
                            button.disabled = false;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showNotification('Terjadi kesalahan saat menambahkan ke keranjang',
                                'error');

                            // Reset button
                            button.innerHTML = originalText;
                            button.disabled = false;
                        });
                });
            });

            // Function to show notification
            function showNotification(message, type = 'success') {
                // Create notification element
                const notification = document.createElement('div');
                notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 ${
                    type === 'success' ? 'bg-green-500' : 'bg-red-500'
                } text-white`;
                notification.textContent = message;

                // Add to body
                document.body.appendChild(notification);

                // Remove after 3 seconds
                setTimeout(() => {
                    notification.remove();
                }, 3000);
            }
        });
    </script>

    <style>
        /* Ripple effect */
        .ripple {
            position: absolute;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple-animation 0.6s ease-out;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Make buttons relative for ripple effect */
        .btn-primary,
        .page-link {
            position: relative;
            overflow: hidden;
        }
    </style>
</body>

</html>
