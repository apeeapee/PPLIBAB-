@extends('layouts.seller')

@section('title', 'Restock Alert - ' . $seller->nama_toko)

@section('content')
<div class="content-wrapper" style="padding-top: 30px;">
{{-- Header --}}
<div class="mb-6 sm:mb-8">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold" style="color:var(--text-main)">Laporan Daftar Produk Segera Dipesan</h1>
            <p class="text-sm sm:text-base" style="color:var(--text-muted)">Produk dengan stok &lt; {{ $threshold }} unit</p>
        </div>
        <div class="text-center sm:text-right px-4 sm:px-6 py-3 sm:py-4 rounded-xl shadow-lg text-white" style="background:linear-gradient(135deg,#ef4444,#dc2626)">
            <div class="text-xs sm:text-sm opacity-90 mb-1">{{ now()->format('d F Y') }}</div>
            <div class="text-2xl sm:text-3xl font-bold">{{ $products->count() }}</div>
            <div class="text-xs sm:text-sm opacity-90">Perlu Restock</div>
        </div>
    </div>
</div>

<div class="my-6 sm:my-8">
    <div class="h-1 rounded-full shadow-md" style="background:linear-gradient(90deg, rgba(249,115,22,0.2) 0%, var(--accent) 50%, rgba(249,115,22,0.2) 100%)"></div>
</div>

{{-- Alert --}}
@if($totalProducts == 0)
<div class="p-4 rounded-xl mb-6 flex items-start gap-4" style="background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.3)">
    <i class="uil uil-info-circle text-2xl mt-0.5" style="color:#22c55e"></i>
    <div>
        <div class="font-bold mb-1" style="color:#22c55e">Belum Ada Produk</div>
        <div class="text-sm" style="color:var(--text-muted)">Toko Anda belum memiliki produk. <a href="{{ route('seller.products.create') }}" class="font-semibold" style="color:var(--accent)">Tambahkan produk pertama</a> untuk mulai berjualan.</div>
    </div>
</div>
@elseif($products->count() > 0)
<div class="p-4 rounded-xl mb-6 flex items-start gap-4" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3)">
    <i class="uil uil-exclamation-triangle text-2xl mt-0.5 animate-pulse" style="color:#ef4444"></i>
    <div>
        <div class="font-bold mb-1" style="color:#ef4444">Peringatan Stok Rendah!</div>
        <div class="text-sm" style="color:var(--text-muted)">Anda memiliki <strong style="color:#ef4444">{{ $products->count() }} produk</strong> dengan stok di bawah {{ $threshold }} unit. Segera lakukan restock.</div>
    </div>
</div>
@endif

@if($totalProducts > 0)
{{-- Statistics Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
    <div class="rounded-xl shadow-md p-4 sm:p-6" style="background:var(--card-bg);border:1px solid var(--card-border)">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background:rgba(239,68,68,0.1);color:#ef4444">
                <i class="uil uil-exclamation-triangle"></i>
            </div>
            <div>
                <div class="text-2xl font-bold" style="color:var(--text-main)">{{ $products->count() }}</div>
                <div class="text-xs sm:text-sm" style="color:var(--text-muted)">Perlu Restock</div>
            </div>
        </div>
    </div>
    <div class="rounded-xl shadow-md p-4 sm:p-6" style="background:var(--card-bg);border:1px solid var(--card-border)">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background:rgba(249,115,22,0.1);color:var(--accent)">
                <i class="uil uil-times-circle"></i>
            </div>
            <div>
                <div class="text-2xl font-bold" style="color:var(--text-main)">{{ $products->where('stock', 0)->count() }}</div>
                <div class="text-xs sm:text-sm" style="color:var(--text-muted)">Stok Habis</div>
            </div>
        </div>
    </div>
    <div class="rounded-xl shadow-md p-4 sm:p-6" style="background:var(--card-bg);border:1px solid var(--card-border)">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl" style="background:rgba(234,179,8,0.1);color:#eab308">
                <i class="uil uil-info-circle"></i>
            </div>
            <div>
                <div class="text-2xl font-bold" style="color:var(--text-main)">{{ $threshold }}</div>
                <div class="text-xs sm:text-sm" style="color:var(--text-muted)">Batas Stok Minimum</div>
            </div>
        </div>
    </div>
</div>

{{-- Export Buttons --}}
<div class="flex gap-3 mb-6 flex-wrap">
    <a href="{{ route('seller.reports.restock.export') }}" class="px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-all shadow-md text-white" style="background:linear-gradient(135deg,#ef4444,#dc2626)">
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
        <h2 class="text-lg font-semibold" style="color:var(--text-main)">Daftar Produk Perlu Restock</h2>
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
                    <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider" style="color:var(--text-muted)">Stock</th>
                </tr>
            </thead>
            <tbody style="color:var(--text-main)">
                @forelse($products as $index => $product)
                <tr class="hover:bg-opacity-50 transition-colors {{ $product->stock == 0 ? 'bg-red-500/5' : '' }}" style="border-bottom:1px solid var(--card-border)">
                    <td class="px-6 py-4 text-center text-sm">{{ $index + 1 }}</td>
                    <td class="px-6 py-4 text-sm">
                        <div class="flex items-center gap-2">
                            @if($product->stock == 0)
                            <i class="uil uil-exclamation-circle" style="color:#ef4444;font-size:18px"></i>
                            @endif
                            <span class="font-medium">{{ $product->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm">{{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}</td>
                    <td class="px-6 py-4 text-sm text-right">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-center">
                        @if($product->stock == 0)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium" style="background:rgba(239,68,68,0.1);color:#ef4444">HABIS</span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium" style="background:rgba(234,179,8,0.1);color:#eab308">{{ $product->stock }} unit</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <i class="uil uil-check-circle text-4xl sm:text-5xl mb-3" style="color:#22c55e"></i>
                        <p class="text-sm sm:text-base" style="color:#22c55e">Semua produk memiliki stok yang cukup!</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endif

{{-- Info Box --}}
<div class="mt-6 p-4 rounded-xl" style="background:rgba(59,130,246,0.1);border:1px solid rgba(59,130,246,0.3)">
    <p class="text-sm" style="color:#3b82f6"><strong>Keterangan:</strong></p>
    <p class="text-sm" style="color:#3b82f6">***) Diurutkan berdasarkan kategori dan produk alfabetis</p>
    <p class="text-sm" style="color:#3b82f6">***) Stock produk yang segera dipesan jika stock &lt; {{ $threshold }}</p>
</div>
</div>
@endsection
