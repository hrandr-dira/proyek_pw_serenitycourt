<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Serenity Court')</title>
    <link rel="stylesheet" href="{{ asset('css/serenity.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #e9ecef;
            margin: 0;
            padding: 0;
        }
        .app-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            max-width: 480px;
            margin: 0 auto;
            background: var(--white);
            position: relative;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .navbar {
            background-color: var(--white);
            padding: 15px 15px;
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .navbar-container {
            display: flex;
            align-items: stretch;
            justify-content: space-between;
            flex-direction: column;
            gap: 14px;
        }
        .logo-wrap {
            display: flex;
            align-items: center;
            justify-content: center;
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
            gap: 10px;
            align-items: center;
            overflow-x: auto;
            padding-bottom: 4px;
            scrollbar-width: none;
        }
        .nav-menu::-webkit-scrollbar {
            display: none;
        }
        .nav-link {
            flex: 0 0 auto;
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
            display: block;
            text-align: center;
            width: 100%;
            box-sizing: border-box;
        }
        .btn-auth:hover {
            background-color: var(--primary-blue);
            color: var(--white);
            text-decoration: none;
        }
        
        footer {
            background-color: var(--primary-blue);
            color: var(--white);
            padding: 30px 15px;
            margin-top: auto;
        }
        .footer-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 14px;
            text-align: center;
        }
        .footer-email {
            font-weight: 500;
            font-size: 14px;
        }
        .footer-socials {
            display: flex;
            gap: 15px;
            font-size: 20px;
            justify-content: center;
        }
        .footer-socials a {
            color: var(--white);
        }
        .footer-socials a:hover {
            color: var(--light-blue);
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="app-wrapper">
        <nav class="navbar">
            <div class="container navbar-container">
                <a href="{{ route('home') }}" class="logo-wrap" style="gap:15px;">
                    <!-- TEMPAT UPLOAD GAMBAR: Simpan logo dengan nama "logo.png" di dalam folder "public/images/" -->
                    <img src="{{ asset('images/logo.png') }}" alt="Serenity Court Logo" style="height:45px; width:auto; border-radius: 8px;">
                    <div style="font-size: 14px; text-align: left;">SERENITY<br>COURT</div>
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
                <div style="flex:1; display:flex; justify-content:center;" class="footer-socials">
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>
