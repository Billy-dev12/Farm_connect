<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Konsumen - Platform Pertanian</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4CAF50;
            --primary-dark: #388E3C;
            --secondary-color: #FF9800;
            --error-color: #F44336;
            --success-color: #4CAF50;
            --text-color: #333333;
            --light-gray: #f5f5f5;
            --medium-gray: #e0e0e0;
            --border-radius: 8px;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            color: var(--text-color);
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            background-image: linear-gradient(rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.8)),
                url('https://images.unsplash.com/photo-1464226184884-fa280b87c399?ixlib=rb-4.0.3');
            background-size: cover;
            background-position: center;
        }

        .container {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            width: 100%;
            max-width: 450px;
            padding: 40px 30px;
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: var(--primary-dark);
            font-weight: 600;
            position: relative;
        }

        h1::after {
            content: '';
            display: block;
            width: 50px;
            height: 3px;
            background: var(--primary-color);
            margin: 10px auto 0;
            border-radius: 2px;
        }

        .alert {
            padding: 12px 15px;
            border-radius: var(--border-radius);
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
        }

        .alert-success {
            background-color: rgba(76, 175, 80, 0.1);
            color: var(--success-color);
            border-left: 4px solid var(--success-color);
        }

        .alert-error {
            background-color: rgba(244, 67, 54, 0.1);
            color: var(--error-color);
            border-left: 4px solid var(--error-color);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #555;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid var(--medium-gray);
            border-radius: var(--border-radius);
            font-size: 15px;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
        }

        .error-message {
            color: var(--error-color);
            font-size: 13px;
            margin-top: 5px;
            display: block;
            font-weight: 500;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }

        .btn {
            display: block;
            width: 100%;
            padding: 14px;
            background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
            color: white;
            border: none;
            border-radius: var(--border-radius);
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
        }

        .btn:active {
            transform: translateY(0);
        }

        .links {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #666;
        }

        .links a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .links a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }

        .divider {
            margin: 15px 0;
            text-align: center;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background-color: var(--medium-gray);
        }

        .divider span {
            background-color: white;
            padding: 0 10px;
            position: relative;
        }

        .icon {
            margin-right: 8px;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .container {
                padding: 30px 20px;
            }

            h1 {
                font-size: 24px;
            }

            input {
                padding: 10px 12px;
            }

            .btn {
                padding: 12px;
                font-size: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h1><span class="icon">🛒</span> Register Konsumen</h1>

        @if (session('success'))
            <div class="alert alert-success">
                <span>✅ {{ session('success') }}</span>
            </div>
        @endif

        @if ($errors->has('error'))
            <div class="alert alert-error">
                <span>❌ {{ $errors->first('error') }}</span>
            </div>
        @endif

        <form action="{{ route('register.consumer.post') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="no_hp">Nomor HP</label>
                <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required>
                @error('no_hp')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit" class="btn">Register</button>
        </form>

        <div class="divider">
            <span>atau</span>
        </div>

        <div class="links">
            <p>Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
        </div>
    </div>
</body>

</html>
