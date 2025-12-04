<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Saya - {{ $seller->nama_toko }} | kampuStore</title>
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
        .shop-status.pending { background:rgba(234,179,8,0.2);color:#eab308; }
        .shop-status.rejected { background:rgba(239,68,68,0.2);color:#ef4444; }

        .btn-add {
            display:inline-flex;align-items:center;gap:8px;padding:12px 24px;
            background:var(--accent);color:#111827;border-radius:50px;font-size:14px;font-weight:600;
            text-decoration:none;transition:all .3s;
        }
        .btn-add:hover { background:var(--accent-hover);transform:translateY(-2px);box-shadow:0 8px 20px rgba(249,115,22,0.3); }

        .content { min-width:0; }
        .page-header { display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:16px; }
        .page-title { font-size:28px;font-weight:800;color:var(--text-main);margin:0; }
        .page-subtitle { font-size:14px;color:var(--text-muted);margin-top:4px; }

        .products-grid { display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:24px; }
        .product-card {
            background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px;
            overflow:hidden;transition:all .3s;
        }
        .product-card:hover { transform:translateY(-6px);box-shadow:0 20px 40px rgba(0,0,0,0.25); }
        .product-image { position:relative;height:180px;background:rgba(0,0,0,0.2);overflow:hidden; }
        .product-image img { width:100%;height:100%;object-fit:cover; }
        .product-image .placeholder { display:flex;align-items:center;justify-content:center;height:100%;color:var(--text-muted);font-size:48px; }
        .product-badge { position:absolute;top:12px;padding:4px 10px;border-radius:50px;font-size:11px;font-weight:600; }
        .product-badge.left { left:12px;background:rgba(59,130,246,0.9);color:white; }
        .product-badge.right { right:12px; }
        .product-badge.stock-low { background:rgba(249,115,22,0.9);color:white; }
        .product-badge.stock-ok { background:rgba(34,197,94,0.9);color:white; }
        .product-info { padding:20px; }
        .product-name { font-size:16px;font-weight:700;color:var(--text-main);margin-bottom:8px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis; }
        .product-desc { font-size:13px;color:var(--text-muted);margin-bottom:16px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden; }
        .product-meta { display:flex;justify-content:space-between;margin-bottom:16px; }
        .product-meta-item label { font-size:11px;color:var(--text-muted);display:block;margin-bottom:2px; }
        .product-meta-item .value { font-size:18px;font-weight:700; }
        .product-meta-item .value.price { color:var(--accent); }
        .product-meta-item .value.stock-low { color:#f97316; }
        .product-meta-item .value.stock-ok { color:#22c55e; }
        .product-actions { display:flex;gap:8px; }
        .action-btn {
            flex:1;padding:10px;border-radius:10px;font-size:13px;font-weight:600;
            display:flex;align-items:center;justify-content:center;gap:6px;
            text-decoration:none;transition:all .2s;border:none;cursor:pointer;
        }
        .action-btn.view { background:rgba(59,130,246,0.15);color:#3b82f6; }
        .action-btn.view:hover { background:rgba(59,130,246,0.25); }
        .action-btn.edit { background:rgba(234,179,8,0.15);color:#eab308; }
        .action-btn.edit:hover { background:rgba(234,179,8,0.25); }
        .action-btn.delete { background:rgba(239,68,68,0.15);color:#ef4444;flex:0;padding:10px 14px; }
        .action-btn.delete:hover { background:rgba(239,68,68,0.25); }

        .empty-state { text-align:center;padding:60px 24px;background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px; }
        .empty-state i { font-size:64px;color:var(--text-muted);margin-bottom:16px; }
        .empty-state h3 { font-size:20px;font-weight:700;color:var(--text-main);margin-bottom:8px; }
        .empty-state p { color:var(--text-muted);margin-bottom:24px; }

        .footer { background:var(--nav-bg);border-top:1px solid var(--card-border);padding:20px 32px;text-align:center;margin-top:auto; }
        .footer p { font-size:13px;color:var(--text-muted); }
        .footer span { color:var(--accent);font-weight:600; }

        .alert { padding:16px 20px;border-radius:12px;margin-bottom:24px;display:flex;align-items:center;gap:12px; }
        .alert-success { background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.3); }
        .alert-success i { color:#22c55e;font-size:20px; }
        .alert-error { background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3); }
        .alert-error i { color:#ef4444;font-size:20px; }

        @media(max-width:900px) {
            .nav { padding:12px 16px; }
            .nav-menu { display:none; }
            .sidebar { position:relative;top:0;max-height:none; }
            .main-container { padding:80px 16px 32px; }
            .page-header { flex-direction:column;align-items:flex-start; }
        }
    </style>
</head>
<body class="theme-dark">

<nav class="nav">
    <div class="nav-left">
        <a href="{{ route('seller.dashboard') }}" class="nav-logo">
            <img src="{{ asset('images/logo.png') }}" alt="kampuStore">
            <span>kampuStore Seller</span>
        </a>
        <div class="nav-menu">
            <a href="{{ route('seller.dashboard') }}">Dashboard</a>
            <a href="{{ route('seller.products.index') }}" class="active">Produk Saya</a>
            <a href="{{ route('seller.reports.stock') }}">Laporan</a>
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
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="uil uil-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>
</nav>

<div class="main-container">
    <aside class="sidebar">
        <div class="sidebar-section">
            <div class="shop-info-box">
                <div class="shop-name">{{ $seller->nama_toko }}</div>
                @if($seller->status === 'approved')
                    <span class="shop-status approved"><i class="uil uil-check-circle"></i> Terverifikasi</span>
                @elseif($seller->status === 'pending')
                    <span class="shop-status pending"><i class="uil uil-clock"></i> Pending</span>
                @else
                    <span class="shop-status rejected"><i class="uil uil-times-circle"></i> Ditolak</span>
                @endif
            </div>
        </div>

        <div class="sidebar-section">
            <div class="sidebar-title">Menu</div>
            <div class="sidebar-menu">
                <a href="{{ route('seller.dashboard') }}" class="sidebar-link">
                    <i class="uil uil-dashboard"></i> Dashboard
                </a>
                <a href="{{ route('seller.products.index') }}" class="sidebar-link active">
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
                <a href="{{ route('seller.reports.rating') }}" class="sidebar-link">
                    <i class="uil uil-star"></i> Laporan Rating
                </a>
                <a href="{{ route('seller.reports.restock') }}" class="sidebar-link">
                    <i class="uil uil-exclamation-triangle"></i> Restock Alert
                </a>
            </div>
        </div>

        <div class="sidebar-section">
            <a href="{{ route('seller.products.create') }}" class="btn-add" style="width:100%;justify-content:center;">
                <i class="uil uil-plus"></i> Tambah Produk
            </a>
        </div>
    </aside>

    <div class="content">
        <div class="page-header">
            <div>
                <h1 class="page-title">Produk Saya</h1>
                <p class="page-subtitle">Kelola semua produk toko {{ $seller->nama_toko }}</p>
            </div>
            <a href="{{ route('seller.products.create') }}" class="btn-add">
                <i class="uil uil-plus"></i> Tambah Produk
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            <i class="uil uil-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-error">
            <i class="uil uil-times-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        @if($products->count() > 0)
        <div class="products-grid">
            @foreach($products as $product)
            <div class="product-card">
                <div class="product-image">
                    @if($product->image_url)
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                    <div class="placeholder" style="display:none;"><i class="uil uil-image"></i></div>
                    @else
                    <div class="placeholder"><i class="uil uil-image"></i></div>
                    @endif
                    <span class="product-badge left">{{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}</span>
                    @if($product->stock < 10)
                    <span class="product-badge right stock-low">Stok Rendah</span>
                    @else
                    <span class="product-badge right stock-ok">Stok Aman</span>
                    @endif
                </div>
                <div class="product-info">
                    <div class="product-name">{{ $product->name }}</div>
                    <div class="product-desc">{{ $product->description }}</div>
                    <div class="product-meta">
                        <div class="product-meta-item">
                            <label>Harga</label>
                            <div class="value price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                        </div>
                        <div class="product-meta-item" style="text-align:right;">
                            <label>Stok</label>
                            <div class="value {{ $product->stock < 10 ? 'stock-low' : 'stock-ok' }}">{{ $product->stock }}</div>
                        </div>
                    </div>
                    <div class="product-actions">
                        <a href="{{ route('products.show', $product) }}" class="action-btn view"><i class="uil uil-eye"></i> Lihat</a>
                        <a href="{{ route('seller.products.edit', $product) }}" class="action-btn edit"><i class="uil uil-edit"></i> Edit</a>
                        <form method="POST" action="{{ route('seller.products.destroy', $product) }}" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete"><i class="uil uil-trash"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($products->hasPages())
        <div style="margin-top:32px;display:flex;justify-content:center;">
            {{ $products->links() }}
        </div>
        @endif
        @else
        <div class="empty-state">
            <i class="uil uil-box"></i>
            <h3>Belum Ada Produk</h3>
            <p>Mulai berjualan dengan menambahkan produk pertama Anda.</p>
            <a href="{{ route('seller.products.create') }}" class="btn-add">
                <i class="uil uil-plus"></i> Tambah Produk Pertama
            </a>
        </div>
        @endif
    </div>
</div>

<footer class="footer">
    <p>© 2025 <span>kampuStore</span>. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
