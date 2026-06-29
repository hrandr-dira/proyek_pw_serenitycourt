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
            margin: 0;
            font-family: var(--font-main), sans-serif;
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
            margin-top: 0;
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
        /* Wrapper baru untuk membungkus input dan tombol mata */
        .input-wrapper {
            flex: 1;
            position: relative;
            display: flex;
            align-items: center;
        }
        .form-input {
            width: 100%;
            padding: 8px 40px 8px 12px; /* Jarak kanan diperlebar agar teks tidak tertutup tombol mata */
            border: none;
            border-radius: 4px;
            font-family: var(--font-main), sans-serif;
            font-size: 13px;
            box-sizing: border-box;
        }
        /* Styling untuk tombol mata */
        .toggle-password {
            position: absolute;
            right: 12px;
            background: none;
            border: none;
            color: #666;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .toggle-password:hover {
            color: #333;
        }
        .password-hint {
            font-size: 11px;
            color: #D1E9FF;
            margin-top: -10px;
            margin-bottom: 15px;
            padding-left: 150px;
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
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
        .alert-error {
            background-color: rgba(255, 77, 79, 0.2);
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
            <div class="alert-error" role="alert">
                <ul style="padding-left: 15px; margin: 0;">
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
                <div class="input-wrapper">
                    <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="email">E-mail</label>
                <div class="input-wrapper">
                    <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="nomor_telepon">No. WhatsApp</label>
                <div class="input-wrapper">
                    <input type="tel" id="nomor_telepon" name="nomor_telepon" class="form-input" value="{{ old('nomor_telepon') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <div class="input-wrapper">
                    <input type="password" id="password" name="password" class="form-input" aria-describedby="password-hint" required>
                    <button type="button" class="toggle-password" data-target="password" aria-label="Tampilkan password">
                        <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
            </div>
            <div id="password-hint" class="password-hint">Minimal 8 karakter</div>

            <div class="form-group">
                <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                <div class="input-wrapper">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
                    <button type="button" class="toggle-password" data-target="password_confirmation" aria-label="Tampilkan password">
                        <svg class="eye-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-register">BUAT AKUN</button>

            <div class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Login</a>
            </div>
        </form>
    </div>

    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function () {
                // Ambil target input berdasarkan atribut data-target
                const targetId = this.getAttribute('data-target');
                const passwordInput = document.getElementById(targetId);
                const svgIcon = this.querySelector('.eye-icon');
                
                if (passwordInput.type === 'password') {
                    // Ubah jadi teks biasa agar kelihatan
                    passwordInput.type = 'text';
                    this.setAttribute('aria-label', 'Sembunyikan password');
                    
                    // Ubah ikon mata menjadi mata dicoret (Eye Off)
                    svgIcon.innerHTML = `
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                        <line x1="1" y1="1" x2="23" y2="23"></line>
                    `;
                } else {
                    // Kembalikan ke format password bintang-bintang
                    passwordInput.type = 'password';
                    this.setAttribute('aria-label', 'Tampilkan password');
                    
                    // Kembalikan ke ikon mata biasa (Eye)
                    svgIcon.innerHTML = `
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    `;
                }
            });
        });
    </script>
</body>
</html>
