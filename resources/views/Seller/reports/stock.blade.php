@extends('layouts.seller')

@section('title', 'Laporan Stok Produk - ' . $seller->nama_toko)

@section('content')
<div class="content-wrapper" style="padding-top: 30px;">
{{-- Header --}}
<div class="mb-6 sm:mb-8">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold" style="color:var(--text-main)">Laporan Daftar Produk Berdasarkan Stock</h1>
            <p class="text-sm sm:text-base" style="color:var(--text-muted)">Diurutkan berdasarkan stock secara menurun</p>
        </div>
        <div class="text-center sm:text-right px-4 sm:px-6 py-3 sm:py-4 rounded-xl shadow-lg text-white" style="background:linear-gradient(135deg,var(--accent),#ea580c)">
            <div class="text-xs sm:text-sm opacity-90 mb-1">{{ now()->format('d F Y') }}</div>
            <div class="text-2xl sm:text-3xl font-bold">{{ $products->count() }}</div>
            <div class="text-xs sm:text-sm opacity-90">Total Produk</div>
        </div>
    </div>
</div>

<div class="my-6 sm:my-8">
    <div class="h-1 rounded-full shadow-md" style="background:linear-gradient(90deg, rgba(249,115,22,0.2) 0%, var(--accent) 50%, rgba(249,115,22,0.2) 100%)"></div>
</div>

{{-- Statistics Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
    <div class="rounded-xl shadow-md p-4 sm:p-6" style="background:var(--card-bg);border:1px solid var(--card-border)">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background:rgba(59,130,246,0.1);color:#3b82f6">
                <i class="uil uil-box"></i>
            </div>
            <div>
                <div class="text-2xl font-bold" style="color:var(--text-main)">{{ $products->count() }}</div>
                <div class="text-xs sm:text-sm" style="color:var(--text-muted)">Total Produk</div>
            </div>
        </div>
    </div>
    <div class="rounded-xl shadow-md p-4 sm:p-6" style="background:var(--card-bg);border:1px solid var(--card-border)">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background:rgba(34,197,94,0.1);color:#22c55e">
                <i class="uil uil-check-circle"></i>
            </div>
            <div>
                <div class="text-2xl font-bold" style="color:var(--text-main)">{{ $products->where('stock', '>', 10)->count() }}</div>
                <div class="text-xs sm:text-sm" style="color:var(--text-muted)">Stok Aman</div>
            </div>
        </div>
    </div>
    <div class="rounded-xl shadow-md p-4 sm:p-6" style="background:var(--card-bg);border:1px solid var(--card-border)">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background:rgba(234,179,8,0.1);color:#eab308">
                <i class="uil uil-exclamation-triangle"></i>
            </div>
            <div>
                <div class="text-2xl font-bold" style="color:var(--text-main)">{{ $products->whereBetween('stock', [1, 10])->count() }}</div>
                <div class="text-xs sm:text-sm" style="color:var(--text-muted)">Stok Menipis</div>
            </div>
        </div>
    </div>
    <div class="rounded-xl shadow-md p-4 sm:p-6" style="background:var(--card-bg);border:1px solid var(--card-border)">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background:rgba(239,68,68,0.1);color:#ef4444">
                <i class="uil uil-times-circle"></i>
            </div>
            <div>
                <div class="text-2xl font-bold" style="color:var(--text-main)">{{ $products->where('stock', 0)->count() }}</div>
                <div class="text-xs sm:text-sm" style="color:var(--text-muted)">Stok Habis</div>
            </div>
        </div>
    </div>
</div>

{{-- Export Buttons --}}
<div class="flex gap-3 mb-6 flex-wrap">
    <a href="{{ route('seller.reports.stock.export') }}" class="px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-all shadow-md text-white" style="background:linear-gradient(135deg,#ef4444,#dc2626)">
        <i class="uil uil-file-download-alt"></i> Export PDF
    </a>
    <button onclick="window.print()" class="px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-all shadow-md text-white" style="background:linear-gradient(135deg,#3b82f6,#2563eb)">
        <i class="uil uil-print"></i> Cetak
    </button>
</div>

<div class="my-6 sm:my-8">
    <div class="h-1 rounded-full shadow-md" style="background:linear-gradient(90deg, rgba(249,115,22,0.2) 0%, var(--accent) 50%, rgba(249,115,22,0.2) 100%)"></div>
</div>

{{-- Data Table --}}
<div class="rounded-xl shadow-lg overflow-hidden" style="background:var(--card-bg);border:1px solid var(--card-border)">
    <div class="px-4 sm:px-6 py-4" style="border-bottom:1px solid var(--card-border)">
        <h2 class="text-lg font-semibold" style="color:var(--text-main)">Daftar Produk (Urutan Stock Menurun)</h2>
        <p class="text-xs sm:text-sm mt-1" style="color:var(--text-muted)">Dibuat: {{ now()->format('d M Y, H:i') }} oleh {{ auth()->user()->name }}</p>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead style="background:rgba(249,115,22,0.05)">
                <tr>
                    <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider" style="color:var(--text-muted)">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color:var(--text-muted)">Produk</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color:var(--text-muted)">Kategori</th>
                    <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider" style="color:var(--text-muted)">Harga</th>
                    <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider" style="color:var(--text-muted)">Rating</th>
                    <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider" style="color:var(--text-muted)">Stock</th>
                </tr>
            </thead>
            <tbody style="color:var(--text-main)">
                @forelse($products as $index => $product)
                <tr class="hover:bg-opacity-50 transition-colors" style="border-bottom:1px solid var(--card-border)">
                    <td class="px-6 py-4 text-center text-sm">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm font-medium">{{ $product->name }}</td>
                    <td class="px-6 py-4 text-sm">{{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}</td>
                    <td class="px-6 py-4 text-sm text-right">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-center">
                        <span style="color:#eab308">{{ number_format($product->avg_rating ?? 0, 1) }} <i class="uil uil-star"></i></span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($product->stock > 10)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium" style="background:rgba(34,197,94,0.1);color:#22c55e">{{ $product->stock }} unit</span>
                        @elseif($product->stock > 0)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium" style="background:rgba(234,179,8,0.1);color:#eab308">{{ $product->stock }} unit</span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium" style="background:rgba(239,68,68,0.1);color:#ef4444">Habis</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <i class="uil uil-box text-4xl sm:text-5xl mb-3" style="color:var(--text-muted)"></i>
                        <p class="text-sm sm:text-base" style="color:var(--text-muted)">Belum ada produk</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Info Box --}}
<div class="mt-6 p-4 rounded-xl" style="background:rgba(59,130,246,0.1);border:1px solid rgba(59,130,246,0.3)">
    <p class="text-sm" style="color:#3b82f6"><strong>Keterangan:</strong> Diurutkan berdasarkan stock secara menurun (descending)</p>
</div>
</div>
@endsection
