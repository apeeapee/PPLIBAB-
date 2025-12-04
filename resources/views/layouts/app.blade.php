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

        .user-badge{
            display:flex;align-items:center;gap:8px;
            padding:8px 16px;background:rgba(249,115,22,0.1);
            border:1px solid rgba(249,115,22,0.3);
            border-radius:50px;font-size:14px;
            font-weight:500;color:var(--text-main);
        }

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
            <div class="user-badge">
                <i class="uil uil-user-circle"></i>
                <span>{{ auth()->user()->name }}</span>
            </div>
            
            @if(auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" class="btn-auth btn-register" style="background: linear-gradient(135deg, #f97316 0%, #fb923c 100%); border-color: #f97316; color: white;">
                    <i class="uil uil-shield-check"></i> Dashboard Admin
                </a>
            @elseif(auth()->user()->seller)
                <a href="{{ route('seller.dashboard') }}" class="btn-auth btn-register" style="background: #3b82f6; border-color: #3b82f6; color: white; font-weight: 600; display: inline-flex;">
                    <i class="uil uil-store"></i> Dashboard Seller
                </a>
            @endif
            
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
            
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="uil uil-sign-out-alt"></i> Logout
                </button>
            </form>
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
</script>

</body>
</html>
