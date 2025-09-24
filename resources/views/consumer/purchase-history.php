<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembelian - E-commerce Pertanian</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

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

        .order-card {
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

        .order-items {
            margin-bottom: 15px;
        }

        .order-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .order-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }

        .item-image {
            width: 60px;
            height: 60px;
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
            font-size: 1.5rem;
            color: var(--primary-green);
        }

        .item-details {
            flex-grow: 1;
        }

        .item-name {
            font-weight: 500;
            margin-bottom: 5px;
        }

        .item-price {
            color: var(--earth-brown);
            font-weight: 600;
        }

        .item-quantity {
            color: #666;
            font-size: 0.9rem;
        }

        .order-summary {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px dashed #ddd;
        }

        .summary-label {
            color: #666;
        }

        .summary-value {
            font-weight: 600;
            color: var(--dark-green);
        }

        .order-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 15px;
            gap: 10px;
        }

        .btn {
            padding: 8px 15px;
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
            margin-right: 5px;
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

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 30px;
            position: relative;
            z-index: 1;
        }

        .pagination a {
            padding: 8px 12px;
            margin: 0 5px;
            border-radius: 5px;
            background-color: white;
            color: var(--dark-green);
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .pagination a:hover {
            background-color: var(--light-green);
        }

        .pagination .active {
            background-color: var(--primary-green);
            color: white;
            border-color: var(--primary-green);
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            position: relative;
            z-index: 1;
        }

        .empty-state i {
            font-size: 3rem;
            color: var(--light-green);
            margin-bottom: 15px;
        }

        .empty-state h3 {
            color: var(--dark-green);
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #666;
            margin-bottom: 20px;
        }

        .empty-state .btn {
            margin: 0 auto;
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
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <a href="{{ route('konsumen.dashboard') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
        </a>

        <h1>Riwayat Pembelian</h1>
        <p class="subtitle">Lihat semua pesanan yang telah Anda buat</p>

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

        @if($orders->count() > 0)
        @foreach($orders as $order)
        <div class="order-card">
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
                <div class="order-items">
                    @foreach($order->items as $item)
                    <div class="order-item">
                        <div class="item-image">
                            @if($item->product->gambar)
                            <img src="{{ asset('storage/' . $item->product->gambar) }}"
                                alt="{{ $item->product->nama_produk }}">
                            @else
                            <i class="fas fa-seedling"></i>
                            @endif
                        </div>
                        <div class="item-details">
                            <div class="item-name">{{ $item->product->nama_produk }}</div>
                            <div class="item-price">Rp {{ number_format($item->price, 0, ',', '.') }}</div>
                            <div class="item-quantity">Qty: {{ $item->quantity }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="order-summary">
                    <div class="summary-label">Total:</div>
                    <div class="summary-value">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                </div>
                <div class="order-actions">
                    <a href="{{ route('konsumen.purchase.detail', $order->id) }}" class="btn btn-primary">
                        <i class="fas fa-eye"></i> Detail Pesanan
                    </a>
                    @if($order->status == 'Completed')
                    <button class="btn btn-outline" onclick="showReviewForm({{ $order->id }})">
                        <i class="fas fa-star"></i> Beri Review
                    </button>
                    @endif
                </div>
            </div>
        </div>
        @endforeach

        <div class="pagination">
            {{ $orders->links() }}
        </div>
        @else
        <div class="empty-state">
            <i class="fas fa-shopping-bag"></i>
            <h3>Belum Ada Riwayat Pembelian</h3>
            <p>Anda belum melakukan pembelian apapun. Ayo mulai belanja produk pertanian segar!</p>
            <a href="{{ route('konsumen.browse') }}" class="btn btn-primary">
                <i class="fas fa-search"></i> Cari Produk
            </a>
        </div>
        @endif
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
        document.addEventListener('DOMContentLoaded', function () {
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
                star.addEventListener('click', function () {
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

                star.addEventListener('mouseover', function () {
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
            document.querySelector('.star-rating').parentElement.addEventListener('mouseleave', function () {
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