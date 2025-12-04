<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Toko - {{ $seller->nama_toko }} | kampuStore</title>
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
            border-bottom:1px solid rgba(249,115,22,0.3);
            padding:12px 48px;display:flex;align-items:center;justify-content:space-between;
            min-height:65px;
        }
        .nav-left { display:flex;align-items:center;gap:32px;flex:1; }
        .nav-logo { display:flex;align-items:center;gap:10px;text-decoration:none; }
        .nav-logo img { height:36px;width:36px; }
        .nav-logo span { font-size:20px;font-weight:700;color:var(--text-main); }
        .nav-menu { display:flex;gap:4px;align-items:center;flex:1; }
        .nav-item { position:relative; }
        .nav-link { 
            display:inline-flex;align-items:center;gap:6px;color:var(--text-muted);font-size:14px;font-weight:500;
            text-decoration:none;transition:all .2s;padding:8px 14px;border-radius:8px;white-space:nowrap;
        }
        .nav-link:hover, .nav-link.active { color:var(--accent);background:rgba(249,115,22,0.1); }
        .nav-link i { font-size:16px; }
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
        .nav-center { display:flex;align-items:center;gap:20px; }
        .shop-badge {
            display:flex;align-items:center;gap:10px;padding:6px 16px;border-radius:50px;
            background:rgba(249,115,22,0.1);border:1px solid rgba(249,115,22,0.3);
        }
        .shop-badge-name { font-size:14px;font-weight:600;color:var(--text-main); }
        .shop-badge-status { display:inline-flex;align-items:center;gap:4px;font-size:11px;font-weight:600;padding:2px 8px;border-radius:50px; }
        .shop-badge-status.approved { background:rgba(34,197,94,0.2);color:#22c55e; }
        .shop-badge-status.pending { background:rgba(234,179,8,0.2);color:#eab308; }
        .shop-badge-status.rejected { background:rgba(239,68,68,0.2);color:#ef4444; }
        .nav-actions { display:flex;align-items:center;gap:16px; }

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

        .btn-logout {
            border:none;background:rgba(239,68,68,0.1);color:#ef4444;cursor:pointer;
            padding:8px 16px;border-radius:50px;font-size:13px;font-weight:600;transition:all .3s;
            display:flex;align-items:center;gap:6px;
        }
        .btn-logout:hover{background:#ef4444;color:white;}

        /* LAYOUT - FULL WIDTH */
        .main-container { max-width:1600px;margin:0 auto;padding:85px 48px 40px; }
        @media(max-width:900px) { .main-container { padding:85px 20px 32px; } }
        /* CONTENT */
        .page-header { margin-bottom:24px; }
        .page-title { font-size:28px;font-weight:800;color:var(--text-main);margin-bottom:6px; }
        .page-subtitle { font-size:14px;color:var(--text-muted); }

        /* CARDS */
        .stats-grid { display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;margin-bottom:28px; }
        .stat-card {
            background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px;
            padding:24px;transition:all .3s;
        }
        .stat-card:hover { transform:translateY(-4px);box-shadow:0 20px 40px rgba(0,0,0,0.2); }
        .stat-icon { width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:24px;margin-bottom:16px; }
        .stat-icon.blue { background:rgba(59,130,246,0.2);color:#3b82f6; }
        .stat-icon.green { background:rgba(34,197,94,0.2);color:#22c55e; }
        .stat-icon.orange { background:rgba(249,115,22,0.2);color:#f97316; }
        .stat-icon.yellow { background:rgba(234,179,8,0.2);color:#eab308; }
        .stat-value { font-size:32px;font-weight:800;color:var(--text-main);margin-bottom:4px; }
        .stat-label { font-size:13px;color:var(--text-muted); }

        .card {
            background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px;
            padding:24px;margin-bottom:24px;
        }
        .card-header { display:flex;align-items:center;justify-content:space-between;margin-bottom:20px; }
        .card-title { font-size:18px;font-weight:700;color:var(--text-main); }
        .card-link { font-size:13px;color:var(--accent);text-decoration:none;display:flex;align-items:center;gap:4px; }
        .card-link:hover { color:var(--accent-hover); }

        /* TABLE */
        .table-wrap { overflow-x:auto; }
        table { width:100%;border-collapse:collapse; }
        th { text-align:left;padding:12px 16px;font-size:12px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.5px;border-bottom:1px solid var(--card-border); }
        td { padding:16px;border-bottom:1px solid var(--card-border);font-size:14px;color:var(--text-main); }
        tr:hover td { background:rgba(249,115,22,0.03); }
        .product-cell { display:flex;align-items:center;gap:12px; }
        .product-img { width:48px;height:48px;border-radius:10px;object-fit:cover;background:var(--card-border); }
        .product-name { font-weight:600; }
        .product-desc { font-size:12px;color:var(--text-muted); }
        .badge { padding:4px 10px;border-radius:50px;font-size:12px;font-weight:600; }
        .badge-blue { background:rgba(59,130,246,0.2);color:#3b82f6; }
        .badge-green { background:rgba(34,197,94,0.2);color:#22c55e; }
        .badge-orange { background:rgba(249,115,22,0.2);color:#f97316; }
        .action-btn { display:inline-flex;align-items:center;justify-content:center;padding:8px;border-radius:8px;color:var(--text-muted);transition:all .2s;background:none;border:none;cursor:pointer;text-decoration:none; }
        .action-btn:hover { background:rgba(249,115,22,0.1);color:var(--accent); }
        .action-btn i { font-size:18px; }

        /* ALERT */
        .alert { padding:16px 20px;border-radius:12px;margin-bottom:24px;display:flex;align-items:flex-start;gap:12px; }
        .alert-warning { background:rgba(234,179,8,0.1);border:1px solid rgba(234,179,8,0.3); }
        .alert-warning i { color:#eab308;font-size:24px; }
        .alert-error { background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3); }
        .alert-error i { color:#ef4444;font-size:24px; }
        .alert-title { font-weight:600;margin-bottom:4px; }
        .alert-text { font-size:13px;color:var(--text-muted); }

        /* INFO GRID */
        .info-grid { display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:16px; }
        .info-item { background:rgba(0,0,0,0.1);border-radius:12px;padding:16px; }
        body.theme-light .info-item { background:rgba(0,0,0,0.03); }
        .info-label { font-size:12px;color:var(--text-muted);margin-bottom:6px;display:flex;align-items:center;gap:6px; }
        .info-value { font-size:14px;font-weight:500;color:var(--text-main); }
        .info-full { grid-column:1/-1; }

        .btn-add {
            display:inline-flex;align-items:center;gap:8px;padding:12px 24px;
            background:var(--accent);color:#111827;border-radius:50px;font-size:14px;font-weight:600;
            text-decoration:none;transition:all .3s;
        }
        .btn-add:hover { background:var(--accent-hover);transform:translateY(-2px);box-shadow:0 8px 20px rgba(249,115,22,0.3); }

        .empty-state { text-align:center;padding:48px 24px; }
        .empty-state i { font-size:64px;color:var(--text-muted);margin-bottom:16px; }
        .empty-state p { color:var(--text-muted);margin-bottom:20px; }

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
            .nav { flex-wrap:wrap;padding:10px 20px; }
            .nav-center { order:3;width:100%;margin-top:10px;justify-content:center; }
            .shop-badge { width:100%;justify-content:center; }
            .dropdown-menu { right:0;left:auto; }
        }
        @media(max-width:600px) {
            .nav-logo span { display:none; }
            .nav-link span { display:none; }
            .nav-link { padding:6px 8px; }
            .btn-logout span { display:none; }
        }
    </style>
</head>
<body class="theme-dark">

{{-- NAVBAR --}}
<nav class="nav">
    <div class="nav-left">
        <a href="{{ route('seller.dashboard') }}" class="nav-logo">
            <img src="{{ asset('images/logo.png') }}" alt="kampuStore">
            <span>kampuStore Seller</span>
        </a>
        <div class="nav-menu">
            <div class="nav-item">
                <a href="{{ route('seller.dashboard') }}" class="nav-link active">
                    <i class="uil uil-dashboard"></i> Dashboard
                </a>
            </div>
            <div class="nav-item">
                <a href="{{ route('seller.products.index') }}" class="nav-link">
                    <i class="uil uil-box"></i> Produk
                </a>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle">
                    <i class="uil uil-chart-bar"></i> Laporan
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('seller.reports.stock') }}" class="dropdown-item">
                        <i class="uil uil-layers"></i> Laporan Stok
                    </a>
                    <a href="{{ route('seller.reports.rating') }}" class="dropdown-item">
                        <i class="uil uil-star"></i> Laporan Rating
                    </a>
                    <a href="{{ route('seller.reports.restock') }}" class="dropdown-item">
                        <i class="uil uil-exclamation-triangle"></i> Restock Alert
                    </a>
                </div>
            </div>
            <div class="nav-item">
                <a href="{{ route('seller.notifications.index') }}" class="nav-link">
                    <i class="uil uil-envelope"></i> Notifikasi
                    @php
                        $unreadCount = auth()->user()->seller?->notifications()->where('is_read', false)->count() ?? 0;
                    @endphp
                    @if($unreadCount > 0)
                        <span style="background:#ef4444;color:white;font-size:10px;padding:2px 6px;border-radius:50px;margin-left:4px;">{{ $unreadCount }}</span>
                    @endif
                </a>
            </div>
            @if($seller->status === 'approved')
            <div class="nav-item">
                <a href="{{ route('seller.products.create') }}" class="nav-link" style="background:var(--accent);color:#111827;font-weight:600;padding:6px 14px;">
                    <i class="uil uil-plus" style="font-size:14px;"></i> <span>Tambah Produk</span>
                </a>
            </div>
            @endif
        </div>
    </div>
    <div class="nav-center">
        <div class="shop-badge">
            <span class="shop-badge-name">{{ $seller->nama_toko }}</span>
            @if($seller->status === 'approved')
                <span class="shop-badge-status approved"><i class="uil uil-check-circle"></i> Verified</span>
            @elseif($seller->status === 'pending')
                <span class="shop-badge-status pending"><i class="uil uil-clock"></i> Pending</span>
            @else
                <span class="shop-badge-status rejected"><i class="uil uil-times-circle"></i> Rejected</span>
            @endif
        </div>
    </div>
    <div class="nav-actions">
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
        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="uil uil-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</nav>

<div class="main-container">
        <div class="page-header">
            <h1 class="page-title">Dashboard</h1>
            <p class="page-subtitle">Selamat datang kembali, {{ $seller->nama_pic }}!</p>
        </div>

        @if($seller->status === 'pending')
        <div class="alert alert-warning">
            <i class="uil uil-exclamation-triangle"></i>
            <div>
                <div class="alert-title">Toko Menunggu Verifikasi</div>
                <div class="alert-text">Pendaftaran toko Anda sedang dalam proses verifikasi. Biasanya memakan waktu 1-3 hari kerja.</div>
            </div>
        </div>
        @elseif($seller->status === 'rejected')
        <div class="alert alert-error">
            <i class="uil uil-times-circle"></i>
            <div>
                <div class="alert-title">Pendaftaran Ditolak</div>
                <div class="alert-text">{{ $seller->rejection_reason ?? 'Alasan tidak disebutkan.' }}</div>
            </div>
        </div>
        @endif

        @if($seller->status === 'approved')
        {{-- Stats --}}
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue"><i class="uil uil-package"></i></div>
                <div class="stat-value">{{ $totalProducts }}</div>
                <div class="stat-label">Total Produk</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green"><i class="uil uil-layers"></i></div>
                <div class="stat-value">{{ $totalStock }}</div>
                <div class="stat-label">Total Stok</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon orange"><i class="uil uil-exclamation-triangle"></i></div>
                <div class="stat-value">{{ $lowStockProducts }}</div>
                <div class="stat-label">Stok &lt; 2 (Restock)</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon yellow"><i class="uil uil-star"></i></div>
                <div class="stat-value">{{ number_format($avgRating, 1) }}</div>
                <div class="stat-label">Rating ({{ $totalReviews }} ulasan)</div>
            </div>
        </div>

        {{-- SRS-08: Charts Section --}}
        <style>
            .charts-grid { display:grid;grid-template-columns:repeat(auto-fit,minmax(350px,1fr));gap:24px;margin-bottom:28px; }
            @media(max-width:800px) { .charts-grid { grid-template-columns:1fr; } }
            .chart-card { background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px;padding:24px; }
            .chart-title { font-size:16px;font-weight:700;color:var(--text-main);margin-bottom:4px;display:flex;align-items:center;gap:8px; }
            .chart-subtitle { font-size:12px;color:var(--text-muted);margin-bottom:20px; }
            .bar-chart { display:flex;align-items:flex-end;justify-content:flex-start;gap:8px;height:180px;border-left:1px solid var(--card-border);border-bottom:1px solid var(--card-border);padding:16px 8px 0;overflow-x:auto; }
            .bar-item { display:flex;flex-direction:column;align-items:center;min-width:50px;flex-shrink:0; }
            .bar { width:40px;border-radius:6px 6px 0 0;position:relative;min-height:10px;transition:height 0.3s; }
            .bar-value { position:absolute;top:-22px;left:50%;transform:translateX(-50%);padding:2px 6px;border-radius:4px;font-size:10px;font-weight:700;color:white;white-space:nowrap; }
            .bar-label { font-size:9px;color:var(--text-muted);margin-top:6px;text-align:center;max-width:60px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap; }
            .progress-list { display:flex;flex-direction:column;gap:14px;max-height:200px;overflow-y:auto; }
            .progress-item { }
            .progress-header { display:flex;align-items:center;justify-content:space-between;margin-bottom:6px; }
            .progress-label { display:flex;align-items:center;gap:6px;font-size:13px;font-weight:500;color:var(--text-main); }
            .progress-dot { width:8px;height:8px;border-radius:50%; }
            .progress-value { font-size:12px;font-weight:600;color:var(--text-main); }
            .progress-bar { height:6px;background:rgba(148,163,184,0.2);border-radius:50px;overflow:hidden; }
            .progress-fill { height:100%;border-radius:50px; }
        </style>

        <div class="charts-grid">
            {{-- SRS-08: Sebaran Stok per Produk --}}
            <div class="chart-card">
                <div class="chart-title"><i class="uil uil-layers"></i> Sebaran Stok per Produk</div>
                <div class="chart-subtitle">Top 10 produk berdasarkan jumlah stok</div>
                @if($stockByProduct->count() > 0)
                    @php $maxStock = $stockByProduct->max('stock') ?: 1; @endphp
                    <div class="bar-chart">
                        @foreach($stockByProduct as $idx => $item)
                            @php 
                                $pct = ($item->stock / $maxStock) * 100;
                                $colors = ['#3b82f6', '#22c55e', '#f97316', '#a855f7', '#06b6d4', '#ef4444', '#eab308', '#ec4899'];
                                $color = $colors[$idx % count($colors)];
                            @endphp
                            <div class="bar-item">
                                <div class="bar" style="height:{{ max(10, $pct) }}%; background:linear-gradient(to top, {{ $color }}, {{ $color }}99);">
                                    <span class="bar-value" style="background:{{ $color }};">{{ $item->stock }}</span>
                                </div>
                                <span class="bar-label" title="{{ $item->name }}">{{ Str::limit($item->name, 8) }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align:center;padding:30px;color:var(--text-muted);">
                        <i class="uil uil-info-circle" style="font-size:32px;"></i>
                        <p style="font-size:13px;">Belum ada data produk</p>
                    </div>
                @endif
            </div>

            {{-- SRS-08: Sebaran Rating per Produk --}}
            <div class="chart-card">
                <div class="chart-title"><i class="uil uil-star"></i> Sebaran Rating per Produk</div>
                <div class="chart-subtitle">Top 10 produk berdasarkan rating tertinggi</div>
                @if($ratingByProduct->count() > 0)
                    <div class="progress-list">
                        @foreach($ratingByProduct as $idx => $item)
                            @php 
                                $ratingPct = ($item->avg_rating / 5) * 100;
                                $colors = ['#eab308', '#f97316', '#22c55e', '#3b82f6', '#a855f7'];
                                $color = $colors[$idx % count($colors)];
                            @endphp
                            <div class="progress-item">
                                <div class="progress-header">
                                    <span class="progress-label">
                                        <span class="progress-dot" style="background:{{ $color }};"></span>
                                        {{ Str::limit($item->name, 20) }}
                                    </span>
                                    <span class="progress-value">{{ number_format($item->avg_rating, 1) }} ★ ({{ $item->review_count }})</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width:{{ $ratingPct }}%; background:linear-gradient(to right, {{ $color }}, {{ $color }}99);"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align:center;padding:30px;color:var(--text-muted);">
                        <i class="uil uil-info-circle" style="font-size:32px;"></i>
                        <p style="font-size:13px;">Belum ada data rating</p>
                    </div>
                @endif
            </div>

            {{-- SRS-08: Sebaran Pemberi Rating Berdasarkan Provinsi --}}
            <div class="chart-card">
                <div class="chart-title"><i class="uil uil-map-marker"></i> Review Berdasarkan Provinsi</div>
                <div class="chart-subtitle">Asal pemberi rating untuk produk Anda</div>
                @if($reviewersByProvince->count() > 0)
                    <div class="progress-list">
                        @php $maxReviews = $reviewersByProvince->max('total') ?: 1; @endphp
                        @foreach($reviewersByProvince as $idx => $item)
                            @php 
                                $provincePct = ($item->total / $maxReviews) * 100;
                                $colors = ['#3b82f6', '#22c55e', '#f97316', '#a855f7', '#06b6d4', '#ef4444', '#eab308', '#ec4899'];
                                $color = $colors[$idx % count($colors)];
                            @endphp
                            <div class="progress-item">
                                <div class="progress-header">
                                    <span class="progress-label">
                                        <span class="progress-dot" style="background:{{ $color }};"></span>
                                        {{ $item->guest_province }}
                                    </span>
                                    <span class="progress-value">{{ $item->total }} review</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width:{{ $provincePct }}%; background:linear-gradient(to right, {{ $color }}, {{ $color }}99);"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="text-align:center;padding:30px;color:var(--text-muted);">
                        <i class="uil uil-map-marker" style="font-size:32px;"></i>
                        <p style="font-size:13px;">Belum ada review dengan data provinsi</p>
                    </div>
                @endif
            </div>

        </div>

        {{-- Recent Products --}}
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Produk Terbaru</h2>
                <a href="{{ route('seller.products.index') }}" class="card-link">Lihat Semua <i class="uil uil-arrow-right"></i></a>
            </div>
            @if($products->count() > 0)
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>
                                <div class="product-cell">
                                    @if($product->image_url)
                                    <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}" class="product-img">
                                    @else
                                    <div class="product-img" style="display:flex;align-items:center;justify-content:center;"><i class="uil uil-image" style="color:var(--text-muted);"></i></div>
                                    @endif
                                    <div>
                                        <div class="product-name">{{ $product->name }}</div>
                                        <div class="product-desc">{{ Str::limit($product->description, 40) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge badge-blue">{{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}</span></td>
                            <td style="font-weight:600;">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>
                                @if($product->stock < 10)
                                <span class="badge badge-orange">{{ $product->stock }}</span>
                                @else
                                <span class="badge badge-green">{{ $product->stock }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('products.show', $product) }}" class="action-btn" title="Lihat"><i class="uil uil-eye"></i></a>
                                <a href="{{ route('seller.products.edit', $product) }}" class="action-btn" title="Edit"><i class="uil uil-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-state">
                <i class="uil uil-box"></i>
                <p>Belum ada produk</p>
                <a href="{{ route('seller.products.create') }}" class="btn-add">
                    <i class="uil uil-plus"></i> Tambah Produk Pertama
                </a>
            </div>
            @endif
        </div>

        {{-- Shop Info --}}
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Informasi Toko</h2>
            </div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label"><i class="uil uil-user"></i> Nama PIC</div>
                    <div class="info-value">{{ $seller->nama_pic }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label"><i class="uil uil-envelope"></i> Email PIC</div>
                    <div class="info-value">{{ $seller->email_pic }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label"><i class="uil uil-phone"></i> No. HP PIC</div>
                    <div class="info-value">{{ $seller->no_hp_pic }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label"><i class="uil uil-location-point"></i> Lokasi</div>
                    <div class="info-value">{{ $seller->kota }}, {{ $seller->provinsi }}</div>
                </div>
                <div class="info-item info-full">
                    <div class="info-label"><i class="uil uil-map-marker"></i> Alamat Lengkap</div>
                    <div class="info-value">{{ $seller->alamat_pic }}, RT {{ $seller->rt }} / RW {{ $seller->rw }}, Kel. {{ $seller->kelurahan }}, {{ $seller->kota }}, {{ $seller->provinsi }}</div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<footer class="footer">
    <p>© 2025 <span>kampuStore</span>. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({ icon: 'success', title: 'Berhasil!', text: '{{ session('success') }}', confirmButtonColor: '#f97316' });
</script>
@endif
@if(session('error'))
<script>
    Swal.fire({ icon: 'error', title: 'Error!', text: '{{ session('error') }}', confirmButtonColor: '#f97316' });
</script>
@endif

<script>
(function(){
    const KEY = 'kampuStoreTheme';
    const body = document.body;
    const toggle = document.querySelector('.js-theme-toggle');
    function apply(mode){
        if(mode === 'light'){ body.classList.add('theme-light'); body.classList.remove('theme-dark'); }
        else{ body.classList.remove('theme-light'); body.classList.add('theme-dark'); }
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
