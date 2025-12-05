@extends('layouts.seller')

@section('title', 'Laporan - ' . $seller->nama_toko)

@push('styles')
<style>
    .content-wrapper {
        padding-top: 30px;
    }
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
        margin-top: 10px;
        flex-wrap: wrap;
        gap: 16px;
    }
    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: var(--text-main);
        margin: 0;
    }
    .page-subtitle {
        color: var(--text-muted);
        margin: 4px 0 0 0;
    }

    .reports-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 24px;
        margin-bottom: 32px;
    }

    .report-card {
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        border-radius: 16px;
        padding: 32px;
        text-align: center;
        transition: all 0.3s;
        cursor: pointer;
        text-decoration: none;
        display: block;
    }

    .report-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.2);
    }

    .report-icon {
        width: 64px;
        height: 64px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        margin: 0 auto 20px;
    }

    .report-icon.blue {
        background: rgba(59,130,246,0.2);
        color: #3b82f6;
    }

    .report-icon.green {
        background: rgba(34,197,94,0.2);
        color: #22c55e;
    }

    .report-icon.orange {
        background: rgba(249,115,22,0.2);
        color: #f97316;
    }

    .report-title {
        font-size: 20px;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 8px;
    }

    .report-description {
        font-size: 14px;
        color: var(--text-muted);
        line-height: 1.5;
    }

    @media (max-width: 640px) {
        .reports-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="content-wrapper">
<div class="page-header">
    <div>
        <h1 class="page-title">Laporan</h1>
        <p class="page-subtitle">Kelola dan pantau laporan toko {{ $seller->nama_toko }}</p>
    </div>
</div>

<div class="reports-grid">
    <a href="{{ route('seller.reports.stock') }}" class="report-card">
        <div class="report-icon blue">
            <i class="uil uil-layers"></i>
        </div>
        <h3 class="report-title">Laporan Stok</h3>
        <p class="report-description">Daftar semua produk berdasarkan jumlah stok dari yang terbanyak hingga yang paling sedikit</p>
    </a>

    <a href="{{ route('seller.reports.rating') }}" class="report-card">
        <div class="report-icon green">
            <i class="uil uil-star"></i>
        </div>
        <h3 class="report-title">Laporan Rating</h3>
        <p class="report-description">Daftar produk berdasarkan rating ulasan dari pelanggan</p>
    </a>

    <a href="{{ route('seller.reports.restock') }}" class="report-card">
        <div class="report-icon orange">
            <i class="uil uil-exclamation-triangle"></i>
        </div>
        <h3 class="report-title">Laporan Restock</h3>
        <p class="report-description">Daftar produk yang perlu segera di-restock karena stok tersisa sedikit</p>
    </a>
</div>
</div>
@endsection