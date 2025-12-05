@extends('pdf.pro-layout')

@section('content')
{{-- SRS-MartPlace-09: Platform Laporan daftar akun penjual aktif dan tidak aktif (format PDF) --}}
{{-- Format: No | Nama User | Nama PIC | Nama Toko | Status --}}
{{-- Urutan: berdasarkan status (aktif dulu baru tidak aktif) --}}

<h2 class="section-title">LAPORAN DAFTAR AKUN PENJUAL BERDASARKAN STATUS</h2>

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
            <div class="metadata-label">Total Penjual</div>
            <div class="metadata-value">{{ $sellers->count() }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Aktif</div>
            <div class="metadata-value">{{ $sellers->where('status', 'approved')->count() }}</div>
        </div>
        <div class="metadata-item">
            <div class="metadata-label">Tidak Aktif</div>
            <div class="metadata-value">{{ $sellers->where('status', 'rejected')->count() + $sellers->where('status', 'pending')->count() }}</div>
        </div>
    </div>
</div>

<table>
    <thead>
        <tr>
            <th style="width:6%">NO</th>
            <th style="width:24%">NAMA USER</th>
            <th style="width:24%">NAMA PIC</th>
            <th style="width:26%">NAMA TOKO</th>
            <th style="width:20%">STATUS</th>
        </tr>
    </thead>
    <tbody>
        @forelse($sellers as $index => $seller)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td>{{ $seller->user->name ?? $seller->nama_pic }}</td>
            <td>{{ $seller->nama_pic }}</td>
            <td><strong>{{ $seller->nama_toko }}</strong></td>
            <td class="text-center">
                @if($seller->status == 'approved')
                    <span class="badge badge-success">Aktif</span>
                @elseif($seller->status == 'pending')
                    <span class="badge badge-warning">Pending</span>
                @else
                    <span class="badge badge-danger">Tidak Aktif</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="no-data">Tidak ada data penjual tersedia</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="warning-box" style="background:#f0f9ff;border-color:#3b82f6;">
    <p style="color:#1e40af;"><strong>KETERANGAN:</strong></p>
    <p style="color:#1e40af;">***) Diurutkan berdasarkan status (aktif dulu baru tidak aktif)</p>
</div>
@endsection
