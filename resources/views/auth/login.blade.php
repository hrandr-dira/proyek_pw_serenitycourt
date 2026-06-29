<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Serenity Court</title>
    <link rel="stylesheet" href="{{ asset('css/serenity.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background:
                linear-gradient(rgba(248,249,250,0.88), rgba(248,249,250,0.88)),
                url('https://images.unsplash.com/photo-1518605368461-1ee71abed5de?q=80&w=2000&auto=format&fit=crop') center/cover no-repeat;
            margin: 0;
            overflow-x: hidden;
            padding: 24px;
        }
        .login-left {
            width: 100%;
            max-width: 460px;
            padding: 34px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 24px 60px rgba(21,51,81,0.14);
        }
        .login-right {
            display: none;
        }
        
        .logo-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
            margin-bottom: 28px;
            font-weight: 700;
            font-size: 20px;
            color: var(--primary-blue);
            line-height: 1.1;
        }
        .logo-icon {
            width: 50px;
            height: 30px;
            background-color: var(--light-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--primary-blue);
        }

        .login-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--text-dark);
            text-align: center;
        }
        .login-subtitle {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 30px;
            text-align: center;
        }

        .input-group {
            position: relative;
            margin-bottom: 15px;
        }
        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }
        .input-with-icon {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            font-family: var(--font-main);
            font-size: 14px;
            outline: none;
        }
        .input-with-icon:focus {
            border-color: var(--secondary-blue);
        }

        .forgot-password {
            text-align: right;
            font-size: 11px;
            margin-top: 5px;
            margin-bottom: 25px;
        }

        .role-label {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 10px;
            display: block;
        }

        .role-selector {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 25px;
        }
        .role-card {
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 12px 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            transition: border-color 0.2s;
        }
        .role-card.active {
            border-color: var(--primary-blue);
            border-width: 2px;
            padding: 11px 14px; /* compensate border */
        }
        .role-info {
            display: flex;
            align-items: center;
            gap: 15px;
            font-weight: 600;
            font-size: 14px;
            color: var(--primary-blue);
        }
        .role-info i {
            font-size: 18px;
            color: var(--text-muted);
        }
        .role-card.active .role-info i {
            color: var(--primary-blue);
        }
        .check-icon {
            width: 20px;
            height: 20px;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: transparent;
        }
        .role-card.active .check-icon {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
            color: var(--white);
            font-size: 12px;
        }

        .btn-login {
            width: 100%;
            background-color: var(--primary-blue);
            color: var(--white);
            padding: 14px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
        }

        .register-link {
            text-align: center;
            font-size: 12px;
            margin-top: 15px;
            color: var(--text-muted);
        }

        .alert-error {
            background-color: rgba(255, 77, 79, 0.1);
            color: #FF4D4F;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            body {
                align-items: flex-start;
                padding: 16px;
            }
            .login-left {
                max-width: 100%;
                padding: 24px 18px;
            }
            .login-title {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login-left">
        <div class="logo-wrap">
            <!-- TEMPAT UPLOAD GAMBAR: Simpan logo dengan nama "logo.png" di dalam folder "public/images/" -->
            <img src="{{ asset('images/logo.png') }}" alt="Serenity Court Logo" style="height:45px; width:auto; border-radius: 8px;">
            <div style="font-size: 14px; text-align: left; line-height: 1.1;">SERENITY<br>COURT</div>
        </div>

        <h1 class="login-title">Selamat Datang Kembali!</h1>
        <p class="login-subtitle">Masuk untuk melanjutkan</p>

        @if($errors->any() || session('error'))
            <div class="alert-error">
                {{ session('error') ?? $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="input-group">
                <i class="fa-regular fa-envelope"></i>
                <input type="email" name="email" class="input-with-icon" placeholder="Email atau Nomor Telephone" value="{{ old('email') }}" required>
            </div>

            <div class="input-group" style="margin-bottom:0;">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" class="input-with-icon" placeholder="Password" required>
            </div>

            <div class="forgot-password">
                <a href="#">Lupa password?</a>
            </div>

            <span class="role-label">Masuk sebagai</span>
            <div class="role-selector">
                <label class="role-card active" id="card-customer">
                    <input type="radio" name="role_selector" value="customer" style="display:none;" checked>
                    <div class="role-info">
                        <i class="fa-solid fa-users"></i> Customer
                    </div>
                    <div class="check-icon"><i class="fa-solid fa-check"></i></div>
                </label>

                <label class="role-card" id="card-admin">
                    <input type="radio" name="role_selector" value="admin" style="display:none;">
                    <div class="role-info">
                        <i class="fa-solid fa-shield-halved"></i> Admin
                    </div>
                    <div class="check-icon"><i class="fa-solid fa-check"></i></div>
                </label>
            </div>

            <button type="submit" class="btn-login">MASUK</button>

            <div class="register-link">
                Belum punya akun? <a href="{{ route('register') }}" style="color:var(--primary-blue); font-weight:600;">Buat akun</a>
            </div>
        </form>
    </div>
    
    <div class="login-right"></div>

    <script>
        const cardCustomer = document.getElementById('card-customer');
        const cardAdmin = document.getElementById('card-admin');
        const radioCustomer = cardCustomer.querySelector('input');
        const radioAdmin = cardAdmin.querySelector('input');

        cardCustomer.addEventListener('click', () => {
            cardCustomer.classList.add('active');
            cardAdmin.classList.remove('active');
            radioCustomer.checked = true;
        });

        cardAdmin.addEventListener('click', () => {
            cardAdmin.classList.add('active');
            cardCustomer.classList.remove('active');
            radioAdmin.checked = true;
        });
    </script>
</body>
</html>
