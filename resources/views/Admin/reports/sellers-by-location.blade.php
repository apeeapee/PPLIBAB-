@extends('layouts.admin')

@push('styles')
<style>
/* Ensure all elements are properly styled */
.badge { display: inline-flex; align-items: center; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 500; }
.btn { display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.375rem 0.75rem; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 500; transition: all 0.2s; }
</style>
@endpush

@section('content')
    <!-- Header -->
    <div class="mb-6 sm:mb-8">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white mb-2">Penjual per Lokasi</h1>
                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Distribusi toko berdasarkan lokasi provinsi</p>
            </div>
            <div class="text-center sm:text-right bg-gradient-to-br from-orange-500 to-orange-600 px-4 sm:px-6 py-3 sm:py-4 rounded-xl shadow-lg text-white">
                <div class="text-xs sm:text-sm opacity-90 mb-1">{{ now()->format('d F Y') }}</div>
                <div class="text-2xl sm:text-3xl font-bold">{{ $totalSellers }}</div>
                <div class="text-xs sm:text-sm opacity-90">Total Toko Aktif</div>
            </div>
        </div>
    </div>

    <div class="my-6 sm:my-8">
        <div class="h-1 bg-gradient-to-r from-orange-200 via-orange-500 to-orange-200 dark:from-orange-900 dark:via-orange-600 dark:to-orange-900 rounded-full shadow-md"></div>
    </div>

    <!-- Filter Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 sm:p-6 border border-gray-200 dark:border-gray-700 mb-6 sm:mb-8">
        <form method="GET" action="{{ route('admin.reports.sellers-location') }}">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Filter Lokasi</label>
                    <select name="location" class="w-full px-4 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                        <option value="">Semua Lokasi</option>
                        @foreach($sellersByLocation as $location)
                            <option value="{{ $location->$groupBy }}" {{ request('location') == $location->$groupBy ? 'selected' : '' }}>
                                {{ $location->$groupBy }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end gap-2 flex-wrap">
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all shadow-md font-medium flex items-center gap-2">
                        <i class="uil uil-filter"></i> Filter
                    </button>
                    <a href="{{ route('admin.reports.sellers-location') }}" class="px-4 py-2 bg-gray-600 dark:bg-gray-700 text-white rounded-lg hover:bg-gray-700 dark:hover:bg-gray-600 transition-all shadow-md font-medium flex items-center gap-2">
                        <i class="uil uil-redo"></i> Reset
                    </a>
                    <a href="{{ route('admin.reports.sellers-location.export-excel', request()->all()) }}" class="px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 transition-all shadow-md font-medium flex items-center gap-2">
                        <i class="uil uil-file-download-alt"></i> Excel
                    </a>
                    <a href="{{ route('admin.reports.sellers-location.export-pdf', request()->all()) }}" class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all shadow-md font-medium flex items-center gap-2">
                        <i class="uil uil-file-pdf-alt"></i> PDF
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="my-6 sm:my-8">
        <div class="h-1 bg-gradient-to-r from-orange-200 via-orange-500 to-orange-200 dark:from-orange-900 dark:via-orange-600 dark:to-orange-900 rounded-full shadow-md"></div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-6 sm:mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 sm:p-6 border border-gray-200 dark:border-gray-700">
            <div class="text-center">
                <div class="text-2xl font-bold text-orange-600 dark:text-orange-400">{{ $totalSellers }}</div>
                <div class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Total Toko</div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 sm:p-6 border border-gray-200 dark:border-gray-700">
            <div class="text-center">
                <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $sellersByLocation->count() }}</div>
                <div class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Jumlah {{ ucfirst($groupBy) }}</div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 sm:p-6 border border-gray-200 dark:border-gray-700">
            <div class="text-center">
                <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $sellersByLocation->max('total') }}</div>
                <div class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Toko Terbanyak</div>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 sm:p-6 border border-gray-200 dark:border-gray-700">
            <div class="text-center">
                <div class="text-2xl font-bold text-purple-600 dark:text-purple-400">
                    {{ $sellersByLocation->count() > 0 ? round($totalSellers / $sellersByLocation->count(), 1) : 0 }}
                </div>
                <div class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Rata-rata/Provinsi</div>
            </div>
        </div>
    </div>

    <!-- Location Distribution -->
    @if(!$selectedLocation)
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden mb-6 sm:mb-8">
        <div class="px-4 sm:px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Distribusi Toko per {{ ucfirst($groupBy) }}</h2>
            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-1">Jumlah toko berdasarkan lokasi</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ ucfirst($groupBy) }}</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Jumlah Toko</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Persentase</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($sellersByLocation as $index => $location)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-4 text-center text-sm text-gray-900 dark:text-gray-200">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">{{ $location->$groupBy }}</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-900 dark:text-gray-200">{{ $location->total }} Toko</td>
                        <td class="px-6 py-4 text-center text-sm text-gray-900 dark:text-gray-200">
                            {{ $totalSellers > 0 ? round(($location->total / $totalSellers) * 100, 1) : 0 }}%
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($location->total >= 20)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">TINGGI</span>
                            @elseif($location->total >= 10)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300">SEDANG</span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">RENDAH</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="?location={{ urlencode($location->$groupBy) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all shadow-sm text-xs font-medium">
                                <i class="uil uil-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="text-center">
                                <i class="uil uil-map-marker text-4xl text-gray-400 mb-2"></i>
                                <p class="text-gray-500">Tidak ada data lokasi</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Detail Location (if selected) - SRS-10 Format: No | Nama Toko | Nama PIC | Propinsi -->
    @if($selectedLocation && $sellersDetail)
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="px-4 sm:px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
            <div>
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Laporan Daftar Toko Berdasarkan Lokasi Propinsi</h2>
                <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-1">Tanggal dibuat: {{ now()->format('d-m-Y') }} oleh {{ auth()->user()->name ?? 'Admin' }}</p>
            </div>
            <a href="{{ route('admin.reports.sellers-location') }}" class="px-4 py-2 bg-gray-600 dark:bg-gray-700 text-white rounded-lg hover:bg-gray-700 dark:hover:bg-gray-600 transition-all shadow-md font-medium flex items-center gap-2 text-sm">
                <i class="uil uil-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nama Toko</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Nama PIC</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Propinsi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($sellersDetail as $index => $seller)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-4 text-center text-sm text-gray-900 dark:text-gray-200">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">{{ $seller->nama_toko }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ $seller->nama_pic }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ $seller->provinsi ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="text-center">
                                <i class="uil uil-store text-4xl sm:text-5xl text-gray-400 dark:text-gray-600 mb-3"></i>
                                <p class="text-sm sm:text-base text-gray-500 dark:text-gray-400">Tidak ada toko di lokasi ini</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <!-- Keterangan -->
    <div class="mt-6 bg-blue-50 dark:bg-blue-900/20 rounded-xl p-4 border border-blue-200 dark:border-blue-700">
        <p class="text-sm text-blue-700 dark:text-blue-300"><strong>Keterangan:</strong> ***) Diurutkan berdasarkan propinsi alfabetis</p>
    </div>
@endsection