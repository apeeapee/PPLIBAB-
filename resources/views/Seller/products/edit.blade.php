<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - {{ $seller->nama_toko }} | KampuStore</title>
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
            --accent: #f97316;
            --input-bg: rgba(15,23,42,0.8);
            --input-border: rgba(148,163,184,0.3);
            --input-text: #f9fafb;
        }
        body.theme-light {
            --bg-main: linear-gradient(135deg, #ffffff 0%, #e3e8ff 40%, #d5ddff 100%);
            --nav-bg: rgba(255,255,255,0.95);
            --card-bg: rgba(255,255,255,0.96);
            --card-border: #e5e7eb;
            --text-main: #111827;
            --text-muted: #6b7280;
            --input-bg: rgba(255,255,255,0.9);
            --input-border: #d1d5db;
            --input-text: #111827;
        }
        body { background: var(--bg-main); }
        body.theme-light .bg-slate-900\/95 { background: var(--nav-bg) !important; }
        body.theme-light .bg-slate-800\/50 { background: rgba(255,255,255,0.9) !important; }
        body.theme-light .bg-slate-900\/50 { background: var(--input-bg) !important; color: var(--input-text) !important; }
        body.theme-light .border-blue-500\/30 { border-color: #e5e7eb !important; }
        body.theme-light .border-slate-700 { border-color: var(--input-border) !important; }
        body.theme-light .text-white { color: var(--text-main) !important; }
        body.theme-light .text-gray-300 { color: var(--text-muted) !important; }
        body.theme-light .text-gray-400 { color: #6b7280 !important; }
        body.theme-light .text-gray-500 { color: #9ca3af !important; }
        body.theme-light h1, body.theme-light h2, body.theme-light h3, body.theme-light h4 { color: var(--text-main) !important; }
        body.theme-light label, body.theme-light p, body.theme-light span, body.theme-light li { color: var(--text-main) !important; }
        body.theme-light .text-sm, body.theme-light .text-xs { color: var(--text-muted) !important; }
        body.theme-light .bg-gradient-to-r { color: #111827 !important; }
        body.theme-light input::placeholder,
        body.theme-light textarea::placeholder { color: #9ca3af !important; opacity: 1; }
        body.theme-light select option { background: white; color: #111827; }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }

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

        /* Sidebar Layout Styles */
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

        .btn-logout {
            border:none;background:rgba(239,68,68,0.1);color:#ef4444;cursor:pointer;
            padding:8px 16px;border-radius:50px;font-size:13px;font-weight:600;transition:all .3s;
            display:flex;align-items:center;gap:6px;
        }
        .btn-logout:hover{background:#ef4444;color:white;}

        .main-container { max-width:1400px;margin:0 auto;padding:90px 24px 40px;display:grid;grid-template-columns:260px 1fr;gap:28px; }
        @media(max-width:900px) { .main-container { grid-template-columns:1fr;padding-top:80px; } }

        .sidebar {
            background:var(--card-bg);border-radius:16px;padding:24px;
            border:1px solid var(--card-border);box-shadow:0 10px 40px rgba(0,0,0,0.2);
            position:sticky;top:90px;max-height:calc(100vh - 110px);overflow-y:auto;
        }
        .sidebar-section { margin-bottom:24px;padding-bottom:20px;border-bottom:1px solid var(--card-border); }
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
        .back-link { display:inline-flex;align-items:center;gap:6px;color:var(--accent);font-size:14px;text-decoration:none;margin-bottom:16px; }
        .back-link:hover { color:var(--accent-hover); }
        .page-title { font-size:28px;font-weight:800;color:var(--text-main);margin-bottom:6px; }
        .page-subtitle { font-size:14px;color:var(--text-muted);margin-bottom:24px; }

        .form-card { background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px;padding:32px; }

        .footer { background:var(--nav-bg);border-top:1px solid var(--card-border);padding:20px 32px;text-align:center;margin-top:auto; }
        .footer p { font-size:13px;color:var(--text-muted); }
        .footer span { color:var(--accent);font-weight:600; }

        /* Form Styles */
        .form-group { margin-bottom:24px; }
        .form-label { display:block;font-size:14px;font-weight:600;color:var(--text-main);margin-bottom:8px; }
        .form-label .required { color:#ef4444; }
        .form-input, .form-select, .form-textarea {
            width:100%;padding:12px 16px;background:var(--input-bg);border:1px solid var(--input-border);
            border-radius:10px;color:var(--input-text);font-size:14px;transition:all .2s;
        }
        .form-input::placeholder, .form-textarea::placeholder { color:var(--text-muted); }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline:none;border-color:var(--accent);box-shadow:0 0 0 3px rgba(249,115,22,0.15);
        }
        .form-textarea { resize:vertical;min-height:120px; }
        .form-hint { font-size:12px;color:var(--text-muted);margin-top:6px; }
        .form-error { font-size:12px;color:#ef4444;margin-top:6px; }
        .form-actions { display:flex;gap:16px;margin-top:32px; }
        .btn-submit {
            flex:1;padding:14px 24px;background:var(--accent);color:#111827;border:none;border-radius:50px;
            font-size:15px;font-weight:600;cursor:pointer;transition:all .3s;display:flex;align-items:center;justify-center;gap:8px;
        }
        .btn-submit:hover { background:var(--accent-hover);transform:translateY(-2px);box-shadow:0 8px 20px rgba(249,115,22,0.3); }
        .btn-cancel {
            flex:1;padding:14px 24px;background:rgba(148,163,184,0.2);color:var(--text-main);border:none;border-radius:50px;
            font-size:15px;font-weight:600;cursor:pointer;transition:all .2s;text-decoration:none;text-align:center;display:flex;align-items:center;justify-center;gap:8px;
        }
        .btn-cancel:hover { background:rgba(148,163,184,0.3); }
        .form-row { display:grid;grid-template-columns:1fr 1fr;gap:24px; }
        @media(max-width:600px) { .form-row { grid-template-columns:1fr; } }
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
            <a href="{{ route('seller.products.index') }}">Produk Saya</a>
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
                <span class="shop-status approved"><i class="uil uil-check-circle"></i> Terverifikasi</span>
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
    </aside>

    <div class="content">
        <a href="{{ route('seller.products.index') }}" class="back-link">
            <i class="uil uil-arrow-left"></i> Kembali ke Daftar Produk
        </a>
        <h1 class="page-title">Edit Produk</h1>
        <p class="page-subtitle">Perbarui informasi produk {{ $product->name }}</p>

        @if($errors->any())
        <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);border-radius:12px;padding:16px;margin-bottom:24px;">
            <div style="display:flex;align-items:start;gap:12px;">
                <i class="uil uil-exclamation-triangle" style="font-size:24px;color:#ef4444;margin-top:2px;"></i>
                <div>
                    <h3 style="font-size:14px;font-weight:700;color:#ef4444;margin-bottom:8px;">Ada beberapa kesalahan:</h3>
                    <ul style="list-style:disc;padding-left:20px;font-size:13px;color:var(--text-main);">
                        @foreach($errors->all() as $error)
                            <li style="margin-bottom:4px;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        <div class="form-card">
            <form method="POST" action="{{ route('seller.products.update', $product) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Form content starts here --}}
                <div style="margin-bottom:32px;">
                    <h3 style="font-size:16px;font-weight:700;color:var(--text-main);margin-bottom:16px;padding-bottom:12px;border-bottom:2px solid var(--card-border);">
                        <i class="uil uil-info-circle"></i> Informasi Dasar Produk
                    </h3>
                    <div style="display:flex;flex-direction:column;gap:24px;">

                {{-- Nama Produk --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                        Nama Produk <span class="text-red-400">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name', $product->name) }}"
                        required
                        class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        placeholder="Contoh: Buku Matematika Dasar"
                    >
                    @error('name')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div>
                    <label for="category_slug" class="block text-sm font-medium text-gray-300 mb-2">
                        Kategori <span class="text-red-400">*</span>
                    </label>
                    <select 
                        id="category_slug" 
                        name="category_slug" 
                        required
                        class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                    >
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category['slug'] }}" {{ old('category_slug', $product->category_slug) == $category['slug'] ? 'selected' : '' }}>
                                {{ $category['name'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_slug')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kondisi dan Size dalam satu baris --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- Kondisi --}}
                    <div>
                        <label for="condition" class="block text-sm font-medium text-gray-300 mb-2">
                            Kondisi <span class="text-red-400">*</span>
                        </label>
                        <select 
                            id="condition" 
                            name="condition" 
                            required
                            class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        >
                            <option value="">Pilih Kondisi</option>
                            <option value="baru" {{ old('condition', $product->condition) == 'baru' ? 'selected' : '' }}>Baru</option>
                            <option value="bekas" {{ old('condition', $product->condition) == 'bekas' ? 'selected' : '' }}>Bekas</option>
                        </select>
                        @error('condition')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Size (Optional) --}}
                    <div>
                        <label for="size" class="block text-sm font-medium text-gray-300 mb-2">
                            Ukuran (Opsional)
                        </label>
                        <input 
                            type="text" 
                            id="size" 
                            name="size" 
                            value="{{ old('size', $product->size) }}"
                            class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="Contoh: L, XL, atau 42"
                        >
                        @error('size')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Harga dan Stok dalam satu baris --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- Harga --}}
                    <div>
                        <label for="price_display" class="block text-sm font-medium text-gray-300 mb-2">
                            Harga (Rp) <span class="text-red-400">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="price_display" 
                            value="{{ old('price') ? number_format(old('price'), 0, ',', '.') : number_format($product->price, 0, ',', '.') }}"
                            required
                            class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="50.000"
                        >
                        <input type="hidden" id="price" name="price" value="{{ old('price', $product->price) }}">
                        <p class="mt-1 text-xs text-gray-500">Ketik angka, titik akan otomatis muncul</p>
                        @error('price')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Stok --}}
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-300 mb-2">
                            Stok <span class="text-red-400">*</span>
                        </label>
                        <input 
                            type="number" 
                            id="stock" 
                            name="stock" 
                            value="{{ old('stock', $product->stock) }}"
                            required
                            min="0"
                            class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="10"
                        >
                        @error('stock')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-300 mb-2">
                        Deskripsi Produk <span class="text-red-400">*</span>
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        required
                        rows="5"
                        class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none"
                        placeholder="Jelaskan detail produk, kondisi, dan informasi penting lainnya..."
                    >{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                    </div>
                </div>

                {{-- Section: Foto Produk --}}
                <div>
                    <h3 class="text-lg font-bold text-white mb-4 pb-3 border-b-2 border-slate-700 flex items-center gap-2">
                        <i class="uil uil-images text-blue-400"></i>
                        Foto Produk ({{ $product->images->count() }}/5)
                    </h3>

                {{-- Image Upload Info Box --}}
                <div class="bg-gradient-to-r from-blue-500/10 to-cyan-500/10 border border-blue-500/30 rounded-xl p-4 mb-6">
                    <div class="flex items-start gap-3">
                        <i class="uil uil-info-circle text-2xl text-blue-400 mt-0.5"></i>
                        <div>
                            <h3 class="text-sm font-semibold text-white mb-2">📸 Upload Banyak Foto Produk</h3>
                            <ul class="text-xs text-gray-300 space-y-1">
                                <li>✓ Bisa upload hingga <strong>5 foto</strong> untuk 1 produk</li>
                                <li>✓ Klik foto untuk <strong>pilih sebagai foto utama</strong></li>
                                <li>✓ Centang icon 🗑️ untuk <strong>menandai foto yang akan dihapus</strong></li>
                                <li>✓ Tambah foto baru dengan tombol "Tambah Foto Baru" di bawah</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Current Images --}}
                @if($product->images->count() > 0)
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-3 flex items-center gap-2">
                        <i class="uil uil-image text-lg"></i>
                        Foto Saat Ini ({{ $product->images->count() }}/5 foto)
                    </label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4" id="existingImagesGrid">
                        @foreach($product->images as $image)
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $product->name }}" 
                                class="w-full h-32 object-cover rounded-lg border-2 cursor-pointer transition-all duration-200 existing-image {{ $image->is_primary ? 'border-blue-500' : 'border-slate-700' }}"
                                data-id="{{ $image->id }}"
                                onclick="setPrimaryImage({{ $image->id }})"
                                onerror="this.src='{{ asset('images/no-image.png') }}';">
                            <span class="primary-badge absolute top-1 left-1 text-xs px-2 py-1 rounded-full font-semibold {{ $image->is_primary ? 'bg-blue-500 text-white' : 'bg-black/60 text-white' }}">
                                {{ $image->is_primary ? 'Utama' : $loop->iteration }}
                            </span>
                            <label class="absolute top-1 right-1 bg-red-500/80 hover:bg-red-500 text-white p-1 rounded cursor-pointer">
                                <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" class="hidden delete-checkbox" onchange="toggleDeleteMark(this)">
                                <i class="uil uil-trash-alt text-sm"></i>
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <input type="hidden" name="primary_image" id="primary_image" value="{{ $product->images->where('is_primary', true)->first()?->id }}">
                </div>
                @elseif($product->image_url)
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Foto Saat Ini</label>
                    <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="w-48 h-48 object-cover rounded-lg border-2 border-slate-700" onerror="this.src='{{ asset('images/no-image.png') }}';">
                </div>
                @endif

                {{-- Upload Gambar Baru --}}
                <div>
                    <label for="images" class="block text-sm font-medium text-gray-300 mb-2">
                        Tambah Foto Baru (Opsional, maksimal 5 gambar total)
                    </label>
                    <div class="relative">
                        <input 
                            type="file" 
                            id="images" 
                            name="images[]" 
                            accept=".jpg,.jpeg,.png"
                            multiple
                            class="w-full px-4 py-3 bg-slate-900/50 border border-slate-700 rounded-lg text-white file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 file:cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                        >
                    </div>
                    <p class="mt-2 text-xs text-gray-500">Format: JPG, JPEG, PNG. Maksimal 2MB per gambar.</p>
                    @error('images')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                    @error('images.*')
                        <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Preview New Images --}}
                <div id="newImagePreview" class="hidden">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Preview Foto Baru</label>
                    <div id="newPreviewGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4"></div>
                </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="uil uil-check"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('seller.products.index') }}" class="btn-cancel">
                        <i class="uil uil-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<footer class="footer">
    <p>© 2025 <span>kampuStore</span>. All rights reserved.</p>
