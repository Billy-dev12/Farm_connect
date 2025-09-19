<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    
    @if($errors->any())
        <div style="color: red;">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    
    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        
        <div>
            <label>Email</label>
            <input type="email" name="email" required value="{{ old('email') }}">
        </div>
        
        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        
        <button type="submit">Login</button>
    </form>
    
    <p>Belum punya akun? 
        <a href="{{ route('register.consumer') }}">Yuk daftar</a>
    </p>
</body>
</html>