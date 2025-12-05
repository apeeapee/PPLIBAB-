@extends('layouts.seller')

@section('title', 'Restock Alert - ' . $seller->nama_toko)

@push('styles')
<style>
    .page-header { display:flex;justify-content:space-between;align-items:center;margin-bottom:32px;flex-wrap:wrap;gap:16px; }
    .page-title { font-size:28px;font-weight:700;color:var(--text-main);margin:0; }
    .page-subtitle { color:var(--text-muted);margin:4px 0 0 0; }
    
    .alert { padding:20px 24px;border-radius:12px;margin-bottom:32px;display:flex;align-items:start;gap:16px; }
    .alert-warning { background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3); }
    .alert-success { background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.3); }
    .alert i { font-size:24px;margin-top:2px; }
    .alert-warning i { color:#ef4444; }
    .alert-success i { color:#22c55e; }
    .alert-title { font-size:16px;font-weight:700;margin-bottom:4px; }
    .alert-text { font-size:14px;color:var(--text-muted); }
    
    @keyframes pulse { 0%, 100% { opacity:1; } 50% { opacity:0.5; } }
    .pulse { animation:pulse 2s infinite; }
    
    .stats-grid { display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;margin-bottom:32px; }
    .stat-card { background:var(--card-bg);border:1px solid var(--card-border);border-radius:12px;padding:20px;display:flex;align-items:center;gap:16px; }
    .stat-icon { width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:24px; }
    .stat-icon.red { background:rgba(239,68,68,0.1);color:#ef4444; }
    .stat-icon.orange { background:rgba(249,115,22,0.1);color:var(--accent); }
    .stat-icon.yellow { background:rgba(234,179,8,0.1);color:#eab308; }
    .stat-value { font-size:28px;font-weight:700;color:var(--text-main); }
    .stat-label { font-size:13px;color:var(--text-muted); }
    
    .card { background:var(--card-bg);border:1px solid var(--card-border);border-radius:16px;overflow:hidden; }
    .card-header { padding:24px;border-bottom:1px solid var(--card-border);display:flex;justify-content:space-between;align-items:center; }
    .card-title { font-size:18px;font-weight:700;color:var(--text-main);margin:0; }
    
    .table-wrap { overflow-x:auto; }
    table { width:100%;border-collapse:collapse; }
    thead { background:rgba(249,115,22,0.05); }
    th { padding:16px;text-align:left;font-size:13px;font-weight:700;color:var(--text-main);border-bottom:1px solid var(--card-border); }
    td { padding:16px;font-size:14px;color:var(--text-main);border-bottom:1px solid var(--card-border); }
    tbody tr:hover { background:rgba(249,115,22,0.03); }
    tbody tr.critical { background:rgba(239,68,68,0.05); }
    
    .badge { padding:6px 12px;border-radius:6px;font-size:12px;font-weight:600; }
    .badge-red { background:rgba(239,68,68,0.1);color:#ef4444; }
    .badge-yellow { background:rgba(234,179,8,0.1);color:#eab308; }
    
    .btn-action { display:inline-flex;align-items:center;gap:8px;padding:10px 20px;border-radius:10px;font-size:14px;font-weight:600;text-decoration:none;border:none;cursor:pointer;transition:all .2s; }
    .btn-success { background:rgba(34,197,94,0.1);color:#22c55e; }
    .btn-success:hover { background:rgba(34,197,94,0.2); }
    .btn-primary { background:rgba(59,130,246,0.1);color:#3b82f6; }
    .btn-primary:hover { background:rgba(59,130,246,0.2); }
    
    .empty-state { text-align:center;padding:40px;color:var(--text-muted); }
    .empty-state i { font-size:48px;margin-bottom:12px; }
    
    @media print {
        .no-print { display:none !important; }
        body { background:white;color:black; }
        .card { border:1px solid #e5e7eb; }
    }
</style>
@endpush

@section('content')
<div class="main-container">
<div class="page-header">
    <div>
        <h1 class="page-title">Restock Alert</h1>
        <p class="page-subtitle">Produk dengan stok di bawah {{ $threshold }} unit</p>
    </div>
    <div class="no-print" style="display:flex;gap:12px;">
        <a href="{{ route('seller.reports.restock.export') }}" class="btn-action btn-success">
            <i class="uil uil-file-download-alt"></i> Export Excel
        </a>
        <button onclick="window.print()" class="btn-action btn-primary">
            <i class="uil uil-print"></i> Cetak
        </button>
    </div>
</div>

@if($totalProducts == 0)
<div class="alert alert-success">
    <i class="uil uil-info-circle"></i>
    <div>
        <div class="alert-title" style="color:#22c55e;">Belum Ada Produk</div>
        <div class="alert-text">Toko Anda belum memiliki produk. <a href="{{ route('seller.products.create') }}" style="color:#f97316;font-weight:600;">Tambahkan produk pertama</a> untuk mulai berjualan.</div>
    </div>
</div>
@elseif($products->count() > 0)
<div class="alert alert-warning">
    <i class="uil uil-exclamation-triangle pulse"></i>
    <div>
        <div class="alert-title" style="color:#ef4444;">Peringatan Stok Rendah!</div>
        <div class="alert-text">Anda memiliki <strong style="color:#ef4444;">{{ $products->count() }} produk</strong> dengan stok di bawah {{ $threshold }} unit. Segera lakukan restock.</div>
    </div>
</div>
@endif

@if($totalProducts > 0)
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon red"><i class="uil uil-exclamation-triangle"></i></div>
        <div>
            <div class="stat-value">{{ $products->count() }}</div>
            <div class="stat-label">Perlu Restock</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange"><i class="uil uil-times-circle"></i></div>
        <div>
            <div class="stat-value">{{ $products->where('stock', 0)->count() }}</div>
            <div class="stat-label">Stok Habis</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon yellow"><i class="uil uil-info-circle"></i></div>
        <div>
            <div class="stat-value">{{ $threshold }}</div>
            <div class="stat-label">Batas Stok Minimum</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">Daftar Produk Perlu Restock</h2>
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
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index => $product)
                <tr class="{{ $product->stock == 0 ? 'critical' : '' }}">
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:8px;">
                            @if($product->stock == 0)
                            <i class="uil uil-exclamation-circle" style="color:#ef4444;font-size:18px;"></i>
                            @endif
                            <span style="font-weight:600;">{{ $product->name }}</span>
                        </div>
                    </td>
                    <td>{{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}</td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>
                        @if($product->stock == 0)
                            <span class="badge badge-red">Habis</span>
                        @else
                            <span class="badge badge-yellow">{{ $product->stock }} unit</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <i class="uil uil-check-circle"></i>
                            <p>Semua produk memiliki stok yang cukup!</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endif
</div>
@endsection
