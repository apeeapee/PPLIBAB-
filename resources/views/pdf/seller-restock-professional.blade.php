@extends('pdf.pro-layout')

@section('content')
{{-- SRS-MartPlace-14: Laporan Daftar Produk Segera Dipesan --}}
{{-- Format: No | Produk | Kategori | Harga | Stock --}}
{{-- Kriteria: stock < 2 --}}
{{-- Urutan: berdasarkan kategori dan produk alfabetis --}}

<h2 class="section-title">LAPORAN DAFTAR PRODUK SEGERA DIPESAN</h2>

<div class="metadata-section">
    <div class="metadata-grid">
        <div class="metadata-item">
            <div class="metadata-label">Tanggal Dibuat</div>
            <div class="metadata-value">{{ $generatedDate->format('d-m-Y') }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Dibuat Oleh</div>
            <div class="metadata-value">{{ $user ?? $seller->nama_pic }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Nama Toko</div>
            <div class="metadata-value">{{ $seller->nama_toko }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Kriteria Stock</div>
            <div class="metadata-value">&lt; {{ $threshold }} unit</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Produk Perlu Restock</div>
            <div class="metadata-value">{{ $products->count() }}</div>
        </div>
    </div>
</div>

@if($products->count() > 0)
<div class="warning-box">
    <p><strong>PERINGATAN:</strong> Terdapat {{ $products->count() }} produk yang membutuhkan restock segera!</p>
</div>
@endif

<table>
    <thead>
        <tr>
            <th style="width:8%">NO</th>
            <th style="width:35%">PRODUK</th>
            <th style="width:22%">KATEGORI</th>
            <th style="width:20%">HARGA</th>
            <th style="width:15%">STOCK</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $index => $product)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td><strong>{{ $product->name }}</strong></td>
            <td>{{ ucfirst(str_replace('-', ' ', $product->category_slug ?? '-')) }}</td>
            <td class="text-right">Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}</td>
            <td class="text-center">
                @if($product->stock == 0)
                    <span class="badge badge-danger">HABIS</span>
                @else
                    <span class="badge badge-warning">{{ $product->stock }}</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="no-data" style="color:#166534;">
                Tidak ada produk yang memerlukan restock
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="warning-box" style="background:#f0f9ff;border-color:#3b82f6;">
    <p style="color:#1e40af;"><strong>KETERANGAN:</strong></p>
    <p style="color:#1e40af;">***) Diurutkan berdasarkan kategori dan produk alfabetis</p>
    <p style="color:#1e40af;">***) Stock produk yang segera dipesan jika stock &lt; {{ $threshold }}</p>
</div>
@endsection
