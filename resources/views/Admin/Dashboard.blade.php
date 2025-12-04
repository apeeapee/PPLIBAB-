@extends('layouts.admin')

@section('content')
    <!-- Header Section -->
    <div class="mb-6 sm:mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-2">Dashboard Admin</h1>
                <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Kelola pengajuan toko dan pantau aktivitas marketplace</p>
            </div>
            <div class="bg-gradient-to-br from-orange-500 to-orange-600 px-4 sm:px-6 py-3 sm:py-4 rounded-xl shadow-lg text-white">
                <div class="text-xs sm:text-sm opacity-90 mb-1">{{ now()->format('d F Y') }}</div>
                <div class="text-2xl sm:text-3xl font-bold">{{ $total }}</div>
                <div class="text-xs sm:text-sm opacity-90">Total Pengajuan</div>
            </div>
        </div>
    </div>

    <!-- Divider -->
    <div class="my-6 sm:my-8"><div class="h-1 bg-gradient-to-r from-orange-200 via-orange-500 to-orange-200 dark:from-orange-900 dark:via-orange-600 dark:to-orange-900 rounded-full shadow-md"></div></div>

    <!-- Stats Overview -->
    <div class="mb-6 sm:mb-8">
        <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-4">Statistik Pengajuan</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-xl p-4 sm:p-6 border-2 border-transparent hover:border-yellow-400 dark:hover:border-yellow-600 transition-all duration-300">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex-1">
                        <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Pending</p>
                        <p class="text-2xl sm:text-3xl font-bold text-yellow-600 dark:text-yellow-400">{{ $pending }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ number_format($pPct, 1) }}% dari total</p>
                    </div>
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-yellow-400 to-yellow-500 rounded-2xl flex items-center justify-center shadow-lg flex-shrink-0">
                        <i class="uil uil-clock text-white text-xl sm:text-2xl"></i>
                    </div>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-3">
                    <div class="bg-yellow-500 h-2 rounded-full transition-all duration-500" style="width: {{ $pPct }}%"></div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-xl p-4 sm:p-6 border-2 border-transparent hover:border-green-400 dark:hover:border-green-600 transition-all duration-300">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex-1">
                        <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Disetujui</p>
                        <p class="text-2xl sm:text-3xl font-bold text-green-600 dark:text-green-400">{{ $approved }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ number_format($aPct, 1) }}% dari total</p>
                    </div>
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-green-400 to-green-500 rounded-2xl flex items-center justify-center shadow-lg flex-shrink-0">
                        <i class="uil uil-check-circle text-white text-xl sm:text-2xl"></i>
                    </div>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-3">
                    <div class="bg-green-500 h-2 rounded-full transition-all duration-500" style="width: {{ $aPct }}%"></div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-xl p-4 sm:p-6 border-2 border-transparent hover:border-red-400 dark:hover:border-red-600 transition-all duration-300 sm:col-span-2 lg:col-span-1">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex-1">
                        <p class="text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Ditolak</p>
                        <p class="text-2xl sm:text-3xl font-bold text-red-600 dark:text-red-400">{{ $rejected }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ number_format($rPct, 1) }}% dari total</p>
                    </div>
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gradient-to-br from-red-400 to-red-500 rounded-2xl flex items-center justify-center shadow-lg flex-shrink-0">
                        <i class="uil uil-times-circle text-white text-xl sm:text-2xl"></i>
                    </div>
                </div>
                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 mt-3">
                    <div class="bg-red-500 h-2 rounded-full transition-all duration-500" style="width: {{ $rPct }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Divider -->
    <div class="my-6 sm:my-8"><div class="h-1 bg-gradient-to-r from-orange-200 via-orange-500 to-orange-200 dark:from-orange-900 dark:via-orange-600 dark:to-orange-900 rounded-full shadow-md"></div></div>

    <!-- Charts Row 1 -->
    <div class="mb-6 sm:mb-8">
        <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-4">Statistik Pengguna</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
            <!-- Seller Statistics -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 sm:p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white">Statistik Penjual</h3>
                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-1">Jumlah penjual aktif dan tidak aktif</p>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="uil uil-users-alt text-white text-lg"></i>
                    </div>
                </div>

                <div class="bg-gray-50 dark:bg-gray-900 rounded-xl p-4 mb-4">
                    <div class="flex justify-center items-end space-x-8 sm:space-x-12 h-40 sm:h-48">
                        <div class="flex flex-col items-center group cursor-pointer">
                            <div class="text-base sm:text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $approved }}</div>
                            <div class="w-16 sm:w-20 bg-gradient-to-t from-green-500 to-green-400 rounded-t-lg shadow-lg transition-all group-hover:scale-105"
                                 style="height: {{ max(40, ($total > 0 ? ($approved / $total) * 100 : 0) * 1.5) }}px;"></div>
                            <div class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-3 font-medium">Aktif</div>
                        </div>
                        <div class="flex flex-col items-center group cursor-pointer">
                            <div class="text-base sm:text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $pending + $rejected }}</div>
                            <div class="w-16 sm:w-20 bg-gradient-to-t from-red-500 to-red-400 rounded-t-lg shadow-lg transition-all group-hover:scale-105"
                                 style="height: {{ max(40, ($total > 0 ? (($pending + $rejected) / $total) * 100 : 0) * 1.5) }}px;"></div>
                            <div class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-3 font-medium">Tidak Aktif</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Review Statistics -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 sm:p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white">Statistik Review</h3>
                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-1">Jumlah reviewer dan ulasan produk</p>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="uil uil-star text-white text-lg"></i>
                    </div>
                </div>

                <div class="bg-gray-50 dark:bg-gray-900 rounded-xl p-4 mb-4">
                    <div class="flex justify-center items-end space-x-8 sm:space-x-12 h-40 sm:h-48">
                        <div class="flex flex-col items-center group cursor-pointer">
                            <div class="text-base sm:text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $totalReviews }}</div>
                            <div class="w-16 sm:w-20 bg-gradient-to-t from-blue-500 to-blue-400 rounded-t-lg shadow-lg transition-all group-hover:scale-105"
                                 style="height: {{ max(40, min(140, ($totalReviews / 10) * 1.5)) }}px;"></div>
                            <div class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-3 font-medium">Total Review</div>
                        </div>
                        <div class="flex flex-col items-center group cursor-pointer">
                            <div class="text-base sm:text-lg font-bold text-gray-900 dark:text-white mb-2">{{ $uniqueReviewers }}</div>
                            <div class="w-16 sm:w-20 bg-gradient-to-t from-orange-500 to-orange-400 rounded-t-lg shadow-lg transition-all group-hover:scale-105"
                                 style="height: {{ max(40, min(140, ($uniqueReviewers / 10) * 1.5)) }}px;"></div>
                            <div class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-3 font-medium">Reviewer</div>
                        </div>
                    </div>
                </div>

                <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                    <div class="grid grid-cols-2 gap-3">
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-3 text-center">
                            <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">User Terdaftar</div>
                            <div class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white">{{ $userReviewers }}</div>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-3 text-center">
                            <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Guest Reviewer</div>
                            <div class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white">{{ $guestReviewers }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Divider -->
    <div class="my-6 sm:my-8"><div class="h-1 bg-gradient-to-r from-orange-200 via-orange-500 to-orange-200 dark:from-orange-900 dark:via-orange-600 dark:to-orange-900 rounded-full shadow-md"></div></div>

    <!-- Charts Row 2 -->
    <div class="mb-6 sm:mb-8">
        <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-4">Distribusi Data</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
            <!-- Products by Category -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 sm:p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white">Produk per Kategori</h3>
                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-1">Distribusi produk berdasarkan kategori</p>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="uil uil-apps text-white text-lg"></i>
                    </div>
                </div>

                @if($productsByCategory->count() > 0)
                    @php($maxCategoryProducts = $productsByCategory->max('total'))
                    <div class="bg-gray-50 dark:bg-gray-900 rounded-xl p-4">
                        <div class="flex justify-start items-end space-x-2 sm:space-x-3 h-40 sm:h-48 overflow-x-auto pb-2">
                            @foreach($productsByCategory->take(8) as $category)
                                <div class="flex flex-col items-center flex-shrink-0 group cursor-pointer">
                                    <div class="text-xs sm:text-sm font-bold text-gray-900 dark:text-white mb-2">{{ $category['total'] }}</div>
                                    <div class="w-10 sm:w-14 bg-gradient-to-t from-indigo-500 to-indigo-400 rounded-t-lg shadow-lg transition-all group-hover:scale-105"
                                         style="height: {{ max(30, ($category['total'] / $maxCategoryProducts) * 120) }}px;"></div>
                                    <div class="text-[10px] sm:text-xs text-gray-600 dark:text-gray-400 mt-3 w-10 sm:w-14 text-center truncate font-medium" title="{{ $category['category'] }}">
                                        {{ Str::limit($category['category'], 6) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="text-center py-12 sm:py-16 text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-900 rounded-xl">
                        <i class="uil uil-package text-4xl sm:text-5xl mb-3 opacity-50"></i>
                        <p class="text-xs sm:text-sm">Belum ada data produk</p>
                    </div>
                @endif
            </div>

            <!-- Sellers by Province -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 sm:p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white">Toko per Provinsi</h3>
                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-1">Distribusi toko berdasarkan lokasi</p>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="uil uil-map-marker text-white text-lg"></i>
                    </div>
                </div>

                @if($sellersByProvince->count() > 0)
                    @php($maxProvinceSellers = $sellersByProvince->max('total'))
                    <div class="bg-gray-50 dark:bg-gray-900 rounded-xl p-4 mb-4">
                        <div class="flex justify-start items-end space-x-2 sm:space-x-3 h-40 sm:h-48 overflow-x-auto pb-2">
                            @foreach($sellersByProvince->take(8) as $province)
                                <div class="flex flex-col items-center flex-shrink-0 group cursor-pointer">
                                    <div class="text-xs sm:text-sm font-bold text-gray-900 dark:text-white mb-2">{{ $province->total }}</div>
                                    <div class="w-10 sm:w-14 bg-gradient-to-t from-pink-500 to-pink-400 rounded-t-lg shadow-lg transition-all group-hover:scale-105"
                                         style="height: {{ max(30, ($province->total / $maxProvinceSellers) * 120) }}px;"></div>
                                    <div class="text-[10px] sm:text-xs text-gray-600 dark:text-gray-400 mt-3 w-10 sm:w-14 text-center truncate font-medium" title="{{ $province->provinsi }}">
                                        {{ Str::limit($province->provinsi, 6) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                        <div class="grid grid-cols-2 gap-2 sm:gap-3">
                            @foreach($sellersByProvince->take(4) as $province)
                                <div class="bg-gray-50 dark:bg-gray-900 rounded-lg p-2 sm:p-3">
                                    <div class="text-[10px] sm:text-xs text-gray-500 dark:text-gray-400 truncate mb-1" title="{{ $province->provinsi }}">{{ Str::limit($province->provinsi, 15) }}</div>
                                    <div class="text-sm sm:text-lg font-bold text-gray-900 dark:text-white">{{ $province->total }} <span class="text-[10px] sm:text-xs font-normal text-gray-500 dark:text-gray-400">toko</span></div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="text-center py-12 sm:py-16 text-gray-500 dark:text-gray-400 bg-gray-50 dark:bg-gray-900 rounded-xl">
                        <i class="uil uil-map-marker text-4xl sm:text-5xl mb-3 opacity-50"></i>
                        <p class="text-xs sm:text-sm">Belum ada data toko</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Divider -->
    <div class="my-6 sm:my-8"><div class="h-1 bg-gradient-to-r from-orange-200 via-orange-500 to-orange-200 dark:from-orange-900 dark:via-orange-600 dark:to-orange-900 rounded-full shadow-md"></div></div>

    <!-- Rating Analytics (SRS-MartPlace-08) -->
    <div class="mb-6 sm:mb-8">
        <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-4">Analisis Rating & Review</h2>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
            <!-- Rating Distribution -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 sm:p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white">Sebaran Nilai Rating</h3>
                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-1">Distribusi rating 1-5 bintang</p>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="uil uil-star text-white text-lg"></i>
                    </div>
                </div>

                <div class="space-y-3">
                    @foreach(range(5, 1) as $star)
                        <?php
                        $ratingData = $ratingDistribution->firstWhere('rating', $star);
                        $count = $ratingData ? $ratingData['total'] : 0;
                        $percentage = $totalReviews > 0 ? (($count / $totalReviews) * 100) : 0;
                        ?>
                        <div class="flex items-center gap-3">
                            <div class="flex items-center gap-1 w-20">
                                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">{{ $star }}</span>
                                <i class="uil uil-star text-yellow-500 text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-6">
                                    <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 h-6 rounded-full flex items-center px-2 transition-all duration-500" style="width: {{ $percentage }}%">
                                        <?php if($count > 0): ?>
                                        <span class="text-xs font-semibold text-white">{{ $count }}</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="w-16 text-right">
                                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">{{ number_format($percentage, 1) }}%</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600 dark:text-gray-400">Total Review</span>
                        <span class="text-lg font-bold text-gray-900 dark:text-white">{{ $totalReviews }}</span>
                    </div>
                </div>
            </div>

            <!-- Rating by Province -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-4 sm:p-6 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-900 dark:text-white">Review Berdasarkan Provinsi</h3>
                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-1">Sebaran pemberi rating per lokasi</p>
                    </div>
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                        <i class="uil uil-map-marker text-white text-lg"></i>
                    </div>
                </div>

                <div class="space-y-3 max-h-80 overflow-y-auto">
                    @forelse($ratingsByProvince as $index => $item)
                        <?php
                            $maxReviews = $ratingsByProvince->max('total');
                            $percentage = $maxReviews > 0 ? ($item['total'] / $maxReviews) * 100 : 0;
                            $colors = ['from-blue-500 to-blue-600', 'from-green-500 to-green-600', 'from-purple-500 to-purple-600', 'from-pink-500 to-pink-600', 'from-indigo-500 to-indigo-600'];
                            $color = $colors[$index % count($colors)];
                        ?>
                        <div class="flex items-center gap-3">
                            <div class="w-32 flex-shrink-0">
                                <div class="text-sm font-semibold text-gray-700 dark:text-gray-300 truncate">{{ $item['province'] }}</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1">
                                    <i class="uil uil-star text-yellow-500"></i>
                                    {{ $item['avg_rating'] }}
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-6">
                                    <div class="bg-gradient-to-r {{ $color }} h-6 rounded-full flex items-center justify-between px-2 transition-all duration-500" 
                                         style="width: {{ $percentage }}%">
                                        <span class="text-xs font-semibold text-white">{{ $item['total'] }} review</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <i class="uil uil-map-marker text-gray-300 dark:text-gray-600 text-4xl mb-2"></i>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada data review berdasarkan provinsi</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Top Rated Products -->
    <div class="mb-6 sm:mb-8">
        <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-4">Produk dengan Rating Tertinggi</h2>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Rank</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Produk</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Rating</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Review</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Harga</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($topRatedProducts as $index => $product)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-900 transition-colors">
                                <td class="px-4 py-4">
                                    <div class="flex items-center justify-center w-8 h-8 rounded-full {{ $index === 0 ? 'bg-yellow-500' : ($index === 1 ? 'bg-gray-400' : ($index === 2 ? 'bg-orange-600' : 'bg-gray-300')) }} text-white font-bold text-sm">
                                        {{ $index + 1 }}
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                                             class="w-12 h-12 rounded-lg object-cover">
                                        <div>
                                            <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ Str::limit($product->name, 50) }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $product->seller_name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-1">
                                        <i class="uil uil-star text-yellow-500"></i>
                                        <span class="text-sm font-bold text-gray-900 dark:text-white">{{ number_format($product->avg_rating, 1) }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $product->review_count }} review</span>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="text-sm font-semibold text-orange-600 dark:text-orange-400">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center">
                                    <i class="uil uil-star text-gray-300 dark:text-gray-600 text-4xl mb-2"></i>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Belum ada produk dengan rating</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Divider -->
    <div class="my-6 sm:my-8"><div class="h-1 bg-gradient-to-r from-orange-200 via-orange-500 to-orange-200 dark:from-orange-900 dark:via-orange-600 dark:to-orange-900 rounded-full shadow-md"></div></div>

    <!-- Quick Actions -->
    <div class="mb-6 sm:mb-8">
        <h2 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-white mb-4">Aksi Cepat</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
            <a href="{{ route('admin.sellers.index') }}"
               class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-xl p-4 sm:p-6 border-2 border-transparent hover:border-orange-400 dark:hover:border-orange-600 transition-all duration-300 group">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-orange-400 to-orange-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform flex-shrink-0">
                        <i class="uil uil-folder-open text-white text-xl sm:text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 dark:text-white text-base sm:text-lg mb-1">Pengajuan Toko</h3>
                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Kelola pengajuan pembukaan toko</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.reports.index') }}"
               class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-xl p-4 sm:p-6 border-2 border-transparent hover:border-blue-400 dark:hover:border-blue-600 transition-all duration-300 group">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform flex-shrink-0">
                        <i class="uil uil-chart-bar text-white text-xl sm:text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 dark:text-white text-base sm:text-lg mb-1">Laporan</h3>
                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Lihat laporan dan statistik</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('products.index') }}"
               class="bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-xl p-4 sm:p-6 border-2 border-transparent hover:border-green-400 dark:hover:border-green-600 transition-all duration-300 group sm:col-span-2 lg:col-span-1">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-green-400 to-green-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform flex-shrink-0">
                        <i class="uil uil-shopping-cart text-white text-xl sm:text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 dark:text-white text-base sm:text-lg mb-1">Marketplace</h3>
                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Lihat produk di marketplace</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
