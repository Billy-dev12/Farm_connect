<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #{{ $order->id }} - E-commerce Pertanian</title>

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
            max-width: 1000px;
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

        .back-link {
            display: inline-flex;
            align-items: center;
            color: var(--dark-green);
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .back-link i {
            margin-right: 8px;
        }

        h1 {
            font-size: 2rem;
            color: var(--dark-green);
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .subtitle {
            color: #666;
            margin-bottom: 30px;
            font-size: 1.1rem;
            position: relative;
            z-index: 1;
        }

        .order-detail-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .order-header {
            padding: 15px 20px;
            background-color: var(--light-green);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-number {
            font-weight: 600;
            color: var(--dark-green);
        }

        .order-date {
            color: #666;
            font-size: 0.9rem;
        }

        .order-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-processed {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .status-shipped {
            background-color: #d4edda;
            color: #155724;
        }

        .status-completed {
            background-color: #c8e6c9;
            color: #2e7d32;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        .order-body {
            padding: 20px;
        }

        .order-section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 1.2rem;
            color: var(--dark-green);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 8px;
        }

        .section-title i {
            margin-right: 10px;
            color: var(--primary-green);
        }

        .order-items {
            margin-bottom: 15px;
        }

        .order-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .order-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .item-image {
            width: 80px;
            height: 80px;
            background-color: var(--light-green);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
        }

        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .item-image i {
            font-size: 2rem;
            color: var(--primary-green);
        }

        .item-details {
            flex-grow: 1;
        }

        .item-name {
            font-weight: 500;
            margin-bottom: 5px;
            font-size: 1.1rem;
        }

        .item-price {
            color: var(--earth-brown);
            font-weight: 600;
        }

        .item-quantity {
            color: #666;
            font-size: 0.9rem;
        }

        .item-subtotal {
            color: var(--dark-green);
            font-weight: 600;
            margin-top: 5px;
        }

        .address-info {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .address-label {
            font-weight: 500;
            color: #666;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .address-value {
            color: #333;
        }

        .order-summary {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 15px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .summary-row:last-child {
            margin-bottom: 0;
            padding-top: 10px;
            border-top: 1px dashed #ddd;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .summary-label {
            color: #666;
        }

        .summary-value {
            color: #333;
        }

        .order-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
        }

        .btn i {
            margin-right: 8px;
        }

        .btn-primary {
            background-color: var(--primary-green);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--dark-green);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--primary-green);
            border: 1px solid var(--primary-green);
        }

        .btn-outline:hover {
            background-color: var(--light-green);
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .timeline {
            position: relative;
            margin: 20px 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            left: 15px;
            height: 100%;
            width: 2px;
            background: #ddd;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 20px;
            padding-left: 50px;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-icon {
            position: absolute;
            left: 0;
            top: 0;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: white;
            border: 2px solid var(--primary-green);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-green);
            z-index: 1;
        }

        .timeline-icon.active {
            background: var(--primary-green);
            color: white;
        }

        .timeline-content {
            background: #f9f9f9;
            border-radius: 8px;
            padding: 12px 15px;
        }

        .timeline-title {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .timeline-date {
            font-size: 0.8rem;
            color: #666;
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

        @media (max-width: 600px) {
            .dashboard-container {
                padding: 30px 15px;
                margin-top: 20px;
                margin-bottom: 20px;
            }

            h1 {
                font-size: 1.8rem;
            }

            .order-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .order-status {
                margin-top: 10px;
            }

            .order-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
                margin-bottom: 10px;
            }

            .btn:last-child {
                margin-bottom: 0;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <a href="{{ route('konsumen.purchase.history') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Riwayat Pembelian
        </a>

        <h1>Detail Pesanan #{{ $order->id }}</h1>
        <p class="subtitle">Dibuat pada {{ $order->created_at->format('d M Y, H:i') }}</p>

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

        <div class="order-detail-card">
            <div class="order-header">
                <div>
                    <div class="order-number">Pesanan #{{ $order->id }}</div>
                    <div class="order-date">{{ $order->created_at->format('d M Y, H:i') }}</div>
                </div>
                <div class="order-status status-{{ strtolower(str_replace(' ', '-', $order->status)) }}">
                    {{ $order->status }}
                </div>
            </div>
            <div class="order-body">
                <div class="order-section">
                    <h3 class="section-title">
                        <i class="fas fa-box"></i> Produk Dipesan
                    </h3>
                    <div class="order-items">
                        @foreach ($order->items as $item)
                            <div class="order-item">
                                <div class="item-image">
                                    @if ($item->product->gambar)
                                        <img src="{{ asset('storage/' . $item->product->gambar) }}"
                                            alt="{{ $item->product->nama_produk }}">
                                    @else
                                        <i class="fas fa-seedling"></i>
                                    @endif
                                </div>
                                <div class="item-details">
                                    <div class="item-name">{{ $item->product->nama_produk }}</div>
                                    <div class="item-price">Rp {{ number_format($item->price, 0, ',', '.') }} /
                                        {{ $item->product->satuan ?? 'unit' }}</div>
                                    <div class="item-quantity">Qty: {{ $item->quantity }}
                                        {{ $item->product->satuan ?? 'unit' }}</div>
                                    <div class="item-subtotal">Subtotal: Rp
                                        {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="order-section">
                    <h3 class="section-title">
                        <i class="fas fa-map-marker-alt"></i> Alamat Pengiriman
                    </h3>
                    <div class="address-info">
                        <div class="address-label">Penerima:</div>
                        <div class="address-value">{{ $order->address->penerima }}</div>

                        <div class="address-label" style="margin-top: 10px;">Nomor HP:</div>
                        <div class="address-value">{{ $order->address->no_hp }}</div>

                        <div class="address-label" style="margin-top: 10px;">Alamat Lengkap:</div>
                        <div class="address-value">
                            {{ $order->address->alamat_lengkap }}, {{ $order->address->kecamatan }},
                            {{ $order->address->kota }}, {{ $order->address->provinsi }}
                            {{ $order->address->kode_pos }}
                        </div>
                    </div>
                </div>

                <div class="order-section">
                    <h3 class="section-title">
                        <i class="fas fa-clock"></i> Status Pesanan
                    </h3>
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-icon active">
                                <i class="fas fa-check"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-title">Pesanan Dibuat</div>
                                <div class="timeline-date">{{ $order->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>

                        @if ($order->processed_at)
                            <div class="timeline-item">
                                <div class="timeline-icon active">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">Pesanan Diproses</div>
                                    <div class="timeline-date">{{ $order->processed_at->format('d M Y, H:i') }}</div>
                                </div>
                            </div>
                        @else
                            <div class="timeline-item">
                                <div class="timeline-icon">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">Pesanan Diproses</div>
                                    <div class="timeline-date">Menunggu</div>
                                </div>
                            </div>
                        @endif

                        @if ($order->shipped_at)
                            <div class="timeline-item">
                                <div class="timeline-icon active">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">Pesanan Dikirim</div>
                                    <div class="timeline-date">{{ $order->shipped_at->format('d M Y, H:i') }}</div>
                                </div>
                            </div>
                        @else
                            <div class="timeline-item">
                                <div class="timeline-icon">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">Pesanan Dikirim</div>
                                    <div class="timeline-date">Menunggu</div>
                                </div>
                            </div>
                        @endif

                        @if ($order->completed_at)
                            <div class="timeline-item">
                                <div class="timeline-icon active">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">Pesanan Selesai</div>
                                    <div class="timeline-date">{{ $order->completed_at->format('d M Y, H:i') }}</div>
                                </div>
                            </div>
                        @else
                            <div class="timeline-item">
                                <div class="timeline-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">Pesanan Selesai</div>
                                    <div class="timeline-date">Menunggu</div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="order-section">
                    <h3 class="section-title">
                        <i class="fas fa-calculator"></i> Rincian Pembayaran
                    </h3>
                    <div class="order-summary">
                        <div class="summary-row">
                            <div class="summary-label">Subtotal:</div>
                            <div class="summary-value">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</div>
                        </div>
                        <div class="summary-row">
                            <div class="summary-label">Ongkos Kirim:</div>
                            <div class="summary-value">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="summary-row">
                            <div class="summary-label">Total:</div>
                            <div class="summary-value">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <div class="order-actions">
                    <a href="{{ route('konsumen.browse') }}" class="btn btn-outline">
                        <i class="fas fa-shopping-cart"></i> Belanja Lagi
                    </a>
                    @if ($order->status == 'Completed')
                        <button class="btn btn-primary" onclick="showReviewForm({{ $order->id }})">
                            <i class="fas fa-star"></i> Beri Review
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Form Review Modal -->
    <div class="overlay" id="review-overlay"></div>
    <div class="product-preview" id="review-modal">
        <div class="product-preview-header">
            <h3>Beri Review Produk</h3>
            <button class="close-preview" id="close-review">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="product-preview-body" id="review-form-content">
            <!-- Konten form review akan dimuat melalui AJAX -->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Setup event listeners
            setupEventListeners();
        });

        function setupEventListeners() {
            // Close review modal
            document.getElementById('close-review').addEventListener('click', hideReviewForm);
            document.getElementById('review-overlay').addEventListener('click', hideReviewForm);
        }

        function showReviewForm(orderId) {
            const overlay = document.getElementById('review-overlay');
            const modal = document.getElementById('review-modal');
            const content = document.getElementById('review-form-content');

            // Load review form via AJAX
            fetch(`/api/orders/${orderId}/products`)
                .then(response => response.json())
                .then(data => {
                    let formHTML = `
                        <form id="review-form" data-order-id="${orderId}">
                            <input type="hidden" name="order_id" value="${orderId}">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Produk:</label>
                                <select name="product_id" class="shadow border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    `;

                    data.products.forEach(product => {
                        formHTML += `<option value="${product.id}">${product.nama_produk}</option>`;
                    });

                    formHTML += `
                                </select>
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Rating:</label>
                                <div class="flex">
                                    <span class="star-rating" data-rating="1"><i class="far fa-star"></i></span>
                                    <span class="star-rating" data-rating="2"><i class="far fa-star"></i></span>
                                    <span class="star-rating" data-rating="3"><i class="far fa-star"></i></span>
                                    <span class="star-rating" data-rating="4"><i class="far fa-star"></i></span>
                                    <span class="star-rating" data-rating="5"><i class="far fa-star"></i></span>
                                </div>
                                <input type="hidden" name="rating" id="rating-value" value="0">
                            </div>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Komentar:</label>
                                <textarea name="comment" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                            </div>
                            <div class="flex items-center justify-between">
                                <button type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" onclick="hideReviewForm()">
                                    Batal
                                </button>
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                    Kirim Review
                                </button>
                            </div>
                        </form>
                    `;

                    content.innerHTML = formHTML;

                    // Setup star rating
                    setupStarRating();

                    // Setup form submission
                    document.getElementById('review-form').addEventListener('submit', submitReview);

                    overlay.style.display = 'block';
                    modal.style.display = 'block';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Gagal memuat form review');
                });
        }

        function hideReviewForm() {
            document.getElementById('review-overlay').style.display = 'none';
            document.getElementById('review-modal').style.display = 'none';
        }

        function setupStarRating() {
            const stars = document.querySelectorAll('.star-rating');
            const ratingValue = document.getElementById('rating-value');

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = this.getAttribute('data-rating');
                    ratingValue.value = rating;

                    stars.forEach((s, index) => {
                        if (index < rating) {
                            s.innerHTML = '<i class="fas fa-star"></i>';
                        } else {
                            s.innerHTML = '<i class="far fa-star"></i>';
                        }
                    });
                });

                star.addEventListener('mouseover', function() {
                    const rating = this.getAttribute('data-rating');

                    stars.forEach((s, index) => {
                        if (index < rating) {
                            s.innerHTML = '<i class="fas fa-star"></i>';
                        } else {
                            s.innerHTML = '<i class="far fa-star"></i>';
                        }
                    });
                });
            });

            // Reset to original rating when mouse leaves
            document.querySelector('.star-rating').parentElement.addEventListener('mouseleave', function() {
                const rating = ratingValue.value;

                stars.forEach((s, index) => {
                    if (index < rating) {
                        s.innerHTML = '<i class="fas fa-star"></i>';
                    } else {
                        s.innerHTML = '<i class="far fa-star"></i>';
                    }
                });
            });
        }

        function submitReview(e) {
            e.preventDefault();

            const form = e.target;
            const formData = new FormData(form);

            fetch('/reviews/store', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Review berhasil dikirim!');
                        hideReviewForm();
                        // Refresh page to show updated data
                        window.location.reload();
                    } else {
                        alert(data.message || 'Gagal mengirim review');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengirim review');
                });
        }
    </script>
</body>

</html>
