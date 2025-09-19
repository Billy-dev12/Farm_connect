<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Petani - Sistem Pertanian</title>

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
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .dashboard-header {
            background: linear-gradient(135deg, #4a7c59 0%, #6fa071 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .welcome-message {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .sub-message {
            font-size: 16px;
            opacity: 0.9;
        }

        .dashboard-content {
            padding: 40px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            transition: transform 0.3s ease;
            border: 1px solid #e9ecef;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            font-size: 40px;
            color: #4a7c59;
            margin-bottom: 15px;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 14px;
            color: #7f8c8d;
        }

        .section-title {
            font-size: 24px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 10px;
            color: #4a7c59;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 40px;
        }

        .action-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 15px;
            text-decoration: none;
            transition: transform 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            min-height: 120px;
        }

        .action-card:hover {
            transform: translateY(-3px);
            text-decoration: none;
            color: white;
        }

        .action-card i {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .action-card span {
            font-weight: 500;
            text-align: center;
        }

        .table-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .table-header {
            background: #f8f9fa;
            padding: 15px 20px;
            border-bottom: 1px solid #e9ecef;
        }

        .table-header h3 {
            color: #2c3e50;
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }

        th {
            background: #f8f9fa;
            font-weight: 600;
            color: #2c3e50;
        }

        .status-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-diproses {
            background: #fff3cd;
            color: #856404;
        }

        .status-dikirim {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-selesai {
            background: #d4edda;
            color: #155724;
        }

        .logout-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 15px 25px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        .alert-success {
            background: #d4edda;
            border-left: 4px solid #28a745;
            color: #155724;
        }

        .alert-info {
            background: #d1ecf1;
            border-left: 4px solid #17a2b8;
            color: #0c5460;
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <!-- Header -->
        <div class="dashboard-header">
            <h1 class="welcome-message">
                <i class="fas fa-seedling"></i> Selamat Datang, Petani {{ $user->name }}!
            </h1>
            <p class="sub-message">
                Kelola produk pertanian Anda dan pantau pesanan masuk dengan mudah
            </p>
        </div>

        <!-- Content -->
        <div class="dashboard-content">
            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if (session('info'))
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> {{ session('info') }}
                </div>
            @endif

            <!-- resources/views/dashboard/petani.blade.php -->
            <!-- Tambahkan di bagian atas -->

            <div class="alert alert-info">
                @if ($user->hasProposal())
                    <i class="fas fa-file-pdf"></i>
                    <strong>Proposal Anda:</strong>
                    <a href="{{ asset('storage/' . $user->proposal_path) }}" target="_blank"
                        class="btn btn-sm btn-primary">
                        <i class="fas fa-download"></i> Lihat Proposal
                    </a>
                @else
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Belum Upload Proposal</strong> -
                    <a href="{{ route('register.farmer') }}" class="btn btn-sm btn-warning">
                        Upload Proposal Sekarang
                    </a>
                @endif
            </div>

            <!-- Statistik Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="stat-number">{{ $totalProduk }}</div>
                    <div class="stat-label">Total Produk</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-number">{{ $produkAktif }}</div>
                    <div class="stat-label">Produk Aktif</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stat-number">{{ $totalPesanan }}</div>
                    <div class="stat-label">Total Pesanan</div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-number">{{ $pesananBaru }}</div>
                    <div class="stat-label">Pesanan Baru</div>
                </div>
            </div>

            <!-- Quick Actions -->
            <h2 class="section-title">
                <i class="fas fa-bolt"></i> Aksi Cepat
            </h2>

            <div class="quick-actions">
                <a href="{{ route('produk.create') }}" class="action-card">
                    <i class="fas fa-plus-circle"></i>
                    <span>Tambah Produk</span>
                </a>

                <a href="{{ route('produk.index') }}" class="action-card">
                    <i class="fas fa-list"></i>
                    <span>Kelola Produk</span>
                </a>

                <a href="{{ route('pesanan.index') }}" class="action-card">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Lihat Pesanan</span>
                </a>

                <a href="{{ route('profile.edit') }}" class="action-card">
                    <i class="fas fa-user-edit"></i>
                    <span>Edit Profile</span>
                </a>
            </div>

            <!-- Pesanan Terbaru -->
            <h2 class="section-title">
                <i class="fas fa-history"></i> Pesanan Terbaru
            </h2>

            <div class="table-container">
                <div class="table-header">
                    <h3>5 Pesanan Terakhir</h3>
                </div>

                @if ($recentOrders->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>No. Pesanan</th>
                                <th>Konsumen</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentOrders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>
                                        @foreach ($order->detail as $detail)
                                            {{ $detail->produk->nama_produk }}
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($order->detail as $detail)
                                            {{ $detail->jumlah }} {{ $detail->produk->satuan }}
                                            @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="status-badge status-{{ $order->status_pesanan }}">
                                            {{ ucfirst($order->status_pesanan) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div style="padding: 20px; text-align: center; color: #7f8c8d;">
                        <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 15px; opacity: 0.5;"></i>
                        <p>Belum ada pesanan masuk</p>
                    </div>
                @endif
            </div>

            <!-- Produk Terbaru -->
            <h2 class="section-title">
                <i class="fas fa-leaf"></i> Produk Terbaru
            </h2>

            <div class="table-container">
                <div class="table-header">
                    <h3>3 Produk Terakhir Ditambahkan</h3>
                </div>

                @if ($recentProducts->count() > 0)
                    <table>
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Ditambahkan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentProducts as $product)
                                <tr>
                                    <td>{{ $product->nama_produk }}</td>
                                    <td>{{ $product->jenis_tanaman ?? '-' }}</td>
                                    <td>{{ $product->stok }} {{ $product->satuan }}</td>
                                    <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <span
                                            class="status-badge {{ $product->stok > 0 ? 'status-selesai' : 'status-diproses' }}">
                                            {{ $product->stok > 0 ? 'Tersedia' : 'Habis' }}
                                        </span>
                                    </td>
                                    <td>{{ $product->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div style="padding: 20px; text-align: center; color: #7f8c8d;">
                        <i class="fas fa-box-open" style="font-size: 48px; margin-bottom: 15px; opacity: 0.5;"></i>
                        <p>Belum ada produk ditambahkan</p>
                        <a href="{{ route('produk.create') }}"
                            style="color: #4a7c59; text-decoration: none; font-weight: 500; margin-top: 10px; display: inline-block;">
                            <i class="fas fa-plus"></i> Tambah Produk Pertama
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Logout Button -->
    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Logout
        </button>
    </form>
</body>

</html>
