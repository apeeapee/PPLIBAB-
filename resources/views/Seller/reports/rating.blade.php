@extends('layouts.seller')

@section('title', 'Laporan Rating Produk - ' . $seller->nama_toko)

@push('styles')
<style>
    .page-header { display:flex;justify-content:space-between;align-items:center;margin-bottom:32px;flex-wrap:wrap;gap:16px; }
    .page-title { font-size:28px;font-weight:700;color:var(--text-main);margin:0; }
    .page-subtitle { color:var(--text-muted);margin:4px 0 0 0; }
    
    .stats-grid { display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;margin-bottom:32px; }
    .stat-card { background:var(--card-bg);border:1px solid var(--card-border);border-radius:12px;padding:20px;display:flex;align-items:center;gap:16px; }
    .stat-icon { width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:24px; }
    .stat-icon.blue { background:rgba(59,130,246,0.1);color:#3b82f6; }
    .stat-icon.green { background:rgba(34,197,94,0.1);color:#22c55e; }
    .stat-icon.yellow { background:rgba(234,179,8,0.1);color:#eab308; }
    .stat-icon.orange { background:rgba(249,115,22,0.1);color:var(--accent); }
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
    
    .badge { padding:6px 12px;border-radius:6px;font-size:12px;font-weight:600; }
    .badge-green { background:rgba(34,197,94,0.1);color:#22c55e; }
    .badge-yellow { background:rgba(234,179,8,0.1);color:#eab308; }
    .badge-red { background:rgba(239,68,68,0.1);color:#ef4444; }
    
    .rating-stars { display:flex;gap:2px; }
    .rating-stars i.filled { color:#eab308; }
    .rating-stars i.empty { color:var(--text-muted);opacity:0.3; }
    
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
        <div>
            <div class="stat-value">{{ $products->count() }}</div>
            <div class="stat-label">Total Produk</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon yellow"><i class="uil uil-star"></i></div>
        <div>
            <div class="stat-value">{{ $products->count() > 0 ? number_format($products->avg('avg_rating'), 1) : '0' }}</div>
            <div class="stat-label">Rata-rata Rating</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="uil uil-trophy"></i></div>
        <div>
            <div class="stat-value">{{ $products->where('avg_rating', '>=', 4)->count() }}</div>
            <div class="stat-label">Rating 4+ Bintang</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange"><i class="uil uil-comment-alt-lines"></i></div>
        <div>
            <div class="stat-value">{{ $products->sum('review_count') }}</div>
            <div class="stat-label">Total Review</div>
        </div>
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
                            <i class="uil uil-box"></i>
                            <p>Belum ada produk</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection
