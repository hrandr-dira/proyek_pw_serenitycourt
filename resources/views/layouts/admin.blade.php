<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Serenity Court')</title>
    <link rel="stylesheet" href="{{ asset('css/serenity.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
    <style>
        /* Admin specific overrides - Mobile Forced */
        :root { --warning: #FBBF24; }
        body {
            background: #e9ecef;
        }
        .dashboard-layout {
            display: block;
            max-width: 480px;
            margin: 0 auto;
            background: var(--bg-light);
            min-height: 100vh;
            position: relative;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .sidebar {
            position: sticky;
            top: 0;
            width: 100%;
            height: auto;
            padding: 12px;
            border-right: none;
            border-bottom: 1px solid rgba(10,107,166,0.14);
            z-index: 50;
            background: #13131F;
            box-sizing: border-box;
        }
        .nav-brand {
            justify-content: center;
            padding-bottom: 10px;
            font-size: 17px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--white);
            font-weight: 700;
        }
        .nav-brand span { color: var(--secondary-blue); }
        .sidebar-menu {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            padding: 8px 0 10px;
            scrollbar-width: none;
            list-style: none;
            margin: 0;
        }
        .sidebar-menu::-webkit-scrollbar {
            display: none;
        }
        .sidebar-menu li {
            flex: 0 0 auto;
        }
        .sidebar-link {
            min-height: 42px;
            padding: 10px 12px;
            font-size: 13px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-radius: 8px;
            color: rgba(255,255,255,0.78);
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
        }
        .sidebar-link.active {
            background: rgba(10,107,166,0.16);
            color: var(--secondary-blue);
        }
        .sidebar-link:hover {
            background: rgba(10,107,166,0.1);
            color: var(--secondary-blue);
            text-decoration: none;
        }
        .sidebar-footer {
            display: none;
        }
        .main-content {
            width: 100%;
            margin-left: 0;
            padding: 20px 14px 32px;
            box-sizing: border-box;
        }
        .dash-header {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            margin-bottom: 20px;
            gap: 10px;
        }
        .dash-header h2 {
            font-size: 21px;
            color: var(--text-dark);
        }
        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 10px 12px;
            justify-content: space-between;
            width: 100%;
            box-sizing: border-box;
        }
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--secondary-blue);
        }
        .glass-card {
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 10px 28px rgba(21,51,81,0.06);
        }
        .table-responsive {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        .table-responsive table {
            min-width: 600px;
        }
    </style>
</head>
<body>
    <div class="bg-blob bg-blob-accent" style="opacity: 0.05;"></div>

    <div class="dashboard-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="nav-brand mb-3" style="gap:15px; padding: 0 10px 20px;">
                <!-- TEMPAT UPLOAD GAMBAR: Simpan logo dengan nama "logo.png" di dalam folder "public/images/" -->
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:35px; width:auto; border-radius: 6px;">
                <div style="font-size: 14px; text-align: left; line-height: 1.2;">Serenity<br><span>Admin</span></div>
            </div>
            
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-chart-pie"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.reservasi.index') }}" class="sidebar-link {{ request()->routeIs('admin.reservasi.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-calendar-check"></i> Reservasi
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.lapangan.index') }}" class="sidebar-link {{ request()->routeIs('admin.lapangan.*') ? 'active' : '' }}">
                        <i class="fa-solid fa-layer-group"></i> Kelola Lapangan
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="margin:0; padding:0;">
                        @csrf
                        <button type="submit" class="sidebar-link" style="background:transparent; border:none; cursor:pointer; color: #FF4D4F; padding-left:12px; padding-right:12px;">
                            <i class="fa-solid fa-right-from-bracket"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="dash-header">
                <div>
                    <h2 style="margin-bottom:0.25rem;">@yield('header-title', 'Admin Panel')</h2>
                    <p style="color:var(--text-muted); font-size:0.9rem;">@yield('header-subtitle', 'Sistem Manajemen Serenity Court')</p>
                </div>
                <div class="user-profile">
                    <div class="text-right" style="text-align:right;">
                        <div style="font-weight:600;">{{ Auth::user()->name }}</div>
                        <div style="font-size:0.8rem; color:var(--secondary-blue);">Administrator</div>
                    </div>
                    <div class="avatar" style="background: var(--secondary-blue);">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div style="background:rgba(78,204,163,0.15); border:1px solid var(--success); color:var(--success); padding:1rem; border-radius:12px; margin-bottom:1.5rem;">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
    <script>
        // Auto-hide success alerts
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert-success, [style*="rgba(78,204,163,0.15)"]');
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
