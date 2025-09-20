<!-- resources/views/errors/404.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tidak Ditemukan - 404</title>
    
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
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        
        .error-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            padding: 40px;
            max-width: 500px;
            width: 90%;
            text-align: center;
        }
        
        .error-icon {
            font-size: 80px;
            color: #e74c3c;
            margin-bottom: 20px;
        }
        
        .error-title {
            font-size: 28px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
        }
        
        .error-message {
            font-size: 16px;
            color: #7f8c8d;
            margin-bottom: 25px;
            line-height: 1.5;
        }
        
        .error-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
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
            transform: translateY(-2px);
        }
        
        .btn-outline {
            background: transparent;
            border: 2px solid #4a7c59;
            color: #4a7c59;
        }
        
        .btn-outline:hover {
            background: #4a7c59;
            color: white;
        }
        
        .search-box {
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
        }
        
        .search-box input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 25px;
            font-size: 14px;
        }
        
        .search-box input:focus {
            outline: none;
            border-color: #4a7c59;
        }
        
        .popular-links {
            margin-top: 20px;
        }
        
        .popular-links h4 {
            color: #2c3e50;
            margin-bottom: 10px;
        }
        
        .popular-links ul {
            list-style: none;
        }
        
        .popular-links li {
            margin-bottom: 8px;
        }
        
        .popular-links a {
            color: #4a7c59;
            text-decoration: none;
            font-weight: 500;
        }
        
        .popular-links a:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .error-container {
                padding: 30px 20px;
            }
            
            .error-title {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        
        <h1 class="error-title">Halaman Tidak Ditemukan</h1>
        
        <p class="error-message">
            Maaf, halaman yang Anda cari tidak ditemukan. Mungkin sudah dihapus atau URL yang Anda masukkan salah.
        </p>
        
        <div class="error-actions">
            <a href="{{ url('/dashboard/konsumen') }}" class="btn btn-primary">
                <i class="fas fa-home"></i> Kembali ke Beranda
            </a>
            
            <a href="{{ route('konsumen.browse') }}" class="btn btn-outline">
                <i class="fas fa-store"></i> Lihat Produk
            </a>
        </div>
        
        <div class="search-box">
            <h4><i class="fas fa-search"></i> Cari Produk</h4>
            <form action="{{ route('konsumen.search') }}" method="GET">
                <input type="text" 
                       name="q" 
                       placeholder="Cari produk pertanian..." 
                       value="{{ request('q') }}">
                <button type="submit" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #4a7c59;">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        
        <div class="popular-links">
            <h4><i class="fas fa-star"></i> Populer</h4>
            <ul>
                <li><a href="{{ route('konsumen.browse') }}">Semua Produk</a></li>
                <li><a href="{{ route('konsumen.browse') }}?category=Sayuran">Sayuran Segar</a></li>
                <li><a href="{{ route('konsumen.browse') }}?category=Bahan%20Pokok">Bahan Pokok</a></li>
                <li><a href="{{ route('konsumen.wishlist') }}">Wishlist Saya</a></li>
            </ul>
        </div>
    </div>
</body>
</html>