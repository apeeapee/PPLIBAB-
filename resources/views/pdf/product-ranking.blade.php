@extends('pdf.layout')

@section('content')
{{-- Laporan daftar produk dan rating-nya yang diurutkan berdasarkan rating secara menurun (descending) --}}

<div class="srs-reference">
    <strong>Referensi Laporan:</strong> Daftar produk dan rating berdasarkan rating tertinggi
</div>

<div class="stats-row">
    <div class="stat-box">
        <div class="value">{{ $products->count() }}</div>
        <div class="label">Total Produk</div>
    </div>
    <div class="stat-box">
        <div class="value">{{ $products->where('avg_rating', '>', 0)->count() }}</div>
        <div class="label">Produk Dengan Rating</div>
    </div>
    <div class="stat-box">
        <div class="value">{{ $products->max('avg_rating') > 0 ? number_format($products->max('avg_rating'), 1) : '0.0' }}</div>
        <div class="label">Rating Tertinggi</div>
    </div>
    <div class="stat-box">
        <div class="value">{{ $products->sum('review_count') ?? 0 }}</div>
        <div class="label">Total Review</div>
    </div>
</div>

<div class="info-box">
    <p><strong>Jenis Laporan:</strong> Daftar produk dan rating yang diurutkan berdasarkan rating secara menurun (descending)</p>
    <p><strong>Format:</strong> PDF</p>
    <p><strong>Urutan:</strong> Rating tertinggi ke terendah</p>
    <p><strong>Total Produk:</strong> {{ $products->count() }} produk</p>
    @if($category)
    <p><strong>Kategori Filter:</strong> {{ ucfirst(str_replace('-', ' ', $category)) }}</p>
    @endif
    <p><strong>Kriteria:</strong> Setiap produk dilengkapi nama toko, kategori produk, harga, dan lokasi provinsi</p>
</div>

