<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin' }} | kampuStore</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#f97316',
                    }
                }
            }
        }
        if (localStorage.getItem('kampuStoreTheme') === 'light') {
            document.documentElement.classList.remove('dark');
        } else {
            document.documentElement.classList.add('dark');
        }
    </script>
    
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    @stack('styles')
    
    <style>
        *{margin:0;padding:0;box-sizing:border-box}

        /* ===================== THEME VARIABLES ===================== */
        :root{
          --bg-body:#050b1f;
          --text-main:#e5e7eb;
          --text-muted:#9ca3af;

          --nav-bg:linear-gradient(90deg,#020617,#020617);
          --nav-border-bottom:rgba(30,64,175,0.5);
          --nav-shadow:0 14px 40px rgba(15,23,42,0.9);
          --nav-link-color:#e5e7eb;

          --market-bg:radial-gradient(circle at top left,#1f3b8a 0,#020617 52%,#020617 100%);

          --card-bg:rgba(15,23,42,0.96);
          --card-border:rgba(148,163,184,0.2);
          --card-shadow:0 20px 60px rgba(15,23,42,0.9);

          --accent:#f97316;

          --input-bg:rgba(15,23,42,0.75);
          --input-border:rgba(148,163,184,0.7);

          --badge-green-bg:rgba(34,197,94,0.1);
          --badge-green-text:#22c55e;
          --badge-yellow-bg:rgba(234,179,8,0.1);
          --badge-yellow-text:#eab308;
          --badge-red-bg:rgba(239,68,68,0.1);
          --badge-red-text:#ef4444;
          --badge-blue-bg:rgba(59,130,246,0.1);
          --badge-blue-text:#3b82f6;
        }

        body.theme-light{
          --bg-body:#eef2ff;
          --text-main:#1a2550;
          --text-muted:#6b7280;

          --nav-bg:#ffffff;
          --nav-border-bottom:#d9ddf0;
          --nav-shadow:0 4px 12px rgba(20,30,60,0.08);
          --nav-link-color:#1a2450;

          --market-bg:linear-gradient(135deg,#ffffff 0%,#e3e8ff 40%,#d5ddff 100%);

          --card-bg:rgba(255,255,255,0.96);
          --card-border:#e5e7eb;
          --card-shadow:0 20px 60px rgba(148,163,184,0.4);

          --input-bg:#ffffff;
          --input-border:#cbd5e1;

          --badge-green-bg:rgba(34,197,94,0.15);
          --badge-yellow-bg:rgba(234,179,8,0.15);
          --badge-red-bg:rgba(239,68,68,0.15);
          --badge-blue-bg:rgba(59,130,246,0.15);
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
            padding:18px 60px;
            background:var(--nav-bg);
            border-bottom:1px solid var(--nav-border-bottom);
            box-shadow:var(--nav-shadow);
        }
        .nav-container{
            display:flex;
            align-items:center;
            justify-content:space-between;
            min-height:64px;
            max-width:1600px;
            margin:0 auto;
            gap:32px;
        }
        .nav-left{display:flex;align-items:center;gap:32px;flex:1;}
        .nav-logo{
            display:flex;align-items:center;
            font-weight:700;font-size:22px;
            letter-spacing:0.04em;color:#f9fafb;
            cursor:pointer;
            transition:all .3s;
            text-decoration:none;
        }
        .nav-logo:hover { transform:scale(1.05); }
        .nav-logo img{height:36px;width:36px;display:block;}
        body.theme-light .nav-logo{color:#111827;}

        .nav-menu{display:flex;gap:4px;align-items:center;flex:1;}
        .nav-item{position:relative;}
        .nav-menu a{
            color:var(--nav-link-color);
            display:inline-flex;
            align-items:center;
            gap:6px;
            transition:color .3s ease;
            padding:8px 14px;
            border-radius:8px;
            text-decoration:none;
            font-size:14px;
            font-weight:500;
        }
        .nav-menu a:hover{color:#f97316;background:rgba(249,115,22,0.1);}
        .nav-menu a.active{color:#f97316;font-weight:600;}
        .nav-right{display:flex;align-items:center;justify-content:flex-end;gap:16px;}
        .nav-actions{display:flex;align-items:center;gap:12px;}

        .admin-badge{
            display:flex;align-items:center;gap:8px;
            padding:6px 16px;
            background:rgba(249,115,22,0.1);
            border:1px solid rgba(249,115,22,0.2);
            border-radius:8px;
            font-size:14px;
            font-weight:600;
        }
        .admin-badge i {
            color:var(--accent);
            font-size:18px;
        }
        .admin-badge-name {
            color:var(--text-main);
        }

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
        .dropdown-item:hover{background:rgba(249,115,22,0.1);color:var(--accent);}
        .dropdown-item i{font-size:16px;width:20px;text-align:center;}
        .dropdown-divider{height:1px;background:var(--card-border);margin:8px 0;}
        .dropdown-item.logout{color:#ef4444;}
        .dropdown-item.logout:hover{background:rgba(239,68,68,0.1);color:#ef4444;}

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

        /* ===================== MAIN CONTENT ===================== */
        .main-content{
            padding:120px 48px 48px;
            max-width:1500px;
            margin:0 auto;
            min-height:calc(100vh - 120px);
        }

        /* ===================== CARDS ===================== */
        .card{
            background:var(--card-bg);
            border:1px solid var(--card-border);
            border-radius:16px;
            box-shadow:var(--card-shadow);
            backdrop-filter:blur(10px);
        }

        /* ===================== FORMS ===================== */
        input[type="text"],input[type="email"],input[type="date"],select,textarea{
            width:100%;padding:12px 16px;
            background:var(--input-bg);
            border:1px solid var(--input-border);
            border-radius:10px;color:var(--text-main);
            font-size:14px;transition:all .2s;
        }
        input:focus,select:focus,textarea:focus{
            outline:none;border-color:var(--accent);
            box-shadow:0 0 0 3px rgba(249,115,22,0.15);
        }

        /* ===================== BUTTONS ===================== */
        .btn{
            display:inline-flex;align-items:center;gap:8px;
            padding:10px 20px;border-radius:10px;
            font-size:14px;font-weight:600;cursor:pointer;
            transition:all .2s;border:none;
        }
        .btn-primary{
            background:linear-gradient(135deg,var(--accent),#ea580c);
            color:white;box-shadow:0 4px 12px rgba(249,115,22,0.3);
        }
        .btn-primary:hover{transform:translateY(-2px);box-shadow:0 6px 16px rgba(249,115,22,0.4);}
        .btn-secondary{
            background:var(--card-bg);border:1px solid var(--card-border);
            color:var(--text-main);
        }
        .btn-secondary:hover{border-color:var(--accent);color:var(--accent);}
        .btn-success{
            background:linear-gradient(135deg,#22c55e,#16a34a);
            color:white;box-shadow:0 4px 12px rgba(34,197,94,0.3);
        }
        .btn-danger{
            background:linear-gradient(135deg,#ef4444,#dc2626);
            color:white;box-shadow:0 4px 12px rgba(239,68,68,0.3);
        }

        /* Additional Button Styles for Tailwind Override */
        .btn-orange{
            display:inline-flex;align-items:center;gap:6px;
            padding:10px 20px;border-radius:10px;
            font-size:14px;font-weight:600;cursor:pointer;
            background:linear-gradient(135deg,#f97316,#ea580c);
            color:white;border:none;
            box-shadow:0 4px 12px rgba(249,115,22,0.3);
            transition:all .2s;
        }
        .btn-orange:hover{transform:translateY(-2px);box-shadow:0 6px 16px rgba(249,115,22,0.4);}

        .btn-blue{
            display:inline-flex;align-items:center;gap:6px;
            padding:10px 20px;border-radius:10px;
            font-size:14px;font-weight:600;cursor:pointer;
            background:linear-gradient(135deg,#3b82f6,#2563eb);
            color:white;border:none;
            box-shadow:0 4px 12px rgba(59,130,246,0.3);
            transition:all .2s;
        }
        .btn-blue:hover{transform:translateY(-2px);box-shadow:0 6px 16px rgba(59,130,246,0.4);}

        .btn-green{
            display:inline-flex;align-items:center;gap:6px;
            padding:10px 20px;border-radius:10px;
            font-size:14px;font-weight:600;cursor:pointer;
            background:linear-gradient(135deg,#22c55e,#16a34a);
            color:white;border:none;
            box-shadow:0 4px 12px rgba(34,197,94,0.3);
            transition:all .2s;
        }
        .btn-green:hover{transform:translateY(-2px);box-shadow:0 6px 16px rgba(34,197,94,0.4);}

        .btn-red{
            display:inline-flex;align-items:center;gap:6px;
            padding:10px 20px;border-radius:10px;
            font-size:14px;font-weight:600;cursor:pointer;
            background:linear-gradient(135deg,#ef4444,#dc2626);
            color:white;border:none;
            box-shadow:0 4px 12px rgba(239,68,68,0.3);
            transition:all .2s;
        }
        .btn-red:hover{transform:translateY(-2px);box-shadow:0 6px 16px rgba(239,68,68,0.4);}

        /* ===================== BADGES ===================== */
        .badge{
            display:inline-flex;align-items:center;gap:6px;
            padding:6px 12px;border-radius:50px;
            font-size:12px;font-weight:600;
        }
        .badge-success{background:var(--badge-green-bg);color:var(--badge-green-text);}
        .badge-warning{background:var(--badge-yellow-bg);color:var(--badge-yellow-text);}
        .badge-danger{background:var(--badge-red-bg);color:var(--badge-red-text);}
        .badge-info{background:var(--badge-blue-bg);color:var(--badge-blue-text);}

        /* ===================== TABLES ===================== */
        .table-container{overflow-x:auto;}
        table{width:100%;border-collapse:collapse;}
        thead{background:rgba(249,115,22,0.05);}
        body.theme-light thead{background:rgba(249,115,22,0.08);}
        th{
            padding:14px 16px;text-align:left;font-size:12px;
            font-weight:700;text-transform:uppercase;
            letter-spacing:0.5px;color:var(--text-muted);
            border-bottom:1px solid var(--card-border);
        }
        td{
            padding:16px;font-size:14px;color:var(--text-main);
            border-bottom:1px solid var(--card-border);
        }
        tbody tr:hover{background:rgba(249,115,22,0.03);}
        body.theme-light tbody tr:hover{background:rgba(249,115,22,0.05);}

        /* ===================== STAT CARDS ===================== */
        .stat-card{
            background:var(--card-bg);border:1px solid var(--card-border);
            border-radius:16px;padding:24px;transition:all .3s;
        }
        .stat-card:hover{transform:translateY(-4px);box-shadow:0 12px 30px rgba(0,0,0,0.2);}
        .stat-icon{
            width:56px;height:56px;border-radius:14px;
            display:flex;align-items:center;justify-content:center;font-size:24px;
        }
        .stat-icon.yellow{background:linear-gradient(135deg,#eab308,#ca8a04);color:white;}
        .stat-icon.green{background:linear-gradient(135deg,#22c55e,#16a34a);color:white;}
        .stat-icon.red{background:linear-gradient(135deg,#ef4444,#dc2626);color:white;}
        .stat-icon.blue{background:linear-gradient(135deg,#3b82f6,#2563eb);color:white;}
        .stat-icon.purple{background:linear-gradient(135deg,#8b5cf6,#7c3aed);color:white;}
        .stat-icon.orange{background:linear-gradient(135deg,var(--accent),#ea580c);color:white;}
        .stat-icon.pink{background:linear-gradient(135deg,#ec4899,#db2777);color:white;}
        .stat-icon.indigo{background:linear-gradient(135deg,#6366f1,#4f46e5);color:white;}

        .stat-value{font-size:32px;font-weight:800;color:var(--text-main);line-height:1;}
        .stat-bar{
            height:6px;background:rgba(148,163,184,0.2);
            border-radius:10px;margin-top:16px;overflow:hidden;
        }
        .stat-bar-fill{height:100%;border-radius:10px;transition:width .5s ease;}

        /* ===================== CHART AREA ===================== */
        .chart-area{background:rgba(249,115,22,0.03);border-radius:12px;padding:20px;}
        body.theme-light .chart-area{background:rgba(249,115,22,0.05);}

        /* ===================== FOOTER ===================== */
        .footer{
            padding:24px 48px;text-align:center;
            border-top:1px solid var(--card-border);
            color:var(--text-muted);font-size:14px;
        }

        /* ===================== DIVIDER ===================== */
        .divider{
            height:4px;
            background:linear-gradient(90deg,rgba(249,115,22,0.1) 0%,var(--accent) 50%,rgba(249,115,22,0.1) 100%);
            border-radius:10px;margin:32px 0;
        }

        /* ===================== SCROLLBAR ===================== */
        ::-webkit-scrollbar{width:8px;height:8px;}
        ::-webkit-scrollbar-track{background:rgba(148,163,184,0.1);}
        ::-webkit-scrollbar-thumb{background:rgba(148,163,184,0.3);border-radius:4px;}
        ::-webkit-scrollbar-thumb:hover{background:rgba(148,163,184,0.5);}

        /* ===================== RESPONSIVE ===================== */
        @media(max-width:1024px){
            .nav{padding:14px 24px;}
            .main-content{padding:100px 24px 32px;}
            .nav-left{gap:16px;}
            .nav-menu{gap:2px;flex-wrap:nowrap;overflow-x:auto;}
            .nav-menu a{padding:6px 10px;font-size:13px;white-space:nowrap;}
            .admin-badge{padding:4px 12px;}
            .admin-badge-name{font-size:12px;}
        }
        @media(max-width:900px){
            .nav{padding:10px 20px;}
            .nav-container{
                flex-direction:column;
                gap:8px;
            }
            .nav-left{width:100%;justify-content:space-between;}
            .nav-menu{order:2;width:100%;justify-content:center;flex-wrap:wrap;}
            .nav-right{width:100%;justify-content:center;}
            .admin-badge-name{display:none;}
        }
        @media(max-width:640px){
            .nav{padding:12px 16px;}
            .main-content{padding:90px 16px 24px;}
            .nav-logo span{display:none;}
            .nav-menu a span{display:none;}
            .nav-menu a{padding:6px 8px;}
            .admin-badge-name{display:none;}
            .btn-logout span{display:none;}
            .theme-toggle-wrapper{transform:scale(0.85);}
        }

        /* ===================== UTILITY CLASSES ===================== */
        .text-center{text-align:center;}
        .text-right{text-align:right;}
        .font-bold{font-weight:700;}
        .font-semibold{font-weight:600;}
        .text-sm{font-size:14px;}
        .text-xs{font-size:12px;}
        .text-lg{font-size:18px;}
        .text-xl{font-size:20px;}
        .text-2xl{font-size:24px;}
        .text-3xl{font-size:30px;}
        .mb-1{margin-bottom:4px;}
        .mb-2{margin-bottom:8px;}
        .mb-3{margin-bottom:12px;}
        .mb-4{margin-bottom:16px;}
        .mb-6{margin-bottom:24px;}
        .mb-8{margin-bottom:32px;}
        .mt-1{margin-top:4px;}
        .mt-2{margin-top:8px;}
        .mt-3{margin-top:12px;}
        .mt-4{margin-top:16px;}
        .mt-6{margin-top:24px;}
        .gap-2{gap:8px;}
        .gap-3{gap:12px;}
        .gap-4{gap:16px;}
        .gap-6{gap:24px;}
        .grid{display:grid;}
        .grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr));}
        .grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr));}
        .grid-cols-3{grid-template-columns:repeat(3,minmax(0,1fr));}
        .grid-cols-4{grid-template-columns:repeat(4,minmax(0,1fr));}
        .flex{display:flex;}
        .flex-col{flex-direction:column;}
        .flex-1{flex:1;}
        .flex-shrink-0{flex-shrink:0;}
        .items-center{align-items:center;}
        .items-start{align-items:flex-start;}
        .items-end{align-items:flex-end;}
        .justify-between{justify-content:space-between;}
        .justify-center{justify-content:center;}
        .justify-end{justify-content:flex-end;}
        .rounded-xl{border-radius:16px;}
        .rounded-lg{border-radius:12px;}
        .overflow-hidden{overflow:hidden;}
        .overflow-x-auto{overflow-x:auto;}
        .truncate{overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
        .p-3{padding:12px;}
        .p-4{padding:16px;}
        .p-6{padding:24px;}
        .px-2{padding-left:8px;padding-right:8px;}
        .px-4{padding-left:16px;padding-right:16px;}
        .px-6{padding-left:24px;padding-right:24px;}
        .py-2{padding-top:8px;padding-bottom:8px;}
        .py-3{padding-top:12px;padding-bottom:12px;}
        .py-4{padding-top:16px;padding-bottom:16px;}
        .w-full{width:100%;}

        @media(min-width:640px){
            .sm\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr));}
            .sm\:text-base{font-size:16px;}
            .sm\:text-3xl{font-size:30px;}
            .sm\:p-6{padding:24px;}
            .sm\:mb-8{margin-bottom:32px;}
            .sm\:gap-6{gap:24px;}
            .sm\:flex-row{flex-direction:row;}
            .sm\:items-center{align-items:center;}
            .sm\:justify-between{justify-content:space-between;}
            .sm\:text-right{text-align:right;}
        }
        @media(min-width:768px){
            .md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr));}
            .md\:grid-cols-4{grid-template-columns:repeat(4,minmax(0,1fr));}
        }
        @media(min-width:1024px){
            .lg\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr));}
            .lg\:grid-cols-3{grid-template-columns:repeat(3,minmax(0,1fr));}
            .lg\:grid-cols-4{grid-template-columns:repeat(4,minmax(0,1fr));}
            .lg\:text-4xl{font-size:36px;}
        }
    </style>
</head>
<body class="theme-dark">

<nav class="nav">
    <div class="nav-container">
        <!-- Left: Logo & Menu -->
        <div class="nav-left">
            <a href="{{ route('admin.dashboard') }}" class="nav-logo">
                <img src="{{ asset('images/logo.png') }}" alt="kampuStore logo">
                <span>kampuStore</span>
            </a>

            <div class="nav-menu">
                <div class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="uil uil-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.reports.index') }}" class="nav-link {{ request()->routeIs('admin.reports*') ? 'active' : '' }}">
                        <i class="uil uil-chart-bar"></i>
                        <span>Laporan</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.sellers.index') }}" class="nav-link {{ request()->routeIs('admin.sellers*') ? 'active' : '' }}">
                        <i class="uil uil-folder-open"></i>
                        <span>Pengajuan Toko</span>
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
            <!-- Admin Badge -->
            <div class="admin-badge">
                <i class="uil uil-shield-check"></i>
                <span class="admin-badge-name">Admin</span>
            </div>

            <!-- Theme Toggle -->
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

<main class="main-content">
    @yield('content')
</main>

<footer class="footer">
    <p>&copy; {{ date('Y') }} <span style="color:var(--accent);font-weight:600;">kampuStore</span> - Marketplace Mahasiswa UNDIP</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    (function(){
        const KEY = 'kampuStoreTheme';
        const html = document.documentElement;
        const body = document.body;
        const toggle = document.querySelector('.js-theme-toggle');

        function apply(mode){
            if(mode === 'light'){
                html.classList.remove('dark');
                body.classList.remove('theme-dark');
                body.classList.add('theme-light');
            }else{
                html.classList.add('dark');
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

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#f97316',
        background: document.body.classList.contains('theme-light') ? '#ffffff' : '#1f2937',
        color: document.body.classList.contains('theme-light') ? '#111827' : '#f9fafb'
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session('error') }}',
        confirmButtonColor: '#f97316',
        background: document.body.classList.contains('theme-light') ? '#ffffff' : '#1f2937',
        color: document.body.classList.contains('theme-light') ? '#111827' : '#f9fafb'
    });
</script>
@endif

@yield('scripts')
</body>
</html>
