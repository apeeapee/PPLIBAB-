<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rating Produk - {{ $seller->nama_toko }} | kampuStore</title>
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

        .nav {
            position:fixed;top:0;left:0;right:0;z-index:100;
            background:var(--nav-bg);backdrop-filter:blur(20px);
            border-bottom:1px solid rgba(249,115,22,0.3);
            padding:12px 32px;display:flex;align-items:center;justify-content:space-between;
        }
        .nav-left { display:flex;align-items:center;gap:32px; }
        .nav-logo { display:flex;align-items:center;gap:10px;text-decoration:none; }
        .nav-logo img { height:38px;width:38px; }
        .nav-logo span { font-size:22px;font-weight:700;color:var(--text-main); }
        .nav-menu { display:flex;gap:24px; }
        .nav-menu a { color:var(--text-muted);font-size:14px;font-weight:500;text-decoration:none;transition:color .2s; }
        .nav-menu a:hover, .nav-menu a.active { color:var(--accent); }
        .nav-actions { display:flex;align-items:center;gap:16px; }

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

        .main-container { max-width:1400px;margin:0 auto;padding:90px 24px 40px;display:grid;grid-template-columns:260px 1fr;gap:28px; }
        @media(max-width:900px) { .main-container { grid-template-columns:1fr;padding-top:80px; } }

        .sidebar {
            background:var(--sidebar-bg);border-radius:16px;padding:24px;
            border:1px solid var(--sidebar-border);box-shadow:0 10px 40px rgba(0,0,0,0.2);
            position:sticky;top:90px;max-height:calc(100vh - 110px);overflow-y:auto;
        }
        .sidebar-section { margin-bottom:24px;padding-bottom:20px;border-bottom:1px solid var(--sidebar-border); }
        .sidebar-section:last-child { border-bottom:none;margin-bottom:0;padding-bottom:0; }
        .sidebar-title { font-size:13px;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:1px;margin-bottom:14px; }
        .sidebar-menu { display:flex;flex-direction:column;gap:6px; }
        .sidebar-link {
            display:flex;align-items:center;gap:12px;padding:12px 14px;border-radius:10px;
            font-size:14px;font-weight:500;color:var(--text-main);text-decoration:none;transition:all .2s;
        }
        .sidebar-link:hover { background:rgba(249,115,22,0.1);color:var(--accent); }
        .sidebar-link.active { background:rgba(249,115,22,0.15);color:var(--accent);font-weight:600; }
        .sidebar-link i { font-size:20px;width:24px;text-align:center; }

        .shop-info-box {
            background:rgba(249,115,22,0.1);border:1px solid rgba(249,115,22,0.3);
            border-radius:12px;padding:16px;text-align:center;
        }
        .shop-name { font-size:16px;font-weight:700;color:var(--text-main);margin-bottom:4px; }
        .shop-status { display:inline-flex;align-items:center;gap:6px;padding:4px 12px;border-radius:50px;font-size:12px;font-weight:600; }
        .shop-status.approved { background:rgba(34,197,94,0.2);color:#22c55e; }

        .content { min-width:0; }
        .page-header { margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px; }
        .page-title { font-size:28px;font-weight:800;color:var(--text-main);margin-bottom:6px; }
        .page-subtitle { font-size:14px;color:var(--text-muted); }

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

        .table-wrap { overflow-x:auto; }
        table { width:100%;border-collapse:collapse; }
        th { text-align:left;padding:12px 16px;font-size:12px;font-weight:600;color:var(--text-muted);text-transform:uppercase;letter-spacing:0.5px;border-bottom:1px solid var(--card-border); }
        td { padding:16px;border-bottom:1px solid var(--card-border);font-size:14px;color:var(--text-main); }
        tr:hover td { background:rgba(249,115,22,0.03); }

        .badge { padding:4px 10px;border-radius:50px;font-size:12px;font-weight:600; }
        .badge-green { background:rgba(34,197,94,0.2);color:#22c55e; }
        .badge-yellow { background:rgba(234,179,8,0.2);color:#eab308; }
        .badge-red { background:rgba(239,68,68,0.2);color:#ef4444; }

        .btn-action {
            display:inline-flex;align-items:center;gap:8px;padding:10px 20px;
            border-radius:50px;font-size:13px;font-weight:600;text-decoration:none;transition:all .3s;border:none;cursor:pointer;
        }
        .btn-primary { background:var(--accent);color:#111827; }
        .btn-primary:hover { background:var(--accent-hover);transform:translateY(-2px);box-shadow:0 8px 20px rgba(249,115,22,0.3); }
        .btn-success { background:rgba(34,197,94,0.2);color:#22c55e;border:1px solid rgba(34,197,94,0.3); }
        .btn-success:hover { background:rgba(34,197,94,0.3); }

        .rating-stars { display:flex;align-items:center;gap:2px; }
        .rating-stars i { font-size:16px; }
        .rating-stars .filled { color:#eab308; }
        .rating-stars .empty { color:var(--card-border); }

        .empty-state { text-align:center;padding:48px 24px; }
        .empty-state i { font-size:64px;color:var(--text-muted);margin-bottom:16px; }
        .empty-state p { color:var(--text-muted);margin-bottom:20px; }

        @media print {
            body { background: white !important; }
            .no-print { display: none !important; }
            .main-container { display:block;padding:20px; }
            .sidebar { display:none; }
            .card { box-shadow:none;border:1px solid #e5e7eb; }
            th, td { color:#111827 !important; }
        }

        @media(max-width:900px) {
            .nav { padding:12px 16px; }
            .nav-menu { display:none; }
            .sidebar { position:relative;top:0;max-height:none; }
            .main-container { padding:80px 16px 32px; }
        }
    </style>
</head>
<body class="theme-dark">

<nav class="nav no-print">
    <div class="nav-left">
        <a href="{{ route('seller.dashboard') }}" class="nav-logo">
            <img src="{{ asset('images/logo.png') }}" alt="kampuStore">
            <span>kampuStore Seller</span>
        </a>
        <div class="nav-menu">
            <a href="{{ route('seller.dashboard') }}">Dashboard</a>
            <a href="{{ route('seller.products.index') }}">Produk Saya</a>
            <a href="{{ route('seller.reports.stock') }}" class="active">Laporan</a>
        </div>
    </div>
    <div class="nav-actions">
        <div class="theme-toggle-wrapper">
            <label class="toggle-switch">
                <input type="checkbox" class="js-theme-toggle">
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
            <button type="submit" class="btn-logout"><i class="uil uil-sign-out-alt"></i> Logout</button>
        </form>
    </div>
</nav>

<div class="main-container">
    <aside class="sidebar no-print">
        <div class="sidebar-section">
            <div class="shop-info-box">
                <div class="shop-name">{{ $seller->nama_toko }}</div>
                <span class="shop-status approved"><i class="uil uil-check-circle"></i> Aktif</span>
            </div>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-title">Menu Utama</div>
            <div class="sidebar-menu">
                <a href="{{ route('seller.dashboard') }}" class="sidebar-link">
                    <i class="uil uil-dashboard"></i> Dashboard
                </a>
                <a href="{{ route('seller.products.index') }}" class="sidebar-link">
                    <i class="uil uil-box"></i> Produk Saya
                </a>
            </div>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-title">Laporan</div>
            <div class="sidebar-menu">
                <a href="{{ route('seller.reports.stock') }}" class="sidebar-link">
                    <i class="uil uil-chart-bar"></i> Laporan Stok
                </a>
                <a href="{{ route('seller.reports.rating') }}" class="sidebar-link active">
                    <i class="uil uil-star"></i> Laporan Rating
                </a>
                <a href="{{ route('seller.reports.restock') }}" class="sidebar-link">
                    <i class="uil uil-exclamation-triangle"></i> Restock Alert
                </a>
            </div>
        </div>
    </aside>

    <main class="content">
        <div class="page-header">
            <div>
                <h1 class="page-title">Laporan Rating Produk</h1>
                <p class="page-subtitle">Daftar produk berdasarkan rating tertinggi</p>
            </div>
            <div class="no-print" style="display:flex;gap:12px;">
                <a href="{{ route('seller.reports.rating.export') }}" class="btn-action btn-success">
                    <i class="uil uil-file-download-alt"></i> Export Excel
                </a>
                <button onclick="window.print()" class="btn-action btn-primary">
                    <i class="uil uil-print"></i> Cetak
                </button>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon blue"><i class="uil uil-box"></i></div>
                <div class="stat-value">{{ $products->count() }}</div>
                <div class="stat-label">Total Produk</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon yellow"><i class="uil uil-star"></i></div>
                <div class="stat-value">{{ $products->count() > 0 ? number_format($products->avg('avg_rating'), 1) : '0' }}</div>
                <div class="stat-label">Rata-rata Rating</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon green"><i class="uil uil-trophy"></i></div>
                <div class="stat-value">{{ $products->where('avg_rating', '>=', 4)->count() }}</div>
                <div class="stat-label">Rating 4+ Bintang</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon orange"><i class="uil uil-comment-alt-lines"></i></div>
                <div class="stat-value">{{ $products->sum('review_count') }}</div>
                <div class="stat-label">Total Review</div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Daftar Produk (Urutan Rating)</h2>
                <span style="font-size:12px;color:var(--text-muted);">
                    Dibuat: {{ now()->format('d M Y, H:i') }}
                </span>
            </div>
            
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Rating</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $index => $product)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td style="font-weight:600;">{{ $product->name }}</td>
                            <td>{{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>
                                @if($product->stock > 10)
                                    <span class="badge badge-green">{{ $product->stock }}</span>
                                @elseif($product->stock > 0)
                                    <span class="badge badge-yellow">{{ $product->stock }}</span>
                                @else
                                    <span class="badge badge-red">Habis</span>
                                @endif
                            </td>
                            <td>
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <div class="rating-stars">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="uil uil-star {{ $i <= floor($product->avg_rating ?? 0) ? 'filled' : 'empty' }}"></i>
                                        @endfor
                                    </div>
                                    <span style="font-weight:600;color:#eab308;">{{ number_format($product->avg_rating ?? 0, 1) }}</span>
                                    <span style="font-size:12px;color:var(--text-muted);">({{ $product->review_count ?? 0 }})</span>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="uil uil-star"></i>
                                    <p>Belum ada produk</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>

<script>
(function(){
    const KEY = 'kampuStoreTheme';
    const body = document.body;
    const toggle = document.querySelector('.js-theme-toggle');

    function apply(mode){
        if(mode === 'light'){
            body.classList.add('theme-light');
            body.classList.remove('theme-dark');
        } else {
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
