<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - {{ auth()->user()->seller->nama_toko ?? 'Seller' }} | kampuStore</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        :root {
            --bg-main: radial-gradient(circle at top left,#1f3b8a 0,#020617 52%,#020617 100%);
            --nav-bg: rgba(2,6,23,0.95);
            --card-bg: rgba(15,23,42,0.96);
            --card-border: rgba(148,163,184,0.2);
            --text-main: #f9fafb;
            --text-muted: #9ca3af;
            --sidebar-bg: rgba(15,23,42,0.96);
            --sidebar-border: rgba(148,163,184,0.2);
            --accent: #f97316;
            --accent-hover: #fb923c;
        }
        body.theme-light {
            --bg-main: linear-gradient(135deg, #ffffff 0%, #e3e8ff 40%, #d5ddff 100%);
            --nav-bg: rgba(255,255,255,0.95);
            --card-bg: rgba(255,255,255,0.96);
            --card-border: #e5e7eb;
            --text-main: #111827;
            --text-muted: #6b7280;
            --sidebar-bg: rgba(255,255,255,0.96);
            --sidebar-border: #e5e7eb;
        }
        * { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Arial, sans-serif; box-sizing: border-box; }
        body { margin:0; background: var(--bg-main); min-height:100vh; color: var(--text-main); }

        /* NAV */
        .nav {
            position:fixed;top:0;left:0;right:0;z-index:100;
            background:var(--nav-bg);backdrop-filter:blur(20px);
            border-bottom:1px solid rgba(59,130,246,0.3);
            padding:12px 48px;
        }
        .nav-container {
            display:flex;
            align-items:center;
            justify-content:space-between;
            min-height:64px;
            max-width:1600px;
            margin:0 auto;
            gap:32px;
        }
        .nav-left { display:flex;align-items:center;gap:32px;flex:1; }
        .nav-logo { display:flex;align-items:center;gap:12px;text-decoration:none;transition:all .3s; }
        .nav-logo:hover { transform:scale(1.05); }
        .nav-logo-icon { width:40px;height:40px;background:linear-gradient(135deg,#3b82f6,#60a5fa);border-radius:8px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(59,130,246,0.3); }
        .nav-logo-icon i { color:white;font-size:20px; }
        .nav-logo img { height:36px;width:36px; }
        .nav-logo-text { font-size:20px;font-weight:700;background:linear-gradient(135deg,#3b82f6,#60a5fa);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text; }

        .nav-menu { display:flex;gap:4px;align-items:center;flex:1; }
        .nav-item { position:relative; }
        .nav-link {
            display:inline-flex;align-items:center;gap:6px;color:var(--text-muted);font-size:14px;font-weight:500;
            text-decoration:none;transition:all .2s;padding:8px 14px;border-radius:8px;white-space:nowrap;
        }
        .nav-link:hover, .nav-link.active { color:var(--accent);background:rgba(249,115,22,0.1); }
        .nav-link i { font-size:16px; }

        .nav-right { display:flex;align-items:center;gap:16px; }
        .dropdown { position:relative; }
        .dropdown-toggle::after { content:'▾';margin-left:4px;font-size:12px; }
        .dropdown-menu {
            position:absolute;top:100%;left:0;margin-top:8px;
            background:var(--card-bg);border:1px solid var(--card-border);
            border-radius:12px;padding:8px;min-width:200px;
            box-shadow:0 10px 40px rgba(0,0,0,0.3);
            opacity:0;visibility:hidden;transform:translateY(-10px);
            transition:all .2s;
        }
        .dropdown:hover .dropdown-menu { opacity:1;visibility:visible;transform:translateY(0); }
        .dropdown-item {
            display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:8px;
            color:var(--text-main);text-decoration:none;font-size:13px;transition:all .2s;
        }
        .dropdown-item:hover { background:rgba(249,115,22,0.1);color:var(--accent); }
        .dropdown-item i { font-size:16px;width:20px;text-align:center; }

        .shop-badge {
            display:flex;
            flex-direction:column;
            align-items:flex-end;
            gap:2px;
            padding:6px 12px;
            border-radius:8px;
            background:rgba(249,115,22,0.05);
            border:1px solid rgba(249,115,22,0.1);
            min-width:140px;
        }
        .shop-badge-name {
            font-size:13px;
            font-weight:600;
            color:var(--text-main);
            text-align:right;
            line-height:1.2;
        }
        .shop-badge-status {
            display:inline-flex;
            align-items:center;
            gap:4px;
            font-size:10px;
            font-weight:500;
            padding:2px 8px;
            border-radius:50px;
            line-height:1;
        }
        .shop-badge-status.approved {
            background:rgba(34,197,94,0.15);
            color:#22c55e;
            border:1px solid rgba(34,197,94,0.2);
        }
        .shop-badge-status.pending {
            background:rgba(234,179,8,0.15);
            color:#eab308;
            border:1px solid rgba(234,179,8,0.2);
        }
        .shop-badge-status.rejected {
            background:rgba(239,68,68,0.15);
            color:#ef4444;
            border:1px solid rgba(239,68,68,0.2);
        }
        .shop-badge-status i {
            font-size:10px;
        }
        .nav-actions { display:flex;align-items:center;gap:16px; }

        /* Logout Button */
        .btn-logout {
            display:flex;align-items:center;gap:6px;
            padding:8px 16px;border-radius:8px;
            background:rgba(239,68,68,0.1);color:#ef4444;
            font-size:14px;font-weight:500;cursor:pointer;
            transition:all .2s;border:1px solid rgba(239,68,68,0.3);
        }
        .btn-logout:hover {
            background:rgba(239,68,68,0.2);
            border-color:rgba(239,68,68,0.5);
        }

        /* Toggle */
        .theme-toggle-wrapper{display:flex;justify-content:center;align-items:center;}
        .toggle-switch{position:relative;display:inline-block;width:74px;height:36px;transform:scale(.95);transition:transform .2s;}
        .toggle-switch:hover{transform:scale(1);}
        .toggle-switch input{opacity:0;width:0;height:0;}
        .slider{position:absolute;cursor:pointer;inset:0;background:linear-gradient(145deg,#fbbf24,#f97316);transition:.4s;border-radius:34px;box-shadow:0 0 12px rgba(249,115,22,0.5);overflow:hidden;}
        .slider:before{position:absolute;content:"☀";height:28px;width:28px;left:4px;bottom:4px;background:white;transition:.4s;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:16px;box-shadow:0 0 10px rgba(0,0,0,.15);z-index:2;}
        .clouds{position:absolute;width:100%;height:100%;overflow:hidden;pointer-events:none;}
        .cloud{position:absolute;width:24px;height:24px;fill:rgba(255,255,255,0.9);filter:drop-shadow(0 2px 3px rgba(0,0,0,0.08));}
        .cloud1{top:6px;left:10px;animation:floatCloud1 8s infinite linear;}
        .cloud2{top:10px;left:38px;transform:scale(.85);animation:floatCloud2 12s infinite linear;}
        @keyframes floatCloud1{0%{transform:translateX(-20px);opacity:0;}20%{opacity:1;}80%{opacity:1;}100%{transform:translateX(80px);opacity:0;}}
        @keyframes floatCloud2{0%{transform:translateX(-20px) scale(.85);opacity:0;}20%{opacity:.7;}80%{opacity:.7;}100%{transform:translateX(80px) scale(.85);opacity:0;}}
        input.js-theme-toggle:checked + .slider{background:linear-gradient(145deg,#1f2937,#020617);box-shadow:0 0 14px rgba(15,23,42,0.8);}
        input.js-theme-toggle:checked + .slider:before{transform:translateX(38px);content:"🌙";}
        input.js-theme-toggle:checked + .slider .cloud{opacity:0;transform:translateY(-18px);}

        .btn-market {
            background:rgba(59,130,246,0.2);color:#60a5fa;cursor:pointer;
            padding:8px 16px;border-radius:50px;font-size:13px;font-weight:600;transition:all .3s;
            display:flex;align-items:center;gap:6px;text-decoration:none;
            border:1px solid rgba(96,165,250,0.5);
        }
        body.theme-light .btn-market {
            background:#eff6ff;color:#1d4ed8;border-color:#3b82f6;
        }
        .btn-market:hover{background:#3b82f6;color:white;transform:translateY(-2px);box-shadow:0 4px 12px rgba(59,130,246,0.4);border-color:#3b82f6;}
        
        /* ===================== USER DROPDOWN ===================== */
        .user-dropdown{position:relative;}
        .user-dropdown-toggle{
            display:flex;align-items:center;gap:10px;
            padding:8px 16px;border-radius:50px;cursor:pointer;
            background:rgba(59,130,246,0.1);
            border:1px solid rgba(59,130,246,0.3);
            transition:all .2s;
        }
        .user-dropdown-toggle:hover{background:rgba(59,130,246,0.2);}
        .user-avatar{
            width:32px;height:32px;border-radius:50%;
            background:linear-gradient(135deg,#3b82f6,#60a5fa);
            display:flex;align-items:center;justify-content:center;
            color:white;font-weight:700;font-size:14px;
        }
        .user-info{display:flex;flex-direction:column;align-items:flex-start;}
        .user-name{font-size:13px;font-weight:600;color:var(--text-main);}
        .user-role{font-size:11px;color:#3b82f6;}
        .dropdown-arrow{font-size:12px;color:var(--text-muted);transition:transform .2s;}
        .user-dropdown.open .dropdown-arrow{transform:rotate(180deg);}
        .user-dropdown-menu{
            position:absolute;top:calc(100% + 8px);right:0;
            min-width:220px;padding:8px;
            background:var(--card-bg);border:1px solid var(--card-border);
            border-radius:12px;box-shadow:0 10px 40px rgba(0,0,0,0.3);
            opacity:0;visibility:hidden;transform:translateY(-10px);
            transition:all .2s;z-index:100;
        }
        .user-dropdown.open .user-dropdown-menu{
            opacity:1;visibility:visible;transform:translateY(0);
        }
        .dropdown-header{
            padding:12px;margin-bottom:8px;
            border-bottom:1px solid var(--card-border);
        }
        .dropdown-header-name{font-size:14px;font-weight:600;color:var(--text-main);}
        .dropdown-header-email{font-size:12px;color:var(--text-muted);margin-top:2px;}
        .user-dropdown .dropdown-item{
            display:flex;align-items:center;gap:10px;
            padding:10px 12px;border-radius:8px;
            color:var(--text-main);font-size:13px;
            transition:all .2s;cursor:pointer;
        }
        .user-dropdown .dropdown-item:hover{background:rgba(59,130,246,0.1);color:#3b82f6;}
        .user-dropdown .dropdown-item i{font-size:16px;width:20px;text-align:center;}
        .dropdown-divider{height:1px;background:var(--card-border);margin:8px 0;}
        .user-dropdown .dropdown-item.logout{color:#ef4444;}
        .user-dropdown .dropdown-item.logout:hover{background:rgba(239,68,68,0.1);color:#ef4444;}

        /* LAYOUT - FULL WIDTH */
        .main-container {
            max-width:1400px;
            margin:0 auto;
            padding:100px 48px 40px;
            min-height:calc(100vh - 100px);
        }
        
        .btn-add {
            display:inline-flex;align-items:center;gap:6px;padding:8px 16px;
            background:var(--accent);color:#111827;border-radius:8px;font-size:13px;font-weight:600;
            text-decoration:none;transition:all .3s;border:none;cursor:pointer;
        }
        .btn-add:hover { background:var(--accent-hover);transform:translateY(-1px);box-shadow:0 4px 12px rgba(249,115,22,0.25); }

        /* FOOTER */
        .footer { background:var(--nav-bg);border-top:1px solid var(--card-border);padding:20px 32px;text-align:center;margin-top:auto; }
        .footer p { font-size:13px;color:var(--text-muted); }
        .footer span { color:var(--accent);font-weight:600; }

        @media(max-width:1200px) {
            .nav { padding:10px 24px; }
            .nav-left { gap:16px; }
            .nav-menu { gap:2px;flex-wrap:nowrap;overflow-x:auto; }
            .nav-link { padding:6px 10px;font-size:13px;white-space:nowrap; }
            .nav-link i { font-size:14px; }
            .shop-badge { padding:4px 12px; }
            .shop-badge-name { font-size:12px; }
        }
        @media(max-width:900px) {
            .nav { padding:10px 20px; }
            .nav-container {
                flex-direction:column;
                gap:8px;
            }
            .nav-left { width:100%;justify-content:space-between; }
            .nav-menu { order:2;width:100%;justify-content:center;flex-wrap:wrap; }
            .nav-right { width:100%;justify-content:center; }
            .shop-badge-name { display:none; }
        }
        @media(max-width:600px) {
            .nav { padding:8px 16px; }
            .nav-logo span { display:none; }
            .nav-link span { display:none; }
            .nav-link { padding:6px 8px; }
            .shop-badge-name { display:none; }
            .btn-logout span { display:none; }
            .theme-toggle-wrapper { transform: scale(0.85); }
        }
    </style>
    @stack('styles')
</head>
<body>

{{-- NAVBAR --}}
<nav class="nav">
    <div class="nav-container">
        <!-- Left: Logo & Menu -->
        <div class="nav-left">
            <a href="{{ route('seller.dashboard') }}" class="nav-logo">
                <img src="{{ asset('images/logo.png') }}" alt="kampuStore logo">
                <span class="nav-logo-text">kampuStore</span>
            </a>

            <div class="nav-menu">
                <div class="nav-item">
                    <a href="{{ route('seller.dashboard') }}" class="nav-link {{ request()->routeIs('seller.dashboard') ? 'active' : '' }}">
                        <i class="uil uil-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('seller.products.index') }}" class="nav-link {{ request()->routeIs('seller.products*') ? 'active' : '' }}">
                        <i class="uil uil-box"></i>
                        <span>Produk</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('seller.reports.index') }}" class="nav-link {{ request()->routeIs('seller.reports*') ? 'active' : '' }}">
                        <i class="uil uil-chart-bar"></i>
                        <span>Laporan</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('seller.notifications.index') }}" class="nav-link {{ request()->routeIs('seller.notifications*') ? 'active' : '' }}">
                        <i class="uil uil-bell"></i>
                        <span>Notifikasi</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="uil uil-home"></i>
                        <span>Beranda</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Right: Actions -->
        <div class="nav-right">
            <!-- Shop Status -->
            <div class="shop-badge">
                <div class="shop-badge-name">{{ auth()->user()->seller->nama_toko ?? 'Seller' }}</div>
                <div class="shop-badge-status {{ auth()->user()->seller->status }}">
                    @if(auth()->user()->seller->status === 'approved')
                        <i class="uil uil-check-circle"></i> Terverifikasi
                    @elseif(auth()->user()->seller->status === 'rejected')
                        <i class="uil uil-times-circle"></i> Ditolak
                    @else
                        <i class="uil uil-clock"></i> Menunggu
                    @endif
                </div>
            </div>

            <!-- Theme Toggle -->
            <div class="theme-toggle-wrapper">
                <label class="toggle-switch">
                    <input type="checkbox" class="js-theme-toggle" />
                    <span class="slider">
                        <div class="clouds">
                            <svg viewBox="0 0 100 100" class="cloud cloud1"><path d="M30,45 Q35,25 50,25 Q65,25 70,45 Q80,45 85,50 Q90,55 85,60 Q80,65 75,60 Q65,60 60,65 Q55,70 50,65 Q45,70 40,65 Q35,60 25,60 Q20,65 15,60 Q10,55 15,50 Q20,45 30,45"></path></svg>
                            <svg viewBox="0 0 100 100" class="cloud cloud2"><path d="M30,45 Q35,25 50,25 Q65,25 70,45 Q80,45 85,50 Q90,55 85,60 Q80,65 75,60 Q65,60 60,65 Q55,70 50,65 Q45,70 40,65 Q35,60 25,60 Q20,65 15,60 Q10,55 15,50 Q20,45 30,45"></path></svg>
                        </div>
                    </span>
                </label>
            </div>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="uil uil-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="main-container">
    @yield('content')
</div>

<script>
    // Theme Toggle - Apply immediately on load
    (function() {
        const savedTheme = localStorage.getItem('kampuStoreTheme') || 'dark';
        document.body.classList.add('theme-' + savedTheme);
    })();
    
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.querySelector('.js-theme-toggle');
        const body = document.body;
        
        // Set initial toggle state
        const savedTheme = localStorage.getItem('kampuStoreTheme') || 'dark';
        toggle.checked = savedTheme === 'dark';
        
        toggle.addEventListener('change', function() {
            const theme = this.checked ? 'dark' : 'light';
            body.classList.remove('theme-dark', 'theme-light');
            body.classList.add('theme-' + theme);
            localStorage.setItem('kampuStoreTheme', theme);
        });
    });

    </script>

@stack('scripts')

</body>
</html>
