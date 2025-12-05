@extends('pdf.pro-layout')

@section('content')
{{-- SRS-MartPlace-10: Laporan Daftar Toko Berdasarkan Lokasi Propinsi --}}
{{-- Format: No | Nama Toko | Nama PIC | Propinsi --}}
{{-- Urutan: berdasarkan propinsi alfabetis --}}

<h2 class="section-title">LAPORAN DAFTAR TOKO BERDASARKAN LOKASI PROPINSI</h2>

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
            <div class="metadata-label">Total Toko Aktif</div>
            <div class="metadata-value">{{ $totalSellers }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Jumlah Provinsi</div>
            <div class="metadata-value">{{ $sellersByLocation->count() }}</div>
        </div>
    </div>
</div>

@if($sellersDetail && $sellersDetail->count() > 0)
{{-- Detail toko untuk provinsi tertentu --}}
<p style="margin-bottom:15px;font-size:12px;"><strong>Filter Provinsi:</strong> {{ $selectedLocation }}</p>

<table>
    <thead>
        <tr>
            <th style="width:8%">NO</th>
            <th style="width:35%">NAMA TOKO</th>
            <th style="width:30%">NAMA PIC</th>
            <th style="width:27%">PROPINSI</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sellersDetail as $index => $seller)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td><strong>{{ $seller->nama_toko }}</strong></td>
            <td>{{ $seller->nama_pic }}</td>
            <td>{{ $seller->provinsi ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

@else
{{-- Semua toko dikelompokkan per provinsi --}}
@php
    $allSellers = \App\Models\Seller::where('status', 'approved')
        ->whereNotNull('provinsi')
        ->orderBy('provinsi', 'asc')
        ->orderBy('nama_toko', 'asc')
        ->get();
@endphp

<table>
    <thead>
        <tr>
            <th style="width:8%">NO</th>
            <th style="width:35%">NAMA TOKO</th>
            <th style="width:30%">NAMA PIC</th>
            <th style="width:27%">PROPINSI</th>
        </tr>
    </thead>
    <tbody>
        @forelse($allSellers as $index => $seller)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td><strong>{{ $seller->nama_toko }}</strong></td>
            <td>{{ $seller->nama_pic }}</td>
            <td>{{ $seller->provinsi ?? '-' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="no-data">Tidak ada data toko tersedia</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endif

<div class="warning-box" style="background:#f0f9ff;border-color:#3b82f6;">
    <p style="color:#1e40af;"><strong>KETERANGAN:</strong></p>
    <p style="color:#1e40af;">***) Diurutkan berdasarkan propinsi alfabetis</p>
</div>
@endsection
