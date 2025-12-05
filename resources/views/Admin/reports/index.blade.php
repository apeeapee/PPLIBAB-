@extends('layouts.admin')

@section('content')
    <!-- Header -->
    <div class="mb-6 sm:mb-8">
        <div class="flex flex-col gap-3">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">Laporan Admin</h1>
            <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Pilih jenis laporan yang ingin Anda lihat dan download</p>
        </div>
    </div>

    <div class="my-6 sm:my-8">
        <div class="h-1 bg-gradient-to-r from-orange-200 via-orange-500 to-orange-200 dark:from-orange-900 dark:via-orange-600 dark:to-orange-900 rounded-full shadow-md"></div>
    </div>

    <!-- Report Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        <!-- Laporan Daftar Penjual -->
        <a href="{{ route('admin.reports.sellers') }}" 
           class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-2xl p-6 border-2 border-transparent hover:border-blue-400 dark:hover:border-blue-600 transition-all duration-300 group transform hover:-translate-y-1">
            <div class="flex flex-col items-center text-center">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center shadow-lg mb-4 group-hover:scale-110 transition-transform">
                    <i class="uil uil-users-alt text-white text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Daftar Penjual</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Laporan seluruh akun penjual terdaftar dengan berbagai status</p>
                <div class="flex items-center gap-2 text-blue-600 dark:text-blue-400 font-semibold">
                    <span>Lihat Laporan</span>
                    <i class="uil uil-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
        </a>

        <!-- Laporan Penjual per Lokasi -->
        <a href="{{ route('admin.reports.sellers-location') }}" 
           class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-2xl p-6 border-2 border-transparent hover:border-green-400 dark:hover:border-green-600 transition-all duration-300 group transform hover:-translate-y-1">
            <div class="flex flex-col items-center text-center">
                <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center shadow-lg mb-4 group-hover:scale-110 transition-transform">
                    <i class="uil uil-map-marker text-white text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Penjual per Lokasi</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Distribusi penjual berdasarkan provinsi dan kabupaten</p>
                <div class="flex items-center gap-2 text-green-600 dark:text-green-400 font-semibold">
                    <span>Lihat Laporan</span>
                    <i class="uil uil-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
        </a>

        <!-- Laporan Peringkat Produk -->
        <a href="{{ route('admin.reports.product-ranking') }}" 
           class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-2xl p-6 border-2 border-transparent hover:border-purple-400 dark:hover:border-purple-600 transition-all duration-300 group transform hover:-translate-y-1">
            <div class="flex flex-col items-center text-center">
                <div class="w-20 h-20 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg mb-4 group-hover:scale-110 transition-transform">
                    <i class="uil uil-award text-white text-4xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Peringkat Produk</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Produk dengan rating tertinggi berdasarkan ulasan pembeli</p>
                <div class="flex items-center gap-2 text-purple-600 dark:text-purple-400 font-semibold">
                    <span>Lihat Laporan</span>
                    <i class="uil uil-arrow-right group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
        </a>

    </div>

    <div class="my-8">
        <div class="h-1 bg-gradient-to-r from-orange-200 via-orange-500 to-orange-200 dark:from-orange-900 dark:via-orange-600 dark:to-orange-900 rounded-full shadow-md"></div>
    </div>

    <!-- Info Section -->
    <div class="bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 rounded-xl p-6 border border-orange-200 dark:border-orange-700">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="uil uil-info-circle text-white text-2xl"></i>
            </div>
            <div>
                <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Informasi Laporan</h4>
                <ul class="space-y-2 text-sm text-gray-700 dark:text-gray-300">
                    <li class="flex items-start gap-2">
                        <i class="uil uil-check text-orange-500 mt-0.5"></i>
                        <span>Setiap laporan dapat difilter berdasarkan periode waktu, status, dan kategori</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="uil uil-check text-orange-500 mt-0.5"></i>
                        <span>Tombol <strong>Excel</strong> untuk download format .xlsx, tombol <strong>Print</strong> untuk download PDF</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="uil uil-check text-orange-500 mt-0.5"></i>
                        <span>Data laporan diperbarui secara real-time sesuai dengan aktivitas di platform</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
