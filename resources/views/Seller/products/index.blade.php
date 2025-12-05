@extends('layouts.seller')

@section('title', 'Produk Saya - ' . $seller->nama_toko)

@push('styles')
@include('partials.seller-styles')
<style>
    .products-grid { display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:24px;margin-bottom:32px; }
    
    .product-card { background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px;overflow:hidden;transition:transform .3s,box-shadow .3s; }
    .product-card:hover { transform:translateY(-4px);box-shadow:0 12px 24px rgba(0,0,0,0.2); }
    
    .product-image { position:relative;height:220px;background:linear-gradient(135deg,rgba(249,115,22,0.1),rgba(249,115,22,0.05));overflow:hidden; }
    .product-image img { width:100%;height:100%;object-fit:cover; }
    .placeholder { display:flex;align-items:center;justify-content:center;height:100%;color:var(--text-muted);font-size:48px; }
    
    .product-badge { position:absolute;top:12px;padding:6px 12px;border-radius:8px;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.5px; }
    .product-badge.left { left:12px;background:rgba(249,115,22,0.9);color:white; }
    .product-badge.right { right:12px; }
    .stock-low { background:rgba(239,68,68,0.9);color:white; }
    .stock-ok { background:rgba(34,197,94,0.9);color:white; }
    
    .product-info { padding:20px; }
    .product-name { font-size:18px;font-weight:700;color:var(--text-main);margin-bottom:8px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden; }
    .product-desc { font-size:13px;color:var(--text-muted);margin-bottom:16px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden; }
    
    .product-meta { display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:16px;padding:12px;background:rgba(249,115,22,0.05);border-radius:8px; }
    .product-meta-item label { font-size:11px;color:var(--text-muted);text-transform:uppercase;margin-bottom:4px;display:block; }
    .product-meta-item .value { font-size:16px;font-weight:700; }
    .product-meta-item .value.price { color:var(--accent); }
    
    .product-actions { display:flex;gap:8px; }
    .product-actions form { flex:1; }
    .action-btn { flex:1;padding:10px;border-radius:8px;font-size:13px;font-weight:600;text-align:center;text-decoration:none;border:none;cursor:pointer;transition:all .2s;display:flex;align-items:center;justify-content:center;gap:6px; }
    .action-btn.view { background:rgba(59,130,246,0.1);color:#3b82f6; }
    .action-btn.view:hover { background:rgba(59,130,246,0.2); }
    .action-btn.edit { background:rgba(249,115,22,0.1);color:var(--accent); }
    .action-btn.edit:hover { background:rgba(249,115,22,0.2); }
    .action-btn.delete { background:rgba(239,68,68,0.1);color:#ef4444; }
    .action-btn.delete:hover { background:rgba(239,68,68,0.2); }
    
        
    .empty-state { text-align:center;padding:60px 24px;background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px; }
    .empty-state i { font-size:64px;color:var(--text-muted);margin-bottom:16px; }
    .empty-state h3 { font-size:20px;font-weight:700;color:var(--text-main);margin-bottom:8px; }
    .empty-state p { color:var(--text-muted);margin-bottom:24px; }
    
    .alert { padding:16px 20px;border-radius:12px;margin-bottom:24px;display:flex;align-items:center;gap:12px; }
    .alert-success { background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.3);color:#22c55e; }
    .alert-error { background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);color:#ef4444; }
    .alert i { font-size:20px; }
</style>
@endpush

@section('content')
<div class="content-wrapper">
<div class="page-header-with-actions">
    <div>
        <h1 class="page-title">Produk Saya</h1>
        <p class="page-subtitle">Kelola semua produk toko {{ $seller->nama_toko }}</p>
    </div>
    @if($seller->status === 'approved')
    <a href="{{ route('seller.products.create') }}" class="btn-add">
        <i class="uil uil-plus"></i> Tambah Produk
    </a>
    @endif
</div>

@if(session('success'))
<div class="alert alert-success">
    <i class="uil uil-check-circle"></i>
    <div class="alert-content">
        <div class="alert-text">{{ session('success') }}</div>
    </div>
</div>
@endif

@if(session('error'))
<div class="alert alert-error">
    <i class="uil uil-times-circle"></i>
    <div class="alert-content">
        <div class="alert-text">{{ session('error') }}</div>
    </div>
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
</div>
@endif
</div>
@endsection
