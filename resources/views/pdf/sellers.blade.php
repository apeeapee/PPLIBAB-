@extends('pdf.layout')

@section('content')
{{-- SRS-MartPlace-09: Laporan daftar akun penjual aktif dan tidak aktif (format PDF) --}}

<div class="srs-reference">
    <strong>Referensi SRS:</strong> SRS-MartPlace-09 - Laporan daftar akun penjual aktif dan tidak aktif (format PDF)
</div>

<div class="stats-row">
    <div class="stat-box">
        <div class="value">{{ $sellers->count() }}</div>
        <div class="label">Total Penjual</div>
    </div>
    <div class="stat-box">
        <div class="value">{{ $sellers->where('status', 'approved')->count() }}</div>
        <div class="label">Aktif</div>
    </div>
    <div class="stat-box">
        <div class="value">{{ $sellers->where('status', 'pending')->count() }}</div>
        <div class="label">Tidak Aktif (Pending)</div>
    </div>
    <div class="stat-box">
        <div class="value">{{ $sellers->where('status', 'rejected')->count() }}</div>
        <div class="label">Tidak Aktif (Ditolak)</div>
    </div>
</div>

<div class="info-box">
    <p><strong>Jenis Laporan:</strong> Daftar akun penjual aktif dan tidak aktif</p>
    <p><strong>Format:</strong> PDF</p>
    <p><strong>Periode:</strong> Semua data hingga {{ now()->format('d F Y H:i') }}</p>
    <p><strong>Total Data:</strong> {{ $sellers->count() }} penjual</p>
    <p><strong>Distribusi Status:</strong> Aktif: {{ $sellers->where('status', 'approved')->count() }} | Pending: {{ $sellers->where('status', 'pending')->count() }} | Ditolak: {{ $sellers->where('status', 'rejected')->count() }}</p>
</div>

<table>
    <thead>
        <tr>
            <th style="width:5%">No</th>
            <th style="width:20%">Nama Toko</th>
            <th style="width:15%">Nama PIC</th>
            <th style="width:15%">Email PIC</th>
            <th style="width:15%">No HP PIC</th>
            <th style="width:15%">Kota</th>
            <th style="width:15%">Provinsi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($sellers as $index => $seller)
        <tr @if($seller->status === 'approved') class="highlight-row" @endif>
            <td class="text-center">{{ $index + 1 }}</td>
            <td><strong>{{ $seller->nama_toko }}</strong></td>
            <td>{{ $seller->nama_pic }}</td>
            <td>{{ $seller->email_pic }}</td>
            <td class="text-center">{{ $seller->no_hp_pic }}</td>
            <td>{{ $seller->kota }}</td>
            <td>{{ $seller->provinsi }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="no-data">Tidak ada data penjual tersedia</td>
        </tr>
        @endforelse
    </tbody>
</table>

@if($sellers->count() > 0)
<div class="page-break"></div>

<div class="info-box">
    <p><strong>Ringkasan Status:</strong></p>
    <p>• <strong>Aktif:</strong> {{ $sellers->where('status', 'approved')->count() }} penjual yang telah diverifikasi dan dapat melakukan transaksi</p>
    <p>• <strong>Pending:</strong> {{ $sellers->where('status', 'pending')->count() }} penjual yang sedang dalam proses verifikasi</p>
    <p>• <strong>Ditolak:</strong> {{ $sellers->where('status', 'rejected')->count() }} penjual yang tidak memenuhi syarat administrasi</p>
</div>

<table>
    <thead>
        <tr>
            <th>Status</th>
            <th>Jumlah</th>
            <th>Persentase</th>
            <th>Deskripsi</th>
        </tr>
    </thead>
    <tbody>
        <tr class="highlight-row">
            <td><span class="badge badge-success">Aktif</span></td>
            <td class="text-center">{{ $sellers->where('status', 'approved')->count() }}</td>
            <td class="text-center">{{ $sellers->count() > 0 ? round(($sellers->where('status', 'approved')->count() / $sellers->count()) * 100, 1) : 0 }}%</td>
            <td>Dapat menjual produk di marketplace</td>
        </tr>
        <tr>
            <td><span class="badge badge-warning">Pending</span></td>
            <td class="text-center">{{ $sellers->where('status', 'pending')->count() }}</td>
            <td class="text-center">{{ $sellers->count() > 0 ? round(($sellers->where('status', 'pending')->count() / $sellers->count()) * 100, 1) : 0 }}%</td>
            <td>Sedang dalam proses verifikasi</td>
        </tr>
        <tr>
            <td><span class="badge badge-danger">Ditolak</span></td>
            <td class="text-center">{{ $sellers->where('status', 'rejected')->count() }}</td>
            <td class="text-center">{{ $sellers->count() > 0 ? round(($sellers->where('status', 'rejected')->count() / $sellers->count()) * 100, 1) : 0 }}%</td>
            <td>Tidak memenuhi syarat administrasi</td>
        </tr>
    </tbody>
</table>
@endif

<div class="info-box" style="margin-top: 30px;">
    <p><strong>Keterangan SRS-MartPlace-09:</strong></p>
    <p>Platform menyediakan laporan daftar akun penjual aktif dan tidak aktif dalam format PDF yang dapat diunduh oleh admin.</p>
    <p>Laporan ini mencakup informasi lengkap penjual dan status verifikasi akun untuk monitoring sistem.</p>
</div>
@endsection
