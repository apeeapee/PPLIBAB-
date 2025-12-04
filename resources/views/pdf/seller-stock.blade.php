@extends('pdf.layout')

@section('content')
<h3 style="margin-bottom: 20px; color: #f97316;">Laporan Stok Produk</h3>
<table>
    <thead>
        <tr>
            <th style="width:5%">No</th>
            <th style="width:40%">Nama Produk</th>
            <th style="width:18%">Kategori</th>
            <th style="width:17%">Harga</th>
            <th style="width:10%">Stok</th>
            <th style="width:10%">Rating</th>
        </tr>
    </thead>
    <tbody>
        @forelse($products as $index => $product)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ ucfirst(str_replace('-', ' ', $product->category_slug)) }}</td>
            <td class="text-right">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
            <td class="text-center">{{ $product->stock }}</td>
            <td class="text-center">
                @if($product->avg_rating > 0)
                    {{ number_format($product->avg_rating, 1) }} ★
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

@if($products->count() > 0)
<p style="margin-top: 20px; font-size: 12px; color: #6b7280;">
    Total: {{ $products->count() }} produk | Total Stok: {{ $products->sum('stock') }} unit
</p>
@endif
@endsection
