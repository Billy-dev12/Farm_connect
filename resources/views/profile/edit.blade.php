<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Sistem Pertanian</title>

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
        }

        .profile-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-header h1 {
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .profile-header p {
            color: #7f8c8d;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .btn {
            background: #667eea;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn:hover {
            background: #5a6fd8;
            transform: translateY(-2px);
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            color: white;
        }

        .alert-success {
            background: #4caf50;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="profile-container">
        <div class="profile-header">
            <h1><i class="fas fa-user-edit"></i> Edit Profile</h1>
            <p>Lengkapi informasi profil Anda untuk pengalaman berbelanja yang lebih baik</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name"><i class="fas fa-user"></i> Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" readonly>
            </div>

            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" readonly>
            </div>

            <div class="form-group">
                <label for="no_hp"><i class="fas fa-phone"></i> Nomor HP</label>
                <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" required>
            </div>

            <div class="form-group">
                <label for="alamat_pengiriman"><i class="fas fa-map-marker-alt"></i> Alamat Pengiriman</label>
                <textarea id="alamat_pengiriman" name="alamat_pengiriman" required
                    placeholder="Masukkan alamat lengkap untuk pengiriman produk">{{ old('alamat_pengiriman', $user->alamat_pengiriman) }}</textarea>
            </div>

            <button type="submit" class="btn">
                <i class="fas fa-save"></i> Simpan Perubahan
            </button>
        </form>

        <div style="text-align: center; margin-top: 30px;">
            <a href="{{ route('dashboard.customer') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>
</body>

</html>
