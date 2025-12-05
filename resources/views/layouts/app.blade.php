<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'kampuStore' }}</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    
    <style>
        *{margin:0;padding:0;box-sizing:border-box}

        /* ===================== THEME VARIABLES ===================== */
        :root{
          --bg-body:#050b1f;
          --text-main:#e5e7eb;

          --nav-bg:linear-gradient(90deg,#020617,#020617);
          --nav-border-bottom:rgba(30,64,175,0.5);
          --nav-shadow:0 14px 40px rgba(15,23,42,0.9);
          --nav-link-color:#e5e7eb;

          --market-bg:radial-gradient(circle at top left,#1f3b8a 0,#020617 52%,#020617 100%);

          --card-bg:rgba(15,23,42,0.96);
          --card-border:#1f2937;
          --card-border-hover:#3b82f6;

          --page-title-color:#f9fafb;
          --section-text:#cbd5f5;

          --footer-bg:#020617;
          --footer-text:#9ca3af;
          --footer-border:#1f2937;
        }

        body.theme-light{
          --bg-body:#eef2ff;
          --text-main:#1a2550;

          --nav-bg:#ffffff;
          --nav-border-bottom:#d9ddf0;
          --nav-shadow:0 4px 12px rgba(20,30,60,0.08);
          --nav-link-color:#1a2450;

          --market-bg:linear-gradient(135deg,#ffffff 0%,#e3e8ff 40%,#d5ddff 100%);

          --card-bg:#ffffff;
          --card-border:#e5e7eb;
          --card-border-hover:#667eea;

          --page-title-color:#1a2450;
          --section-text:#4b5563;

          --footer-bg:#111827;
          --footer-text:#9ca3af;
          --footer-border:#1f2937;
        }

        body{
            font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Arial,sans-serif;
            background:var(--market-bg);
            color:var(--text-main);
            min-height:100vh;
        }

        a{text-decoration:none;color:inherit;}

        /* ===================== NAVBAR ===================== */
        .nav{
            position:fixed;
            top:0;left:0;right:0;
            z-index:50;
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:18px 60px;
            background:var(--nav-bg);
            border-bottom:1px solid var(--nav-border-bottom);
            box-shadow:var(--nav-shadow);
        }
        .nav-left{display:flex;align-items:center;gap:28px;}
        .nav-logo{
            display:flex;align-items:center;
            font-weight:700;font-size:22px;
            letter-spacing:0.04em;color:#f9fafb;
            cursor:pointer;
        }
        .nav-logo img{height:40px;display:block;}
        body.theme-light .nav-logo{color:#111827;}

        .nav-menu{display:flex;align-items:center;gap:28px;font-size:14px;}
        .nav-menu a{color:var(--nav-link-color);position:relative;}
        .nav-menu a::after{
            content:'';position:absolute;left:0;bottom:-4px;
            height:2px;width:100%;background:#f97316;
            border-radius:999px;transform:scaleX(0);
            transform-origin:left;opacity:0;
            transition:transform .25s ease-out, opacity .2s ease-out;
        }
        .nav-menu a:hover{color:#f97316;}
        .nav-menu a:hover::after{transform:scaleX(1);opacity:1;}

        .nav-actions{display:flex;align-items:center;gap:12px;}

        /* ===================== THEME TOGGLE ===================== */
        .theme-toggle-wrapper{display:flex;justify-content:center;align-items:center;}
        .toggle-switch{
            position:relative;display:inline-block;
            width:74px;height:36px;
            transform:scale(.95);transition:transform .2s;
        }
        .toggle-switch:hover{transform:scale(1);}
        .toggle-switch input{opacity:0;width:0;height:0;}
        .slider{
            position:absolute;cursor:pointer;inset:0;
            background:linear-gradient(145deg,#fbbf24,#f97316);
            transition:.4s;border-radius:34px;
            box-shadow:0 0 12px rgba(249,115,22,0.5);
            overflow:hidden;
        }
        .slider:before{
            position:absolute;content:"☀";
            height:28px;width:28px;left:4px;bottom:4px;
            background:white;transition:.4s;border-radius:50%;
            display:flex;align-items:center;justify-content:center;
            font-size:16px;box-shadow:0 0 10px rgba(0,0,0,.15);z-index:2;
        }
        .clouds{position:absolute;width:100%;height:100%;overflow:hidden;pointer-events:none;}
        .cloud{position:absolute;width:24px;height:24px;fill:rgba(255,255,255,0.9);filter:drop-shadow(0 2px 3px rgba(0,0,0,0.08));}
        .cloud1{top:6px;left:10px;animation:floatCloud1 8s infinite linear;}
        .cloud2{top:10px;left:38px;transform:scale(.85);animation:floatCloud2 12s infinite linear;}
        @keyframes floatCloud1{
            0%{transform:translateX(-20px);opacity:0;}
            20%{opacity:1;}80%{opacity:1;}
            100%{transform:translateX(80px);opacity:0;}
        }
        @keyframes floatCloud2{
            0%{transform:translateX(-20px) scale(.85);opacity:0;}
            20%{opacity:.7;}80%{opacity:.7;}
            100%{transform:translateX(80px) scale(.85);opacity:0;}
        }
        input.js-theme-toggle:checked + .slider{
            background:linear-gradient(145deg,#1f2937,#020617);
            box-shadow:0 0 14px rgba(15,23,42,0.8);
        }
        input.js-theme-toggle:checked + .slider:before{
            transform:translateX(38px);content:"🌙";
        }
        input.js-theme-toggle:checked + .slider .cloud{
            opacity:0;transform:translateY(-18px);
        }

        /* ===================== AUTH BUTTONS ===================== */
        .btn-auth{
            padding:10px 24px;border-radius:50px;
            font-size:14px;font-weight:600;
            display:inline-flex;align-items:center;gap:6px;
            transition:all .3s;
        }
        .btn-login{
            background:transparent;color:#f97316;
            border:2px solid #f97316;
        }
        .btn-login:hover{background:#f97316;color:#111827;}
        .btn-register{
            background:#f97316;color:#111827;
            border:2px solid #f97316;
        }
        .btn-register:hover{background:#fb923c;border-color:#fb923c;}
        .btn-logout{
            border:none;background:rgba(239,68,68,0.1);
            color:#ef4444;cursor:pointer;
            padding:8px 16px;border-radius:50px;
            font-size:13px;font-weight:600;
            transition:all .3s;
        }
        .btn-logout:hover{background:#ef4444;color:white;}
        
        .btn-logout-home{
            border:none;background:rgba(239,68,68,0.1);
            color:#ef4444;cursor:pointer;
            padding:10px 20px;border-radius:50px;
            font-size:14px;font-weight:600;
            transition:all .3s;display:inline-flex;align-items:center;gap:6px;
        }
        .btn-logout-home:hover{background:#ef4444;color:white;transform:scale(1.05);}

        .btn-dashboard{
            padding:10px 20px;border-radius:50px;
            font-size:14px;font-weight:600;
            display:inline-flex;align-items:center;gap:6px;
            transition:all .3s;text-decoration:none;
        }
        .btn-dashboard.admin{
            background:linear-gradient(135deg,#f97316,#fb923c);
            color:white;border:2px solid #f97316;
        }
        .btn-dashboard.admin:hover{transform:scale(1.05);box-shadow:0 4px 12px rgba(249,115,22,0.4);}
        .btn-dashboard.seller{
            background:linear-gradient(135deg,#3b82f6,#60a5fa);
            color:white;border:2px solid #3b82f6;
        }
        .btn-dashboard.seller:hover{transform:scale(1.05);box-shadow:0 4px 12px rgba(59,130,246,0.4);}

        /* ===================== USER DROPDOWN ===================== */
        .user-dropdown{position:relative;}
        .user-dropdown-toggle{
            display:flex;align-items:center;gap:10px;
            padding:8px 16px;border-radius:50px;cursor:pointer;
            background:rgba(249,115,22,0.1);
            border:1px solid rgba(249,115,22,0.3);
            transition:all .2s;
        }
        .user-dropdown-toggle:hover{background:rgba(249,115,22,0.2);}
        .user-avatar{
            width:32px;height:32px;border-radius:50%;
            background:linear-gradient(135deg,#f97316,#ea580c);
            display:flex;align-items:center;justify-content:center;
            color:white;font-weight:700;font-size:14px;
        }
        .user-info{display:flex;flex-direction:column;align-items:flex-start;}
        .user-name{font-size:13px;font-weight:600;color:var(--text-main);}
        .user-role{font-size:11px;color:var(--accent);}
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
        .dropdown-item{
            display:flex;align-items:center;gap:10px;
            padding:10px 12px;border-radius:8px;
            color:var(--text-main);font-size:13px;
            transition:all .2s;cursor:pointer;
        }
        .dropdown-item:hover{background:rgba(249,115,22,0.1);color:#f97316;}
        .dropdown-item i{font-size:16px;width:20px;text-align:center;}
        .dropdown-divider{height:1px;background:var(--card-border);margin:8px 0;}
        .dropdown-item.logout{color:#ef4444;}
        .dropdown-item.logout:hover{background:rgba(239,68,68,0.1);color:#ef4444;}

        /* ===================== CONTAINER ===================== */
        .container{
            max-width:1280px;
            margin:100px auto 40px;
            padding:0 24px;
        }

        /* ===================== FOOTER ===================== */
        .footer{
            background:var(--footer-bg);
            border-top:1px solid var(--footer-border);
            padding:24px 0;text-align:center;
            font-size:14px;color:var(--footer-text);
            margin-top:80px;
        }
        .footer strong{color:#f97316;font-weight:700;}

        /* ===================== RESPONSIVE ===================== */
        @media(max-width:900px){
            .nav{padding:14px 18px;}
            .nav-left{gap:18px;}
            .nav-menu{gap:18px;font-size:13px;}
        }
        @media(max-width:768px){
            .nav{flex-wrap:wrap;gap:12px;}
            .container{margin-top:140px;padding:0 16px;}
        }
    </style>
</head>
<body class="theme-dark">

<nav class="nav">
    <div class="nav-left">
        <a href="{{ route('home') }}" class="nav-logo">
            <img src="{{ asset('images/logo.png') }}" alt="kampuStore logo">
            <span>kampuStore</span>
        </a>
        <div class="nav-menu">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('home') }}#features">Features</a>
            <a href="{{ route('products.index') }}">Market</a>
            <a href="{{ route('home') }}#about">About</a>
            <a href="{{ route('home') }}#contact">Contact</a>
        </div>
    </div>

    <div class="nav-actions">
        @auth
<<<<<<< HEAD
            @php
                $hasSeller = \App\Models\Seller::where('user_id', auth()->id())->exists();
            @endphp

            <div class="user-badge">
                <i class="uil uil-user-circle"></i>
                <span>{{ auth()->user()->name }}</span>
            </div>

            @if(auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" class="btn-dashboard admin">
                    <i class="uil uil-shield-check"></i> Dashboard Admin
                </a>
            @endif

            <!-- Always show dashboard seller button for logged in users -->
            <a href="{{ route('seller.dashboard') }}" class="btn-dashboard seller" style="background:linear-gradient(135deg,#3b82f6,#60a5fa);border-color:#3b82f6;box-shadow:0 4px 12px rgba(59,130,246,0.4);">
                <i class="uil uil-store"></i> Dashboard Seller
            </a>
            
=======
>>>>>>> origin/main
            <div class="theme-toggle-wrapper">
                <label class="toggle-switch">
                    <input type="checkbox" class="js-theme-toggle" />
                    <span class="slider">
                        <div class="clouds">
                            <svg viewBox="0 0 100 100" class="cloud cloud1">
                                <path d="M30,45 Q35,25 50,25 Q65,25 70,45 Q80,45 85,50 Q90,55 85,60 Q80,65 75,60 Q65,60 60,65 Q55,70 50,65 Q45,70 40,65 Q35,60 25,60 Q20,65 15,60 Q10,55 15,50 Q20,45 30,45"></path>
                            </svg>
                            <svg viewBox="0 0 100 100" class="cloud cloud2">
                                <path d="M30,45 Q35,25 50,25 Q65,25 70,45 Q80,45 85,50 Q90,55 85,60 Q80,65 75,60 Q65,60 60,65 Q55,70 50,65 Q45,70 40,65 Q35,60 25,60 Q20,65 15,60 Q10,55 15,50 Q20,45 30,45"></path>
                            </svg>
                        </div>
                    </span>
                </label>
            </div>

            @php
                $hasSeller = \App\Models\Seller::where('user_id', auth()->id())->exists();
            @endphp

            @if(auth()->user()->is_admin)
                <div class="user-dropdown" id="userDropdown">
                    <div class="user-dropdown-toggle" onclick="toggleUserDropdown()">
                        <div class="user-avatar">
                            <i class="uil uil-shield-check"></i>
                        </div>
                        <div class="user-info">
                            <span class="user-name">{{ auth()->user()->name }}</span>
                            <span class="user-role">Administrator</span>
                        </div>
                        <i class="uil uil-angle-down dropdown-arrow"></i>
                    </div>
                    <div class="user-dropdown-menu">
                        <div class="dropdown-header">
                            <div class="dropdown-header-name">{{ auth()->user()->name }}</div>
                            <div class="dropdown-header-email">{{ auth()->user()->email }}</div>
                        </div>
                        <a href="{{ route('admin.dashboard') }}" class="dropdown-item">
                            <i class="uil uil-dashboard"></i> Dashboard
                        </a>
                        <a href="{{ route('admin.sellers.index') }}" class="dropdown-item">
                            <i class="uil uil-folder-open"></i> Pengajuan Toko
                        </a>
                        <a href="{{ route('admin.reports.index') }}" class="dropdown-item">
                            <i class="uil uil-chart-bar"></i> Laporan
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('home') }}" class="dropdown-item">
                            <i class="uil uil-home"></i> Home
                        </a>
                        <a href="{{ route('products.index') }}" class="dropdown-item">
                            <i class="uil uil-shopping-cart"></i> Market
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                            @csrf
                            <button type="submit" class="dropdown-item logout" style="width:100%;border:none;background:none;">
                                <i class="uil uil-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            @elseif($hasSeller)
                <div class="user-dropdown" id="userDropdown">
                    <div class="user-dropdown-toggle" onclick="toggleUserDropdown()" style="background:rgba(59,130,246,0.1);border-color:rgba(59,130,246,0.3);">
                        <div class="user-avatar" style="background:linear-gradient(135deg,#3b82f6,#60a5fa);">
                            <i class="uil uil-store"></i>
                        </div>
                        <div class="user-info">
                            <span class="user-name">{{ auth()->user()->name }}</span>
                            <span class="user-role" style="color:#3b82f6;">Penjual</span>
                        </div>
                        <i class="uil uil-angle-down dropdown-arrow"></i>
                    </div>
                    <div class="user-dropdown-menu">
                        <div class="dropdown-header">
                            <div class="dropdown-header-name">{{ auth()->user()->name }}</div>
                            <div class="dropdown-header-email">{{ auth()->user()->email }}</div>
                        </div>
                        <a href="{{ route('seller.dashboard') }}" class="dropdown-item">
                            <i class="uil uil-dashboard"></i> Dashboard
                        </a>
                        <a href="{{ route('seller.products.index') }}" class="dropdown-item">
                            <i class="uil uil-box"></i> Produk Saya
                        </a>
                        <a href="{{ route('seller.reports.stock') }}" class="dropdown-item">
                            <i class="uil uil-chart-bar"></i> Laporan
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('home') }}" class="dropdown-item">
                            <i class="uil uil-home"></i> Home
                        </a>
                        <a href="{{ route('products.index') }}" class="dropdown-item">
                            <i class="uil uil-shopping-cart"></i> Market
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                            @csrf
                            <button type="submit" class="dropdown-item logout" style="width:100%;border:none;background:none;">
                                <i class="uil uil-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        @else
            <a href="{{ route('login') }}" class="btn-auth btn-login">
                <i class="uil uil-shop"></i> Login
            </a>
            <a href="{{ route('register') }}" class="btn-auth btn-register">
                <i class="uil uil-store-alt"></i> Daftar Penjual
            </a>
            <div class="theme-toggle-wrapper">
                <label class="toggle-switch">
                    <input type="checkbox" class="js-theme-toggle" />
                    <span class="slider">
                        <div class="clouds">
                            <svg viewBox="0 0 100 100" class="cloud cloud1">
                                <path d="M30,45 Q35,25 50,25 Q65,25 70,45 Q80,45 85,50 Q90,55 85,60 Q80,65 75,60 Q65,60 60,65 Q55,70 50,65 Q45,70 40,65 Q35,60 25,60 Q20,65 15,60 Q10,55 15,50 Q20,45 30,45"></path>
                            </svg>
                            <svg viewBox="0 0 100 100" class="cloud cloud2">
                                <path d="M30,45 Q35,25 50,25 Q65,25 70,45 Q80,45 85,50 Q90,55 85,60 Q80,65 75,60 Q65,60 60,65 Q55,70 50,65 Q45,70 40,65 Q35,60 25,60 Q20,65 15,60 Q10,55 15,50 Q20,45 30,45"></path>
                            </svg>
                        </div>
                    </span>
                </label>
            </div>
        @endauth
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

<footer class="footer">
    &copy; {{ date('Y') }} <strong>kampuStore</strong> - Marketplace Mahasiswa UNDIP
</footer>

{{-- THEME TOGGLE JS --}}
<script>
    (function(){
        const KEY = 'kampuStoreTheme';
        const body = document.body;
        const toggle = document.querySelector('.js-theme-toggle');

        function apply(mode){
            if(mode === 'light'){
                body.classList.add('theme-light');
                body.classList.remove('theme-dark');
            }else{
                body.classList.remove('theme-light');
                body.classList.add('theme-dark');
            }
        }

        const saved = localStorage.getItem(KEY) || 'dark';
        apply(saved);

        if(toggle){
            toggle.checked = (saved !== 'light');
            toggle.addEventListener('change', () => {
                const mode = toggle.checked ? 'dark' : 'light';
                apply(mode);
                localStorage.setItem(KEY, mode);
            });
        }
    })();

    function toggleUserDropdown() {
        const dropdown = document.getElementById('userDropdown');
        if (dropdown) dropdown.classList.toggle('open');
    }

    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('userDropdown');
        if (dropdown && !dropdown.contains(e.target)) {
            dropdown.classList.remove('open');
        }
    });
</script>

</body>
</html>
