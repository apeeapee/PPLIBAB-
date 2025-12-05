@php
    $title = 'Market - kampuStore';
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
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

          --sidebar-bg:rgba(15,23,42,0.96);
          --sidebar-border:rgba(59,130,246,0.65);
          --sidebar-text:#e5e7eb;

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

          --sidebar-bg:#ffffff;
          --sidebar-border:#cfd6f5;
          --sidebar-text:#1f2b60;

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
        .nav-menu a.active{color:#f97316;}
        .nav-menu a.active::after{transform:scaleX(1);opacity:1;}

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

        /* ===================== MAIN CONTAINER ===================== */
        .market-container{
            max-width:1400px;
            margin:0 auto;
            padding:100px 24px 40px;
        }

        /* ===================== SIDEBAR ===================== */
        .sidebar{
            background:var(--sidebar-bg);
            border-radius:16px;
            padding:24px;
            border:1px solid var(--sidebar-border);
            box-shadow:0 10px 40px rgba(0,0,0,0.3);
            position:sticky;
            top:100px;
            max-height:calc(100vh - 120px);
            overflow-y:auto;
        }
        .sidebar::-webkit-scrollbar{width:6px;}
        .sidebar::-webkit-scrollbar-track{background:transparent;border-radius:10px;}
        .sidebar::-webkit-scrollbar-thumb{background:#4b5563;border-radius:10px;}
        
        .filter-section{
            margin-bottom:28px;
            padding-bottom:20px;
            border-bottom:1px solid rgba(148,163,184,0.3);
        }
        .filter-section:last-child{border-bottom:none;}
        
        .filter-title{
            font-size:15px;font-weight:700;
            color:var(--page-title-color);
            margin-bottom:14px;
            display:flex;align-items:center;gap:8px;
        }
        
        .filter-option{
            display:flex;align-items:center;gap:10px;
            padding:8px 0;cursor:pointer;
            font-size:14px;color:var(--section-text);
            transition:color .2s;
        }
        .filter-option:hover{color:#f97316;}
        .filter-option input[type="checkbox"]{
            width:18px;height:18px;
            border-radius:4px;cursor:pointer;
            accent-color:#f97316;
        }
        
        .filter-input{
            width:100%;padding:10px 14px;
            border:1px solid var(--sidebar-border);
            border-radius:10px;font-size:14px;
            background:var(--card-bg);
            color:var(--text-main);
            transition:all .3s;
        }
        .filter-input:focus{
            outline:none;
            border-color:#f97316;
            box-shadow:0 0 0 2px rgba(249,115,22,0.2);
        }
        
        .btn-filter{
            width:100%;padding:10px;
            background:#f97316;color:#111827;
            border:none;border-radius:10px;
            font-size:13px;font-weight:600;
            cursor:pointer;transition:all .3s;
            display:inline-flex;align-items:center;justify-content:center;gap:6px;
        }
        .btn-filter:hover{background:#fb923c;}
        
        /* Location Filter Dropdown */
        .location-filter-group{margin-bottom:10px;}
        .filter-select{
            width:100%;padding:10px 14px;
            border:1px solid var(--sidebar-border);
            border-radius:10px;font-size:13px;
            background:var(--card-bg);
            color:var(--text-main);
            transition:all .3s;
            cursor:pointer;
            appearance:none;
            background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%239ca3af' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat:no-repeat;
            background-position:right 12px center;
            padding-right:32px;
        }
        .filter-select:focus{
            outline:none;
            border-color:#f97316;
            box-shadow:0 0 0 2px rgba(249,115,22,0.2);
        }
        .filter-select:disabled{
            opacity:0.6;
            cursor:not-allowed;
            background-color:var(--sidebar-bg);
        }
        .filter-select option{
            background:var(--card-bg);
            color:var(--text-main);
            padding:8px;
        }
        .location-active-filter{
            display:flex;align-items:center;gap:6px;
            padding:8px 12px;margin-bottom:10px;
            background:rgba(249,115,22,0.1);
            border:1px solid rgba(249,115,22,0.3);
            border-radius:8px;font-size:12px;
            color:#f97316;
        }
        .location-active-filter i{font-size:14px;}
        
        .btn-reset{
            width:100%;padding:12px;
            background:rgba(239,68,68,0.1);
            color:#ef4444;border:1px solid rgba(239,68,68,0.3);
            border-radius:10px;font-weight:600;
            cursor:pointer;transition:all .3s;
            font-size:14px;display:block;text-align:center;
        }
        .btn-reset:hover{
            background:#ef4444;color:white;
        }

        /* ===================== WELCOME BANNER ===================== */
        .welcome-banner{
            background:var(--card-bg);
            border-radius:16px;padding:28px;
            margin-bottom:32px;
            border:1px solid var(--card-border);
            box-shadow:0 10px 40px rgba(0,0,0,0.3);
        }
        .welcome-title{
            font-size:28px;font-weight:800;
            color:var(--page-title-color);margin-bottom:8px;
        }
        .welcome-subtitle{
            font-size:15px;color:var(--section-text);
        }
        
        .info-box{
            background:rgba(249,115,22,0.1);
            border:1px solid rgba(249,115,22,0.3);
            border-radius:12px;padding:16px;margin-top:16px;
        }
        .info-box-title{
            font-weight:700;color:#f97316;
            margin-bottom:6px;display:flex;
            align-items:center;gap:6px;
        }
        .info-box-text{
            font-size:14px;color:var(--section-text);margin-bottom:12px;
        }
        
        .btn-cta{
            display:inline-flex;align-items:center;gap:8px;
            padding:10px 20px;background:#f97316;
            color:#111827;border-radius:50px;
            font-size:13px;font-weight:600;
            transition:all .3s;
        }
        .btn-cta:hover{
            transform:translateY(-2px);
            box-shadow:0 6px 20px rgba(249,115,22,0.4);
        }

        /* ===================== PRODUCT GRID ===================== */
        .product-grid{
            display:grid;
            grid-template-columns:repeat(auto-fill, minmax(250px, 1fr));
            gap:24px;
        }
        
        .product-card{
            background:var(--card-bg);
            border-radius:16px;overflow:hidden;
            border:1px solid var(--card-border);
            box-shadow:0 4px 20px rgba(0,0,0,0.2);
            transition:all .3s cubic-bezier(0.4,0,0.2,1);
            display:flex;flex-direction:column;
        }
        .product-card:hover{
            transform:translateY(-8px);
            border-color:var(--card-border-hover);
            box-shadow:0 20px 40px rgba(0,0,0,0.3);
        }
        
        .product-image{
            position:relative;aspect-ratio:1;
            overflow:hidden;
            background:linear-gradient(135deg,#1e3a8a 20%,#7c3aed 100%);
        }
        .product-image img{
            width:100%;height:100%;
            object-fit:cover;transition:transform .5s;
        }
        .product-card:hover .product-image img{transform:scale(1.1);}
        
        .product-badge{
            position:absolute;top:12px;left:12px;
            padding:6px 12px;border-radius:20px;
            font-size:11px;font-weight:700;
            text-transform:uppercase;
            letter-spacing:.5px;
        }
        .product-badge.baru{
            background:rgba(34,197,94,0.95);
            color:#fff;
        }
        .product-badge.bekas{
            background:rgba(251,191,36,0.95);
            color:#111827;
        }
        
        .product-info{
            padding:18px;flex:1;
            display:flex;flex-direction:column;
        }
        .product-name{
            font-size:16px;font-weight:700;
            color:var(--page-title-color);
            margin-bottom:8px;line-height:1.4;
            display:-webkit-box;
            -webkit-line-clamp:2;
            -webkit-box-orient:vertical;
            overflow:hidden;
        }
        .product-seller{
            font-size:13px;color:var(--section-text);
            margin-bottom:12px;
            display:flex;align-items:center;gap:4px;
        }
        .product-price{
            font-size:20px;font-weight:800;
            color:#f97316;margin-top:auto;
        }
        .product-stock{
            font-size:12px;color:#22c55e;
            margin-top:6px;display:flex;
            align-items:center;gap:4px;
        }
        .product-stock.low{color:#ef4444;}

        /* ===================== NO PRODUCTS ===================== */
        .no-products{
            background:var(--card-bg);
            border-radius:16px;padding:80px 40px;
            text-align:center;
            border:1px solid var(--card-border);
            box-shadow:0 10px 40px rgba(0,0,0,0.2);
        }
        .no-products i{
            font-size:80px;color:#4b5563;margin-bottom:20px;
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
        .btn-login:hover{
            background:#f97316;color:#111827;
        }
        .btn-register{
            background:#f97316;color:#111827;
            border:2px solid #f97316;
        }
        .btn-register:hover{
            background:#fb923c;border-color:#fb923c;
        }
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
        .user-role{font-size:11px;color:#f97316;}
        .dropdown-arrow{font-size:12px;color:var(--text-main);transition:transform .2s;}
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
        .dropdown-header-name{font-size:14px;font-weight:600;color:var(--page-title-color);}
        .dropdown-header-email{font-size:12px;color:var(--section-text);margin-top:2px;}
        .dropdown-item{
            display:flex;align-items:center;gap:10px;
            padding:10px 12px;border-radius:8px;
            color:var(--page-title-color);font-size:13px;
            transition:all .2s;cursor:pointer;
        }
        .dropdown-item:hover{background:rgba(249,115,22,0.1);color:#f97316;}
        .dropdown-item i{font-size:16px;width:20px;text-align:center;}
        .dropdown-divider{height:1px;background:var(--card-border);margin:8px 0;}
        .dropdown-item.logout{color:#ef4444;}
        .dropdown-item.logout:hover{background:rgba(239,68,68,0.1);color:#ef4444;}

        /* ===================== FOOTER ===================== */
        .footer{
            background:var(--footer-bg);
            border-top:1px solid var(--footer-border);
            padding:24px 0;text-align:center;
            font-size:14px;color:var(--footer-text);
            margin-top:80px;
        }
        .footer strong{color:#f97316;font-weight:700;}

        /* ===================== GRID LAYOUT ===================== */
        .main-grid{
            display:grid;
            grid-template-columns:280px 1fr;
            gap:32px;align-items:start;
        }

        .results-info{
            margin-bottom:20px;padding:12px 20px;
            background:var(--card-bg);border-radius:12px;
            border:1px solid var(--card-border);
            color:var(--section-text);font-size:14px;
        }
        .results-info strong{color:#f97316;}

        /* ===================== SEARCH BAR IN NAVBAR ===================== */
        .nav-search{
            display:flex;align-items:center;
            flex:1;max-width:500px;margin:0 24px;
        }
        .nav-search-form{
            display:flex;width:100%;
            position:relative;
        }
        .nav-search-input{
            width:100%;padding:10px 44px 10px 16px;
            background:var(--card-bg);
            border:1px solid var(--card-border);
            border-radius:50px;
            font-size:14px;color:var(--text-main);
            transition:all .3s;
        }
        .nav-search-input::placeholder{color:var(--section-text);}
        .nav-search-input:focus{
            outline:none;
            border-color:#f97316;
            box-shadow:0 0 0 3px rgba(249,115,22,0.15);
        }
        .nav-search-btn{
            position:absolute;right:4px;top:50%;
            transform:translateY(-50%);
            width:32px;height:32px;
            background:#f97316;color:#111827;
            border:none;border-radius:50%;
            cursor:pointer;transition:all .2s;
            display:flex;align-items:center;justify-content:center;
        }
        .nav-search-btn:hover{
            background:#fb923c;
        }
        .nav-search-btn i{font-size:16px;}
        
        .search-tag{
            display:inline-flex;align-items:center;gap:6px;
            padding:6px 14px;
            background:rgba(249,115,22,0.15);
            border:1px solid rgba(249,115,22,0.3);
            border-radius:50px;font-size:13px;
            color:#f97316;margin-bottom:16px;
        }
        .search-tag a{
            color:#ef4444;font-weight:600;
            margin-left:4px;
        }
        .search-tag a:hover{text-decoration:underline;}

        /* ===================== FLOATING CHAT BUTTON ===================== */
        .chat-float-btn{
            position:fixed;
            bottom:24px;
            right:24px;
            width:60px;
            height:60px;
            border-radius:50%;
            background:linear-gradient(135deg,#f97316,#fb923c);
            border:none;
            cursor:pointer;
            box-shadow:0 4px 20px rgba(249,115,22,0.4);
            display:flex;
            align-items:center;
            justify-content:center;
            z-index:1000;
            transition:all .3s ease;
        }
        .chat-float-btn:hover{
            transform:scale(1.1);
            box-shadow:0 6px 30px rgba(249,115,22,0.5);
        }
        .chat-float-btn i{
            font-size:28px;
            color:#fff;
        }
        .chat-float-btn .chat-badge{
            position:absolute;
            top:-2px;
            right:-2px;
            width:18px;
            height:18px;
            background:#22c55e;
            border-radius:50%;
            border:2px solid #fff;
        }

        /* Chat Window */
        .chat-window{
            position:fixed;
            bottom:100px;
            right:24px;
            width:380px;
            max-width:calc(100vw - 48px);
            height:500px;
            max-height:calc(100vh - 140px);
            background:var(--card-bg);
            border:1px solid var(--card-border);
            border-radius:20px;
            box-shadow:0 10px 50px rgba(0,0,0,0.3);
            display:none;
            flex-direction:column;
            z-index:1001;
            overflow:hidden;
        }
        .chat-window.open{
            display:flex;
            animation:chatSlideIn .3s ease;
        }
        @keyframes chatSlideIn{
            from{opacity:0;transform:translateY(20px) scale(0.95);}
            to{opacity:1;transform:translateY(0) scale(1);}
        }

        .chat-header{
            background:linear-gradient(135deg,#f97316,#fb923c);
            padding:16px 20px;
            display:flex;
            align-items:center;
            gap:12px;
        }
        .chat-header-avatar{
            width:40px;
            height:40px;
            background:rgba(255,255,255,0.2);
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
        }
        .chat-header-avatar i{
            font-size:22px;
            color:#fff;
        }
        .chat-header-info{
            flex:1;
        }
        .chat-header-title{
            font-size:15px;
            font-weight:700;
            color:#fff;
        }
        .chat-header-status{
            font-size:11px;
            color:rgba(255,255,255,0.8);
            display:flex;
            align-items:center;
            gap:4px;
        }
        .chat-header-status::before{
            content:'';
            width:6px;
            height:6px;
            background:#22c55e;
            border-radius:50%;
        }
        .chat-close-btn{
            background:rgba(255,255,255,0.2);
            border:none;
            width:32px;
            height:32px;
            border-radius:50%;
            cursor:pointer;
            display:flex;
            align-items:center;
            justify-content:center;
            transition:background .2s;
        }
        .chat-close-btn:hover{
            background:rgba(255,255,255,0.3);
        }
        .chat-close-btn i{
            font-size:18px;
            color:#fff;
        }

        .chat-messages{
            flex:1;
            padding:16px;
            overflow-y:auto;
            display:flex;
            flex-direction:column;
            gap:12px;
        }
        .chat-messages::-webkit-scrollbar{width:6px;}
        .chat-messages::-webkit-scrollbar-track{background:transparent;}
        .chat-messages::-webkit-scrollbar-thumb{background:var(--card-border);border-radius:3px;}

        .chat-message{
            max-width:85%;
            padding:12px 16px;
            border-radius:16px;
            font-size:14px;
            line-height:1.5;
        }
        .chat-message.bot{
            align-self:flex-start;
            background:var(--sidebar-bg);
            border:1px solid var(--card-border);
            color:var(--text-main);
            border-bottom-left-radius:4px;
        }
        .chat-message.user{
            align-self:flex-end;
            background:linear-gradient(135deg,#f97316,#fb923c);
            color:#fff;
            border-bottom-right-radius:4px;
        }
        .chat-message.typing{
            display:flex;
            gap:4px;
            padding:16px 20px;
        }
        .chat-message.typing span{
            width:8px;
            height:8px;
            background:var(--text-muted);
            border-radius:50%;
            animation:typingDot 1.4s infinite;
        }
        .chat-message.typing span:nth-child(2){animation-delay:.2s;}
        .chat-message.typing span:nth-child(3){animation-delay:.4s;}
        @keyframes typingDot{
            0%,60%,100%{transform:translateY(0);}
            30%{transform:translateY(-6px);}
        }

        .chat-suggestions{
            display:flex;
            flex-wrap:wrap;
            gap:8px;
            padding:0 16px 12px;
        }
        .chat-suggestion{
            padding:8px 14px;
            background:var(--sidebar-bg);
            border:1px solid var(--card-border);
            border-radius:20px;
            font-size:12px;
            color:var(--text-main);
            cursor:pointer;
            transition:all .2s;
        }
        .chat-suggestion:hover{
            border-color:#f97316;
            color:#f97316;
        }

        .chat-input-area{
            padding:12px 16px;
            border-top:1px solid var(--card-border);
            display:flex;
            gap:10px;
        }
        .chat-input{
            flex:1;
            padding:12px 16px;
            background:var(--sidebar-bg);
            border:1px solid var(--card-border);
            border-radius:24px;
            font-size:14px;
            color:var(--text-main);
            outline:none;
            transition:border-color .2s;
        }
        .chat-input::placeholder{color:var(--section-text);}
        .chat-input:focus{border-color:#f97316;}
        .chat-send-btn{
            width:44px;
            height:44px;
            background:linear-gradient(135deg,#f97316,#fb923c);
            border:none;
            border-radius:50%;
            cursor:pointer;
            display:flex;
            align-items:center;
            justify-content:center;
            transition:transform .2s;
        }
        .chat-send-btn:hover{transform:scale(1.05);}
        .chat-send-btn i{font-size:18px;color:#fff;}

        /* ===================== PAGINATION ===================== */
        nav[role="navigation"]{
            display:flex;
            justify-content:center;
            align-items:center;
            margin-top:40px;
            padding:20px 0;
        }
        nav[role="navigation"] .pagination{
            display:inline-flex;
            gap:8px;
            list-style:none;
            padding:8px 12px;
            margin:0;
            background:var(--card-bg);
            border:1px solid var(--card-border);
            border-radius:16px;
            box-shadow:0 8px 24px rgba(0,0,0,0.15);
        }
        nav[role="navigation"] .page-item{display:block;}
        nav[role="navigation"] .page-link{
            display:flex;
            align-items:center;
            justify-content:center;
            min-width:42px;
            height:42px;
            padding:0 12px;
            background:transparent;
            border:none;
            border-radius:10px;
            color:var(--section-text);
            font-size:15px;
            font-weight:600;
            text-decoration:none;
            transition:all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            position:relative;
        }
        nav[role="navigation"] .page-link:hover{
            background:rgba(249,115,22,0.1);
            color:#f97316;
            transform:translateY(-2px);
        }
        nav[role="navigation"] .page-item.active .page-link{
            background:linear-gradient(135deg,#f97316,#fb923c);
            color:white;
            box-shadow:0 4px 16px rgba(249,115,22,0.35),
                       inset 0 1px 0 rgba(255,255,255,0.2);
            transform:scale(1.05);
        }
        nav[role="navigation"] .page-item.active .page-link:hover{
            transform:scale(1.05) translateY(-1px);
        }
        nav[role="navigation"] .page-item.disabled .page-link{
            opacity:0.3;
            cursor:not-allowed;
            background:transparent;
            color:var(--section-text);
        }
        nav[role="navigation"] .page-item.disabled .page-link:hover{
            transform:none;
            background:transparent;
        }
        /* Pagination arrows */
        nav[role="navigation"] .page-link svg{
            width:14px;
            height:14px;
        }
        /* Dots styling */
        nav[role="navigation"] .page-link:has(span:contains('...')){
            pointer-events:none;
            min-width:32px;
        }

        /* ===================== RESPONSIVE ===================== */
        @media(max-width:1024px){
            .market-container{padding:140px 16px 40px;}
            .sidebar{position:static;margin-bottom:24px;max-height:none;}
            .main-grid{grid-template-columns:1fr;}
            .product-grid{grid-template-columns:repeat(auto-fill, minmax(200px, 1fr));gap:16px;}
            .nav-search{max-width:300px;margin:0 16px;}
        }
        @media(max-width:900px){
            .nav{padding:14px 18px;flex-wrap:wrap;gap:12px;}
            .nav-left{gap:18px;}
            .nav-menu{gap:18px;font-size:13px;}
            .nav-search{order:3;flex:1 1 100%;max-width:100%;margin:8px 0 0 0;}
        }
        @media(max-width:640px){
            .product-grid{grid-template-columns:repeat(2, 1fr);}
            .nav-menu{display:none;}
            nav[role="navigation"] .page-link{min-width:32px;height:32px;padding:4px 8px;font-size:13px;}
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
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('home') }}#features">Features</a>
            <a href="{{ route('products.index') }}" class="active">Market</a>
            <a href="{{ route('home') }}#about">About</a>
            <a href="{{ route('home') }}#contact">Contact</a>
        </div>
    </div>
    
    {{-- Search Bar --}}
    <div class="nav-search">
        <form method="GET" action="{{ route('products.index') }}" class="nav-search-form">
            <input type="text" name="q" value="{{ $q }}" class="nav-search-input" placeholder="Cari produk, toko...">
            <button type="submit" class="nav-search-btn">
                <i class="uil uil-search"></i>
            </button>
        </form>
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

        @auth
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
        @endauth
    </div>
</nav>

<div class="market-container">
    {{-- Welcome Banner --}}
    <div class="welcome-banner">
        @auth
            <div class="welcome-title">Selamat datang, {{ auth()->user()->name }}!</div>
            <div class="welcome-subtitle">Temukan kebutuhan kampus dari sesama mahasiswa UNDIP</div>
        @else
            <div class="welcome-title">Selamat datang di kampuStore!</div>
            <div class="welcome-subtitle">Belanja perlengkapan kampus dari mahasiswa UNDIP - langsung beli tanpa perlu login!</div>
            
            <div class="info-box">
                <div class="info-box-title">
                    <i class="uil uil-info-circle"></i>
                    Ingin Berjualan?
                </div>
                <div class="info-box-text">
                    Daftar sebagai penjual untuk mulai jualan di kampuStore!
                </div>
                <a href="{{ route('register') }}" class="btn-cta">
                    Daftar Sekarang
                    <i class="uil uil-arrow-right"></i>
                </a>
            </div>
        @endauth
    </div>

    {{-- Main Grid: Sidebar + Products --}}
    <div class="main-grid">
        {{-- Sidebar Filter --}}
        <aside class="sidebar">
            <form method="GET" action="{{ route('products.index') }}" id="filterForm">
                @if($q)
                    <input type="hidden" name="q" value="{{ $q }}">
                @endif
                
                {{-- Kategori --}}
                <div class="filter-section">
                    <div class="filter-title">
                        <i class="uil uil-apps"></i> Kategori
                    </div>
                    @foreach($allCats as $c)
                        <label class="filter-option">
                            <input type="checkbox" name="cat[]" value="{{ $c['slug'] }}" 
                                {{ in_array($c['slug'], $cats) ? 'checked' : '' }}
                                onchange="document.getElementById('filterForm').submit()">
                            <span>{{ $c['name'] }}</span>
                        </label>
                    @endforeach
                </div>
                
                {{-- Harga --}}
                <div class="filter-section">
                    <div class="filter-title">
                        <i class="uil uil-money-bill"></i> Harga
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:10px;">
                        <input type="number" name="pmin" placeholder="Min" value="{{ $priceMin }}" class="filter-input" min="0">
                        <input type="number" name="pmax" placeholder="Max" value="{{ $priceMax }}" class="filter-input" min="0">
                    </div>
                    <button type="submit" class="btn-filter">Terapkan</button>
                </div>
                
                {{-- Kondisi --}}
                <div class="filter-section">
                    <div class="filter-title">
                        <i class="uil uil-tag-alt"></i> Kondisi
                    </div>
                    <label class="filter-option">
                        <input type="checkbox" name="cond[]" value="baru" 
                            {{ in_array('baru', $cond) ? 'checked' : '' }}
                            onchange="document.getElementById('filterForm').submit()">
                        <span>Baru</span>
                    </label>
                    <label class="filter-option">
                        <input type="checkbox" name="cond[]" value="bekas" 
                            {{ in_array('bekas', $cond) ? 'checked' : '' }}
                            onchange="document.getElementById('filterForm').submit()">
                        <span>Bekas</span>
                    </label>
                </div>
                
                {{-- Stok --}}
                <div class="filter-section">
                    <div class="filter-title">
                        <i class="uil uil-layers"></i> Ketersediaan
                    </div>
                    <label class="filter-option">
                        <input type="checkbox" name="in_stock" value="1" 
                            {{ $inStock ? 'checked' : '' }}
                            onchange="document.getElementById('filterForm').submit()">
                        <span>Stok Tersedia</span>
                    </label>
                </div>
                
                {{-- Filter Lokasi Penjual --}}
                <div class="filter-section">
                    <div class="filter-title">
                        <i class="uil uil-map-marker"></i> Lokasi Penjual
                    </div>
                    
                    <div class="location-filter-group">
                        <select name="provinsi" id="filterProvinsi" class="filter-select">
                            <option value="">Semua Provinsi</option>
                        </select>
                    </div>
                </div>
                
                {{-- Reset --}}
                <a href="{{ route('products.index') }}" class="btn-reset">
                    <i class="uil uil-redo"></i> Reset Filter
                </a>
            </form>
        </aside>

        {{-- Products Grid --}}
        <main>
            @if($q)
                <div class="search-tag">
                    <i class="uil uil-search"></i>
                    Hasil pencarian: "<strong>{{ $q }}</strong>"
                    <a href="{{ route('products.index', array_filter([
                        'cat' => $cats ?: null,
                        'cond' => $cond ?: null,
                        'pmin' => $priceMin ?: null,
                        'pmax' => $priceMax ?: null,
                        'in_stock' => $inStock ? 1 : null,
                    ])) }}">
                        <i class="uil uil-times"></i> Hapus
                    </a>
                </div>
            @endif

            @if($products->isEmpty())
                <div class="no-products">
                    <i class="uil uil-shopping-bag"></i>
                    <h3 style="font-size:22px;font-weight:700;color:var(--page-title-color);margin-bottom:8px;">
                        Tidak ada produk ditemukan
                    </h3>
                    <p style="color:var(--section-text);font-size:14px;margin-bottom:20px;">
                        Coba ubah filter atau kata kunci pencarian Anda
                    </p>
                    <a href="{{ route('products.index') }}" class="btn-cta">
                        Lihat Semua Produk
                    </a>
                </div>
            @else
                <div class="results-info">
                    Menampilkan <strong>{{ $products->count() }}</strong> dari <strong>{{ $products->total() }}</strong> produk
                </div>
                
                <div class="product-grid">
                    @foreach($products as $p)
                        @php
                            $imgUrl = $p->image_url;
                            if ($imgUrl && str_starts_with($imgUrl, '/images/')) {
                                $imgSrc = asset($imgUrl);
                            } elseif ($imgUrl) {
                                $imgSrc = asset('storage/' . $imgUrl);
                            } else {
                                $imgSrc = null;
                            }
                        @endphp
                        <a href="{{ route('products.show', $p->slug) }}" class="product-card">
                            <div class="product-image">
                                @if($imgSrc)
                                    <img src="{{ $imgSrc }}" alt="{{ $p->name }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                                    <div style="width:100%;height:100%;display:none;align-items:center;justify-content:center;">
                                        <i class="uil uil-image" style="font-size:60px;color:rgba(255,255,255,0.5);"></i>
                                    </div>
                                @else
                                    <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                                        <i class="uil uil-image" style="font-size:60px;color:rgba(255,255,255,0.5);"></i>
                                    </div>
                                @endif
                                @if($p->condition)
                                    <span class="product-badge {{ $p->condition }}">{{ ucfirst($p->condition) }}</span>
                                @endif
                            </div>
                            <div class="product-info">
                                <div class="product-name">{{ $p->name }}</div>
                                <div class="product-seller">
                                    <i class="uil uil-shop"></i>
                                    {{ $p->seller_name ?? $p->seller->nama_toko ?? 'Toko' }}
                                </div>
                                <div class="product-price">
                                    Rp {{ number_format($p->price, 0, ',', '.') }}
                                </div>
                                <div class="product-stock {{ $p->stock < 10 ? 'low' : '' }}">
                                    <i class="uil uil-layers"></i>
                                    Stok: {{ $p->stock }}
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                
                {{-- Pagination --}}
                <div style="margin-top:40px;display:flex;justify-content:center;">
                    {{ $products->withQueryString()->links('pagination::custom') }}
                </div>
            @endif
        </main>
    </div>
</div>

{{-- Floating Chat Button --}}
<button class="chat-float-btn" id="chatFloatBtn" onclick="toggleChat()">
    <i class="uil uil-comment-alt-dots"></i>
    <span class="chat-badge"></span>
</button>

{{-- Chat Window --}}
<div class="chat-window" id="chatWindow">
    <div class="chat-header">
        <div class="chat-header-avatar">
            <i class="uil uil-robot"></i>
        </div>
        <div class="chat-header-info">
            <div class="chat-header-title">KampuBot AI</div>
            <div class="chat-header-status">Online - Siap membantu</div>
        </div>
        <button class="chat-close-btn" onclick="toggleChat()">
            <i class="uil uil-times"></i>
        </button>
    </div>
    
    <div class="chat-messages" id="chatMessages">
        <div class="chat-message bot">
            Halo! Saya KampuBot, asisten AI kampuStore. Ada yang bisa saya bantu hari ini? 😊
        </div>
    </div>
    
    <div class="chat-suggestions" id="chatSuggestions">
        <button class="chat-suggestion" onclick="sendSuggestion('Bagaimana cara belanja?')">Cara belanja</button>
        <button class="chat-suggestion" onclick="sendSuggestion('Bagaimana cara jadi penjual?')">Jadi penjual</button>
        <button class="chat-suggestion" onclick="sendSuggestion('Produk apa saja yang dijual?')">Kategori produk</button>
        <button class="chat-suggestion" onclick="sendSuggestion('Apakah aman berbelanja disini?')">Keamanan</button>
    </div>
    
    <div class="chat-input-area">
        <input type="text" class="chat-input" id="chatInput" placeholder="Ketik pesan..." onkeypress="handleChatKeypress(event)">
        <button class="chat-send-btn" onclick="sendMessage()">
            <i class="uil uil-message"></i>
        </button>
    </div>
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

    // User Dropdown toggle
    function toggleUserDropdown(){
        const dd = document.getElementById('userDropdown');
        if(dd) dd.classList.toggle('open');
    }
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e){
        const dd = document.getElementById('userDropdown');
        if(dd && !dd.contains(e.target)){
            dd.classList.remove('open');
        }
    });

    // ===================== CHAT AI =====================
    const chatResponses = {
        'cara belanja': 'Belanja di kampuStore sangat mudah!\n\n1. Browse produk di halaman Market\n2. Klik produk untuk melihat detail\n3. Hubungi penjual via kontak yang tersedia\n4. Janjian COD atau kirim via ekspedisi\n\nTidak perlu login untuk melihat produk!',
        'jadi penjual': 'Untuk menjadi penjual:\n\n1. Klik "Daftar Penjual" di halaman utama\n2. Isi form pendaftaran dengan data lengkap\n3. Tunggu verifikasi dari admin (1-2 hari kerja)\n4. Setelah disetujui, login dan mulai upload produk!\n\nGratis tanpa biaya pendaftaran.',
        'kategori produk': 'kampuStore menyediakan berbagai kategori:\n\n📚 Buku & Alat Tulis\n🎒 Alat Kuliah\n👕 Fashion Kampus\n💻 Elektronik\n\nSemua produk relevan untuk kebutuhan mahasiswa UNDIP!',
        'keamanan': 'Keamanan di kampuStore:\n\n✅ Semua penjual terverifikasi sebagai mahasiswa/civitas UNDIP\n✅ Sistem rating & review untuk transparansi\n✅ Transaksi bisa COD di area kampus\n✅ Lokasi penjual dekat (area Tembalang)\n\nBelanja dengan aman!',
        'kontak': 'Hubungi tim kampuStore:\n\n📧 Email: support@kampustore.id\n📱 WhatsApp: +62 812-3456-7890\n📷 Instagram: @kampustore.undip\n📍 Lokasi: Universitas Diponegoro, Tembalang',
        'harga': 'Harga di kampuStore sangat terjangkau!\n\nKarena penjual sesama mahasiswa, harga cenderung lebih murah. Anda juga bisa:\n\n💬 Nego langsung dengan penjual\n🔄 Beli barang bekas berkualitas\n🚫 Hemat ongkir dengan COD',
        'default': 'Maaf, saya belum memahami pertanyaan Anda. Coba tanyakan tentang:\n\n• Cara belanja\n• Cara jadi penjual\n• Kategori produk\n• Keamanan transaksi\n• Kontak kampuStore\n\nAtau ketik pertanyaan dengan kata kunci yang lebih spesifik!'
    };

    function toggleChat() {
        const chatWindow = document.getElementById('chatWindow');
        chatWindow.classList.toggle('open');
    }

    function sendSuggestion(text) {
        document.getElementById('chatInput').value = text;
        sendMessage();
        document.getElementById('chatSuggestions').style.display = 'none';
    }

    function handleChatKeypress(e) {
        if (e.key === 'Enter') {
            sendMessage();
        }
    }

    function sendMessage() {
        const input = document.getElementById('chatInput');
        const message = input.value.trim();
        if (!message) return;

        const messagesContainer = document.getElementById('chatMessages');
        
        // Add user message
        const userMsg = document.createElement('div');
        userMsg.className = 'chat-message user';
        userMsg.textContent = message;
        messagesContainer.appendChild(userMsg);
        
        input.value = '';
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        // Show typing indicator
        const typingMsg = document.createElement('div');
        typingMsg.className = 'chat-message bot typing';
        typingMsg.id = 'typingIndicator';
        typingMsg.innerHTML = '<span></span><span></span><span></span>';
        messagesContainer.appendChild(typingMsg);
        messagesContainer.scrollTop = messagesContainer.scrollHeight;

        // Simulate AI response
        setTimeout(() => {
            document.getElementById('typingIndicator').remove();
            
            const botMsg = document.createElement('div');
            botMsg.className = 'chat-message bot';
            botMsg.style.whiteSpace = 'pre-line';
            botMsg.textContent = getAIResponse(message);
            messagesContainer.appendChild(botMsg);
            messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }, 1000 + Math.random() * 500);
    }

    function getAIResponse(message) {
        const lowerMsg = message.toLowerCase();
        
        if (lowerMsg.includes('belanja') || lowerMsg.includes('beli') || lowerMsg.includes('order')) {
            return chatResponses['cara belanja'];
        }
        if (lowerMsg.includes('penjual') || lowerMsg.includes('jual') || lowerMsg.includes('daftar') || lowerMsg.includes('jualan')) {
            return chatResponses['jadi penjual'];
        }
        if (lowerMsg.includes('kategori') || lowerMsg.includes('produk') || lowerMsg.includes('barang') || lowerMsg.includes('jenis')) {
            return chatResponses['kategori produk'];
        }
        if (lowerMsg.includes('aman') || lowerMsg.includes('keamanan') || lowerMsg.includes('terpercaya') || lowerMsg.includes('penipuan')) {
            return chatResponses['keamanan'];
        }
        if (lowerMsg.includes('kontak') || lowerMsg.includes('hubungi') || lowerMsg.includes('email') || lowerMsg.includes('whatsapp')) {
            return chatResponses['kontak'];
        }
        if (lowerMsg.includes('harga') || lowerMsg.includes('murah') || lowerMsg.includes('mahal') || lowerMsg.includes('nego')) {
            return chatResponses['harga'];
        }
        if (lowerMsg.includes('halo') || lowerMsg.includes('hai') || lowerMsg.includes('hi') || lowerMsg.includes('hello')) {
            return 'Halo juga! 👋 Ada yang bisa saya bantu tentang kampuStore?';
        }
        if (lowerMsg.includes('terima kasih') || lowerMsg.includes('makasih') || lowerMsg.includes('thanks')) {
            return 'Sama-sama! Senang bisa membantu. Jangan ragu bertanya lagi ya! 😊';
        }
        
        return chatResponses['default'];
    }

    // ===================== LOCATION FILTER (CASCADING DROPDOWN) =====================
    const API_BASE = 'https://www.emsifa.com/api-wilayah-indonesia/api';
    
    const locationCache = {
        provinces: null
    };

    const filterProvinsi = document.getElementById('filterProvinsi');

    // Data dari server (filter yang sedang aktif)
    const currentProvinsi = "{{ $selProvinsi ?? '' }}";
    
    // Lokasi default seller jika login
    const sellerLocation = @json($sellerLocation ?? null);

    async function fetchLocationData(url) {
        try {
            const response = await fetch(url);
            if (!response.ok) throw new Error('Network error');
            return await response.json();
        } catch (error) {
            console.error('Error fetching location:', error);
            return [];
        }
    }

    function setSelectLoading(select, isLoading) {
        if (isLoading) {
            select.innerHTML = '<option value="">Loading...</option>';
            select.disabled = true;
        } else {
            select.disabled = false;
        }
    }

    async function loadProvinces() {
        if (locationCache.provinces) {
            populateProvinces(locationCache.provinces);
            return;
        }

        setSelectLoading(filterProvinsi, true);
        const provinces = await fetchLocationData(`${API_BASE}/provinces.json`);
        locationCache.provinces = provinces;
        populateProvinces(provinces);
        setSelectLoading(filterProvinsi, false);
    }

    function populateProvinces(provinces) {
        filterProvinsi.innerHTML = '<option value="">Semua Provinsi</option>';
        provinces.forEach(prov => {
            const option = document.createElement('option');
            option.value = prov.name;
            option.textContent = prov.name;
            option.dataset.id = prov.id;
            filterProvinsi.appendChild(option);
        });
    }

    // Initialize location filter
    window.addEventListener('DOMContentLoaded', async function() {
        await loadProvinces();

        // Set provinsi value from current filter
        if (currentProvinsi) {
            filterProvinsi.value = currentProvinsi;
        }
    });
</script>

</body>
</html>
