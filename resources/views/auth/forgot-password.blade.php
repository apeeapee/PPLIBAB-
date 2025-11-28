@php($title = 'Forgot Password | kampuStore')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    <style>
        *{margin:0;padding:0;box-sizing:border-box}

        /* ===================== THEME VARIABLES (SAMA PERSIS LOGIN) ===================== */
        :root{
          --bg-body:#050b1f;
          --text-main:#e5e7eb;

          --nav-bg:linear-gradient(90deg,#020617,#020617);
          --nav-border-bottom:rgba(30,64,175,0.5);
          --nav-shadow:0 14px 40px rgba(15,23,42,0.9);
          --nav-link-color:#e5e7eb;

          --market-bg:radial-gradient(circle at top left,#1f3b8a 0,#020617 52%,#020617 100%);

          --sidebar-bg:rgba(15,23,42,0.96);
          --sidebar-border:rgba(59,130,246,0.65);
          --sidebar-scroll-thumb:#4b5563;
          
          --sidebar-divider:rgba(55,65,81,0.85);
          --sidebar-select-bg:#020617;
          --sidebar-select-border:#3b82f6;
          --sidebar-text:#e5e7eb;

          --search-bg:#020617;
          --search-border:#1d4ed8;
          --search-text:#e5e7eb;
          --search-placeholder:#9ca3af;

          --icon-border:rgba(59,130,246,0.7);
          --icon-bg:rgba(15,23,42,0.9);
          --icon-color:#e5e7eb;

          --page-title-color:#f9fafb;
          --breadcrumb-color:#9ca3af;

          --reset-btn-bg:#020617;
          --reset-btn-border:#1f2937;

          --toast-bg:#020617;
        }

        body.theme-light{
          --bg-body:#eef2ff;
          --text-main:#1a2550;

          --nav-bg:#ffffff;
          --nav-border-bottom:#d9ddf0;
          --nav-shadow:0 4px 12px rgba(20,30,60,0.08);
          --nav-link-color:#1a2450;

          --market-bg:linear-gradient(
              135deg,
              #ffffff 0%,
              #e3e8ff 40%,
              #d5ddff 100%
          );

          --sidebar-bg:#ffffff;
          --sidebar-border:#cfd6f5;
          --sidebar-scroll-thumb:#97a3d5;
          --sidebar-divider:#d6dcfa;

          --sidebar-select-bg:#f2f4ff;
          --sidebar-select-border:#b9c4ef;
          --sidebar-text:#1f2b60;

          --search-bg:#ffffff;
          --search-border:#c4ccf2;
          --search-text:#1a1f3f;
          --search-placeholder:#9aa6d6;

          --icon-border:#c4ccf2;
          --icon-bg:#ffffff;
          --icon-color:#1b234a;

          --page-title-color:#1a2450;
          --breadcrumb-color:#6b76a5;

          --reset-btn-bg:#e3e6ff;
          --reset-btn-border:#c5cdf5;

          --toast-bg:#1b2652;
        }

        /* ===================== GLOBAL BODY ===================== */
        body{
            font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Arial,sans-serif;
            background:var(--bg-body);
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
        .nav-left{
            display:flex;
            align-items:center;
            gap:28px;
        }
        .nav-logo{
            display:flex;
            align-items:center;
            font-weight:700;
            font-size:22px;
            letter-spacing:0.04em;
            color:#f9fafb;
            cursor:pointer;
        }
        .nav-logo img{
            height:40px;
            display:block;
        }
        body.theme-light .nav-logo{color:#111827;}
        .nav-logo:hover{opacity:.85;}

        .nav-menu{
            display:flex;
            align-items:center;
            gap:28px;
            font-size:14px;
        }
        .nav-menu a{
            color:var(--nav-link-color);
            position:relative;
        }
        .nav-menu a::after{
            content:'';
            position:absolute;
            left:0;
            bottom:-4px;
            height:2px;
            width:100%;
            background:#f97316;
            border-radius:999px;
            transform:scaleX(0);
            transform-origin:left;
            opacity:0;
            transition:transform .25s ease-out, opacity .2s ease-out;
        }
        .nav-menu a:hover{
            color:#f97316;
        }
        .nav-menu a:hover::after{
            transform:scaleX(1);
            opacity:1;
        }

        .nav-actions{
            display:flex;
            align-items:center;
            gap:12px;
        }

        /* ===================== THEME TOGGLE ===================== */
        .theme-toggle-wrapper{
            display:flex;
            justify-content:center;
            align-items:center;
        }
        .toggle-switch{
            position:relative;
            display:inline-block;
            width:74px;
            height:36px;
            transform:scale(.95);
            transition:transform .2s;
        }
        .toggle-switch:hover{transform:scale(1);}
        .toggle-switch input{
            opacity:0;
            width:0;
            height:0;
        }
        .slider{
            position:absolute;
            cursor:pointer;
            inset:0;
            background:linear-gradient(145deg,#fbbf24,#f97316);
            transition:.4s;
            border-radius:34px;
            box-shadow:0 0 12px rgba(249,115,22,0.5);
            overflow:hidden;
        }
        .slider:before{
            position:absolute;
            content:"☀️";
            height:28px;
            width:28px;
            left:4px;
            bottom:4px;
            background:white;
            transition:.4s;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:16px;
            box-shadow:0 0 10px rgba(0,0,0,.15);
            z-index:2;
        }
        .clouds{
            position:absolute;
            width:100%;
            height:100%;
            overflow:hidden;
            pointer-events:none;
        }
        .cloud{
            position:absolute;
            width:24px;
            height:24px;
            fill:rgba(255,255,255,0.9);
            filter:drop-shadow(0 2px 3px rgba(0,0,0,0.08));
        }
        .cloud1{
            top:6px;
            left:10px;
            animation:floatCloud1 8s infinite linear;
        }
        .cloud2{
            top:10px;
            left:38px;
            transform:scale(.85);
            animation:floatCloud2 12s infinite linear;
        }
        @keyframes floatCloud1{
            0%{transform:translateX(-20px);opacity:0;}
            20%{opacity:1;}
            80%{opacity:1;}
            100%{transform:translateX(80px);opacity:0;}
        }
        @keyframes floatCloud2{
            0%{transform:translateX(-20px) scale(.85);opacity:0;}
            20%{opacity:.7;}
            80%{opacity:.7;}
            100%{transform:translateX(80px) scale(.85);opacity:0;}
        }
        input.js-theme-toggle:checked + .slider{
            background:linear-gradient(145deg,#1f2937,#020617);
            box-shadow:0 0 14px rgba(15,23,42,0.8);
        }
        input.js-theme-toggle:checked + .slider:before{
            transform:translateX(38px);
            content:"🌙";
        }
        input.js-theme-toggle:checked + .slider .cloud{
            opacity:0;
            transform:translateY(-18px);
        }

        /* ===================== AUTH BACKGROUND ===================== */
        .auth-bg{
            min-height:100vh;
            padding:120px 40px 60px;
            display:flex;
            align-items:center;
            justify-content:center;
            background:var(--market-bg);
            position:relative;
            overflow:hidden;
        }
        .auth-bg::before,
        .auth-bg::after{
            content:'';
            position:absolute;
            border-radius:999px;
            filter:blur(26px);
            opacity:.55;
        }
        .auth-bg::before{
            width:360px;height:360px;
            background:linear-gradient(135deg,#6366f1,#f97316);
            top:-130px;left:-80px;
        }
        .auth-bg::after{
            width:320px;height:320px;
            background:linear-gradient(135deg,#0ea5e9,#22c55e);
            bottom:-150px;right:-70px;
        }
        body.theme-light .auth-bg::before,
        body.theme-light .auth-bg::after{
            opacity:.2;
        }

        /* ===================== SHELL (FRAME LUAR) ===================== */
        .auth-shell{
            width:100%;
            max-width:1100px;
            min-height:520px;
            border-radius:28px;
            overflow:hidden;
            background:linear-gradient(
                135deg,
                rgba(15,23,42,0.74),
                rgba(15,23,42,0.94)
            );
            border:1px solid rgba(59,130,246,0.45);
            box-shadow:0 22px 60px rgba(0,0,0,.9);
            display:flex;
            position:relative;
            z-index:1;
            backdrop-filter:blur(18px);
        }
        body.theme-light .auth-shell{
            background:linear-gradient(
                135deg,
                rgba(255,255,255,0.88),
                rgba(239,246,255,0.98)
            );
            border:1px solid rgba(148,163,184,0.6);
            box-shadow:0 20px 50px rgba(148,163,184,0.65);
        }

        .auth-panel,
        .auth-visual{
            transition:
                transform .6s cubic-bezier(0.25,0.8,0.25,1),
                opacity   .6s cubic-bezier(0.25,0.8,0.25,1);
        }
        .auth-shell.pre-enter .auth-panel{
            transform:translate3d(60px,0,0);
            opacity:0;
        }
        .auth-shell.pre-enter .auth-visual{
            transform:translate3d(-60px,0,0);
            opacity:0;
        }
        .auth-shell.is-visible .auth-panel,
        .auth-shell.is-visible .auth-visual{
            transform:translate3d(0,0,0);
            opacity:1;
        }
        .auth-shell.exit .auth-panel{
            transform:translate3d(60px,0,0);
            opacity:0;
        }
        .auth-shell.exit .auth-visual{
            transform:translate3d(-60px,0,0);
            opacity:0;
        }

        /* FOTO (KIRI) + KARTU LOGO ==================================== */
        .auth-visual{
            flex: 1.15;
            background:
                radial-gradient(circle at top,#1f3f90 0,#020617 55%,#020617 100%);
            display:flex;
            justify-content:center;
            align-items:center;
            padding:32px 28px;
            position:relative;
            overflow:hidden;
        }
        body.theme-light .auth-visual{
            background:radial-gradient(circle at top,#dbeafe 0,#93c5fd 45%,#60a5fa 100%);
        }
        .auth-visual::before{
            content:'';
            position:absolute;
            inset:0;
            background:
                radial-gradient(circle at 10% 10%,rgba(96,165,250,0.18),transparent 55%),
                radial-gradient(circle at 90% 90%,rgba(248,113,22,0.18),transparent 55%);
            opacity:.8;
            pointer-events:none;
        }

        .visual-card{
            position:relative;
            width:100%;
            max-width:480px;
            padding:28px 34px;
            border-radius:26px;
            background:radial-gradient(
                circle at 40% 40%,
                rgba(255,255,255,0.97) 0,
                rgba(248,250,252,0.92) 45%,
                rgba(59,130,246,0.45) 100%
            );
            backdrop-filter:blur(26px);
            border:1px solid rgba(191,219,254,0.95);
            box-shadow:
                0 20px 50px rgba(15,23,42,0.65),
                0 0 40px rgba(96,165,250,0.4);
            display:flex;
            align-items:center;
            justify-content:center;
        }
        body.theme-light .visual-card{
            background:radial-gradient(
                circle at 40% 40%,
                rgba(255,255,255,1) 0,
                rgba(239,246,255,0.98) 55%,
                rgba(191,219,254,0.85) 100%
            );
            border:1px solid rgba(148,163,184,0.8);
            box-shadow:
                0 18px 40px rgba(148,163,184,0.65),
                0 0 30px rgba(129,140,248,0.35);
        }
        .visual-card img{
            position:relative;
            max-width:100%;
            height:auto;
            display:block;
            border-radius:20px;
            filter:
                drop-shadow(0 12px 24px rgba(15,23,42,0.35))
                brightness(1.25)
                contrast(1.12);
        }

        /* ===================== FORM (KANAN) – GLASS BLUE ===================== */
        .auth-panel{
            flex:1.05;
            padding:34px 46px 34px;
            display:flex;
            flex-direction:column;
            color:#f9fafb;
            background:linear-gradient(
                145deg,
                rgba(23,37,84,0.78),
                rgba(15,23,42,0.94),
                rgba(30,64,175,0.86)
            );
            border-left:1px solid rgba(148,163,184,0.6);
            backdrop-filter:blur(26px);
            box-shadow:
                inset 0 0 0 1px rgba(30,64,175,0.45),
                0 18px 45px rgba(0,0,0,0.9),
                0 0 35px rgba(37,99,235,0.35);
        }
        body.theme-light .auth-panel{
            background:linear-gradient(
                145deg,
                rgba(255,255,255,0.9),
                rgba(239,246,255,0.99)
            );
            color:#111827;
            border-left:1px solid rgba(191,219,254,0.9);
            box-shadow:
                inset 0 0 0 1px rgba(255,255,255,0.7),
                0 18px 40px rgba(148,163,184,0.7);
        }
        .auth-panel-inner{
            max-width:380px;
            margin:auto 0;
        }
        .auth-eyebrow{
            font-size:12px;
            letter-spacing:.18em;
            text-transform:uppercase;
            color:#9ca3af;
            margin-bottom:4px;
        }
        body.theme-light .auth-eyebrow{color:#6b7280;}
        .auth-title{
            font-size:28px;
            font-weight:800;
            margin-bottom:6px;
            color:var(--page-title-color);
        }
        .auth-subtitle{
            font-size:13px;
            color:#9ca3af;
            margin-bottom:20px;
        }
        body.theme-light .auth-subtitle{color:#6b7280;}

        .field-group{margin-bottom:18px;width:100%;}

        /* FLOATING INPUT */
        .group{position:relative;}
        .group .auth-input{
            font-size:14px;
            padding:10px 10px 10px 5px;
            display:block;
            width:100%;
            border:none;
            border-bottom:1px solid rgba(148,163,184,0.7);
            border-radius:0;
            background:transparent;
            color:#f9fafb;
        }
        body.theme-light .group .auth-input{
            color:#111827;
            border-bottom-color:#9ca3af;
        }
        .group .auth-input:focus{outline:none;}

        .group label{
            color:#9ca3af;
            font-size:13px;
            font-weight:500;
            position:absolute;
            pointer-events:none;
            left:5px;
            top:10px;
            transition:.2s ease all;
        }
        body.theme-light .group label{color:#6b7280;}

        .group .auth-input:focus ~ label,
        .group .auth-input:not(:placeholder-shown) ~ label{
            top:-12px;
            font-size:11px;
            color:#f97316;
        }

        .group .bar{
            position:relative;
            display:block;
            width:100%;
            height:2px;
        }
        .group .bar:before,
        .group .bar:after{
            content:'';
            height:2px;
            width:0;
            bottom:0;
            position:absolute;
            background:#f97316;
            transition:.2s ease all;
        }
        .group .bar:before{left:50%;}
        .group .bar:after{right:50%;}
        .group .auth-input:focus ~ .bar:before,
        .group .auth-input:focus ~ .bar:after{
            width:50%;
        }
        .group .highlight{
            position:absolute;
            height:60%;
            width:100px;
            top:25%;
            left:0;
            pointer-events:none;
            opacity:.5;
        }
        .group .auth-input:focus ~ .highlight{
            animation:inputHighlighter .3s ease;
        }
        @keyframes inputHighlighter{
            from{background:#f97316;}
            to{width:0;background:transparent;}
        }

        .auth-error{
            font-size:12px;
            color:#fecaca;
            margin-top:4px;
        }

        .auth-bottom-text{
            margin-top:18px;
            font-size:13px;
            text-align:center;
            color:var(--text-main);
        }
        .auth-bottom-text a{
            color:#f97316;
            font-weight:600;
        }

        /* BUTTON */
        .auth-btn-primary{
            width:100%;
            border:none;
            border-radius:999px;
            padding:11px 18px;
            font-size:14px;
            font-weight:700;
            cursor:pointer;
            background:#f97316;
            color:#111827;
            margin-top:4px;
            transition:background .2s ease, transform .15s ease, box-shadow .15s ease;
            box-shadow:0 12px 25px rgba(248,113,22,.45);
        }
        .auth-btn-primary:hover{
            background:#fb923c;
            transform:translateY(-1px);
        }
        .auth-btn-primary:active{
            transform:translateY(0);
            box-shadow:0 6px 16px rgba(248,113,22,.5);
        }

        @media(max-width:900px){
            .nav{padding:14px 20px;}
            .auth-bg{padding:110px 18px 40px;}
            .auth-shell{
                max-width:520px;
                flex-direction:column;
                border-radius:24px;
            }
            .auth-panel{padding:26px 22px 24px;}
            .auth-panel-inner{max-width:100%;}
            .auth-visual{padding:12px 16px 18px;}
            .visual-card{max-width:100%;}
            .visual-card img{border-radius:20px;}
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
            <a href="{{ route('home') }}#about">About</a>
            <a href="{{ route('products.index') }}">Market</a>
            <a href="{{ route('home') }}#contact">Contact</a>
        </div>
    </div>
    <div class="nav-actions">
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

<main class="auth-bg">
    <div class="auth-shell pre-enter">

        {{-- CARD LOGO KIRI --}}
        <div class="auth-visual">
            <div class="visual-card">
                <img src="{{ asset('images/pc.png') }}" alt="kampuStore hero">
            </div>
        </div>

        {{-- FORM FORGOT PASSWORD KANAN --}}
        <div class="auth-panel">
            <div class="auth-panel-inner">
                <div class="auth-eyebrow">RESET PASSWORD</div>
                <h1 class="auth-title">Forgot Password</h1>
                <p class="auth-subtitle">
                    Masukkan email kampus UNDIP yang terdaftar, kami akan mengirimkan tautan untuk mengatur ulang password.
                </p>

                @if (session('status'))
                    <div class="auth-error" style="color:#bbf7d0;">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="field-group group">
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="auth-input"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            placeholder=" "
                        >
                        <span class="highlight"></span>
                        <span class="bar"></span>
                        <label for="email">Email Address</label>
                        @error('email')
                            <div class="auth-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="auth-btn-primary">
                        Send Reset Link
                    </button>
                </form>

                <div class="auth-bottom-text">
                    Remember your password?
                    <a href="{{ route('login') }}" id="goLogin">Back to Login</a>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // THEME TOGGLE – sinkron dengan halaman lain
    (function(){
        const KEY = 'kampuStoreTheme';
        const body = document.body;
        const toggle = document.querySelector('.js-theme-toggle');

        function apply(mode){
            if(mode === 'light'){
                body.classList.add('theme-light');
            }else{
                body.classList.remove('theme-light');
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

    // animasi card masuk + keluar ke login
    document.addEventListener('DOMContentLoaded', function () {
        const shell   = document.querySelector('.auth-shell');
        const goLogin = document.getElementById('goLogin');

        if(shell){
            requestAnimationFrame(() => {
                shell.classList.remove('pre-enter');
                shell.classList.add('is-visible');
            });
        }

        if(shell && goLogin){
            goLogin.addEventListener('click', function(e){
                e.preventDefault();
                shell.classList.remove('is-visible');
                shell.classList.add('exit');
                setTimeout(() => {
                    window.location.href = goLogin.href;
                }, 600);
            });
        }
    });
</script>

</body>
</html>
