<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Platform Pertanian</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('https://sfile.chatglm.cn/images-ppt/f850dfa11e19.jpg');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .login-container {
            width: 100%;
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 16px;
            padding: 40px 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
        }
        
        .logo-container {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }
        
        .logo {
            width: 80px;
            height: 80px;
            background-color: #627b3f;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 36px;
        }
        
        .login-title {
            text-align: center;
            margin-bottom: 30px;
            color: #8c460b;
            font-size: 28px;
            font-weight: 600;
        }
        
        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
        }
        
        .alert-success {
            background-color: rgba(76, 175, 80, 0.1);
            color: #4CAF50;
            border-left: 4px solid #4CAF50;
        }
        
        .alert-error {
            background-color: rgba(244, 67, 54, 0.1);
            color: #F44336;
            border-left: 4px solid #F44336;
        }
        
        .form-group {
            margin-bottom: 20px;
            position: relative;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #513b25;
            font-weight: 500;
            font-size: 14px;
        }
        
        .form-control {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #d1a776;
            border-radius: 8px;
            font-size: 16px;
            background-color: rgba(255, 255, 255, 0.8);
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            outline: none;
            border-color: #627b3f;
            box-shadow: 0 0 0 3px rgba(98, 123, 63, 0.2);
        }
        
        .error-message {
            color: #F44336;
            font-size: 13px;
            margin-top: 5px;
            display: block;
            font-weight: 500;
            animation: shake 0.5s ease-in-out;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 42px;
            cursor: pointer;
            color: #a36b3e;
        }
        
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 14px;
        }
        
        .remember-me {
            display: flex;
            align-items: center;
            color: #513b25;
        }
        
        .remember-me input {
            margin-right: 8px;
            accent-color: #627b3f;
        }
        
        .forgot-password {
            color: #627b3f;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .forgot-password:hover {
            color: #49612d;
            text-decoration: underline;
        }
        
        .login-btn {
            width: 100%;
            padding: 14px;
            background-color: #c17f2e;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-bottom: 25px;
        }
        
        .login-btn:hover {
            background-color: #b36906;
        }
        
        .divider {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
            color: #a36b3e;
        }
        
        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background-color: #d1a776;
        }
        
        .divider span {
            background-color: rgba(255, 255, 255, 0.85);
            padding: 0 15px;
            position: relative;
        }
        
        .signup-link {
            text-align: center;
            color: #513b25;
            font-size: 14px;
        }
        
        .signup-link a {
            color: #627b3f;
            text-decoration: none;
            font-weight: 600;
        }
        
        .signup-link a:hover {
            text-decoration: underline;
        }
        
        /* Responsive */
        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
            }
            
            .login-title {
                font-size: 24px;
            }
            
            .form-control {
                padding: 10px 12px;
                font-size: 15px;
            }
            
            .login-btn {
                padding: 12px;
                font-size: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <div class="logo">
                <i class="material-icons">eco</i>
            </div>
        </div>
        
        <h2 class="login-title">Masuk ke Akun Pertanian</h2>
        
        @if(session('success'))
            <div class="alert alert-success">
                <span>✅ {{ session('success') }}</span>
            </div>
        @endif
        
        @if($errors->any())
            <div class="alert alert-error">
                <span>❌ {{ $errors->first() }}</span>
            </div>
        @endif
        
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="nama@email.com" required value="{{ old('email') }}">
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
                <i class="material-icons password-toggle" id="togglePassword">visibility_off</i>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-options">
                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Ingat saya</label>
                </div>
                <a href="#" class="forgot-password">Lupa kata sandi?</a>
            </div>
            
            <button type="submit" class="login-btn">Masuk</button>
        </form>
        
        <div class="divider">
            <span>Atau</span>
        </div>
        
        <div class="signup-link">
            Belum punya akun? <a href="{{ route('register.consumer') }}">Yuk daftar</a>
        </div>
    </div>
    
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            if (type === 'password') {
                this.textContent = 'visibility_off';
            } else {
                this.textContent = 'visibility';
            }
        });
    </script>
</body>
</html>