<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - Serenity Court')</title>
    <link rel="stylesheet" href="{{ asset('css/serenity.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #e9ecef;
        }
        .dashboard-wrapper {
            display: block;
            max-width: 480px;
            margin: 0 auto;
            background: var(--white);
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .sidebar {
            width: 100%;
            height: auto;
            max-height: none;
            background-color: var(--primary-blue);
            position: sticky;
            top: 0;
            z-index: 20;
        }
        .sidebar-logo {
            padding: 16px 20px;
            background-color: var(--primary-blue);
            color: var(--white);
            border-bottom: none;
            margin-bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .sidebar-logo-box {
            width: 40px; height: 25px;
            background-color: var(--light-blue);
            display: flex; align-items: center; justify-content: center;
            color: var(--primary-blue);
        }
        .sidebar-menu {
            display: flex;
            gap: 6px;
            overflow-x: auto;
            padding: 8px 10px 12px !important;
            scrollbar-width: none; /* hide scrollbar */
            list-style: none;
            margin: 0;
        }
        .sidebar-menu::-webkit-scrollbar {
            display: none;
        }
        .sidebar-menu li {
            flex: 0 0 auto;
        }
        .sidebar-menu li[style] {
            margin-top: 0 !important;
        }
        .sidebar-item {
            padding: 10px 14px;
            font-weight: 600;
            font-size: 12px;
            min-height: 42px;
            border-radius: 6px;
            margin-right: 0;
            white-space: nowrap;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .sidebar-item.active {
            background-color: var(--white);
            color: var(--primary-blue);
        }
        .sidebar-item:hover:not(.active) {
            background-color: rgba(255,255,255,0.1);
            color: var(--white);
        }
        .sidebar-item i {
            margin-right: 6px;
        }
        .main-content {
            background-color: var(--white);
            margin-left: 0;
            padding: 22px 16px 32px;
            box-sizing: border-box;
        }
        .top-greeting {
            margin-bottom: 24px;
        }
        .top-greeting h1 {
            font-size: 20px;
            color: var(--text-dark);
            margin-bottom: 5px;
        }
        .top-greeting p {
            font-size: 13px;
            color: var(--text-muted);
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-logo" style="gap:15px; padding: 12px 15px;">
                <!-- TEMPAT UPLOAD GAMBAR: Simpan logo dengan nama "logo.png" di dalam folder "public/images/" -->
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:35px; width:auto; border-radius: 6px;">
                <div style="font-size: 14px; text-align: left; line-height: 1.2;">SERENITY<br>COURT</div>
            </div>
            
            <ul class="sidebar-menu" style="padding-top:0;">
                <li>
                    <a href="{{ route('customer.dashboard') }}" class="sidebar-item {{ request()->routeIs('customer.dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-house"></i> Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.lapangan') }}" class="sidebar-item {{ request()->routeIs('customer.lapangan') ? 'active' : '' }}">
                        <i class="fa-solid fa-layer-group"></i> Lapangan
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.booking') }}" class="sidebar-item {{ request()->routeIs('customer.booking') ? 'active' : '' }}">
                        <i class="fa-solid fa-calendar-check"></i> Reservasi saya
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.riwayat') }}" class="sidebar-item {{ request()->routeIs('customer.riwayat') || request()->routeIs('customer.feedback') ? 'active' : '' }}">
                        <i class="fa-solid fa-clock-rotate-left"></i> Riwayat
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.riwayat') }}" class="sidebar-item {{ request()->routeIs('customer.pembayaran') ? 'active' : '' }}" onclick="alert('Silakan pilih lapangan yang ingin dibayar pada menu Riwayat dengan mengklik tombol \'Bayar Sekarang\'');">
                        <i class="fa-solid fa-wallet"></i> Pembayaran
                    </a>
                </li>
                <li>
                    <a href="{{ route('customer.support') }}" class="sidebar-item {{ request()->routeIs('customer.support') ? 'active' : '' }}">
                        <i class="fa-solid fa-headset"></i> Customer support
                    </a>
                </li>
                <li style="margin-top: 30px;">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="sidebar-item" style="background:none; border:none; width:100%; text-align:left; cursor:pointer;">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="top-greeting">
                <h1>Hi, {{ explode(' ', Auth::user()->name)[0] }} 👋</h1>
                <p>Selamat datang kembali di Serenity Court!</p>
            </div>

            @yield('content')
        </main>
    </div>

    @stack('scripts')
    <script>
        // Auto-hide success alerts
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('[style*="background:rgba(82,196,26,0.1)"]');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 3500);
            });
        });
    </script>
</body>
</html>
