<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pending - Sistem Pertanian</title>
    
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
            padding: 20px;
        }
        
        .pending-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            padding: 40px;
            text-align: center;
        }
        
        .icon-container {
            margin-bottom: 30px;
        }
        
        .pending-icon {
            font-size: 80px;
            color: #f39c12;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        h1 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 28px;
        }
        
        .message {
            color: #7f8c8d;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        
        .admin-info {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            margin: 30px 0;
            border-left: 5px solid #3498db;
        }
        
        .admin-info h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 20px;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 10px 0;
            color: #34495e;
        }
        
        .contact-item i {
            margin-right: 10px;
            color: #3498db;
            width: 20px;
        }
        
        .back-btn {
            display: inline-block;
            background: #3498db;
            color: white;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            margin-top: 20px;
            transition: all 0.3s ease;
        }
        
        .back-btn:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }
        
        .status-badge {
            display: inline-block;
            background: #fff3cd;
            color: #856404;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="pending-container">
        <div class="icon-container">
            <i class="fas fa-hourglass-half pending-icon"></i>
        </div>
        
        <span class="status-badge">
            <i class="fas fa-clock"></i> Menunggu Verifikasi
        </span>
        
        <h1>Akun Anda Sedang Diverifikasi</h1>
        
        <p class="message">
            Terima kasih telah mendaftar sebagai petani di platform kami. Saat ini akun Anda masih dalam proses verifikasi oleh admin. 
            Anda akan dapat menggunakan semua fitur setelah akun disetujui.
        </p>
        
        <div class="admin-info">
            <h3><i class="fas fa-user-shield"></i> Hubungi Admin untuk Verifikasi</h3>
            
            <div class="contact-item">
                <i class="fas fa-phone"></i>
                <span>0812-3456-7890</span>
            </div>
            
            <div class="contact-item">
                <i class="fas fa-envelope"></i>
                <span>admin@sistem-pertanian.com</span>
            </div>
            
            <div class="contact-item">
                <i class="fab fa-whatsapp"></i>
                <span>0812-3456-7890 (WhatsApp)</span>
            </div>
        </div>
        
        <p class="message">
            <strong>Catatan:</strong> Proses verifikasi biasanya memakan waktu 1x24 jam. 
            Pastikan Anda telah memberikan data yang lengkap dan valid saat registrasi.
        </p>
        
        <a href="{{ route('login') }}" class="back-btn">
            <i class="fas fa-arrow-left"></i> Kembali ke Login
        </a>
    </div>
</body>
</html>