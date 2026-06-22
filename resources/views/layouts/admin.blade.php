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
        /* Admin specific overrides */
        :root { --warning: #FBBF24; }
        body {
            background: var(--bg-light);
        }
        .dashboard-layout {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 270px;
            background: #13131F;
            border-right: 1px solid rgba(10,107,166,0.12);
            padding: 20px 14px;
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 30;
        }
        .nav-brand {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--white);
            font-size: 18px;
            font-weight: 700;
            padding: 0 4px 20px;
            line-height: 1.1;
        }
        .nav-brand span { color: var(--secondary-blue); }
        .sidebar-menu {
            padding: 10px 0;
            list-style: none;
            flex: 1;
        }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
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
            margin-top: auto;
            padding-top: 18px;
        }
        .main-content {
            width: calc(100% - 270px);
            margin-left: 270px;
            padding: 28px;
        }
        .dash-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            margin-bottom: 28px;
        }
        .dash-header h2 {
            color: var(--text-dark);
            font-size: 24px;
        }
        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--white);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 10px 12px;
        }
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
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
            min-width: 760px;
        }
        @media (max-width: 900px) {
            .dashboard-layout {
                display: block;
            }
            .sidebar {
                position: sticky;
                top: 0;
                width: 100%;
                height: auto;
                padding: 12px;
                border-right: none;
                border-bottom: 1px solid rgba(10,107,166,0.14);
            }
            .nav-brand {
                justify-content: center;
                padding-bottom: 10px;
                font-size: 17px;
            }
            .sidebar-menu {
                display: flex;
                gap: 8px;
                overflow-x: auto;
                padding: 8px 0 10px;
                scrollbar-width: thin;
            }
            .sidebar-menu li {
                flex: 0 0 auto;
            }
            .sidebar-link {
                min-height: 42px;
                padding: 10px 12px;
                font-size: 13px;
            }
            .sidebar-footer {
                margin-top: 0;
                padding-top: 8px;
            }
            .sidebar-footer .btn {
                padding: 10px;
            }
            .main-content {
                width: 100%;
                margin-left: 0;
                padding: 20px 14px 32px;
            }
            .dash-header {
                align-items: stretch;
                flex-direction: column;
                margin-bottom: 20px;
            }
            .dash-header h2 {
                font-size: 21px;
            }
            .user-profile {
                justify-content: space-between;
                width: 100%;
            }
        }
        @media (max-width: 480px) {
            .nav-brand {
                justify-content: flex-start;
            }
            .sidebar-link {
                font-size: 12px;
            }
            .sidebar-link i {
                margin-right: 0;
            }
            .main-content {
                padding-inline: 12px;
            }
            .user-profile .text-right {
                text-align: left !important;
            }
        }
    </style>
</head>
<body>
    <div class="bg-blob bg-blob-accent" style="opacity: 0.05;"></div>

    <div class="dashboard-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="nav-brand mb-3">
                <i class="fa-solid fa-shield-halved text-accent"></i> Serenity <span>Admin</span>
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
            </ul>

            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline" style="width:100%; border-color:var(--text-muted); color:var(--text-muted);">
                        <i class="fa-solid fa-right-from-bracket"></i> Logout
                    </button>
                </form>
            </div>
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
