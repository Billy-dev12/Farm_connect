<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist Saya - Sistem Pertanian</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            color: #2c3e50;
        }

        .back-btn {
            background: #4a7c59;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .back-btn:hover {
            background: #3a6249;
            color: white;
        }

        .wishlist-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
        }

        .wishlist-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
        }

        .wishlist-title {
            font-size: 24px;
            color: #2c3e50;
        }

        .wishlist-count {
            background: #e74c3c;
            color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }

        .wishlist-card {
            background: #f8f9fa;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            position: relative;
        }

        .wishlist-card:hover {
            transform: translateY(-5px);
        }

        .wishlist-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #e74c3c;
            color: white;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

        .wishlist-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .wishlist-content {
            padding: 20px;
        }

        .wishlist-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #2c3e50;
        }

        .wishlist-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .wishlist-category {
            background: #e8f5e9;
            color: #4a7c59;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .wishlist-location {
            color: #666;
            font-size: 14px;
        }

        .wishlist-price {
            font-size: 20px;
            font-weight: 700;
            color: #e74c3c;
            margin-bottom: 15px;
        }

        .wishlist-actions {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary {
            background: #4a7c59;
            color: white;
        }

        .btn-primary:hover {
            background: #3a6249;
            color: white;
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
        }

        .btn-danger:hover {
            background: #c0392b;
            color: white;
        }

        .empty-wishlist {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-wishlist i {
            font-size: 64px;
            color: #ddd;
            margin-bottom: 20px;
        }

        .empty-wishlist h3 {
            font-size: 24px;
            color: #666;
            margin-bottom: 10px;
        }

        .empty-wishlist p {
            color: #999;
            margin-bottom: 25px;
        }

        .notification {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .notification.success {
            background: #d4edda;
            color: #155724;
        }

        .notification.info {
            background: #d1ecf1;
            color: #0c5460;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            gap: 10px;
        }

        .page-link {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
        }

        .page-link.active {
            background: #4a7c59;
            color: white;
            border-color: #4a7c59;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
            }

            .wishlist-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1><i class="fas fa-heart"></i> Wishlist Saya</h1>
            <a href="{{ route('konsumen.dashboard') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>

        @if (session('success'))
            <div class="notification success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if (session('info'))
            <div class="notification info">
                <i class="fas fa-info-circle"></i> {{ session('info') }}
            </div>
        @endif

        <!-- Wishlist Container -->
        <div class="wishlist-container">
            <div class="wishlist-header">
                <h2 class="wishlist-title">Produk Favorit Saya</h2>
                <div class="wishlist-count">{{ $wishlistItems->count() }}</div>
            </div>

            @forelse ($wishlistItems as $item)
                <div class="wishlist-grid">
                    <div class="wishlist-card">
                        <div class="wishlist-badge">
                            <i class="fas fa-heart"></i>
                        </div>

                        @if ($item->gambar)
                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_produk }}"
                                class="wishlist-image">
                        @else
                            <img src="{{ asset('images/default-product.jpg') }}" alt="Default Product Image"
                                class="wishlist-image">
                        @endif

                        <div class="wishlist-content">
                            <h3 class="wishlist-title">{{ $item->nama_produk }}</h3>

                            <div class="wishlist-meta">
                                <span class="wishlist-category">{{ $item->kategori }}</span>
                                <span class="wishlist-location">
                                    <i class="fas fa-map-marker-alt"></i> {{ $item->lokasi }}
                                </span>
                            </div>

                            <div class="wishlist-price">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}/{{ $item->satuan }}
                            </div>

                            <div class="wishlist-actions">
                                <a href="{{ route('konsumen.show', $item->id) }}" class="btn btn-primary">
                                    <i class="fas fa-eye"></i> Lihat Detail
                                </a>
                                <form action="{{ route('konsumen.wishlist.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-wishlist">
                    <i class="fas fa-heart-broken"></i>
                    <h3>Wishlist Anda Kosong</h3>
                    <p>Anda belum menambahkan produk apapun ke wishlist</p>
                    <a href="{{ route('konsumen.browse') }}" class="btn btn-primary">
                        <i class="fas fa-search"></i> Jelajahi Produk
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($wishlistItems->count() > 0)
            <div class="pagination">
                {{ $wishlistItems->links() }}
            </div>
        @endif
    </div>
</body>

</html>
