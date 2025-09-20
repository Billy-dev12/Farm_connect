<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->nama_produk }} - Detail Produk</title>

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

        .product-detail {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 30px;
        }

        .product-detail-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            padding: 30px;
        }

        .product-image-container {
            position: relative;
        }

        .product-image-large {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 10px;
        }

        .wishlist-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.9);
            color: #e74c3c;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .product-info h1 {
            font-size: 28px;
            margin-bottom: 15px;
            color: #2c3e50;
        }

        .product-meta-detail {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 5px;
            color: #666;
        }

        .product-price {
            font-size: 24px;
            font-weight: 700;
            color: #e74c3c;
            margin-bottom: 25px;
        }

        .product-description {
            margin-bottom: 25px;
            line-height: 1.6;
            color: #555;
        }

        .farmer-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
        }

        .farmer-info h3 {
            margin-bottom: 15px;
            color: #4a7c59;
        }

        .farmer-info p {
            margin-bottom: 8px;
        }

        .product-actions {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background: #4a7c59;
            color: white;
        }

        .btn-primary:hover {
            background: #3a6249;
            color: white;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #4a7c59;
            color: #4a7c59;
        }

        .btn-outline:hover {
            background: #4a7c59;
            color: white;
        }

        .btn-wishlist {
            background: transparent;
            border: 1px solid #e74c3c;
            color: #e74c3c;
        }

        .btn-wishlist:hover {
            background: #e74c3c;
            color: white;
        }

        .btn-wishlist.active {
            background: #e74c3c;
            color: white;
        }

        .related-products {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .related-products h2 {
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        .related-card {
            background: #f8f9fa;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            position: relative;
        }

        .related-card:hover {
            transform: translateY(-5px);
        }

        .related-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }

        .related-card-content {
            padding: 15px;
        }

        .related-card h4 {
            font-size: 16px;
            margin-bottom: 8px;
            color: #2c3e50;
        }

        .related-card .price {
            font-weight: 600;
            color: #e74c3c;
            margin-bottom: 10px;
        }

        .related-wishlist-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255, 255, 255, 0.9);
            color: #e74c3c;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
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

        .notification.error {
            background: #f8d7da;
            color: #721c24;
        }

        @media (max-width: 768px) {
            .product-detail-content {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                gap: 15px;
            }

            .product-actions {
                flex-direction: column;
            }

            .related-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1><i class="fas fa-shopping-basket"></i> Detail Produk</h1>
            <a href="{{ route('konsumen.browse') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Kembali ke Produk
            </a>
        </div>

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

        <!-- Product Detail -->
        <div class="product-detail">
            <div class="product-detail-content">
                <div class="product-image-container">
                    @if ($product->gambar)
                        <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama_produk }}"
                            class="product-image-large">
                    @else
                        <img src="{{ asset('images/default-product.jpg') }}" alt="Default Product Image"
                            class="product-image-large">
                    @endif

                    <!-- Wishlist Badge - Tanda jika produk sudah di wishlist -->
                    @if (Auth::user()->wishlist()->where('dummy_product_id', $product->id)->exists())
                        <div class="wishlist-badge">
                            <i class="fas fa-heart"></i>
                        </div>
                    @endif
                </div>

                <div class="product-info">
                    <h1>{{ $product->nama_produk }}</h1>

                    <div class="product-meta-detail">
                        <div class="meta-item">
                            <i class="fas fa-tag"></i>
                            <span>{{ $product->kategori }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $product->lokasi }}</span>
                        </div>
                        <div class="meta-item">
                            <i class="fas fa-box"></i>
                            <span>Stok: {{ $product->stok }} {{ $product->satuan }}</span>
                        </div>
                    </div>

                    <div class="product-price">
                        Rp {{ number_format($product->harga, 0, ',', '.') }}/{{ $product->satuan }}
                    </div>

                    <div class="product-description">
                        {{ $product->deskripsi }}
                    </div>

                    <div class="farmer-info">
                        <h3><i class="fas fa-user"></i> Informasi Petani</h3>
                        <p><strong>Nama:</strong> {{ $product->farmer->name }}</p>
                        <p><strong>Lokasi Pertanian:</strong> {{ $product->farmer->lokasi_pertanian }}</p>
                        <p><strong>Jenis Tanaman:</strong> {{ $product->farmer->jenis_tanaman }}</p>
                    </div>

                    <div class="product-actions">
                        <button class="btn btn-primary" disabled>
                            <i class="fas fa-shopping-cart"></i> Beli Sekarang
                        </button>

                        @if (Auth::user()->wishlist()->where('dummy_product_id', $product->id)->exists())
                            <!-- Jika sudah di wishlist, tombol untuk menghapus -->
                            <form action="{{ route('konsumen.wishlist.remove', $product->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-wishlist active">
                                    <i class="fas fa-heart"></i> Hapus dari Wishlist
                                </button>
                            </form>
                        @else
                            <!-- Jika belum di wishlist, tombol untuk menambahkan -->
                            <form action="{{ route('konsumen.wishlist.add', $product->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-wishlist">
                                    <i class="far fa-heart"></i> Tambah ke Wishlist
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if ($relatedProducts->count() > 0)
            <div class="related-products">
                <h2><i class="fas fa-thumbs-up"></i> Produk Terkait</h2>

                <div class="related-grid">
                    @foreach ($relatedProducts as $related)
                        <div class="related-card">
                            @if ($related->gambar)
                                <img src="{{ asset('storage/' . $related->gambar) }}"
                                    alt="{{ $related->nama_produk }}">
                            @else
                                <img src="{{ asset('images/default-product.jpg') }}" alt="Default Product Image">
                            @endif

                            <!-- Wishlist Badge untuk produk terkait -->
                            @if (Auth::user()->wishlist()->where('dummy_product_id', $related->id)->exists())
                                <div class="related-wishlist-badge">
                                    <i class="fas fa-heart"></i>
                                </div>
                            @endif

                            <div class="related-card-content">
                                <h4>{{ $related->nama_produk }}</h4>
                                <div class="price">Rp {{ number_format($related->harga, 0, ',', '.') }}</div>
                                <a href="{{ route('konsumen.show', $related->id) }}" class="btn btn-primary">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</body>

</html>
