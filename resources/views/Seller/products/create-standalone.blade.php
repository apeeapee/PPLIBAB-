<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - {{ $seller->nama_toko }} | kampuStore</title>
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
            --input-bg: rgba(15,23,42,0.6);
            --input-border: rgba(148,163,184,0.3);
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
            --input-bg: rgba(255,255,255,0.8);
            --input-border: #d1d5db;
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
        .back-link { display:inline-flex;align-items:center;gap:6px;color:var(--accent);font-size:14px;text-decoration:none;margin-bottom:16px; }
        .back-link:hover { color:var(--accent-hover); }
        .page-title { font-size:28px;font-weight:800;color:var(--text-main);margin-bottom:6px; }
        .page-subtitle { font-size:14px;color:var(--text-muted);margin-bottom:24px; }

        .form-card { background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px;padding:32px; }
        .form-group { margin-bottom:24px; }
        .form-row { display:grid;grid-template-columns:1fr 1fr;gap:24px; }
        @media(max-width:600px) { .form-row { grid-template-columns:1fr; } }
        .form-label { display:block;font-size:14px;font-weight:600;color:var(--text-main);margin-bottom:8px; }
        .form-label .required { color:#ef4444; }
        .form-input, .form-select, .form-textarea {
            width:100%;padding:12px 16px;background:var(--input-bg);border:1px solid var(--input-border);
            border-radius:10px;color:var(--text-main);font-size:14px;transition:all .2s;
        }
        .form-input::placeholder, .form-textarea::placeholder { color:var(--text-muted); }
        .form-input:focus, .form-select:focus, .form-textarea:focus {
            outline:none;border-color:var(--accent);box-shadow:0 0 0 3px rgba(249,115,22,0.15);
        }
        .form-textarea { resize:vertical;min-height:120px; }
        .form-hint { font-size:12px;color:var(--text-muted);margin-top:6px; }
        .form-error { font-size:12px;color:#ef4444;margin-top:6px; }
        .form-file {
            width:100%;padding:12px 16px;background:var(--input-bg);border:1px solid var(--input-border);
            border-radius:10px;color:var(--text-main);font-size:14px;cursor:pointer;
        }
        .form-file::file-selector-button {
            padding:8px 16px;background:var(--accent);color:#111827;border:none;border-radius:50px;
            font-size:13px;font-weight:600;cursor:pointer;margin-right:12px;
        }
        .form-file::file-selector-button:hover { background:var(--accent-hover); }

        .preview-box { margin-top:16px; }
        .preview-box img { width:160px;height:160px;object-fit:cover;border-radius:12px;border:2px solid var(--card-border); }
        .preview-item { position:relative;display:inline-block; }
        .preview-item .btn-remove {
            position:absolute;top:-8px;right:-8px;width:24px;height:24px;
            background:#ef4444;color:#fff;border:none;border-radius:50%;
            font-size:14px;cursor:pointer;display:flex;align-items:center;justify-content:center;
            opacity:0;transition:opacity 0.2s;z-index:10;box-shadow:0 2px 6px rgba(0,0,0,0.3);
        }
        .preview-item:hover .btn-remove { opacity:1; }
        .preview-item .btn-remove:hover { background:#dc2626;transform:scale(1.1); }

        .form-actions { display:flex;gap:16px;margin-top:32px; }
        .btn-submit {
            flex:1;padding:14px 24px;background:var(--accent);color:#111827;border:none;border-radius:50px;
            font-size:15px;font-weight:600;cursor:pointer;transition:all .3s;display:flex;align-items:center;justify-content:center;gap:8px;
        }
        .btn-submit:hover { background:var(--accent-hover);transform:translateY(-2px);box-shadow:0 8px 20px rgba(249,115,22,0.3); }
        .btn-cancel {
            flex:1;padding:14px 24px;background:rgba(148,163,184,0.2);color:var(--text-main);border:none;border-radius:50px;
            font-size:15px;font-weight:600;cursor:pointer;transition:all .2s;text-decoration:none;text-align:center;
        }
        .btn-cancel:hover { background:rgba(148,163,184,0.3); }

        .alert { padding:16px 20px;border-radius:12px;margin-bottom:24px;display:flex;align-items:flex-start;gap:12px; }
        .alert-error { background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3); }
        .alert-error i { color:#ef4444;font-size:20px;margin-top:2px; }
        .alert-error ul { margin:8px 0 0 0;padding-left:20px; }
        .alert-error li { font-size:13px;color:var(--text-main);margin-bottom:4px; }

        .footer { background:var(--nav-bg);border-top:1px solid var(--card-border);padding:20px 32px;text-align:center;margin-top:auto; }
        .footer p { font-size:13px;color:var(--text-muted); }
        .footer span { color:var(--accent);font-weight:600; }

        @media(max-width:900px) {
            .nav { padding:12px 16px; }
            .nav-menu { display:none; }
            .sidebar { position:relative;top:0;max-height:none; }
            .main-container { padding:80px 16px 32px; }
            .form-card { padding:24px; }
            .form-actions { flex-direction:column; }
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
        <h1 class="page-title">Tambah Produk Baru</h1>
        <p class="page-subtitle">Isi formulir di bawah untuk menambahkan produk ke toko {{ $seller->nama_toko }}</p>

        @if($errors->any())
        <div class="alert alert-error">
            <i class="uil uil-exclamation-triangle"></i>
            <div>
                <strong>Ada beberapa kesalahan:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        <div class="form-card">
            <form method="POST" action="{{ route('seller.products.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- Section: Informasi Dasar --}}
                <div style="margin-bottom:32px;">
                    <h3 style="font-size:16px;font-weight:700;color:var(--text-main);margin-bottom:16px;padding-bottom:12px;border-bottom:2px solid var(--card-border);">
                        <i class="uil uil-info-circle"></i> Informasi Dasar Produk
                    </h3>

                <div class="form-group">
                    <label class="form-label">Nama Produk <span class="required">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-input" placeholder="Contoh: Buku Matematika Dasar" required>
                    @error('name')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Kategori <span class="required">*</span></label>
                    <select name="category_slug" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category['slug'] }}" {{ old('category_slug') == $category['slug'] ? 'selected' : '' }}>{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                    @error('category_slug')<p class="form-error">{{ $message }}</p>@enderror
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Kondisi <span class="required">*</span></label>
                        <select name="condition" class="form-select" required>
                            <option value="">Pilih Kondisi</option>
                            <option value="baru" {{ old('condition') == 'baru' ? 'selected' : '' }}>Baru</option>
                            <option value="bekas" {{ old('condition') == 'bekas' ? 'selected' : '' }}>Bekas</option>
                        </select>
                        @error('condition')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Ukuran (Opsional)</label>
                        <input type="text" name="size" value="{{ old('size') }}" class="form-input" placeholder="Contoh: L, XL, atau 42">
                        @error('size')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Harga (Rp) <span class="required">*</span></label>
                        <input type="text" id="price_display" value="{{ old('price') ? number_format(old('price'), 0, ',', '.') : '' }}" class="form-input" placeholder="50.000" required>
                        <input type="hidden" id="price" name="price" value="{{ old('price') }}">
                        <p class="form-hint">Ketik angka, titik akan otomatis muncul</p>
                        @error('price')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Stok <span class="required">*</span></label>
                        <input type="number" name="stock" value="{{ old('stock') }}" class="form-input" placeholder="10" min="0" required>
                        @error('stock')<p class="form-error">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi Produk <span class="required">*</span></label>
                    <textarea name="description" class="form-textarea" placeholder="Jelaskan detail produk, kondisi, dan informasi penting lainnya..." required>{{ old('description') }}</textarea>
                    @error('description')<p class="form-error">{{ $message }}</p>@enderror
                </div>
                </div>

                {{-- Section: Foto Produk --}}
                <div style="margin-bottom:32px;">
                    <h3 style="font-size:16px;font-weight:700;color:var(--text-main);margin-bottom:16px;padding-bottom:12px;border-bottom:2px solid var(--card-border);">
                        <i class="uil uil-images"></i> Foto Produk
                    </h3>

                {{-- Image Upload Info Box --}}
                <div style="background:rgba(249,115,22,0.1);border:1px solid rgba(249,115,22,0.3);border-radius:12px;padding:16px;margin-bottom:20px;">
                    <div style="display:flex;align-items:start;gap:12px;">
                        <i class="uil uil-info-circle" style="font-size:24px;color:var(--accent);margin-top:2px;"></i>
                        <div>
                            <h3 style="font-size:14px;font-weight:700;color:var(--text-main);margin-bottom:8px;">📸 Upload Banyak Foto Produk</h3>
                            <ul style="font-size:12px;color:var(--text-main);line-height:1.6;list-style:none;padding:0;">
                                <li style="margin-bottom:4px;">✓ Pilih hingga <strong>5 foto sekaligus</strong> dengan tombol di bawah</li>
                                <li style="margin-bottom:4px;">✓ Klik pada foto untuk <strong>menentukan foto utama</strong> (yang tampil pertama)</li>
                                <li style="margin-bottom:4px;">✓ Klik tombol <strong>×</strong> di pojok foto untuk menghapus</li>
                                <li>✓ Format: JPG, JPEG, PNG • Maksimal 2MB per foto</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="uil uil-image"></i> Foto Produk <span class="required">*</span>
                        <span style="font-size:12px;font-weight:400;color:var(--text-muted);margin-left:8px;">(Pilih 1-5 foto)</span>
                    </label>
                    <input type="file" name="images[]" id="images" class="form-file" accept=".jpg,.jpeg,.png" multiple required>
                    <p class="form-hint">Pilih beberapa file sekaligus untuk upload banyak foto. Foto pertama akan jadi foto utama secara default.</p>
                    @error('images')<p class="form-error">{{ $message }}</p>@enderror
                    @error('images.*')<p class="form-error">{{ $message }}</p>@enderror
                    <div id="imagePreviewContainer" class="preview-box" style="display:none; margin-top:16px;">
                        <p style="font-size:13px;font-weight:600;color:var(--text-main);margin-bottom:12px;">
                            <i class="uil uil-eye"></i> Preview Foto (<span id="imageCount">0</span>/5) - Klik foto untuk jadikan foto utama
                        </p>
                        <div id="previewGrid" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(120px,1fr));gap:12px;"></div>
                        <input type="hidden" name="primary_image" id="primary_image" value="0">
                    </div>
                </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="uil uil-check"></i> Tambah Produk
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
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('images');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const previewGrid = document.getElementById('previewGrid');
    const primaryInput = document.getElementById('primary_image');
    
    let selectedFiles = [];

    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            selectedFiles = files.slice(0, 5);
            
            if (files.length > 5) {
                alert('Maksimal 5 gambar. Hanya 5 gambar pertama yang akan digunakan.');
            }
            
            renderPreviews();
        });
    }

    function renderPreviews() {
        previewGrid.innerHTML = '';
        const imageCount = document.getElementById('imageCount');
        if (imageCount) imageCount.textContent = selectedFiles.length;
        
        if (selectedFiles.length > 0) {
            previewContainer.style.display = 'block';
            
            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const imgContainer = document.createElement('div');
                    imgContainer.className = 'preview-item';
                    imgContainer.style.cssText = 'position:relative;cursor:pointer;';
                    imgContainer.dataset.index = index;
                    
                    const isPrimary = index === parseInt(primaryInput.value);
                    imgContainer.innerHTML = `
                        <img src="${e.target.result}" style="width:120px;height:120px;object-fit:cover;border-radius:10px;border:3px solid ${isPrimary ? 'var(--accent)' : 'var(--card-border)'};transition:all 0.2s;" data-index="${index}">
                        <span class="badge-label" style="position:absolute;top:4px;left:4px;background:${isPrimary ? 'var(--accent)' : 'rgba(0,0,0,0.6)'};color:${isPrimary ? '#111' : '#fff'};font-size:11px;padding:2px 8px;border-radius:20px;font-weight:600;">${isPrimary ? 'Utama' : index + 1}</span>
                        <button type="button" class="btn-remove" data-index="${index}" title="Hapus gambar">
                            <i class="uil uil-times"></i>
                        </button>
                    `;
                    
                    imgContainer.querySelector('img').onclick = function(ev) {
                        ev.stopPropagation();
                        primaryInput.value = index;
                        updatePrimarySelection(index);
                    };
                    
                    imgContainer.querySelector('.btn-remove').onclick = function(ev) {
                        ev.stopPropagation();
                        removeImage(index);
                    };
                    
                    previewGrid.appendChild(imgContainer);
                };
                
                reader.readAsDataURL(file);
            });
        } else {
            previewContainer.style.display = 'none';
            primaryInput.value = 0;
        }
        
        updateFileInput();
    }

    function removeImage(index) {
        selectedFiles.splice(index, 1);
        
        if (parseInt(primaryInput.value) === index) {
            primaryInput.value = 0;
        } else if (parseInt(primaryInput.value) > index) {
            primaryInput.value = parseInt(primaryInput.value) - 1;
        }
        
        renderPreviews();
    }

    function updateFileInput() {
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        imageInput.files = dt.files;
    }

    function updatePrimarySelection(selectedIndex) {
        const containers = previewGrid.querySelectorAll('.preview-item');
        containers.forEach((container, idx) => {
            const img = container.querySelector('img');
            const badge = container.querySelector('.badge-label');
            if (idx === selectedIndex) {
                img.style.borderColor = 'var(--accent)';
                badge.style.background = 'var(--accent)';
                badge.style.color = '#111';
                badge.textContent = 'Utama';
            } else {
                img.style.borderColor = 'var(--card-border)';
                badge.style.background = 'rgba(0,0,0,0.6)';
                badge.style.color = '#fff';
                badge.textContent = idx + 1;
            }
        });
    }

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
