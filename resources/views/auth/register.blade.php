<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Serenity Court</title>
    <link rel="stylesheet" href="{{ asset('css/serenity.css') }}">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #F5F5F5;
        }
        .register-container {
            background-color: var(--primary-blue);
            width: 100%;
            max-width: 500px;
            padding: 40px;
            border-radius: 8px;
            color: var(--white);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .register-title {
            text-align: center;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 30px;
        }
        .form-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .form-label {
            width: 150px;
            font-size: 13px;
            font-weight: 500;
        }
        .form-input {
            flex: 1;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            font-family: var(--font-main);
            font-size: 13px;
        }
        .btn-register {
            width: 100%;
            background-color: var(--secondary-blue);
            color: var(--white);
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            margin-top: 20px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-register:hover {
            background-color: #085585;
        }
        .login-link {
            text-align: center;
            margin-top: 15px;
            font-size: 12px;
        }
        .login-link a {
            color: #4DA3FF;
        }
        .alert-error {
            background-color: rgba(255, 77, 79, 0.1);
            color: #FF4D4F;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2 class="register-title">Register</h2>

        @if($errors->any())
            <div class="alert-error">
                <ul style="padding-left: 15px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label" for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="email">E-mail</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="nomor_telepon">No. WhatsApp</label>
                <input type="text" id="nomor_telepon" name="nomor_telepon" class="form-input" value="{{ old('nomor_telepon') }}" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" name="password" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
            </div>

            <button type="submit" class="btn-register">BUAT AKUN</button>

            <div class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Login</a>
            </div>
        </form>
    </div>
</body>
</html>
