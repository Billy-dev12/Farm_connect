<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Konsumen - Sistem Pertanian</title>

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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .dashboard-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            padding: 40px;
            text-align: center;
        }

        .welcome-icon {
            font-size: 64px;
            color: #667eea;
            margin-bottom: 20px;
        }

        h1 {
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .subtitle {
            color: #7f8c8d;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }

        .menu-item {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 15px;
            padding: 25px;
            text-decoration: none;
            color: #2c3e50;
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            background: #667eea;
            color: white;
            transform: translateY(-3px);
            text-decoration: none;
        }

        .menu-item i {
            font-size: 32px;
            margin-bottom: 10px;
            display: block;
        }

        .menu-item span {
            font-weight: 500;
            font-size: 14px;
        }

        .logout-btn {
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 50px;
            padding: 12px 25px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .logout-btn:hover {
            background: #c82333;
            transform: translateY(-2px);
            text-decoration: none;
            color: white;
        }

        @media (max-width: 768px) {
            .menu-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <div class="welcome-icon">
            <i class="fas fa-shopping-basket"></i>
        </div>

        <h1>Selamat Datang, {{ $user->name }}!</h1>
        <p class="subtitle">Ayo belanja produk pertanian segar langsung dari petani lokal</p>

        @if (session('success'))
            <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 10px; margin-bottom: 20px;">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="menu-grid">
            <a href="#" class="menu-item">
                <i class="fas fa-search"></i>
                <span>Cari Produk</span>
            </a>

            <a href="#" class="menu-item">
                <i class="fas fa-shopping-cart"></i>
                <span>Keranjang</span>
            </a>

            <a href="#" class="menu-item">
                <i class="fas fa-list"></i>
                <span>Pesanan Saya</span>
            </a>

            <a href="{{ route('profile.edit') }}" class="menu-item">
                <i class="fas fa-user-edit"></i>
                <span>Edit Profile</span>
            </a>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</body>

</html>
