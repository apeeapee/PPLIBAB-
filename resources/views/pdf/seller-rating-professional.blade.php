@extends('pdf.pro-layout')

@section('content')
{{-- SRS-MartPlace-13: Laporan Daftar Produk Berdasarkan Rating --}}
{{-- Format: No | Produk | Kategori | Harga | Stock | Rating --}}
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
            <div class="metadata-value">{{ $user ?? $seller->nama_pic }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Nama Toko</div>
            <div class="metadata-value">{{ $seller->nama_toko }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Total Produk</div>
            <div class="metadata-value">{{ $products->count() }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Rata-rata Rating</div>
            <div class="metadata-value">{{ $products->where('avg_rating', '>', 0)->count() > 0 ? number_format($products->where('avg_rating', '>', 0)->avg('avg_rating'), 1) : '-' }}</div>
        </div>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th style="width:6%">NO</th>
            <th style="width:30%">PRODUK</th>
            <th style="width:18%">KATEGORI</th>
            <th style="width:18%">HARGA</th>
            <th style="width:14%">STOCK</th>
            <th style="width:14%">RATING</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $index => $product)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td><strong>{{ $product->name }}</strong></td>
            <td>{{ ucfirst(str_replace('-', ' ', $product->category_slug ?? '-')) }}</td>
            <td class="text-right">Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}</td>
            <td class="text-center">{{ $product->stock }}</td>
            <td class="text-center">
                @if($product->avg_rating > 0)
                    {{ number_format($product->avg_rating, 1) }}
                @else
                    -
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="no-data">Tidak ada data produk tersedia</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="warning-box" style="background:#f0f9ff;border-color:#3b82f6;">
    <p style="color:#1e40af;"><strong>KETERANGAN:</strong></p>
    <p style="color:#1e40af;">***) Diurutkan berdasarkan rating secara menurun (descending)</p>
</div>
@endsection
