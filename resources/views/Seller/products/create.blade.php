@extends('layouts.seller')

@section('title', 'Tambah Produk')

@push('styles')
@include('partials.seller-styles')
<style>
.back-link { display:inline-flex;align-items:center;gap:6px;color:var(--accent);font-size:14px;text-decoration:none;margin-bottom:16px;transition:color .2s; }
.back-link:hover { color:var(--accent-hover); }

.form-card { background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px;padding:32px;box-shadow:0 10px 40px rgba(0,0,0,0.1); }
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
    font-size:13px;font-weight:600;cursor:pointer;margin-right:12px;transition:background .2s;
}
.form-file::file-selector-button:hover { background:var(--accent-hover); }

.info-box {
    background:rgba(249,115,22,0.1);border:1px solid rgba(249,115,22,0.3);
    border-radius:12px;padding:16px;margin-bottom:20px;
}
.info-box h3 { font-size:14px;font-weight:700;color:var(--text-main);margin-bottom:8px; }
.info-box ul { font-size:12px;color:var(--text-main);line-height:1.6;list-style:none;padding:0;margin:0; }
.info-box li { margin-bottom:4px; }

.preview-container { margin-top:16px;display:none; }
.preview-container.active { display:block; }
.preview-grid { display:grid;grid-template-columns:repeat(auto-fill,minmax(140px,1fr));gap:16px; }
.preview-item {
    position:relative;display:flex;flex-direction:column;border-radius:12px;
    background:var(--card-bg);border:1px solid var(--card-border);padding:8px;cursor:pointer;transition:all .2s;
}
.preview-item:hover { transform:translateY(-4px);box-shadow:0 8px 20px rgba(0,0,0,0.15); }
.preview-item img {
    width:100%;height:140px;object-fit:cover;border-radius:8px;
    border:2px solid var(--card-border);transition:border-color .2s;
}
.preview-item .badge-label {
    position:absolute;top:12px;left:12px;padding:4px 10px;border-radius:50px;
    font-size:11px;font-weight:700;z-index:5;
}
.preview-item .btn-remove {
    position:absolute;top:4px;right:4px;width:26px;height:26px;
    background:#ef4444;color:#fff;border:none;border-radius:50%;
    font-size:14px;cursor:pointer;display:flex;align-items:center;justify-content:center;
    opacity:0;transition:opacity 0.2s;z-index:10;box-shadow:0 2px 8px rgba(0,0,0,0.4);
}
.preview-item:hover .btn-remove { opacity:1; }
.preview-item .btn-remove:hover { background:#dc2626;transform:scale(1.1); }

.form-actions { display:flex;gap:16px;margin-top:32px; }
.btn-submit {
    flex:1;padding:14px 24px;background:var(--accent);color:#111827;border:none;border-radius:50px;
    font-size:15px;font-weight:600;cursor:pointer;transition:all .3s;
    display:flex;align-items:center;justify-content:center;gap:8px;
}
.btn-submit:hover { background:var(--accent-hover);transform:translateY(-2px);box-shadow:0 8px 20px rgba(249,115,22,0.3); }
.btn-cancel {
    flex:1;padding:14px 24px;background:rgba(148,163,184,0.2);color:var(--text-main);border:none;border-radius:50px;
    font-size:15px;font-weight:600;cursor:pointer;transition:all .2s;text-decoration:none;text-align:center;
    display:flex;align-items:center;justify-content:center;
}
.btn-cancel:hover { background:rgba(148,163,184,0.3); }


.section-divider {
    font-size:16px;font-weight:700;color:var(--text-main);margin:32px 0 16px 0;
    padding-bottom:12px;border-bottom:2px solid var(--card-border);display:flex;align-items:center;gap:8px;
}

@media(max-width:900px) {
    .form-card { padding:24px; }
    .form-actions { flex-direction:column; }
    .preview-grid { grid-template-columns:repeat(auto-fill,minmax(110px,1fr)); }
    .preview-item img { height:110px; }
}
</style>
@endpush

@section('content')
<div class="content-wrapper" style="max-width:900px;margin:0 auto;">
    <a href="{{ route('seller.products.index') }}" class="back-link">
        <i class="uil uil-arrow-left"></i> Kembali ke Daftar Produk
    </a>

    <h1 class="page-title">Tambah Produk Baru</h1>
    <p class="page-subtitle">Isi formulir di bawah untuk menambahkan produk ke toko {{ $seller->nama_toko }}</p>

    @if($errors->any())
    <div class="alert alert-error">
        <i class="uil uil-exclamation-triangle"></i>
        <div class="alert-content">
            <div class="alert-title">Terjadi Kesalahan</div>
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
            <div class="section-divider">
                <i class="uil uil-info-circle"></i> Informasi Dasar Produk
            </div>

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

            {{-- Section: Harga & Stok --}}
            <div class="section-divider">
                <i class="uil uil-money-bill"></i> Harga & Stok
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

            {{-- Section: Foto Produk --}}
            <div class="section-divider">
                <i class="uil uil-images"></i> Foto Produk
            </div>

            {{-- Image Upload Info Box --}}
            <div class="info-box">
                <div style="display:flex;align-items:start;gap:12px;">
                    <i class="uil uil-info-circle" style="font-size:24px;color:var(--accent);margin-top:2px;"></i>
                    <div>
                        <h3>📸 Upload Banyak Foto Produk</h3>
                        <ul>
                            <li>✓ Pilih hingga <strong>5 foto sekaligus</strong> dengan tombol di bawah</li>
                            <li>✓ Klik pada foto untuk <strong>menentukan foto utama</strong> (yang tampil pertama)</li>
                            <li>✓ Klik tombol <strong>×</strong> di pojok foto untuk menghapus</li>
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
                
                <input type="hidden" name="primary_image_index" id="primary_image_index" value="0">
                
                <div class="preview-container" id="preview_container">
                    <p style="font-size:13px;font-weight:600;color:var(--text-main);margin-bottom:12px;">
                        <i class="uil uil-eye"></i> Preview Foto (klik untuk set foto utama)
                    </p>
                    <div class="preview-grid" id="preview_grid"></div>
                </div>
            </div>

            {{-- Form Actions --}}
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
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('images');
    const previewContainer = document.getElementById('preview_container');
    const previewGrid = document.getElementById('preview_grid');
    const primaryInput = document.getElementById('primary_image_index');
    
    let selectedFiles = [];
    
    imageInput.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        if (files.length > 5) {
            alert('Maksimal 5 foto');
            e.target.value = '';
            return;
        }
        selectedFiles = files;
        renderPreviews();
    });
    
    function renderPreviews() {
        previewGrid.innerHTML = '';
        
        if (selectedFiles.length > 0) {
            previewContainer.classList.add('active');
            
            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const imgContainer = document.createElement('div');
                    imgContainer.className = 'preview-item';
                    imgContainer.innerHTML = `
                        <span class="badge-label" style="background:${index === 0 ? 'var(--accent)' : 'rgba(0,0,0,0.6)'};color:${index === 0 ? '#111' : '#fff'};">${index === 0 ? 'Utama' : index + 1}</span>
                        <img src="${e.target.result}" style="border-color:${index === 0 ? 'var(--accent)' : 'var(--card-border)'};">
                        <button type="button" class="btn-remove">×</button>
                    `;
                    
                    imgContainer.onclick = function(ev) {
                        if (ev.target.classList.contains('btn-remove')) return;
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
            previewContainer.classList.remove('active');
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
    
    // Price formatting
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
        
        // Format on load if has old value
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
@endpush
