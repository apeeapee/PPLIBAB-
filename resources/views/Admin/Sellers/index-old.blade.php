<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pengajuan Toko | kampuStore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- ICON (optional) --}}
    <link rel="stylesheet"
          href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <style>
        *{margin:0;padding:0;box-sizing:border-box}

        /* ========== THEME VARIABLES (SAMA SPIRIT DENGAN MARKET) ========== */
        :root{
          --bg-body:#050b1f;
          --text-main:#e5e7eb;

          --nav-bg:linear-gradient(90deg,#020617,#020617);
          --nav-border-bottom:rgba(30,64,175,0.5);
          --nav-shadow:0 14px 40px rgba(15,23,42,0.9);
          --nav-link-color:#e5e7eb;

          --admin-bg:radial-gradient(circle at top left,#1f3b8a 0,#020617 52%,#020617 100%);
          --bubble-1:#6366f1;
          --bubble-2:#f97316;
          --bubble-3:#0ea5e9;
          --bubble-4:#22c55e;

          --sidebar-bg:rgba(15,23,42,0.96);
          --sidebar-border:rgba(59,130,246,0.65);
          --sidebar-scroll-thumb:#4b5563;
          --sidebar-divider:rgba(55,65,81,0.85);
          --sidebar-text:#e5e7eb;

          --card-bg:rgba(15,23,42,0.98);
          --card-border:rgba(55,65,81,0.9);

          --chip-bg:#020617;
          --chip-border:#1f2937;

          --accent-orange:#f97316;
          --accent-orange-soft:#fb923c;
        }

        /* LIGHT MODE OVERRIDE – disamain feel-nya dengan Market */
        body.theme-light{
          --bg-body:#eef2ff;
          --text-main:#1a2550;

          --nav-bg:#ffffff;
          --nav-border-bottom:#d9ddf0;
          --nav-shadow:0 4px 12px rgba(20,30,60,0.08);
          --nav-link-color:#1a2450;

          --admin-bg:linear-gradient(
              135deg,
              #ffffff 0%,
              #e3e8ff 40%,
              #d5ddff 100%
          );

          --sidebar-bg:#ffffff;
          --sidebar-border:#cfd6f5;
          --sidebar-scroll-thumb:#97a3d5;
          --sidebar-divider:#d6dcfa;
          --sidebar-text:#1f2b60;

          --card-bg:#ffffff;
          --card-border:#d3daf9;

          --chip-bg:#e3e6ff;
          --chip-border:#c5cdf5;
        }

        /* BODY */
        body{
          font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Arial,sans-serif;
          background:var(--bg-body);
          color:var(--text-main);
          font-size:14px;
          line-height:1.6;
        }

        a{text-decoration:none;color:inherit;}

        /* ================= NAVBAR ================= */
        .nav{
          position:fixed;
          top:0;left:0;right:0;
          z-index:100;
          display:flex;
          align-items:center;
          justify-content:space-between;
          padding:18px 40px;
          background:var(--nav-bg);
          border-bottom:1px solid var(--nav-border-bottom);
          box-shadow:var(--nav-shadow);
        }
        .nav-left{
          display:flex;
          align-items:center;
          gap:26px;
        }
        .nav-logo{
          display:flex;
          align-items:center;
          font-weight:700;
          font-size:22px;
          letter-spacing:0.04em;
          color:#f9fafb;
          cursor:pointer;
          gap:8px;
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
          gap:24px;
          font-size:14px;
        }
        .nav-menu a{
            color:var(--nav-link-color);
            position:relative;
            transition:color .25s ease-out;
        }
        .nav-menu a::after{
            content:'';
            position:absolute;
            left:0;
            bottom:-4px;
            height:2px;
            width:100%;
            background:var(--accent-orange);
            border-radius:999px;
            transform:scaleX(0);
            transform-origin:left;
            opacity:0;
            transition:transform .25s ease-out, opacity .2s ease-out;
        }
        .nav-menu a:hover{
            color:var(--accent-orange);
        }
        .nav-menu a:hover::after{
            transform:scaleX(1);
            opacity:1;
        }

        /* INI BIAR .active GA NGAPA-NGAPAIN DI NAVBAR */
        .nav-menu a.active{
            color:var(--nav-link-color);
        }
        .nav-menu a.active::after{
            transform:scaleX(0);
            opacity:0;
        }

        .nav-search{
          flex:1;
          max-width:420px;
          margin:0 24px;
          position:relative;
        }
        .nav-search input{
          width:100%;
          padding:9px 14px;
          border-radius:999px;
          border:1px solid #1d4ed8;
          background:#020617;
          color:#e5e7eb;
          font-size:13px;
          outline:none;
        }
        .nav-search input::placeholder{
          color:#9ca3af;
        }
        .nav-search input:focus{
          border-color:var(--accent-orange);
        }

        body.theme-light .nav-search input{
          background:#ffffff;
          border-color:#c4ccf2;
          color:#1a1f3f;
        }
        body.theme-light .nav-search input::placeholder{
          color:#9aa6d6;
        }

        .header-right{
          display:flex;
          align-items:center;
          gap:14px;
        }

        /* THEME TOGGLE */
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
          transform:scale(0.95);
          transition:transform .2s;
        }
        .toggle-switch:hover{
          transform:scale(1);
        }
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
          box-shadow:0 0 10px rgba(0,0,0,0.15);
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
          transform:scale(0.85);
          animation:floatCloud2 12s infinite linear;
        }
        @keyframes floatCloud1{
          0%{transform:translateX(-20px);opacity:0;}
          20%{opacity:1;}
          80%{opacity:1;}
          100%{transform:translateX(80px);opacity:0;}
        }
        @keyframes floatCloud2{
          0%{transform:translateX(-20px) scale(0.85);opacity:0;}
          20%{opacity:0.7;}
          80%{opacity:0.7;}
          100%{transform:translateX(80px) scale(0.85);opacity:0;}
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

        /* ICON HEADER */
        .icon-btn{
          background:none;
          border:none;
          cursor:pointer;
          position:relative;
          padding:0;
        }
        .icon-round{
          width:32px;
          height:32px;
          border-radius:999px;
          border:1px solid #3b82f6;
          display:flex;
          align-items:center;
          justify-content:center;
          background:#020617;
          font-size:18px;
          color:#e5e7eb;
          box-shadow:0 0 0 1px rgba(15,23,42,0.6);
          transition:transform .18s ease,
                     background .18s ease,
                     border-color .18s ease,
                     box-shadow .18s ease;
        }
        .header-right .icon-btn:hover .icon-round{
          transform:translateY(-2px);
          background:#ffffff;
          border-color:#d1d5db;
          box-shadow:
            0 0 0 1px rgba(148,163,184,0.5),
            0 8px 18px rgba(0,0,0,.45);
          color:#111827;
        }

        body.theme-light .icon-round{
          background:#ffffff;
          color:#1b234a;
          border-color:#c4ccf2;
          box-shadow:0 0 0 1px rgba(148,163,184,0.5);
        }

        /* ACCOUNT DROPDOWN */
        .account-wrapper{
          position:relative;
        }
        .account-menu{
          position:absolute;
          right:0;
          top:110%;
          min-width:260px;
          padding:12px 12px 14px;
          border-radius:16px;

          background:rgba(15,23,42,0.88);
          border:1px solid rgba(148,163,184,0.55);
          box-shadow:0 18px 40px rgba(0,0,0,.85);
          backdrop-filter:blur(18px);
          -webkit-backdrop-filter:blur(18px);

          opacity:0;
          visibility:hidden;
          transform:translateY(-6px) scale(.97);
          transform-origin:top right;
          pointer-events:none;
          transition:
            opacity .18s ease-out,
            transform .18s ease-out,
            visibility .18s ease-out;
          z-index:120;
        }
        .account-wrapper.is-open .account-menu{
          opacity:1;
          visibility:visible;
          transform:translateY(0) scale(1);
          pointer-events:auto;
        }

        .profile-info{
          padding:10px 14px;
          border-radius:12px;
          background:rgba(15,23,42,0.96);
          border:1px solid rgba(148,163,184,0.4);
          margin:4px 4px 8px;
          display:flex;
          flex-direction:column;
          gap:3px;
          cursor:pointer;
          transition:
            background .18s ease,
            border-color .18s ease,
            box-shadow .18s ease,
            transform .18s ease;
        }
        .profile-info:hover{
          background:linear-gradient(
            135deg,
            rgba(30,64,175,0.95),
            rgba(15,23,42,0.98)
          );
          border-color:#60a5fa;
          box-shadow:0 0 0 1px rgba(37,99,235,0.5);
          transform:translateY(-1px);
        }
        .profile-name{font-weight:600;font-size:14px;}
        .profile-role{font-size:12px;color:#9ca3af;}

        .profile-list{
          margin:0 4px 6px;
          padding:6px 0;
          border-top:1px solid var(--sidebar-divider);
          border-bottom:1px solid var(--sidebar-divider);
          display:flex;
          flex-direction:column;
        }
        .profile-item{
          padding:6px 10px;
          font-size:13px;
          color:var(--sidebar-text);
          border-radius:8px;
          display:flex;
          justify-content:space-between;
          align-items:center;
          cursor:pointer;
          transition:background .16s ease,color .16s ease,transform .16s ease;
        }
        .profile-item:hover{
          background:rgba(15,23,42,0.95);
          color:var(--accent-orange);
          transform:translateX(2px);
        }

        .account-menu .custom-btn{
          width:100%;
          height:38px;
          border-radius:999px;
          padding:0 16px;

          font-family:inherit;
          font-size:13px;
          font-weight:600;

          display:flex;
          align-items:center;
          justify-content:center;

          background:transparent;
          color:var(--sidebar-text);
          border:none;
          cursor:pointer;
          outline:none;

          transition:all 0.3s ease;
          box-shadow:
            inset 2px 2px 2px 0px rgba(255,255,255,.05),
            7px 7px 20px 0px rgba(0,0,0,.25),
            4px 4px 5px 0px rgba(0,0,0,.2);
        }
        .btn-auth-outline{
          border:1px solid rgba(249,115,22,0.7);
          background:rgba(15,23,42,0.9);
        }
        .custom-btn:hover{
          box-shadow:
            4px 4px 6px 0 rgba(255,255,255,.15),
            -4px -4px 6px 0 rgba(15,23,42,.7),
            inset -4px -4px 6px 0 rgba(255,255,255,.08),
            inset 4px 4px 6px 0 rgba(0,0,0,.55);
          transform:translateY(-1px);
        }

        body.theme-light .account-menu{
          background:#ffffff;
          border-color:#d1d5f0;
          box-shadow:0 18px 40px rgba(148,163,184,.6);
        }
        body.theme-light .profile-info{
          background:#f9fafb;
          border-color:#e5e7f5;
        }
        body.theme-light .profile-info:hover{
          background:#e5e9ff;
          border-color:#4f46e5;
          box-shadow:0 0 0 1px rgba(79,70,229,0.4);
        }
        body.theme-light .profile-name{
          color:#111827;
        }
        body.theme-light .profile-role{
          color:#6b7280;
        }
        body.theme-light .profile-item:hover{
          background:#f3f4ff;
          color:#ea580c;
        }

        .admin-avatar-mini{
          width:32px;
          height:32px;
          border-radius:999px;
          background:radial-gradient(circle at 30% 0%,#f97316,#4f46e5);
          display:flex;
          align-items:center;
          justify-content:center;
          font-size:14px;
          font-weight:700;
          color:#f9fafb;
        }

        /* ============== BACKGROUND AREA ADMIN ============== */
        .admin-bg{
          min-height:100vh;
          padding:110px 30px 40px;
          background:var(--admin-bg);
          position:relative;
          overflow:hidden;
        }
        .admin-bg::before,
        .admin-bg::after{
          content:'';
          position:absolute;
          border-radius:999px;
          filter:blur(24px);
          opacity:0.4;
        }
        .admin-bg::before{
          width:340px;height:340px;
          background:linear-gradient(135deg,var(--bubble-1),var(--bubble-2));
          top:-140px;left:-80px;
        }
        .admin-bg::after{
          width:300px;height:300px;
          background:linear-gradient(135deg,var(--bubble-3),var(--bubble-4));
          bottom:-140px;right:-60px;
        }
        body.theme-light .admin-bg::before,
        body.theme-light .admin-bg::after{
          opacity:0.12;
        }

        .admin-container{
          position:relative;
          z-index:1;
          display:flex;
          max-width:1400px;
          margin:0 auto;
          gap:26px;
        }

        .admin-sidebar{
          width:260px;
          background:var(--sidebar-bg);
          padding:20px 18px;
          height:calc(100vh - 150px);
          overflow-y:auto;
          border-radius:16px;
          border:1px solid var(--sidebar-border);
          box-shadow:0 10px 30px rgba(0,0,0,.55);
        }
        .admin-sidebar::-webkit-scrollbar{
          width:6px;
        }
        .admin-sidebar::-webkit-scrollbar-thumb{
          background:var(--sidebar-scroll-thumb);
          border-radius:999px;
        }
        .admin-sidebar-title{
          font-size:19px;
          font-weight:700;
          margin-bottom:4px;
        }
        .admin-sidebar-sub{
          font-size:13px;
          color:#9ca3af;
          margin-bottom:16px;
        }
        .admin-sidebar-section-title{
          font-size:12px;
          text-transform:uppercase;
          letter-spacing:.16em;
          color:#9ca3af;
          margin:10px 0 6px;
        }
        .admin-menu{
          list-style:none;
          display:flex;
          flex-direction:column;
          gap:4px;
          font-size:14px;
        }
        .admin-link{
          display:flex;
          align-items:center;
          gap:10px;
          padding:7px 10px;
          border-radius:10px;
          color:var(--sidebar-text);
          border:1px solid transparent;
          cursor:pointer;
          transition:.18s;
        }
        .admin-link span.icon{
          width:22px;
          height:22px;
          border-radius:999px;
          display:flex;
          align-items:center;
          justify-content:center;
          background:#020617;
          font-size:13px;
          color:#e5e7eb;
        }
        .admin-link:hover{
          background:rgba(15,23,42,0.96);
          border-color:#3b82f6;
          transform:translateX(2px);
        }
        .admin-link.active{
          background:linear-gradient(135deg,#1d4ed8,#4c1d95);
          border-color:#60a5fa;
          box-shadow:0 12px 26px rgba(15,23,42,0.9);
          color:#f9fafb;
        }
        .admin-link.active span.icon{
          background:rgba(15,23,42,0.9);
        }

        body.theme-light .admin-sidebar{
          box-shadow:0 8px 20px rgba(148,163,184,0.35);
        }
        body.theme-light .admin-link span.icon{
          background:#e5e7eb;
          color:#1f2937;
        }

        body.theme-light .admin-link:hover{
          background:#eef2ff;
          border-color:#4f46e5;
          transform:translateX(2px);
          color:#1f2937;
        }
        body.theme-light .admin-link:hover span.icon{
          background:#e5e7eb;
          color:#111827;
        }

        body.theme-light .admin-link.active{
          background:linear-gradient(135deg,#4f46e5,#6366f1);
          border-color:#4f46e5;
          box-shadow:0 12px 26px rgba(129,140,248,0.55);
          color:#f9fafb;
        }
        body.theme-light .admin-link.active span.icon{
          background:rgba(15,23,42,0.15);
          color:#f9fafb;
        }

        .admin-sidebar-footer{
          margin-top:18px;
          padding-top:10px;
          border-top:1px solid var(--sidebar-divider);
          font-size:11px;
          color:#9ca3af;
        }
        .admin-sidebar-footer a{
          color:#93c5fd;
        }
        .admin-sidebar-footer a:hover{
          color:var(--accent-orange);
        }

        .admin-main{
          flex:1;
          padding:22px 10px 10px;
          color:var(--text-main);
        }

        .admin-top-meta{
          display:flex;
          justify-content:space-between;
          align-items:flex-start;
          gap:10px;
          margin-bottom:16px;
        }
        .admin-top-left-title{
          font-size:24px;
          font-weight:800;
        }
        .admin-top-left-sub{
          font-size:14px;
          color:#9ca3af;
        }
        .admin-top-right{
          display:flex;
          align-items:center;
          gap:10px;
          font-size:12px;
        }
        .pill{
          border-radius:999px;
          padding:6px 12px;
          background:var(--chip-bg);
          border:1px solid var(--chip-border);
          color:var(--text-main);
          white-space:nowrap;
        }

        .breadcrumb{
          font-size:13px;
          color:#9ca3af;
          margin-bottom:10px;
        }
        .breadcrumb span.current{
          color:#f9fafb;
        }
        body.theme-light .breadcrumb span.current{
          color:#111827;
        }

        .panel{
          background:var(--card-bg);
          border-radius:18px;
          border:1px solid var(--card-border);
          padding:14px 16px 16px;
          box-shadow:0 16px 30px rgba(15,23,42,.85);
        }
        body.theme-light .panel{
          box-shadow:0 10px 25px rgba(148,163,184,0.45);
        }
        .panel-header{
          display:flex;
          justify-content:space-between;
          align-items:center;
          margin-bottom:12px;
        }
        .panel-title{
          font-size:15px;
          font-weight:600;
        }
        .panel-sub{
          font-size:12px;
          color:#9ca3af;
        }

        .stats-table{
          width:100%;
          border-collapse:collapse;
          margin-top:8px;
          font-size:13px;
        }
        .stats-table th,
        .stats-table td{
          padding:6px 6px;
          border-bottom:1px solid #1f2937;
          text-align:left;
        }
        .stats-table th{
          font-weight:500;
          color:#9ca3af;
          font-size:12px;
        }
        .text-muted{
          color:#9ca3af;
          font-size:12px;
        }

        .status-pill{
          padding:3px 9px;
          border-radius:999px;
          font-size:11px;
          font-weight:600;
          display:inline-block;
        }
        .status-pill.pending{
          background:rgba(251,191,36,0.2);
          color:#facc15;
        }
        .status-pill.approved{
          background:rgba(34,197,94,0.2);
          color:#4ade80;
        }
        .status-pill.rejected{
          background:rgba(248,113,22,0.2);
          color:#fdba74;
        }

        .btn{
          display:inline-flex;
          align-items:center;
          justify-content:center;
          border-radius:8px;
          border:none;
          padding:6px 12px;
          font-size:12px;
          font-weight:600;
          cursor:pointer;
          text-decoration:none;
        }
        .btn-detail{
          background:#0f172a;
          color:#e5e7eb;
          border:1px solid #1f2937;
        }
        .btn-detail:hover{
          background:#111827;
        }
        .btn-approve{
          background:#22c55e;
          color:#0b1120;
        }
        .btn-approve:hover{
          background:#16a34a;
        }
        .btn-reject{
          background:#ef4444;
          color:#f9fafb;
        }
        .btn-reject:hover{
          background:#dc2626;
        }

        body.theme-light .stats-table th,
        body.theme-light .admin-sidebar-sub,
        body.theme-light .admin-top-left-sub,
        body.theme-light .breadcrumb,
        body.theme-light .panel-sub,
        body.theme-light .admin-top-right,
        body.theme-light .pill{
          color:#4b5563;
        }

        @media(max-width:960px){
          .nav{
            padding:14px 16px;
          }
          .nav-search{display:none;}
          .admin-bg{
            padding:100px 16px 26px;
          }
          .admin-container{
            flex-direction:column;
          }
          .admin-sidebar{
            width:100%;
            height:auto;
          }
        }
        @media(max-width:780px){
          .admin-top-meta{
            flex-direction:column;
            align-items:flex-start;
            gap:6px;
          }
          .admin-top-right{
            flex-wrap:wrap;
          }
        }
    </style>
</head>

<body class="theme-dark">

{{-- NAVBAR --}}
<nav class="nav">
    <div class="nav-left">
        <a href="{{ route('home') }}" class="nav-logo">
            <img src="{{ asset('images/logo.png') }}" alt="kampuStore logo">
            <span>kampuStore</span>
        </a>

        <div class="nav-menu">
            <a href="{{ route('admin.dashboard') }}">Admin</a>
        </div>
    </div>

    <div class="nav-search" style="max-width:260px;">
        <input type="text" placeholder="Quick search (dummy)…" disabled>
    </div>

    <div class="header-right">
        {{-- THEME TOGGLE --}}
        <div class="theme-toggle-wrapper">
            <label class="toggle-switch">
                <input type="checkbox" class="js-theme-toggle">
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

        <div class="account-wrapper" id="accountWrapper">
            @php
                $name    = auth()->user()->name ?? 'Admin';
                $initial = strtoupper(mb_substr($name, 0, 1));
            @endphp

            <button class="icon-btn js-account-toggle" type="button" title="Akun Admin">
                <span class="icon-round">
                    {{ $initial }}
                </span>
            </button>

            <div class="account-menu" id="accountMenu">
                @auth
                    <div class="profile-info">
                        <div class="profile-name">{{ auth()->user()->name }}</div>
                        <div class="profile-role">Admin kampuStore</div>
                    </div>

                    <div class="profile-list">
                        <a href="{{ route('admin.dashboard') }}" class="profile-item">
                            <span>Dashboard Admin</span>
                        </a>
                        <a href="{{ route('admin.sellers.index') }}" class="profile-item">
                            <span>Pengajuan Toko</span>
                        </a>
                        <a href="{{ route('products.index') }}" class="profile-item">
                            <span>Kembali ke Market</span>
                        </a>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="custom-btn btn-auth-outline"
                                style="margin:6px 10px 4px;">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                       class="custom-btn btn-auth-outline"
                       style="margin:4px 10px 2px;">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="custom-btn"
                       style="margin:2px 10px 6px;
                              background:linear-gradient(135deg,#f97316,#fb923c,#f97316);
                              color:#111827;
                              box-shadow:0 10px 24px rgba(248,113,22,.55);">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

{{-- AREA ADMIN --}}
<main class="admin-bg">
    <div class="admin-container">
        {{-- SIDEBAR --}}
        <aside class="admin-sidebar">
            <div>
                <div class="admin-sidebar-title">Admin Panel</div>
                <div class="admin-sidebar-sub">
                    Kelola pengajuan buka toko dan pantau market.
                </div>
            </div>

            <div>
                <div class="admin-sidebar-section-title">Main Menu</div>
                <ul class="admin-menu">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="admin-link">
                            <span class="icon"><i class="uil uil-estate"></i></span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.sellers.index') }}" class="admin-link active">
                            <span class="icon"><i class="uil uil-store"></i></span>
                            <span>Pengajuan Toko</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <div class="admin-sidebar-section-title">Lainnya</div>
                <ul class="admin-menu">
                    <li>
                        <a href="{{ route('products.index') }}" class="admin-link">
                            <span class="icon"><i class="uil uil-shopping-bag"></i></span>
                            <span>Kembali ke Market</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="admin-sidebar-footer">
                kampuStore · {{ date('Y') }} <br>
                <a href="{{ route('home') }}">Lihat landing page</a>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <section class="admin-main">
            <div class="admin-top-meta">
                <div>
                    <div class="admin-top-left-title">Pengajuan Toko</div>
                    <div class="admin-top-left-sub">
                        Daftar pengajuan buka toko dari seller kampuStore.
                    </div>
                </div>
                <div class="admin-top-right">
                    <span class="pill">{{ now()->format('d M Y') }}</span>
                    <span class="pill">{{ $total }} pengajuan</span>
                </div>
            </div>

            <div class="breadcrumb">
                Admin &raquo; <span class="current">Pengajuan Toko</span>
            </div>

            <section class="panel">
                <header class="panel-header">
                    <div>
                        <div class="panel-title">Daftar Pengajuan</div>
                        <div class="panel-sub">
                            Lihat detail pengajuan, lalu approve atau reject.
                        </div>
                    </div>
                    <span class="pill">
                        Pending: {{ $pending }} · Approved: {{ $approved }} · Rejected: {{ $rejected }}
                    </span>
                </header>

                <table class="stats-table">
                    <thead>
                    <tr>
                        <th>Nama Toko</th>
                        <th>PIC</th>
                        <th>Kota</th>
                        <th>Status</th>
                        <th style="width:220px;">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($sellers as $seller)
                        <tr>
                            <td>
                                <strong>{{ $seller->nama_toko }}</strong><br>
                                <span class="text-muted">
                                    {{ $seller->deskripsi_singkat }}
                                </span>
                            </td>
                            <td>
                                <div>{{ $seller->nama_pic }}</div>
                                <div class="text-muted">
                                    {{ $seller->no_hp_pic }} · {{ $seller->email_pic }}
                                </div>
                            </td>
                            <td>{{ $seller->kota }}</td>
                            <td>
                                <span class="status-pill {{ $seller->status }}">
                                    {{ ucfirst($seller->status) }}
                                </span>
                            </td>
                            <td>
                                <div style="display:flex;flex-wrap:wrap;gap:6px;">
                                    <a href="{{ route('admin.sellers.show', $seller) }}"
                                       class="btn btn-detail">
                                        Detail
                                    </a>

                                    @if($seller->status === 'pending')
                                        <form action="{{ route('admin.sellers.approve', $seller) }}"
                                              method="POST"
                                              onsubmit="return confirmApprove(event);">
                                            @csrf
                                            <button type="submit" class="btn btn-approve">
                                                Approve
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.sellers.reject', $seller) }}"
                                              method="POST"
                                              onsubmit="return confirmReject(event);">
                                            @csrf
                                            <button type="submit" class="btn btn-reject">
                                                Reject
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">
                                            Sudah diverifikasi.
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;padding:18px 6px;">
                                <span class="text-muted">
                                    Belum ada pengajuan toko.
                                </span>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </section>
        </section>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success') || session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if(session('success'))
            Swal.fire({
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#f97316',
                confirmButtonText: 'OK'
            });
            @endif

            @if(session('error'))
            Swal.fire({
                title: 'Gagal!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonColor: '#ef4444',
                confirmButtonText: 'OK'
            });
            @endif
        });
    </script>
@endif

<script>
    // THEME TOGGLE – pakai key yang sama dengan Market
    (function(){
        const THEME_KEY = 'kampuStoreTheme';
        const body = document.body;
        const checkbox = document.querySelector('.js-theme-toggle');

        function applyTheme(mode){
            if(mode === 'light'){
                body.classList.add('theme-light');
            } else {
                body.classList.remove('theme-light');
            }
        }

        const saved = localStorage.getItem(THEME_KEY) || 'dark';
        applyTheme(saved);

        if(checkbox){
            // checked = dark, unchecked = light
            checkbox.checked = (saved !== 'light');

            checkbox.addEventListener('change', () => {
                const mode = checkbox.checked ? 'dark' : 'light';
                applyTheme(mode);
                localStorage.setItem(THEME_KEY, mode);
            });
        }
    })();
</script>

<script>
    // Dropdown akun (klik untuk buka/tutup)
    (function(){
        const accWrapper = document.getElementById('accountWrapper');
        if (!accWrapper) return;

        const accToggle  = accWrapper.querySelector('.js-account-toggle');
        const accMenu    = document.getElementById('accountMenu');

        function closeAcc(){
            accWrapper.classList.remove('is-open');
        }
        function openAcc(){
            accWrapper.classList.add('is-open');
        }

        if (accToggle && accMenu){
            accToggle.addEventListener('click', function(e){
                e.stopPropagation();
                const isOpen = accWrapper.classList.contains('is-open');
                if (isOpen){ closeAcc(); } else { openAcc(); }
            });

            accMenu.addEventListener('click', function(e){
                e.stopPropagation();
            });

            document.addEventListener('click', function(e){
                if (!accWrapper.contains(e.target)){
                    closeAcc();
                }
            });
        }
    })();

    function confirmApprove(e){
        e.preventDefault();
        Swal.fire({
            title:"Setujui Toko?",
            icon:"question",
            showCancelButton:true,
            confirmButtonText:"Ya, setujui",
            cancelButtonText:"Batal",
        }).then(r=>{
            if(r.isConfirmed){
                e.target.closest("form").submit();
            }
        });
    }

    function confirmReject(e){
        e.preventDefault();
        Swal.fire({
            title:"Tolak Pengajuan?",
            icon:"warning",
            showCancelButton:true,
            confirmButtonText:"Ya, tolak",
            cancelButtonText:"Batal",
        }).then(r=>{
            if(r.isConfirmed){
                e.target.closest("form").submit();
            }
        });
    }
</script>

</body>
</html>