</footer>

<script>
function setPrimaryImage(imageId) {
    document.getElementById('primary_image').value = imageId;
    
    document.querySelectorAll('.existing-image').forEach(img => {
        img.classList.remove('border-blue-500');
        img.classList.add('border-slate-700');
    });
    document.querySelectorAll('.primary-badge').forEach((badge, idx) => {
        badge.classList.remove('bg-blue-500');
        badge.classList.add('bg-black/60');
        badge.textContent = idx + 1;
    });
    
    const selectedImg = document.querySelector(`.existing-image[data-id="${imageId}"]`);
    if (selectedImg) {
        selectedImg.classList.remove('border-slate-700');
        selectedImg.classList.add('border-blue-500');
        const badge = selectedImg.parentElement.querySelector('.primary-badge');
        if (badge) {
            badge.classList.remove('bg-black/60');
            badge.classList.add('bg-blue-500');
            badge.textContent = 'Utama';
        }
    }
}

function toggleDeleteMark(checkbox) {
    const img = checkbox.closest('.relative').querySelector('img');
    if (checkbox.checked) {
        img.style.opacity = '0.3';
        img.style.filter = 'grayscale(100%)';
    } else {
        img.style.opacity = '1';
        img.style.filter = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('images');
    const previewContainer = document.getElementById('newImagePreview');
    const previewGrid = document.getElementById('newPreviewGrid');
    let selectedFiles = [];

    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            selectedFiles = files.slice(0, 5);
            renderNewPreviews();
        });
    }

    function renderNewPreviews() {
        previewGrid.innerHTML = '';
        
        if (selectedFiles.length > 0) {
            previewContainer.classList.remove('hidden');
            
            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const imgContainer = document.createElement('div');
                    imgContainer.className = 'relative group';
                    imgContainer.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-32 object-cover rounded-lg border-2 border-slate-700">
                        <span class="absolute top-1 left-1 bg-green-500 text-white text-xs px-2 py-1 rounded-full font-semibold">Baru</span>
                        <button type="button" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity shadow-lg" onclick="removeNewImage(${index})" title="Hapus gambar">
                            <i class="uil uil-times text-sm"></i>
                        </button>
                    `;
                    previewGrid.appendChild(imgContainer);
                };
                
                reader.readAsDataURL(file);
            });
        } else {
            previewContainer.classList.add('hidden');
        }
        
        updateNewFileInput();
    }

    function updateNewFileInput() {
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        imageInput.files = dt.files;
    }

    window.removeNewImage = function(index) {
        selectedFiles.splice(index, 1);
        renderNewPreviews();
    };

    const priceDisplay = document.getElementById('price_display');
    const priceHidden = document.getElementById('price');

    if (priceDisplay && priceHidden) {
        priceDisplay.addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^\d]/g, '');
            priceHidden.value = value;
            if (value) {
                e.target.value = parseInt(value).toLocaleString('id-ID');
            } else {
                e.target.value = '';
            }
        });

        if (priceDisplay.value) {
            let value = priceDisplay.value.replace(/[^\d]/g, '');
            if (value) {
                priceDisplay.value = parseInt(value).toLocaleString('id-ID');
                priceHidden.value = value;
            }
        }
    }
});
</script>
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
