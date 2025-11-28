@php
    $title = 'kampuStore | Shopping Online';
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>

    {{-- icon unicons untuk features / footer --}}
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <style>
        *{margin:0;padding:0;box-sizing:border-box}

        /* ===================== THEME VARIABLES (DARI HOME LAMA) ===================== */
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

          /* HOME */
          --hero-bg:var(--market-bg);
          --hero-tag-bg:rgba(15,23,42,0.9);
          --hero-tag-border:rgba(129,140,248,0.8);
          --hero-title:#f9fafb;
          --hero-text:#c7d2fe;

          /* section & footer (dipakai untuk layout Features + CTA + Footer) */
          --section-bg:#020617;
          --section-title:#e5e7eb;
          --section-text:#cbd5f5;

          --card-bg:rgba(15,23,42,0.96);
          --card-border:#1f2937;
          --card-border-hover:#3b82f6;
          --card-shadow:0 20px 60px rgba(15,23,42,0.9);

          --cta-bg:radial-gradient(circle at top left,#1f3b8a 0,#020617 70%);
          --cta-subtext:#e5e7eb;

          --footer-bg:#020617;
          --footer-text:#9ca3af;
          --footer-border:#1f2937;
          --footer-heading:#e5e7eb;
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

          --hero-bg:var(--market-bg);
          --hero-tag-bg:#eef2ff;
          --hero-tag-border:#cbd5f5;
          --hero-title:#1f2937;
          --hero-text:#4b5563;

          --section-bg:#f9fafb;
          --section-title:#111827;
          --section-text:#4b5563;

          --card-bg:#ffffff;
          --card-border:#e5e7eb;
          --card-border-hover:#667eea;
          --card-shadow:0 20px 60px rgba(148,163,184,0.4);

          --cta-bg:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
          --cta-subtext:rgba(255,255,255,0.9);

          --footer-bg:#111827;
          --footer-text:#9ca3af;
          --footer-border:#1f2937;
          --footer-heading:#f9fafb;
        }

        body{
            font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Arial,sans-serif;
            background:var(--bg-body);
            color:var(--text-main);
        }

        a{text-decoration:none;color:inherit;}

        /* ==== NAVBAR (DARI HOME LAMA, LINK DIUBAH SEDIKIT) ==== */
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
        body.theme-light .nav-logo{
            color:#111827;
        }

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

        /* ===================== THEME TOGGLE (DARI HOME LAMA) ===================== */
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
            content:"☀";
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

        /* ==== HERO (PERSIS HOME LAMA) ==== */
        .hero{
            min-height:100vh;
            padding:120px 60px 80px;
            display:flex;
            gap:40px;
            align-items:center;
            justify-content:space-between;
            background:var(--hero-bg);
            position:relative;
            overflow:hidden;
        }

        .hero::before,
        .hero::after{
            content:'';
            position:absolute;
            border-radius:999px;
            filter:blur(24px);
            opacity:0.4;
        }
        .hero::before{
            width:420px;height:420px;
            background:radial-gradient(circle at 30% 0,#7c3aed 0,#0f172a 70%);
            top:-120px;left:-80px;
        }
        .hero::after{
            width:360px;height:360px;
            background:radial-gradient(circle at 70% 100%,#22c55e 0,#020617 75%);
            bottom:-160px;right:-60px;
        }
        body.theme-light .hero::before,
        body.theme-light .hero::after{opacity:0.16;}

        .hero-orb{
            position:absolute;
            border-radius:999px;
            background:radial-gradient(circle,#38bdf8 0,transparent 65%);
            opacity:.25;
            filter:blur(2px);
            pointer-events:none;
        }
        .hero-orb.orb-1{
            width:140px;height:140px;
            right:16%;top:18%;
        }
        .hero-orb.orb-2{
            width:110px;height:110px;
            right:4%;bottom:24%;
        }

        .hero-left{
            position:relative;
            z-index:1;
            max-width:480px;
        }
        .hero-tag{
            display:inline-block;
            padding:6px 16px;
            border-radius:999px;
            background:var(--hero-tag-bg);
            border:1px solid var(--hero-tag-border);
            font-size:11px;
            text-transform:uppercase;
            letter-spacing:0.12em;
            margin-bottom:10px;
        }
        .hero-title{
            font-size:34px;
            line-height:1.15;
            font-weight:800;
            margin-bottom:12px;
            color:var(--hero-title);
        }
        .hero-title span{color:#f97316;}
        .hero-text{
            font-size:15px;
            color:var(--hero-text);
            max-width:420px;
            margin-bottom:22px;
        }

        .hero-buttons{
            display:flex;
            gap:14px;
            margin-bottom:18px;
            flex-wrap:wrap;
            align-items:center;
        }

        /* === ANIMATED "SHOP NOW" BUTTON === */
        .animated-button {
            position: relative;
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 12px 30px;
            border: 4px solid transparent;
            font-size: 14px;
            background-color: transparent;
            border-radius: 100px;
            font-weight: 600;
            color: #f97316;
            box-shadow: 0 0 0 2px #f97316;
            cursor: pointer;
            overflow: hidden;
            transition: all 0.6s cubic-bezier(0.23, 1, 0.32, 1);
        }
        .animated-button svg {
            position: absolute;
            width: 20px;
            fill: #f97316;
            z-index: 9;
            transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        }
        .animated-button .arr-1 { right: 16px; }
        .animated-button .arr-2 { left: -25%; }

        .animated-button .circle {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            background-color: #f97316;
            border-radius: 50%;
            opacity: 0;
            transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .animated-button .text {
            position: relative;
            z-index: 1;
            transform: translateX(-12px);
            transition: all 0.8s cubic-bezier(0.23, 1, 0.32, 1);
        }

        .animated-button:hover {
            box-shadow: 0 0 0 12px transparent;
            color: #111827;
            border-radius: 16px;
        }
        .animated-button:hover .arr-1 { right: -25%; }
        .animated-button:hover .arr-2 { left: 16px; }
        .animated-button:hover .text { transform: translateX(12px); }
        .animated-button:hover svg { fill: #111827; }

        .animated-button:active {
            scale: 0.95;
            box-shadow: 0 0 0 4px #f97316;
        }
        .animated-button:hover .circle {
            width: 220px;
            height: 220px;
            opacity: 1;
        }

        /* === AUTH BUTTON (LOGIN & REGISTER) === */
        .btn-auth{
            position: relative;
            display:flex;
            align-items:center;
            justify-content:center;
            padding: 12px 32px;
            border: 4px solid transparent;
            background: transparent;
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
            border-radius: 100px;
            cursor: pointer;
            overflow: hidden;
            box-shadow: 0 0 0 2px #ffffff;
            transition: all .45s ease;
        }
        .btn-auth::before{
            content:"";
            position:absolute;
            inset:0;
            background:#ffffff;
            opacity:0;
            transform:scale(0.4);
            border-radius:100px;
            transition:all .45s ease;
            z-index:-1;
        }
        .btn-auth:hover::before{
            opacity:1;
            transform:scale(1);
        }
        .btn-auth:hover{
            color:#111827;
            box-shadow:0 0 0 2px #f97316, inset 0 0 25px #f97316;
        }
        body.theme-light .btn-auth{
            color:#111827;
            box-shadow:0 0 0 2px #111827;
        }
        body.theme-light .btn-auth::before{
            background:#111827;
        }
        body.theme-light .btn-auth:hover{
            color:white;
            box-shadow:0 0 0 2px #f97316,
            inset 0 0 25px #f97316;
        }

        .hero-bottom-text{
            font-size:13px;
            color:var(--hero-text);
        }

        /* ==== HERO RIGHT (PHONE, DARI HOME LAMA) ==== */
        .hero-right{
            position:relative;
            z-index:1;
            flex:1;
            display:flex;
            justify-content:flex-end;
        }
        .phone{
            width:280px;
            height:520px;
            border-radius:48px;
            background:linear-gradient(180deg,#1d4ed8,#0f172a);
            padding:18px;
            box-shadow:0 32px 80px rgba(0,0,0,0.75);
            position:relative;
            animation:phoneFloat 5s ease-in-out infinite alternate;
        }
        body.theme-light .phone{
            background:linear-gradient(180deg,#4f46e5,#1d4ed8);
            box-shadow:0 26px 70px rgba(148,163,184,0.8);
        }
        .phone::before{
            content:'';
            position:absolute;
            inset:-14px;
            border-radius:60px;
            background:radial-gradient(circle at 20% 0,#38bdf8 0,transparent 60%);
            opacity:.4;
            z-index:-1;
            animation:phoneGlow 5s ease-in-out infinite alternate;
        }

        .phone-inner{
            width:100%;
            height:100%;
            border-radius:36px;
            background:radial-gradient(circle at top,#38bdf8,#020617 62%);
            padding:22px 16px;
            position:relative;
            overflow:hidden;
            display:flex;
            flex-direction:column;
        }
        body.theme-light .phone-inner{
            background:radial-gradient(circle at top,#dbeafe,#020617 70%);
        }

        .phone-store{
            width:100%;
            height:150px;
            border-radius:22px;
            background:rgba(15,23,42,0.9);
            border:1px solid rgba(148,163,184,0.55);
            margin-bottom:14px;
            position:relative;
            overflow:hidden;
            padding:60px 18px 14px;
        }
        body.theme-light .phone-store{
            background:rgba(15,23,42,0.96);
        }

        .phone-ribbon{
            position:absolute;
            left:18px;
            top:24px;
            display:inline-flex;
            align-items:center;
            padding:0;
            background:transparent;
        }
        .phone-ribbon-pill{
            background:#22c55e;
            color:#022c22;
            font-size:10px;
            font-weight:700;
            padding:5px 14px;
            border-radius:999px;
            box-shadow:0 0 12px rgba(34,197,94,0.9);
        }

        .store-product-title{
            font-size:12px;
            font-weight:600;
            color:#f9fafb;
            margin-bottom:2px;
        }
        .store-product-sub{
            font-size:10px;
            color:#cbd5f5;
            margin-bottom:6px;
        }
        .store-price-row{
            display:flex;
            align-items:center;
            justify-content:space-between;
        }
        .store-price{
            font-size:14px;
            font-weight:700;
            color:#f97316;
        }
        .store-btn{
            border:none;
            border-radius:999px;
            padding:4px 10px;
            font-size:10px;
            background:#f97316;
            color:#111827;
            cursor:pointer;
        }
        .store-btn:hover{background:#fb923c;}

        .phone-slide-wrapper{
            position:relative;
            flex:1;
            padding:4px 2px 0;
        }
        .phone-slide{
            position:absolute;
            inset:0;
            padding:4px 2px 0;
            opacity:0;
            pointer-events:none;
            transform:translateX(18px);
            transition:opacity .35s ease, transform .35s ease;
        }
        .phone-slide.active{
            opacity:1;
            pointer-events:auto;
            transform:translateX(0);
        }

        .slide-heading{
            font-size:12px;
            font-weight:600;
            margin-bottom:4px;
            color:#f9fafb;
        }
        .slide-sub{
            font-size:10px;
            color:#9ca3af;
            margin-bottom:8px;
        }
        .phone-chip-row{
            display:flex;
            flex-wrap:wrap;
            gap:6px;
            margin-bottom:8px;
        }
        .phone-chip{
            padding:4px 8px;
            border-radius:999px;
            background:rgba(15,23,42,0.96);
            border:1px solid rgba(148,163,184,0.7);
            font-size:9px;
            color:#e5e7eb;
        }
        .phone-list{
            list-style:none;
            padding-left:0;
            margin:0 0 6px;
        }
        .phone-list li{
            font-size:10px;
            color:#cbd5f5;
            margin-bottom:4px;
            padding-left:10px;
            position:relative;
        }
        .phone-list li::before{
            content:'•';
            position:absolute;
            left:0;
            top:-1px;
            font-size:11px;
            color:#f97316;
        }
        .phone-mini-note{
            font-size:9px;
            color:#64748b;
        }

        .phone-nav-btn{
            position:absolute;
            bottom:46px;
            width:24px;
            height:24px;
            border-radius:999px;
            border:1px solid rgba(148,163,184,0.8);
            background:rgba(15,23,42,0.9);
            color:#e5e7eb;
            font-size:13px;
            display:flex;
            align-items:center;
            justify-content:center;
            cursor:pointer;
            transition:background .2s ease, transform .1s ease;
        }
        .phone-nav-btn:hover{
            background:rgba(30,64,175,0.9);
            transform:translateY(-1px);
        }
        .phone-nav-prev{left:22px;}
        .phone-nav-next{right:22px;}

        .phone-dots{
            position:absolute;
            bottom:18px;
            left:50%;
            transform:translateX(-50%);
            display:flex;
            gap:6px;
        }
        .phone-dot{
            width:6px;
            height:6px;
            border-radius:999px;
            border:none;
            padding:0;
            background:rgba(148,163,184,0.7);
            cursor:pointer;
            transition:width .2s ease, background-color .2s ease, opacity .2s ease;
        }
        .phone-dot.active{
            width:14px;
            background:#f97316;
        }

        @keyframes phoneFloat{
            0%{ transform:translateY(0) translateX(0); }
            100%{ transform:translateY(-12px) translateX(4px); }
        }
        @keyframes phoneGlow{
            0%{ opacity:.3; }
            100%{ opacity:.6; }
        }

        /* ===================== LAYOUT BARU: FEATURES + CTA + FOOTER ===================== */

        .features{
            padding:80px 60px 100px;
            background:var(--section-bg);
        }
        .container{
            max-width:1200px;
            margin:0 auto;
        }
        .section-header{
            text-align:center;
            margin-bottom:60px;
        }
        .section-badge{
            display:inline-block;
            padding:8px 20px;
            border-radius:999px;
            border:1px solid #f97316;
            background:rgba(15,23,42,0.8);
            color:#fed7aa;
            font-size:11px;
            text-transform:uppercase;
            letter-spacing:.16em;
            margin-bottom:18px;
        }
        body.theme-light .section-badge{
            background:rgba(248,250,252,0.9);
            color:#9a3412;
        }
        .section-title{
            font-size:26px;
            font-weight:800;
            color:var(--section-title);
            margin-bottom:10px;
        }
        .section-description{
            font-size:15px;
            color:var(--section-text);
            max-width:640px;
            margin:0 auto;
        }

        .features-grid{
            margin-top:40px;
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:24px;
        }
        @media(max-width:1024px){
            .features-grid{
                grid-template-columns:repeat(2,1fr);
            }
        }
        @media(max-width:768px){
            .features-grid{
                grid-template-columns:1fr;
            }
        }
        .feature-card{
            background:var(--card-bg);
            border-radius:22px;
            padding:26px 24px;
            border:1px solid var(--card-border);
            box-shadow:var(--card-shadow);
            transition:all .3s ease;
            position:relative;
            overflow:hidden;
        }
        .feature-card::before{
            content:'';
            position:absolute;
            top:0;left:0;right:0;
            height:3px;
            background:linear-gradient(90deg,#3b82f6,#f97316);
            transform:scaleX(0);
            transform-origin:left;
            transition:transform .3s ease;
        }
        .feature-card:hover{
            border-color:var(--card-border-hover);
            transform:translateY(-4px);
        }
        .feature-card:hover::before{
            transform:scaleX(1);
        }
        .feature-icon{
            width:56px;
            height:56px;
            border-radius:18px;
            background:radial-gradient(circle at 30% 0,#4f46e5,#020617);
            display:flex;
            align-items:center;
            justify-content:center;
            margin-bottom:16px;
        }
        body.theme-light .feature-icon{
            background:linear-gradient(135deg,#667eea,#764ba2);
        }
        .feature-icon i{
            font-size:26px;
            color:#e5e7eb;
        }
        .feature-title{
            font-size:16px;
            font-weight:700;
            color:var(--section-title);
            margin-bottom:8px;
        }
        .feature-description{
            font-size:14px;
            color:var(--section-text);
        }

        /* CONTACT SECTION */
        .contact{
            padding:80px 60px 100px;
            background:var(--section-bg);
        }
        .contact-grid{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:24px;
            margin-top:40px;
        }
        @media(max-width:1024px){
            .contact-grid{
                grid-template-columns:repeat(2,1fr);
            }
        }
        @media(max-width:640px){
            .contact-grid{
                grid-template-columns:1fr;
            }
        }
        .contact-card{
            background:var(--card-bg);
            border-radius:18px;
            padding:28px 24px;
            border:1px solid var(--card-border);
            text-align:center;
            transition:all .3s ease;
        }
        .contact-card:hover{
            border-color:var(--card-border-hover);
            transform:translateY(-4px);
        }
        .contact-icon{
            width:56px;
            height:56px;
            border-radius:50%;
            background:linear-gradient(135deg,#f97316,#fb923c);
            display:flex;
            align-items:center;
            justify-content:center;
            margin:0 auto 16px;
        }
        .contact-icon i{
            font-size:26px;
            color:#fff;
        }
        .contact-title{
            font-size:16px;
            font-weight:700;
            color:var(--section-title);
            margin-bottom:8px;
        }
        .contact-info{
            font-size:14px;
            color:#f97316;
            font-weight:600;
            margin-bottom:4px;
        }
        .contact-sub{
            font-size:12px;
            color:var(--section-text);
        }

        /* CTA SECTION */
        .cta{
            padding:90px 60px 100px;
            background:var(--cta-bg);
            position:relative;
            overflow:hidden;
        }
        .cta::before{
            content:'';
            position:absolute;
            width:420px;
            height:420px;
            border-radius:999px;
            background:radial-gradient(circle at 0 0,#38bdf8,transparent 70%);
            opacity:.38;
            left:-160px;
            top:-200px;
        }
        .cta::after{
            content:'';
            position:absolute;
            width:420px;
            height:420px;
            border-radius:999px;
            background:radial-gradient(circle at 100% 100%,#f97316,transparent 70%);
            opacity:.35;
            right:-180px;
            bottom:-220px;
        }
        .cta-container{
            max-width:760px;
            margin:0 auto;
            text-align:center;
            position:relative;
            z-index:1;
        }
        .cta-title{
            font-size:32px;
            font-weight:800;
            color:#f9fafb;
            margin-bottom:14px;
        }
        .cta-description{
            font-size:15px;
            color:var(--cta-subtext);
            margin-bottom:30px;
        }
        .cta-buttons{
            display:flex;
            justify-content:center;
            gap:16px;
            flex-wrap:wrap;
        }

        /* BTN versi hero baru tapi pakai tema lama */
        .btn-hero-primary{
            padding:14px 30px;
            border-radius:999px;
            background:#ffffff;
            color:#1d4ed8;
            font-weight:700;
            font-size:15px;
            display:inline-flex;
            align-items:center;
            gap:8px;
            border:2px solid transparent;
            box-shadow:0 14px 40px rgba(15,23,42,0.9);
            transition:all .25s ease;
        }
        .btn-hero-primary:hover{
            transform:translateY(-2px);
            box-shadow:0 20px 50px rgba(15,23,42,1);
            border-color:rgba(96,165,250,0.9);
        }
        .btn-hero-secondary{
            padding:14px 30px;
            border-radius:999px;
            background:rgba(15,23,42,0.9);
            color:#e5e7eb;
            font-weight:600;
            font-size:15px;
            display:inline-flex;
            align-items:center;
            gap:8px;
            border:2px solid rgba(148,163,184,0.7);
            box-shadow:0 10px 30px rgba(15,23,42,0.9);
            transition:all .25s ease;
        }
        .btn-hero-secondary:hover{
            transform:translateY(-2px);
            border-color:#60a5fa;
            color:#e5edff;
        }

        /* FOOTER (layout dari home baru, warna dari tema lama) */
        .footer{
            background:var(--footer-bg);
            color:var(--footer-text);
            padding:50px 60px 26px;
        }
        .footer-container{
            max-width:1200px;
            margin:0 auto;
        }
        .footer-grid{
            display:grid;
            grid-template-columns:2.2fr 1fr 1fr 1fr;
            gap:48px;
            margin-bottom:30px;
        }
        .footer-brand h3{
            font-size:22px;
            font-weight:800;
            color:var(--footer-heading);
            margin-bottom:10px;
        }
        .footer-brand p{
            font-size:13px;
            color:var(--footer-text);
            line-height:1.7;
        }
        .footer-links h4{
            font-size:14px;
            font-weight:700;
            color:var(--footer-heading);
            margin-bottom:14px;
        }
        .footer-links ul{
            list-style:none;
        }
        .footer-links li{
            margin-bottom:8px;
        }
        .footer-links a{
            font-size:13px;
            color:var(--footer-text);
            transition:color .2s ease;
        }
        .footer-links a:hover{
            color:#60a5fa;
        }
        .footer-bottom{
            border-top:1px solid var(--footer-border);
            padding-top:16px;
            text-align:center;
            font-size:13px;
            color:var(--footer-text);
        }

        /* RESPONSIVE UTAMA */
        @media(max-width:900px){
            .nav{padding:14px 18px;}
            .hero{
                flex-direction:column;
                padding:100px 18px 60px;
            }
            .hero-right{justify-content:center;}
            .nav-left{gap:18px;}
            .nav-menu{
                gap:18px;
                font-size:13px;
            }
            .features{padding:70px 18px 80px;}
            .cta{padding:70px 18px 80px;}
            .footer{padding:40px 18px 22px;}
        }
        @media(max-width:768px){
            .footer-grid{
                grid-template-columns:1fr;
            }
        }
    </style>
</head>
<body class="theme-dark">

    {{-- NAVBAR (hero style lama, link seperti layout baru) --}}
    <nav class="nav">
        <div class="nav-left">
            <a href="{{ route('home') }}" class="nav-logo">
                <img src="{{ asset('images/logo.png') }}" alt="kampuStore logo">
                <span>kampuStore</span>
            </a>

            <div class="nav-menu">
                <a href="{{ route('home') }}" class="active">Home</a>
                <a href="#features">Features</a>
                <a href="{{ route('products.index') }}">Market</a>
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
            </div>
        </div>

        <div class="nav-actions">
            <div class="theme-toggle-wrapper">
                <label class="toggle-switch">
                    <input type="checkbox" class="js-theme-toggle" />
                    <span class="slider">
                        <div class="clouds">
                            <svg viewBox="0 0 100 100" class="cloud cloud1">
                                <path
                                    d="M30,45 Q35,25 50,25 Q65,25 70,45 Q80,45 85,50 Q90,55 85,60 Q80,65 75,60 Q65,60 60,65 Q55,70 50,65 Q45,70 40,65 Q35,60 25,60 Q20,65 15,60 Q10,55 15,50 Q20,45 30,45"
                                ></path>
                            </svg>
                            <svg viewBox="0 0 100 100" class="cloud cloud2">
                                <path
                                    d="M30,45 Q35,25 50,25 Q65,25 70,45 Q80,45 85,50 Q90,55 85,60 Q80,65 75,60 Q65,60 60,65 Q55,70 50,65 Q45,70 40,65 Q35,60 25,60 Q20,65 15,60 Q10,55 15,50 Q20,45 30,45"
                                ></path>
                            </svg>
                        </div>
                    </span>
                </label>
            </div>
        </div>
    </nav>

    {{-- HERO (PERSIS HOME LAMA) --}}
    <section class="hero" id="home">
        <div class="hero-orb orb-1"></div>
        <div class="hero-orb orb-2"></div>

        <div class="hero-left">
            <div class="hero-tag">Marketplace Kampus UNDIP</div>
            <h1 class="hero-title">
                SHOPPING <span>ONLINE</span> FOR STUDENTS
            </h1>
            <p class="hero-text">
                kampuStore membantu mahasiswa UNDIP jual – beli kebutuhan kuliah seperti
                alat tulis, buku, elektronik, dan fashion kampus dalam satu platform
                yang aman dan terkurasi.
            </p>
            <div class="hero-buttons">
                <a href="{{ route('products.index') }}">
                    <button class="animated-button" type="button">
                        <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                        </svg>
                        <span class="text">Shop Now</span>
                        <span class="circle"></span>
                        <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"></path>
                        </svg>
                    </button>
                </a>

                <a href="{{ route('register') }}">
                    <button class="btn-auth" type="button">Register</button>
                </a>
                <a href="{{ route('login') }}">
                    <button class="btn-auth" type="button">Login</button>
                </a>
            </div>
            <div class="hero-bottom-text">
                 Transaksi lebih aman | Barang relevan untuk kuliah
            </div>
        </div>

        <div class="hero-right">
            <div class="phone">
                <div class="phone-inner">
                    <div class="phone-store">
                        <div class="phone-ribbon">
                            <div class="phone-ribbon-pill">HOT DEAL</div>
                        </div>

                        <div class="store-product">
                            <div class="store-product-title">Sticky Notes</div>
                            <div class="store-product-sub">Arya – Informatika</div>
                            <div class="store-price-row">
                                <div class="store-price">Rp 5.000</div>
                                <button class="store-btn" type="button">Add to cart</button>
                            </div>
                        </div>
                    </div>

                    <div class="phone-slide-wrapper">
                        <div class="phone-slide active" data-index="0">
                            <div class="slide-heading">Kategori Lengkap</div>
                            <div class="slide-sub">Semua kebutuhan kuliah dalam satu aplikasi.</div>
                            <div class="phone-chip-row">
                                <span class="phone-chip">Alat Tulis</span>
                                <span class="phone-chip">Buku &amp; Modul</span>
                                <span class="phone-chip">Fashion Kampus</span>
                                <span class="phone-chip">Elektronik Ringan</span>
                                <span class="phone-chip">Preloved</span>
                            </div>
                            <div class="phone-mini-note">
                                Mahasiswa cukup buka kampuStore untuk cari kebutuhan harian di kampus.
                            </div>
                        </div>

                        <div class="phone-slide" data-index="1">
                            <div class="slide-heading">Keunggulan untuk Pembeli</div>
                            <div class="slide-sub">Belanja aman karena semua penjual bagian dari UNDIP.</div>
                            <ul class="phone-list">
                                <li>Login & verifikasi dengan akun kampus.</li>
                                <li>Produk relevan dengan kehidupan mahasiswa.</li>
                                <li>Rating & review bantu pilih penjual terpercaya.</li>
                            </ul>
                            <div class="phone-mini-note">
                                Pas buat cari barang mendadak sebelum kuliah atau praktikum.
                            </div>
                        </div>

                        <div class="phone-slide" data-index="2">
                            <div class="slide-heading">Keunggulan untuk Penjual</div>
                            <div class="slide-sub">Mulai latihan bisnis kecil sejak masih kuliah.</div>
                            <ul class="phone-list">
                                <li>Akses langsung ke pasar mahasiswa UNDIP.</li>
                                <li>Dashboard sederhana untuk kelola produk & pesanan.</li>
                                <li>Bisa dipakai untuk bangun personal brand & usaha.</li>
                            </ul>
                            <div class="phone-mini-note">
                                Cocok untuk himpunan, UKM, maupun jualan pribadi mahasiswa.
                            </div>
                        </div>
                    </div>

                    <button class="phone-nav-btn phone-nav-prev" type="button">‹</button>
                    <button class="phone-nav-btn phone-nav-next" type="button">›</button>

                    <div class="phone-dots">
                        <button class="phone-dot active" data-index="0"></button>
                        <button class="phone-dot" data-index="1"></button>
                        <button class="phone-dot" data-index="2"></button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FEATURES (LAYOUT DARI HOME BARU, TEMA GELAP) --}}
    <section class="features" id="features">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Kenapa kampuStore?</span>
                <h2 class="section-title">Keunggulan Platform</h2>
                <p class="section-description">
                    Solusi marketplace khusus untuk mahasiswa UNDIP dengan berbagai fitur yang memudahkan.
                </p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="uil uil-shield-check"></i>
                    </div>
                    <h3 class="feature-title">Aman & Terpercaya</h3>
                    <p class="feature-description">
                        Setiap penjual diverifikasi terlebih dahulu untuk memastikan keamanan. Transaksi lebih terjamin karena berlangsung di dalam komunitas UNDIP.                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="uil uil-shopping-bag"></i>
                    </div>
                    <h3 class="feature-title">Belanja Tanpa Login</h3>
                    <p class="feature-description">
                        Pembeli bisa langsung browsing dan membeli produk tanpa perlu registrasi atau login. Simple dan cepat!
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="uil uil-box"></i>
                    </div>
                    <h3 class="feature-title">Produk Relevan</h3>
                    <p class="feature-description">
                        Semua produk dikurasi khusus untuk kebutuhan mahasiswa. Dari alat tulis, buku, elektronik, hingga fashion kampus.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="uil uil-dashboard"></i>
                    </div>
                    <h3 class="feature-title">Dashboard Penjual</h3>
                    <p class="feature-description">
                        Kelola toko dengan mudah melalui dashboard yang intuitif. Monitor stok, produk, dan penjualan dalam satu tempat.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="uil uil-map-marker"></i>
                    </div>
                    <h3 class="feature-title">Lokasi Dekat</h3>
                    <p class="feature-description">
                        Semua penjual dari area kampus UNDIP. Bisa COD atau janjian di titik terdekat. Hemat ongkir!
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="uil uil-star"></i>
                    </div>
                    <h3 class="feature-title">Rating & Review</h3>
                    <p class="feature-description">
                        Sistem rating dan review membantu kamu memilih penjual terpercaya dan produk berkualitas.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA (ABOUT) --}}
    <section class="cta" id="about">
        <div class="cta-container">
            <h2 class="cta-title">Siap Mulai Jualan?</h2>
            <p class="cta-description">
                Daftar sebagai penjual dan raih peluang bisnis di marketplace khusus mahasiswa UNDIP.
                <br>Proses verifikasi cepat dan mudah!</br>
            </p>
            <div class="cta-buttons">
                <a href="{{ route('register') }}" class="btn-hero-secondary">
                    <i class="uil uil-user-plus"></i>
                    Daftar Sebagai Penjual
                </a>
                <a href="{{ route('products.index') }}" class="btn-hero-secondary">
                    <i class="uil uil-shopping-cart"></i>
                    Lihat Produk
                </a>
            </div>
        </div>
    </section>

    {{-- CONTACT SECTION --}}
    <section class="contact" id="contact">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Hubungi Kami</span>
                <h2 class="section-title">Kontak</h2>
                <p class="section-description">
                    Ada pertanyaan atau butuh bantuan? Jangan ragu untuk menghubungi tim kampuStore.
                </p>
            </div>

            <div class="contact-grid">
                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="uil uil-envelope"></i>
                    </div>
                    <h3 class="contact-title">Email</h3>
                    <p class="contact-info">support@kampustore.id</p>
                    <p class="contact-sub">Respon dalam 1x24 jam</p>
                </div>

                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="uil uil-whatsapp"></i>
                    </div>
                    <h3 class="contact-title">WhatsApp</h3>
                    <p class="contact-info">+62 812-3456-7890</p>
                    <p class="contact-sub">Senin - Jumat, 09:00 - 17:00</p>
                </div>

                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="uil uil-instagram"></i>
                    </div>
                    <h3 class="contact-title">Instagram</h3>
                    <p class="contact-info">@kampustore.undip</p>
                    <p class="contact-sub">Follow untuk info terbaru</p>
                </div>

                <div class="contact-card">
                    <div class="contact-icon">
                        <i class="uil uil-map-marker"></i>
                    </div>
                    <h3 class="contact-title">Lokasi</h3>
                    <p class="contact-info">Universitas Diponegoro</p>
                    <p class="contact-sub">Tembalang, Semarang</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER (LAYOUT BARU, WARNA LAMA) --}}
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <h3>kampuStore</h3>
                    <p>
                        Platform marketplace khusus untuk mahasiswa UNDIP. Jual-beli kebutuhan kuliah
                        dengan aman, mudah, dan terpercaya.
                    </p>
                </div>

                <div class="footer-links">
                    <h4>Platform</h4>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('products.index') }}">Market</a></li>
                        <li><a href="#features">Features</a></li>
                        <li><a href="#about">About</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h4>Penjual</h4>
                    <ul>
                        <li><a href="{{ route('register') }}">Daftar Penjual</a></li>
                        <li><a href="{{ route('login') }}">Login Penjual</a></li>
                        <li><a href="{{ route('seller.dashboard') }}">Dashboard</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h4>Bantuan</h4>
                    <ul>
                        <li><a href="#">Cara Belanja</a></li>
                        <li><a href="#">Cara Berjualan</a></li>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#contact">Kontak</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                © {{ date('Y') }} kampuStore – Marketplace Mahasiswa UNDIP. All rights reserved.
            </div>
        </div>
    </footer>

    {{-- JS: THEME TOGGLE + SLIDER + PARALLAX (DARI HOME LAMA) --}}
    <script>
        // THEME TOGGLE
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
                // unchecked (kiri, matahari) = light, checked (kanan, bulan) = dark
                toggle.checked = (saved !== 'light');
                toggle.addEventListener('change', () => {
                    const mode = toggle.checked ? 'dark' : 'light';
                    apply(mode);
                    localStorage.setItem(KEY, mode);
                });
            }
        })();

        // PHONE SLIDER
        (function(){
            const slides = document.querySelectorAll('.phone-slide');
            const dots   = document.querySelectorAll('.phone-dot');
            const prev   = document.querySelector('.phone-nav-prev');
            const next   = document.querySelector('.phone-nav-next');
            if(!slides.length || !dots.length) return;

            let current = 0;
            let timer   = null;

            function goTo(index){
                current = (index + slides.length) % slides.length;

                slides.forEach((s,i)=>{
                    s.classList.toggle('active', i === current);
                });
                dots.forEach((d,i)=>{
                    d.classList.toggle('active', i === current);
                });
            }

            function autoNext(){
                goTo(current + 1);
            }

            function resetTimer(){
                if(timer) clearInterval(timer);
                timer = setInterval(autoNext, 6000);
            }

            dots.forEach(dot=>{
                dot.addEventListener('click', ()=>{
                    const idx = parseInt(dot.getAttribute('data-index'),10) || 0;
                    goTo(idx);
                    resetTimer();
                });
            });

            if(prev){
                prev.addEventListener('click', ()=>{
                    goTo(current - 1);
                    resetTimer();
                });
            }
            if(next){
                next.addEventListener('click', ()=>{
                    goTo(current + 1);
                    resetTimer();
                });
            }

            goTo(0);
            resetTimer();
        })();

        // PARALLAX HERO BACKGROUND
        (function(){
            const layers = document.querySelectorAll('.hero-orb');
            if(!layers.length) return;

            function onMove(e){
                const w = window.innerWidth;
                const h = window.innerHeight;
                const x = (e.clientX - w/2) / w;
                const y = (e.clientY - h/2) / h;

                layers.forEach((layer,idx)=>{
                    const depth = (idx + 1) * 18;
                    const tx = -x * depth;
                    const ty = -y * depth;
                    layer.style.transform = `translate3d(${tx}px,${ty}px,0)`;
                });
            }

            window.addEventListener('mousemove', onMove);
        })();
    </script>

</body>
</html>