@extends('pdf.pro-layout')

@section('content')
{{-- SRS-MartPlace-11: Laporan Daftar Produk Berdasarkan Rating --}}
{{-- Format: No | Produk | Kategori | Harga | Rating | Nama Toko | Propinsi --}}
{{-- ***) propinsi diisikan propinsi pemberi rating --}}
{{-- Urutan: berdasarkan rating secara menurun (descending) --}}

<h2 class="section-title">LAPORAN DAFTAR PRODUK BERDASARKAN RATING</h2>

<div class="metadata-section">
    <div class="metadata-grid">
        <div class="metadata-item">
            <div class="metadata-label">Tanggal Dibuat</div>
            <div class="metadata-value">{{ $generatedDate->format('d-m-Y') }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Dibuat Oleh</div>
            <div class="metadata-value">{{ $user ?? 'Admin' }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Total Produk</div>
            <div class="metadata-value">{{ $products->count() }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Filter Kategori</div>
            <div class="metadata-value">{{ $category ? ucfirst(str_replace('-', ' ', $category)) : 'Semua' }}</div>
        </div>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th style="width:5%">NO</th>
            <th style="width:22%">PRODUK</th>
            <th style="width:14%">KATEGORI</th>
            <th style="width:14%">HARGA</th>
            <th style="width:10%">RATING</th>
            <th style="width:18%">NAMA TOKO</th>
            <th style="width:17%">PROPINSI</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $index => $product)
        @php
            // SRS-11: Propinsi diisi propinsi pemberi rating (reviewer)
            $reviewerProvince = \App\Models\Review::where('product_id', $product->id)
                ->whereNotNull('guest_province')
                ->orderBy('created_at', 'desc')
                ->value('guest_province') ?? '-';
        @endphp
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td><strong>{{ $product->name }}</strong></td>
            <td>{{ ucfirst(str_replace('-', ' ', $product->category_slug ?? 'Uncategorized')) }}</td>
            <td class="text-right">Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}</td>
            <td class="text-center">
                @if($product->avg_rating > 0)
                    <span class="badge badge-success">{{ number_format($product->avg_rating, 1) }}</span>
                @else
                    <span class="badge badge-warning">-</span>
                @endif
            </td>
            <td>{{ $product->nama_toko ?? $product->seller_name ?? '-' }}</td>
            <td>{{ $reviewerProvince }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="no-data">Tidak ada data produk tersedia</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="warning-box" style="background:#f0f9ff;border-color:#3b82f6;">
    <p style="color:#1e40af;"><strong>KETERANGAN:</strong></p>
    <p style="color:#1e40af;">***) Propinsi diisikan propinsi pemberi rating</p>
    <p style="color:#1e40af;">***) Diurutkan berdasarkan rating secara menurun (descending)</p>
</div>
@endsection