<h3 style="margin-bottom: 15px; color: #f97316;">🏆 Peringkat Produk Berdasarkan Rating</h3>
<table>
    <thead>
        <tr>
            <th style="width:5%">No</th>
            <th style="width:22%">Nama Produk</th>
            <th style="width:15%">Nama Toko</th>
            <th style="width:13%">Kategori Produk</th>
            <th style="width:12%">Harga</th>
            <th style="width:13%">Lokasi Provinsi</th>
            <th style="width:10%">Rating</th>
            <th style="width:10%">Jumlah Review</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $index => $product)
        <tr @if($product->avg_rating >= 4.5) class="highlight-row" @endif>
            <td class="text-center">{{ $index + 1 }}</td>
            <td><strong>{{ $product->name }}</strong></td>
            <td>{{ $product->nama_toko ?? $product->seller_name ?? '-' }}</td>
            <td>{{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}</td>
            <td class="text-right">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
            <td>{{ $product->seller_province ?? '-' }}</td>
            <td class="text-center">
                @if($product->avg_rating > 0)
                    <span class="badge badge-success">{{ number_format($product->avg_rating, 1) }} ★</span>
                @else
                    <span class="badge badge-info">Belum Ada</span>
                @endif
            </td>
            <td class="text-center">{{ $product->review_count ?? 0 }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="no-data">Tidak ada data produk tersedia</td>
        </tr>
        @endforelse
    </tbody>
</table>

@if($products->count() > 0)
<div class="page-break"></div>

<div class="info-box">
    <p><strong>Ringkasan Peringkat:</strong></p>
    <p>• <strong>Produk Rating Tertinggi (5.0 ★):</strong> {{ $products->where('avg_rating', 5.0)->count() }} produk</p>
    <p>• <strong>Produk Rating Tinggi (4.0-4.9 ★):</strong> {{ $products->whereBetween('avg_rating', [4.0, 4.9])->count() }} produk</p>
    <p>• <strong>Produk Rating Sedang (3.0-3.9 ★):</strong> {{ $products->whereBetween('avg_rating', [3.0, 3.9])->count() }} produk</p>
    <p>• <strong>Produk Rating Rendah (1.0-2.9 ★):</strong> {{ $products->whereBetween('avg_rating', [1.0, 2.9])->count() }} produk</p>
    <p>• <strong>Produk Belum Ada Rating:</strong> {{ $products->where('avg_rating', 0)->count() }} produk</p>
</div>

<table>
    <thead>
        <tr>
            <th>Kategori Rating</th>
            <th>Jumlah Produk</th>
            <th>Persentase</th>
            <th>Deskripsi</th>
        </tr>
    </thead>
    <tbody>
        <tr class="highlight-row">
            <td><span class="badge badge-success">Rating 5.0 ★</span></td>
            <td class="text-center">{{ $products->where('avg_rating', 5.0)->count() }}</td>
            <td class="text-center">{{ $products->count() > 0 ? round(($products->where('avg_rating', 5.0)->count() / $products->count()) * 100, 1) : 0 }}%</td>
            <td>Sangat Memuaskan</td>
        </tr>
        <tr>
            <td><span class="badge badge-success">Rating 4.0-4.9 ★</span></td>
            <td class="text-center">{{ $products->whereBetween('avg_rating', [4.0, 4.9])->count() }}</td>
            <td class="text-center">{{ $products->count() > 0 ? round(($products->whereBetween('avg_rating', [4.0, 4.9])->count() / $products->count()) * 100, 1) : 0 }}%</td>
            <td>Memuaskan</td>
        </tr>
        <tr>
            <td><span class="badge badge-warning">Rating 3.0-3.9 ★</span></td>
            <td class="text-center">{{ $products->whereBetween('avg_rating', [3.0, 3.9])->count() }}</td>
            <td class="text-center">{{ $products->count() > 0 ? round(($products->whereBetween('avg_rating', [3.0, 3.9])->count() / $products->count()) * 100, 1) : 0 }}%</td>
            <td>Cukup Memuaskan</td>
        </tr>
        <tr>
            <td><span class="badge badge-danger">Rating 1.0-2.9 ★</span></td>
            <td class="text-center">{{ $products->whereBetween('avg_rating', [1.0, 2.9])->count() }}</td>
            <td class="text-center">{{ $products->count() > 0 ? round(($products->whereBetween('avg_rating', [1.0, 2.9])->count() / $products->count()) * 100, 1) : 0 }}%</td>
            <td>Kurang Memuaskan</td>
        </tr>
        <tr>
            <td><span class="badge badge-info">Belum Ada Rating</span></td>
            <td class="text-center">{{ $products->where('avg_rating', 0)->count() }}</td>
            <td class="text-center">{{ $products->count() > 0 ? round(($products->where('avg_rating', 0)->count() / $products->count()) * 100, 1) : 0 }}%</td>
            <td>Menunggu Review</td>
        </tr>
    </tbody>
</table>

@if($products->where('avg_rating', '>', 0)->count() > 0)
<h3 style="margin-bottom: 15px; color: #f97316;">🌟 Top 10 Produk Terbaik</h3>
<table>
    <thead>
        <tr>
            <th style="width:5%">Rank</th>
            <th style="width:25%">Nama Produk</th>
            <th style="width:20%">Nama Toko</th>
            <th style="width:15%">Rating</th>
            <th style="width:10%">Harga</th>
            <th style="width:15%">Lokasi</th>
            <th style="width:10%">Review</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products->take(10) as $index => $product)
        @if($product->avg_rating > 0)
        <tr class="highlight-row">
            <td class="text-center"><strong>{{ $index + 1 }}</strong></td>
            <td><strong>{{ $product->name }}</strong></td>
            <td>{{ $product->nama_toko ?? $product->seller_name ?? '-' }}</td>
            <td class="text-center"><span class="badge badge-success">{{ number_format($product->avg_rating, 1) }} ★</span></td>
            <td class="text-right">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
            <td>{{ $product->seller_province ?? '-' }}</td>
            <td class="text-center">{{ $product->review_count ?? 0 }}</td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>
@endif
@endif

<div class="info-box" style="margin-top: 30px;">
    <p><strong>Keterangan Laporan:</strong></p>
    <p>Laporan ini menampilkan daftar produk dan rating-nya yang diurutkan berdasarkan rating secara menurun (descending).</p>
    <p>Setiap produk dilengkapi dengan informasi nama toko, kategori produk, harga, dan lokasi provinsi.</p>
    <p>Urutan ditampilkan dari rating tertinggi hingga terendah untuk memudahkan evaluasi kualitas produk.</p>
</div>
@endsection
