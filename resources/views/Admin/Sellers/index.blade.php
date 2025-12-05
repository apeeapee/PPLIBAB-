@extends('layouts.admin')

@section('content')
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Pengajuan Toko</h1>
                <p class="text-gray-600 dark:text-gray-400">Kelola pengajuan pembukaan toko dari penjual</p>
            </div>
            <div class="text-center sm:text-right bg-gradient-to-br from-orange-500 to-orange-600 px-4 sm:px-6 py-3 sm:py-4 rounded-xl shadow-lg text-white">
                <div class="text-xs sm:text-sm opacity-90 mb-1">{{ now()->format('d F Y') }}</div>
                <div class="text-2xl sm:text-3xl font-bold">{{ $sellers->count() }}</div>
                <div class="text-xs sm:text-sm opacity-90">Total Pengajuan</div>
            </div>
        </div>
    </div>

    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700 hover:scale-105 transition-transform">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Pending</div>
                    <div class="text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $pending }}</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-2">Menunggu verifikasi</div>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="uil uil-clock text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700 hover:scale-105 transition-transform">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Disetujui</div>
                    <div class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $approved }}</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-2">Toko aktif</div>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="uil uil-check-circle text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700 hover:scale-105 transition-transform">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm text-gray-500 dark:text-gray-400 mb-1">Ditolak</div>
                    <div class="text-3xl font-bold text-red-600 dark:text-red-400">{{ $rejected }}</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-2">Pengajuan ditolak</div>
                </div>
                <div class="w-16 h-16 bg-gradient-to-br from-red-400 to-red-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="uil uil-times-circle text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Applications Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Daftar Pengajuan</h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Klik "Lihat Detail" untuk review pengajuan</p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Toko</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">PIC</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($sellers as $seller)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $seller->nama_toko }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ Str::limit($seller->deskripsi_singkat ?? '-', 50) }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $seller->nama_pic }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $seller->no_hp_pic }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900 dark:text-white">{{ $seller->kelurahan ?? '-' }}</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">{{ $seller->kota ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($seller->status === 'pending')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300">
                                    <i class="uil uil-clock mr-1"></i> Pending
                                </span>
                            @elseif($seller->status === 'approved')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                    <i class="uil uil-check mr-1"></i> Disetujui
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">
                                    <i class="uil uil-times mr-1"></i> Ditolak
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.sellers.show', $seller) }}" class="inline-flex items-center px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white text-sm font-medium rounded-lg transition-colors">
                                <i class="uil uil-eye mr-1"></i> Lihat Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="text-center">
                                <i class="uil uil-folder-open text-5xl text-gray-400 dark:text-gray-600 mb-3"></i>
                                <p class="text-gray-500 dark:text-gray-400">Belum ada pengajuan toko</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection