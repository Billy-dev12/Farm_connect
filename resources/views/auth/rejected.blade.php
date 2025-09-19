<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Ditolak - Sistem Pertanian</title>

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
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .rejected-container {
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

        .rejected-icon {
            font-size: 80px;
            color: #e74c3c;
            animation: shake 0.5s;
            animation-iteration-count: 3;
        }

        @keyframes shake {
            0% {
                transform: translate(1px, 1px) rotate(0deg);
            }

            10% {
                transform: translate(-1px, -2px) rotate(-1deg);
            }

            20% {
                transform: translate(-3px, 0px) rotate(1deg);
            }

            30% {
                transform: translate(3px, 2px) rotate(0deg);
            }

            40% {
                transform: translate(1px, -1px) rotate(1deg);
            }

            50% {
                transform: translate(-1px, 2px) rotate(-1deg);
            }

            60% {
                transform: translate(-3px, 1px) rotate(0deg);
            }

            70% {
                transform: translate(3px, 1px) rotate(-1deg);
            }

            80% {
                transform: translate(-1px, -1px) rotate(1deg);
            }

            90% {
                transform: translate(1px, 2px) rotate(0deg);
            }

            100% {
                transform: translate(1px, -2px) rotate(-1deg);
            }
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

        .status-badge {
            display: inline-block;
            background: #f8d7da;
            color: #721c24;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .reason-box {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            margin: 30px 0;
            border-left: 5px solid #e74c3c;
            text-align: left;
        }

        .reason-box h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 18px;
        }

        .reason-text {
            color: #e74c3c;
            font-size: 16px;
            font-weight: 500;
            font-style: italic;
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #3498db;
            color: white;
        }

        .btn-primary:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #e74c3c;
            color: white;
        }

        .btn-danger:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        .contact-info {
            margin-top: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 15px;
        }

        .contact-info h3 {
            color: #2c3e50;
            margin-bottom: 15px;
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
    </style>
</head>

<body>
    <div class="rejected-container">
        <div class="icon-container">
            <i class="fas fa-times-circle rejected-icon"></i>
        </div>

        <span class="status-badge">
            <i class="fas fa-exclamation-triangle"></i> Akun Ditolak
        </span>

        <h1>Pendaftaran Anda Ditolak</h1>

        @if (session('user_data'))
            <p class="message">
                Hai <strong>{{ session('user_data')['name'] }}</strong>, pendaftaran Anda sebagai petani dengan email
                <strong>{{ session('user_data')['email'] }}</strong> tidak dapat disetujui.
            </p>

            <div class="reason-box">
                <h3><i class="fas fa-comment-alt"></i> Alasan Penolakan:</h3>
                <p class="reason-text">
                    "{{ session('user_data')['alasan_penolakan'] }}"
                </p>
            </div>
        @else
            <p class="message">
                Maaf, pendaftaran Anda sebagai petani tidak dapat disetujui.
            </p>

            <div class="reason-box">
                <h3><i class="fas fa-comment-alt"></i> Alasan Penolakan:</h3>
                <p class="reason-text">
                    Tidak ada alasan penolakan yang tersedia.
                </p>
            </div>
        @endif

        <p class="message">
            Silakan perbaiki data Anda dan daftar kembali, atau hubungi admin jika Anda merasa ada kesalahan.
        </p>

        <div class="action-buttons">
            <a href="{{ route('register.farmer') }}" class="btn btn-danger">
                <i class="fas fa-redo"></i> Daftar Ulang
            </a>
            <a href="{{ route('login') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali ke Login
            </a>
        </div>

        <div class="contact-info">
            <h3><i class="fas fa-headset"></i> Hubungi Admin</h3>
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
    </div>
</body>

</html>
