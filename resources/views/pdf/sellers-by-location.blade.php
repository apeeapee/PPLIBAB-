@extends('pdf.layout')

@section('content')
{{-- SRS-MartPlace-10: Laporan daftar penjual (toko) untuk setiap lokasi provinsi (format PDF) --}}

<div class="srs-reference">
    <strong>Referensi SRS:</strong> SRS-MartPlace-10 - Laporan daftar penjual (toko) untuk setiap lokasi provinsi (format PDF)
</div>

<div class="stats-row">
    <div class="stat-box">
        <div class="value">{{ $totalSellers }}</div>
        <div class="label">Total Toko Aktif</div>
    </div>
    <div class="stat-box">
        <div class="value">{{ $sellersByLocation->count() }}</div>
        <div class="label">Jumlah Provinsi</div>
    </div>
    <div class="stat-box">
        <div class="value">{{ $sellersByLocation->max('total') }}</div>
        <div class="label">Toko Terbanyak</div>
    </div>
    <div class="stat-box">
        <div class="value">{{ $sellersByLocation->min('total') ?? 0 }}</div>
        <div class="label">Toko Paling Sedikit</div>
    </div>
</div>

<div class="info-box">
    <p><strong>Jenis Laporan:</strong> Daftar penjual (toko) untuk setiap lokasi provinsi</p>
    <p><strong>Format:</strong> PDF</p>
    <p><strong>Filter:</strong> Hanya toko dengan status AKTIF (approved)</p>
    <p><strong>Total Penjual Aktif:</strong> {{ $totalSellers }} toko</p>
    <p><strong>Jumlah Lokasi:</strong> {{ $sellersByLocation->count() }} provinsi</p>
    @if($selectedLocation)
    <p><strong>Provinsi Dipilih:</strong> {{ $selectedLocation }}</p>
    @endif
</div>

<h3 style="margin-bottom: 15px; color: #f97316;">📍 Distribusi Toko per Provinsi</h3>
<table>
    <thead>
        <tr>
            <th style="width:5%">No</th>
            <th style="width:25%">Provinsi</th>
            <th style="width:15%">Jumlah Toko</th>
            <th style="width:15%">Persentase</th>
            <th style="width:15%">Status</th>
            <th style="width:25%">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($sellersByLocation as $index => $loc)
        <tr @if($selectedLocation === $loc->provinsi) class="highlight-row" @endif>
            <td class="text-center">{{ $index + 1 }}</td>
            <td><strong>{{ $loc->provinsi ?? '-' }}</strong></td>
            <td class="text-center">{{ $loc->total }} toko</td>
            <td class="text-center">{{ $totalSellers > 0 ? round(($loc->total / $totalSellers) * 100, 1) : 0 }}%</td>
            <td class="text-center">
                @if($loc->total >= 10)
                    <span class="badge badge-success">Tinggi</span>
                @elseif($loc->total >= 5)
                    <span class="badge badge-warning">Sedang</span>
                @else
                    <span class="badge badge-info">Rendah</span>
                @endif
            </td>
            <td class="text-center">
                {{ number_format($loc->total / $totalSellers * 100, 1) }}% dari total
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="no-data">Tidak ada data toko aktif per provinsi</td>
        </tr>
        @endforelse
    </tbody>
</table>

@if($sellersDetail && $sellersDetail->count() > 0)
<div class="page-break"></div>

<div class="info-box">
    <p><strong>Detail Toko di Provinsi:</strong> {{ $selectedLocation }}</p>
    <p><strong>Jumlah Toko:</strong> {{ $sellersDetail->count() }}</p>
    <p><strong>Filter:</strong> Hanya toko dengan status AKTIF</p>
</div>

<h3 style="margin-bottom: 15px; color: #f97316;">📋 Daftar Detail Toko</h3>
<table>
    <thead>
        <tr>
            <th style="width:5%">No</th>
            <th style="width:25%">Nama Toko</th>
            <th style="width:18%">Nama PIC</th>
            <th style="width:18%">Email PIC</th>
            <th style="width:14%">No HP PIC</th>
            <th style="width:20%">Kota</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sellersDetail as $index => $seller)
        <tr class="highlight-row">
            <td class="text-center">{{ $index + 1 }}</td>
            <td><strong>{{ $seller->nama_toko }}</strong></td>
            <td>{{ $seller->nama_pic }}</td>
            <td>{{ $seller->email_pic }}</td>
            <td class="text-center">{{ $seller->no_hp_pic }}</td>
            <td>{{ $seller->kota }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

@if($sellersByLocation->count() > 0)
<div class="page-break"></div>

<div class="info-box">
    <p><strong>Ringkasan Statistik:</strong></p>
    <p>• <strong>Provinsi Terbanyak:</strong> {{ $sellersByLocation->first()->provinsi }} ({{ $sellersByLocation->first()->total }} toko)</p>
    <p>• <strong>Provinsi Paling Sedikit:</strong> {{ $sellersByLocation->last()->provinsi }} ({{ $sellersByLocation->last()->total }} toko)</p>
    <p>• <strong>Rata-rata Toko per Provinsi:</strong> {{ round($totalSellers / $sellersByLocation->count(), 1) }} toko</p>
</div>

<table>
    <thead>
        <tr>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Persentase</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Provinsi dengan ≥10 Toko</td>
            <td class="text-center">{{ $sellersByLocation->where('total', '>=', 10)->count() }}</td>
            <td class="text-center">{{ $sellersByLocation->count() > 0 ? round(($sellersByLocation->where('total', '>=', 10)->count() / $sellersByLocation->count()) * 100, 1) : 0 }}%</td>
        </tr>
        <tr>
            <td>Provinsi dengan 5-9 Toko</td>
            <td class="text-center">{{ $sellersByLocation->whereBetween('total', [5, 9])->count() }}</td>
            <td class="text-center">{{ $sellersByLocation->count() > 0 ? round(($sellersByLocation->whereBetween('total', [5, 9])->count() / $sellersByLocation->count()) * 100, 1) : 0 }}%</td>
        </tr>
        <tr>
            <td>Provinsi dengan ≤4 Toko</td>
            <td class="text-center">{{ $sellersByLocation->where('total', '<=', 4)->count() }}</td>
            <td class="text-center">{{ $sellersByLocation->count() > 0 ? round(($sellersByLocation->where('total', '<=', 4)->count() / $sellersByLocation->count()) * 100, 1) : 0 }}%</td>
        </tr>
    </tbody>
</table>
@endif

<div class="info-box" style="margin-top: 30px;">
    <p><strong>Keterangan SRS-MartPlace-10:</strong></p>
    <p>Platform menyediakan laporan daftar penjual (toko) untuk setiap lokasi provinsi dalam format PDF.</p>
    <p>Laporan ini hanya mencakup toko dengan status AKTIF untuk memberikan gambaran distribusi geografis marketplace.</p>
</div>
@endsection
