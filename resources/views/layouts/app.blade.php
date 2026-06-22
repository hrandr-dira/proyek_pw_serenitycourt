<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Serenity Court')</title>
    <link rel="stylesheet" href="{{ asset('css/serenity.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .navbar {
            background-color: var(--white);
            padding: 15px 0;
            border-bottom: 1px solid var(--border-color);
        }
        .navbar-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .logo-wrap {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 16px;
            color: var(--primary-blue);
            line-height: 1.1;
            text-decoration: none;
        }
        .logo-icon {
            width: 45px;
            height: 25px;
            background-color: var(--light-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--primary-blue);
            color: var(--primary-blue);
        }
        .nav-menu {
            display: flex;
            gap: 30px;
            align-items: center;
        }
        .nav-link {
            font-size: 11px;
            font-weight: 700;
            color: var(--primary-blue);
            text-transform: uppercase;
        }
        .nav-link:hover {
            color: var(--secondary-blue);
            text-decoration: none;
        }
        .btn-auth {
            font-size: 11px;
            font-weight: 700;
            color: var(--primary-blue);
            border: 1px solid var(--primary-blue);
            padding: 8px 15px;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.3s;
        }
        .btn-auth:hover {
            background-color: var(--primary-blue);
            color: var(--white);
            text-decoration: none;
        }
        
        footer {
            background-color: var(--primary-blue);
            color: var(--white);
            padding: 30px 0;
            margin-top: auto;
        }
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .footer-email {
            font-weight: 500;
            font-size: 14px;
        }
        .footer-socials {
            display: flex;
            gap: 15px;
            font-size: 20px;
        }
        .footer-socials a {
            color: var(--white);
        }
        .footer-socials a:hover {
            color: var(--light-blue);
        }
        @media (max-width: 768px) {
            .navbar-container {
                align-items: stretch;
                flex-direction: column;
                gap: 14px;
            }
            .nav-menu {
                gap: 10px;
                overflow-x: auto;
                padding-bottom: 4px;
            }
            .nav-link {
                flex: 0 0 auto;
            }
            .btn-auth {
                display: block;
                text-align: center;
                width: 100%;
            }
            .footer-content {
                flex-direction: column;
                gap: 14px;
                text-align: center;
            }
            .footer-content > div {
                flex: none !important;
            }
            .footer-socials {
                justify-content: center !important;
            }
        }
    </style>
    @stack('styles')
</head>
<body style="display:flex; flex-direction:column; min-height:100vh;">

    <nav class="navbar">
        <div class="container navbar-container">
            <a href="{{ route('home') }}" class="logo-wrap">
                <div class="logo-icon"><i class="fa-solid fa-medal"></i></div>
                <div>SERENITY<br>COURT</div>
            </a>
            
            <div class="nav-menu">
                <a href="{{ route('home') }}" class="nav-link">HOME</a>
                <a href="#lapangan" class="nav-link">LAPANGAN</a>
                <a href="#jadwal" class="nav-link">JADWAL</a>
                <a href="#cara-booking" class="nav-link">CARA BOOKING</a>
            </div>

            <div>
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn-auth">PANEL ADMIN</a>
                    @else
                        <a href="{{ route('customer.dashboard') }}" class="btn-auth">DASHBOARD SAYA</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn-auth">MASUK/DAFTAR</a>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="container footer-content">
            <div style="flex:1;"></div>
            <div class="footer-email">serenitycourt@gmail.com</div>
            <div style="flex:1; display:flex; justify-content:flex-end;" class="footer-socials">
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
