@php($title = 'Dashboard Admin | kampuStore')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --purple-dark: #4c1d95;
            --purple-medium: #7c3aed;
            --purple-light: #a78bfa;
            --indigo-dark: #4338ca;
            --indigo-medium: #6366f1;
            --orange: #f97316;
            --orange-light: #fb923c;
            --green: #10b981;
            --red: #ef4444;
            --yellow: #eab308;
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
        .nav-menu a.active{
          color:var(--accent-orange);
        }
        .nav-menu a.active::after{
          transform:scaleX(1);
          opacity:1;
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

        /* light mode – samain feel sama Market */
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

        /* light mode dropdown account */
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

        /* AVATAR KECIL DI NAV */
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

        /* SIDEBAR ADMIN */
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

        /* >>> FIX VISIBILITY DI LIGHT MODE <<< */
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
        /* <<< END FIX VISIBILITY <<< */

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

        /* MAIN CONTENT */
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

        .headline-filters{
          display:flex;
          justify-content:space-between;
          align-items:center;
          margin-bottom:18px;
          font-size:13px;
        }
        .chips-row{
          display:flex;
          gap:8px;
          flex-wrap:wrap;
        }
        .chip{
          padding:6px 10px;
          border-radius:999px;
          border:1px solid #374151;
          background:rgba(15,23,42,0.95);
          color:var(--text-main);
          font-size:13px;
        }
        body.theme-light .chip{
          border-color:#cbd5f5;
          background:#e3e6ff;
          color:#1f2937;
        }

        /* SUMMARY CARDS */
        .summary-grid{
          display:grid;
          grid-template-columns:repeat(3,minmax(0,1fr));
          gap:16px;
          margin-bottom:18px;
        }

        .summary-card{
          border-radius:18px;
          padding:14px 16px 16px;
          background:radial-gradient(circle at top left,#111827,#020617 70%);
          border:1px solid var(--card-border);
          box-shadow:0 16px 30px rgba(15,23,42,.85);
          position:relative;
          overflow:hidden;
        }
        body.theme-light .summary-card{
          background:var(--card-bg);
          box-shadow:0 10px 25px rgba(148,163,184,0.45);
        }
        .summary-card::after{
          content:'';
          position:absolute;
          right:-30px;
          top:-40px;
          width:120px;
          height:120px;
          border-radius:999px;
          background:radial-gradient(circle,#4f46e5,#7e22ce 60%,transparent);
          opacity:.18;
        }

        .summary-label{
          font-size:13px;
          color:#9ca3af;
          margin-bottom:4px;
        }
        .summary-value{
          font-size:28px;
          font-weight:700;
        }
        .summary-extra{
          font-size:12px;
          margin-top:4px;
        }

        .summary-badge{
          display:inline-flex;
          align-items:center;
          gap:4px;
          padding:3px 7px;
          font-size:11px;
          border-radius:999px;
        }
        .badge-pending{
          background:rgba(251,191,36,0.15);
          color:#fde68a;
        }
        .badge-approved{
          background:rgba(34,197,94,0.18);
          color:#bbf7d0;
        }
        .badge-rejected{
          background:rgba(248,113,22,0.16);
          color:#fed7aa;
        }

        /* LOWER GRID (chart dummy + donut) */
        .lower-grid{
          display:grid;
          grid-template-columns:2fr 1.7fr;
          gap:16px;
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

        .bar-chart{
          display:flex;
          align-items:flex-end;
          gap:10px;
          height:160px;
          margin-top:4px;
        }
        .bar{
          flex:1;
          border-radius:8px 8px 2px 2px;
          background:linear-gradient(180deg,#a855f7,#4f46e5);
        }
        .bar-label{
          font-size:11px;
          text-align:center;
          margin-top:4px;
          color:#9ca3af;
        }

        .donut-wrapper{
          display:flex;
          align-items:center;
          gap:16px;
          margin-top:4px;
        }
        .donut{
          width:130px;
          height:130px;
          border-radius:999px;
          background:
            radial-gradient(circle at center,#020617 55%,transparent 56%),
            conic-gradient(#22c55e 0deg var(--deg-approved),
                           #eab308 var(--deg-approved) var(--deg-approved-pending),
                           #ef4444 var(--deg-approved-pending) 360deg);
          box-shadow:0 10px 25px rgba(15,23,42,.9);
        }
        body.theme-light .donut{
          background:
            radial-gradient(circle at center,#eef2ff 55%,transparent 56%),
            conic-gradient(#22c55e 0deg var(--deg-approved),
                           #eab308 var(--deg-approved) var(--deg-approved-pending),
                           #ef4444 var(--deg-approved-pending) 360deg);
        }

        .donut-text{
          font-size:12px;
          color:#9ca3af;
        }
        .donut-text-main{
          font-size:18px;
          font-weight:700;
          margin-bottom:4px;
          color:#f9fafb;
        }
        body.theme-light .donut-text-main{
          color:#111827;
        }

        .legend{
          font-size:11px;
          margin-top:6px;
        }
        .legend-row{
          display:flex;
          align-items:center;
          gap:6px;
          margin-bottom:3px;
        }
        .legend-dot{
          width:10px;
          height:10px;
          border-radius:999px;
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

        .status-pill{
          padding:2px 7px;
          border-radius:999px;
          font-size:11px;
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

        /* ===== IMPROVE LIGHT MODE READABILITY ===== */
        body.theme-light .admin-sidebar-sub,
        body.theme-light .admin-top-left-sub,
        body.theme-light .breadcrumb,
        body.theme-light .headline-filters div,
        body.theme-light .panel-sub,
        body.theme-light .bar-label,
        body.theme-light .stats-table th,
        body.theme-light .donut-text,
        body.theme-light .admin-top-right,
        body.theme-light .pill,
        body.theme-light .summary-label{
          color:#4b5563;
        }

        /* RESPONSIVE */
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
          .summary-grid{
            grid-template-columns:1fr;
          }
          .lower-grid{
            grid-template-columns:1fr;
          }
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
            <a href="{{ route('admin.dashboard') }}" class="active">Admin</a>
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
            <button class="icon-btn js-account-toggle" type="button" title="Akun Admin">
                <span class="icon-round">
                    @php($initial = strtoupper(substr(auth()->user()->name ?? 'A',0,1)))
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
                        <a href="{{ route('admin.dashboard') }}" class="admin-link active">
                            <span class="icon"><i class="uil uil-estate"></i></span>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.sellers.index') }}" class="admin-link">
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
                    <div class="admin-top-left-title">Dashboard Admin</div>
                    <div class="admin-top-left-sub">
                        Ringkasan cepat pengajuan buka toko di kampuStore.
                    </div>
                </div>
                <div class="admin-top-right">
                    <span class="pill">{{ now()->format('d M Y') }}</span>
                    <span class="pill">{{ $total }} total pengajuan</span>
                </div>
            </div>

            <div class="breadcrumb">
                Admin &raquo; <span class="current">Dashboard</span>
            </div>

            <div class="headline-filters">
                <div style="color:#9ca3af;">
                    Lihat performa pengajuan toko hari ini.
                </div>
                <div class="chips-row">
                    <span class="chip">Periode: Bulan ini (mock)</span>
                    <span class="chip">Segment: Semua status</span>
                </div>
            </div>

            {{-- SUMMARY CARDS --}}
            <section class="summary-grid">
                <article class="summary-card">
                    <div class="summary-label">Pengajuan Pending</div>
                    <div class="summary-value">{{ $pending }}</div>
                    <div class="summary-extra">
                        <span class="summary-badge badge-pending">
                            • {{ $pPct }}% dari total
                        </span>
                    </div>
                </article>

                <article class="summary-card">
                    <div class="summary-label">Toko Disetujui</div>
                    <div class="summary-value">{{ $approved }}</div>
                    <div class="summary-extra">
                        <span class="summary-badge badge-approved">
                            • {{ $aPct }}% dari total
                        </span>
                    </div>
                </article>

                <article class="summary-card">
                    <div class="summary-label">Pengajuan Ditolak</div>
                    <div class="summary-value">{{ $rejected }}</div>
                    <div class="summary-extra">
                        <span class="summary-badge badge-rejected">
                            • {{ $rPct }}% dari total
                        </span>
                    </div>
                </article>
            </section>

            {{-- LOWER GRID --}}
            <section
                class="lower-grid"
                style="--deg-approved: {{ 3.6 * $aPct }}deg;
                       --deg-approved-pending: {{ 3.6 * ($aPct + $pPct) }}deg;"
            >
                {{-- BAR CHART DUMMY --}}
                <article class="panel">
                    <header class="panel-header">
                        <div>
                            <div class="panel-title">Distribusi Status Pengajuan</div>
                            <div class="panel-sub">
                                Visual dummy agar mirip dashboard modern (angka diambil dari data asli).
                            </div>
                        </div>
                        <span class="pill">Update terakhir: {{ now()->format('H:i') }}</span>
                    </header>

                    <div class="bar-chart">
                        <div style="flex:1;">
                            <div class="bar"
                                 style="height:{{ max(18,$pPct) }}%;"></div>
                            <div class="bar-label">Pending</div>
                        </div>
                        <div style="flex:1;">
                            <div class="bar"
                                 style="height:{{ max(18,$aPct) }}%;
                                        background:linear-gradient(180deg,#22c55e,#16a34a);"></div>
                            <div class="bar-label">Approved</div>
                        </div>
                        <div style="flex:1;">
                            <div class="bar"
                                 style="height:{{ max(18,$rPct) }}%;
                                        background:linear-gradient(180deg,#f97316,#b91c1c);"></div>
                            <div class="bar-label">Rejected</div>
                        </div>
                    </div>
                </article>

                {{-- DONUT + TABLE --}}
                <article class="panel">
                    <header class="panel-header">
                        <div>
                            <div class="panel-title">Ringkasan Singkat</div>
                            <div class="panel-sub">
                                Total pengajuan dan proporsi tiap status.
                            </div>
                        </div>
                    </header>

                    <div class="donut-wrapper">
                        <div class="donut"></div>
                        <div class="donut-text">
                            <div class="donut-text-main">
                                {{ $total }} pengajuan
                            </div>
                            <div class="legend">
                                <div class="legend-row">
                                    <span class="legend-dot" style="background:#22c55e;"></span>
                                    <span>Approved: {{ $approved }} ({{ $aPct }}%)</span>
                                </div>
                                <div class="legend-row">
                                    <span class="legend-dot" style="background:#eab308;"></span>
                                    <span>Pending: {{ $pending }} ({{ $pPct }}%)</span>
                                </div>
                                <div class="legend-row">
                                    <span class="legend-dot" style="background:#ef4444;"></span>
                                    <span>Rejected: {{ $rejected }} ({{ $rPct }}%)</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="stats-table">
                        <thead>
                        <tr>
                            <th>Status</th>
                            <th>Jumlah</th>
                            <th>Persentase</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><span class="status-pill pending">Pending</span></td>
                            <td>{{ $pending }}</td>
                            <td>{{ $pPct }}%</td>
                        </tr>
                        <tr>
                            <td><span class="status-pill approved">Approved</span></td>
                            <td>{{ $approved }}</td>
                            <td>{{ $aPct }}%</td>
                        </tr>
                        <tr>
                            <td><span class="status-pill rejected">Rejected</span></td>
                            <td>{{ $rejected }}</td>
                            <td>{{ $rPct }}%</td>
                        </tr>
                        </tbody>
                    </table>
                </article>
            </section>
        </section>
    </div>
</main>

{{-- SweetAlert untuk flash message global --}}
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
</script>

</body>
</html>
