<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistem Pakar')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            background-color: #f8fafc;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            position: fixed;
            top: 0;
            bottom: 0;
            padding: 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .sidebar-header {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h4 {
            font-size: 1.3rem;
            font-weight: 700;
            margin: 0;
            color: white;
        }

        .sidebar-header .subtitle {
            font-size: 0.85rem;
            opacity: 0.8;
            margin-top: 0.3rem;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 0.8rem 1.5rem;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            font-weight: 500;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            border-left-color: #fbbf24;
            transform: translateX(5px);
        }

        .sidebar-nav a i {
            margin-right: 0.8rem;
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        .main-content {
            margin-left: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100%;
        }

        .with-sidebar .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
        }

        .topbar {
            background: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e5e7eb;
            position: fixed;
            top: 0;
            left: 260px;
            right: 0;
            z-index: 999;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .topbar-left {
            display: flex;
            align-items: center;
        }

        .topbar-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #374151;
            margin: 0;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6b7280;
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
        }

        .content {
            padding: 2rem;
            flex: 1;
            margin-top: 80px;
            /* Untuk topbar fixed */
        }

        .content-header {
            margin-bottom: 2rem;
        }

        .content-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1f2937;
            margin: 0;
        }

        footer {
            background: white;
            color: #6b7280;
            padding: 1.5rem 2rem;
            text-align: center;
            border-top: 1px solid #e5e7eb;
            margin-top: auto;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .with-sidebar .main-content {
                margin-left: 0;
                width: 100%;
            }

            .topbar {
                left: 0;
            }

            .content {
                padding: 1rem;
            }
        }

        /* Scrollbar Styling */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>
</head>

<body>

    <div class="wrapper {{ Auth::check() && Auth::user()->role == 'pakar' ? 'with-sidebar' : '' }}">

        @auth
            @if (Auth::user()->role == 'pakar')
                <div class="sidebar">
                    <div class="sidebar-header">
                        <h4><i class="fas fa-user-md me-2"></i>Dashboard Pakar</h4>
                        <div class="subtitle">Sistem Pakar Kulit</div>
                    </div>
                    <nav class="sidebar-nav">
                        <a href="{{ route('pakar.dashboard') }}"
                            class="{{ request()->routeIs('pakar.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-home"></i>
                            Dashboard
                        </a>
                        <a href="{{ route('pakar.penyebab.index') }}"
                            class="{{ request()->routeIs('pakar.penyebab.*') ? 'active' : '' }}">
                            <i class="fas fa-virus"></i>
                            Data Penyebab
                        </a>
                        <a href="{{ route('pakar.permasalahan_kulit.index') }}"
                            class="{{ request()->routeIs('pakar.permasalahan_kulit.*') ? 'active' : '' }}">
                            <i class="fas fa-layer-group"></i>
                            Permasalahan Kulit
                        </a>
                        <a href="{{ route('pakar.pengetahuan.index') }}"
                            class="{{ request()->routeIs('pakar.pengetahuan.*') ? 'active' : '' }}">
                            <i class="fas fa-book-medical"></i>
                            Data Pengetahuan
                        </a>
                        <a href="{{ route('pakar.konsultasi.index') }}"
                            class="{{ request()->routeIs('pakar.konsultasi.*') ? 'active' : '' }}">
                            <i class="fas fa-user-md"></i>
                            Konsultasi Pasien
                            @php
                                $jumlahMenunggu = App\Models\Konsultasi::where('status', 'menunggu')->count();
                            @endphp
                            @if ($jumlahMenunggu > 0)
                                <span class="badge bg-warning text-dark ms-2 rounded-pill">{{ $jumlahMenunggu }}</span>
                            @endif
                        </a>
                        <hr style="border-color: rgba(255,255,255,0.2); margin: 1rem 1.5rem;">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </nav>
                </div>
            @endif
        @endauth

        <div class="main-content">
            @auth
                @if (Auth::user()->role == 'pakar')
                    <div class="topbar">
                        <div class="topbar-left">
                            <h1 class="topbar-title">
                                @yield('page-title', 'Sistem Pakar')
                            </h1>
                        </div>
                        <div class="topbar-right">
                            <div class="user-info">
                                <div class="user-avatar">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-weight: 600; color: #374151;">{{ Auth::user()->name }}</div>
                                    <div style="font-size: 0.8rem; color: #9ca3af;">Pakar</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth

            <div class="content">
                @yield('content')
            </div>

            <footer>
                <div class="container-fluid">
                    Sistem Pakar Diagnosa Penyebab Kulit Wajah &copy; 2025
                </div>
            </footer>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Mobile Menu Toggle -->
    <script>
        // Toggle sidebar on mobile
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('show');
        }

        // Auto-hide sidebar on mobile when clicking outside
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const isClickInsideSidebar = sidebar && sidebar.contains(event.target);
            const isClickOnToggle = event.target.closest('.sidebar-toggle');

            if (!isClickInsideSidebar && !isClickOnToggle && window.innerWidth <= 768) {
                sidebar?.classList.remove('show');
            }
        });

        // Update active navigation based on current page
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.sidebar-nav a');

            navLinks.forEach(link => {
                const href = link.getAttribute('href');
                if (href && currentPath.includes(href.split('/').pop())) {
                    link.classList.add('active');
                }
            });
        });
    </script>

    @yield('scripts')

</body>

</html>
